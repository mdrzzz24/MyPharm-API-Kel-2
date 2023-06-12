<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function addcart(Request $request)
    {
        $transaction_date = Carbon::now()->format('Y-m-d');
        $total_price = ($request['price'])*($request['qty']);
        Transaction::create([
            'product_code' => $request -> product_code,
            'product_name' => $request -> product_name,
            'price' => $request -> price,
            'qty' => $request -> qty,
            'total_price' => $total_price,
            'transaction_date' => $transaction_date,
            'payment_method'=> $request -> payment_method,
            'payment_status'=> $request -> payment_status,
            'customer_name'=> $request -> customer_name,
        ]);
        $id = $request['id'];
        $response = Http::get('http://127.0.0.1:9999/api/obat/'.$id);
        $data = json_decode($response->body(), true);
        $product = $data['data'];
        $stock_result = (($product[0]['stock']))-($request['qty']);

        // dd($product[0]['price']);
        $newvalue = [
            'price' => $product[0]['price'],
            'stock' => $stock_result,
            'exp_date' => $product[0]['exp_date'],
        ];
        // dd($newvalue);
        $response = Http::put('http://127.0.0.1:9999/api/updateobat/'.$id, $newvalue);
        $data = json_decode($response->body(), true);
        $code = $data['code'];
        $message = $data['message'];
        $products = $data['data'];
        return redirect('admin');


    }
    public function cart()
    {
        $datatable = Transaction::select('*')
        ->where('payment_status','=','waiting')
        ->where('customer_name','=', 'offline customer')
        ->get();
        $subtotal = $datatable->sum('total_price');

        return view('admin.detailtransaction', compact(['datatable', 'subtotal']));
    }
    public function pay()
    {
        $datatable = Transaction::select('*')
        ->where('payment_status','=','waiting')
        ->get();
        $subtotal = $datatable->sum('total_price');
        $randomDigits = mt_rand(100000, 999999);
        $randomId = 'T0' . $randomDigits;
        $dataToInsert = [];
        foreach ($datatable as $transaction) {
            $transaction->payment_status = 'paid';
            $transaction->save();

            $dataToInsert[] = [
                'transaction_id' => $randomId,
                'product_code' => $transaction -> product_code,
                'product_name' => $transaction -> product_name,
                'qty' => $transaction -> qty,
                'price' => $transaction -> price,
                'total_price' =>  $subtotal,
                'payment_method'=> $transaction -> payment_method,
                'transaction_date' =>  $transaction -> transaction_date,
                'customer_name'=> $transaction -> customer_name,

                // Masukkan nilai dari transaksi ke kolom tabel lain yang sesuai
            ];
        }
        DetailTransaction::insert($dataToInsert);
        return redirect('/admin');
    }
}
