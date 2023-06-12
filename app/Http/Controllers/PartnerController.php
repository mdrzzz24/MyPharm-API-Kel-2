<?php

namespace App\Http\Controllers;

use App\Formatter\APIFormatter;
use App\Models\DetailTransaction;
use Exception;
use Illuminate\Http\Request;

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
    public function update(Request $request, string $id)
    {
        try {
            $request -> validate([
                'transaction_id' => 'required',
            ]);

            $st = DetailTransaction::findOrFail($id);

            $st -> update([
                'transaction_id' => $request -> price,
            ]);
            $show = DetailTransaction::where('id', '=', $st->id)->get();

            if ($show){
                if ($show) {
                    return APIFormatter::createApi(200, 'Success update data', $show);
                } else {
                    return APIFormatter::createApi(400, 'Failed');
                }
            }
        } catch (Exception $error) {
            return APIFormatter::createApi(400, 'Failed');
        }
    }
    public function index()
    {
        return view('partnersimulation');
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
}
