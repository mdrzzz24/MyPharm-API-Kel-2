<?php

namespace App\Http\Controllers;

use App\Formatter\APIFormatter;
use App\Models\Kota;
use App\Models\Pengiriman;
use App\Models\services;
use Illuminate\Http\Request;

class EkspedisiController extends Controller
{
    public function services()
    {
        $data = services::all();
        if ($data) {
            return APIFormatter::createApi(200, 'Success', $data);
        } else {
            return APIFormatter::createApi(400, 'Failed');
        }
    }
    public function kota()
    {
        $data = Kota::all();
        if ($data) {
            return APIFormatter::createApi(200, 'Success', $data);
        } else {
            return APIFormatter::createApi(400, 'Failed');
        }
    }
    public function pengiriman()
    {
        $data = Pengiriman::all();
        // ->where('customer_name', '=', Auth::user()->name)
        // ->whereNotIn('status', ['done'])
        // ->get();
        if ($data) {
            return APIFormatter::createApi(200, 'Success', $data);
        } else {
            return APIFormatter::createApi(400, 'Failed');
        }
    }
    public function resi()
    {
        $data = Pengiriman::select('resi')->get();
        if ($data) {
            return APIFormatter::createApi(200, 'Success', $data);
        } else {
            return APIFormatter::createApi(400, 'Failed');
        }
    }

}
