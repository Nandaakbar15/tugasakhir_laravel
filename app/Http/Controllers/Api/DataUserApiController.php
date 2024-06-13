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
        $query1 = Pelanggan::query();
        $query2 = Teknisi::query();

        if($request->has('nama_pelanggan') OR $request->has('email')) {
            $query1->where('nama_pelanggan', 'like', '%' . $request->get('nama_pelanggan') . '%')
                    ->orWhere('email', 'like', '%' . $request->get('email') . '%');
        }

        if($request->has('nama_teknisi') OR $request->has('alamat')) {
            $query2->where('nama_teknisi', 'like', '%' . $request->get('nama_teknisi') . '%')
                    ->orWhere('alamat', 'like', '%' . $request->get('alamat') . '%');
        }

        $data = [
            $query1,
            $query2
        ];

        return response()->json([
            'statusCode' => 200,
            'data' => $data
        ]);
    }
}
