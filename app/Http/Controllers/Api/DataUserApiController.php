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
}
