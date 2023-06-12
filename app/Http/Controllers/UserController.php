<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index()
    {
        $response = Http::get('http://127.0.0.1:9999/api/obat');
        $data = json_decode($response, true);

        $code = $data['code'];
        $message = $data['message'];
        $products = $data['data'];
        // dd($products);
        return view('home', compact('code', 'message', 'products'));
    }
    public function myorder()
    {
        $data = DetailTransaction::select('*')
        ->where('customer_name','=', Auth::user()->name)
        ->where('payment_status','=', 'waiting')
        ->distinct('payment_id')
        ->get();
        // dd($data);
        return view('myorder', compact(['data']));
    }
    public function ondelivery()
    {

        $response = Http::get('http://127.0.0.1:9999/api/detailpengiriman');
        $data = json_decode($response, true);
        $value = $data['data'];
        $customerName = Auth::user()->name;

        $filteredData = array_filter($data['data'], function ($item) use ($customerName) {
            return $item['customer_name'] === $customerName;
        });
        // dd($filteredData);

        return view('ondelivery', compact(['filteredData']));
    }
}
