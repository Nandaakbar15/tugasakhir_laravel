<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;

class StatusPembayaranApiController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::all();
        $data = [
            $pembayaran
        ];

        return response()->json([
            'statusCode' => 200,
            'data' => $data
        ]);
    }
}
