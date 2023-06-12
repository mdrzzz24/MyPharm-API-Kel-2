<?php

namespace App\Http\Controllers;

use App\Formatter\APIFormatter;
use App\Models\DetailTransaction;
use App\Models\Pengiriman;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PartnerController extends Controller
{
    public function transaction()
    {
        $data = DetailTransaction::select('*')
        ->where('payment_status','=', 'waiting')
        ->get();
        if ($data) {
            return APIFormatter::createApi(200, 'Success', $data);
        } else {
            return APIFormatter::createApi(400, 'Failed');
        }
    }
    public function index()
    {
        $response = Http::get('http://127.0.0.1:9999/api/detailpengiriman');
        $data = json_decode($response, true);
        $value = $data['data'];
        return view('partnersimulation', compact(['value']));
    }
    public function pay(Request $request)
    {
        $id = $request['transaction_id'];
        $datatable = DetailTransaction::select('*')
        ->where('transaction_id','=',$id)
        ->where('payment_status','=','waiting')
        ->get();
        // dd($datatable);
        foreach ($datatable as $data) {
            $data->payment_status = 'paid';
            $data->save();
        }
        return redirect('/partner');
    }
    public function pengiriman()
    {
        $data = Pengiriman::select('*')
        // ->where('customer_name', '=', Auth::user()->name)
        ->whereNotIn('status', ['done'])
        ->get();
        if ($data) {
            return APIFormatter::createApi(200, 'Success', $data);
        } else {
            return APIFormatter::createApi(400, 'Failed');
        }
    }
    public function status(Request $request)
    {
        $data = Pengiriman::where('resi', $request['resi'])->first();
        if ($data) {
            $data->status = $request['status'];
            $data->save();
            return redirect("/partner");
        } else {
            // Handle the case when the record is not found
            // For example, you could return an error message or redirect back with an error status
        }
        // dd($data);


    }
}
