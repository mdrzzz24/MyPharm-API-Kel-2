<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function index()
    {
        $response = Http::get('http://127.0.0.1:9999/api/obat');
        $data = json_decode($response, true);

        $code = $data['code'];
        $message = $data['message'];
        $products = $data['data'];
        // dd($products);

        $history = DetailTransaction::all();
        // dd($history);
        return view('admin.home', compact('code', 'message', 'products', 'history'));
    }
    public function DetailProduct($id)
    {
        $response = Http::get('http://127.0.0.1:9999/api/obat/'.$id);
        $data = json_decode($response, true);

        $code = $data['code'];
        $message = $data['message'];
        $products = $data['data'];
        // dd($products);
        return view('admin.detailproduct', compact('code', 'message', 'products'));
    }
    public function UpdateProduct($id, Request $request )
    {
        $response = Http::put('http://127.0.0.1:9999/api/updateobat/'.$id, $request->all());
        $data = json_decode($response, true);
        $code = $data['code'];
        $message = $data['message'];
        $products = $data['data'];
        // dd($products);
        return view('admin.detailproduct', compact('code', 'message', 'products'));
    }
    public function AddProduct(Request $request)
    {
        Http::post('http://127.0.0.1:9999/api/addobat?' .http_build_query($request->all()));


        // dd($response);
        return redirect('admin/');
    }
    public function DeleteProduct($id)
    {
        $response = Http::delete('http://127.0.0.1:9999/api/deleteobat/'.$id);
        return redirect('admin/');
    }
    public function find(Request $request)
    {
        $search = $request['search'];
        // dd($search);
        $response = Http::get('http://127.0.0.1:9999/api/obat'); // Ganti URL dengan URL API yang sesuai

        if ($response->successful()) {
            $data = $response->json();

            $products = [];
            foreach ($data['data'] as $item) {
                if ($item['name'] == $search) {
                    $products[] = $item;
                }
            }

            return view('admin.home', compact('products'));
        } else {
            // Handle error response
        }
    }
}
