<?php

namespace App\Http\Controllers\API;

use App\Formatter\APIFormatter;
use App\Http\Controllers\Controller;
use App\Models\Obat;
use Exception;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ShowObat()
    {
        $data = Obat::all();
        if ($data) {
            return APIFormatter::createApi(200, 'Success', $data);
        } else {
            return APIFormatter::createApi(400, 'Failed');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function AddObat(Request $request)
    {
        try {
            $request -> validate([
                'code' => 'required',
                'name' => 'required',
                'category' => 'required',
                'description' => 'required',
                'price' => 'required',
                'stock' => 'required',
                'exp_date' => 'required'
            ]);
            $obat = Obat::create([
                'code' => $request -> code,
                'name' => $request -> name,
                'category' => $request -> category,
                'description' => $request -> description,
                'price' => $request -> price,
                'stock' => $request -> stock,
                'exp_date' => $request -> exp_date,
            ]);

            $show = Obat::where('id', '=', $obat->id)->get();

            if ($show){
                if ($show) {
                    return APIFormatter::createApi(200, 'Success add data', $show);
                } else {
                    return APIFormatter::createApi(400, 'Failed');
                }
            }
        } catch (Exception $error) {
            return APIFormatter::createApi(400, 'Failed');
        }

    }

    /**
     * Display the specified resource.
     */
    public function DetailObat(string $id)
    {
        $obat = Obat::where('id', '=', $id)->get();

        if ($obat) {
            return ApiFormatter::createApi(200, 'Success', $obat);
        } else {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function UpdateObat(Request $request, string $id)
    {
        try {
            $request -> validate([
                'price' => 'required',
                'stock' => 'required',
                'exp_date' => 'required'
            ]);

            $obat = Obat::findOrFail($id);

            $obat -> update([
                'price' => $request -> price,
                'stock' => $request -> stock,
                'exp_date' => $request -> exp_date,
            ]);

            $show = Obat::where('id', '=', $obat->id)->get();

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

    /**
     * Remove the specified resource from storage.
     */
    public function DeleteObat(string $id)
    {
        try {
            $obat = Obat::findOrFail($id);

            $data = $obat->delete();

            if ($data) {
                return ApiFormatter::createApi(200, 'Success Destory data');
            } else {
                return ApiFormatter::createApi(400, 'Failed');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }
}
