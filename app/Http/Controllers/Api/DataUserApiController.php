<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Teknisi;

class DataUserApiController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();
        $teknisi = Teknisi::all();

        $data = [
            'data Pelanggan' => [
                $pelanggan
            ],
            'data teknisi' => [
                $teknisi
            ]
        ];

        return response()->json([
            'statusCode' => 200,
            'data' => $data
        ]);
    }

    public function cariUser(Request $request) // cari user teknisi atau pelanggan
    {
        $cariUser = $request->input('cari_user');

        $pelanggan = Pelanggan::query() // query mencari data pelanggan
                     ->where('nama_pelanggan', 'like', '%' . $cariUser . '%')
                     ->orWhere('email', 'like', '%' . $cariUser . '%')
                     ->get();

        $teknisi  = Teknisi::query() // query mencari data teknisi
                    ->where('nama_teknisi', 'like', '%' . $cariUser . '%')
                    ->orWhere('alamat', 'like', '%' . $cariUser . '%')
                    ->get();

        $data = [
            $pelanggan,
            $teknisi
        ];

        return response()->json([
            'statusCode' => 200,
            'data' => $data
        ]);
    }
}
