<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teknisi;
use App\Models\Pelanggan;
use App\Models\Antrian;
use Illuminate\Support\Carbon;

class TeknisiApiController extends Controller
{
    public function index()
    {
        $teknisi = Teknisi::all();
        $data = [
            'teknisi' => $teknisi
        ];
        return response()->json([
            'statusCode' => 200,
            'data' => $data
        ]);
    }

    public function store(Request $request) // tambah teknisi
    {
        $validateData = $request->validate([
            'nama_teknisi' => 'required|max:50',
            'alamat' => 'required',
            'no_telp' => 'required|max:30',
        ]);

        Teknisi::create($validateData);

        return response()->json([
            'statusCode' => 200,
            'message' => 'Data Teknisi berhasil di tambah!'
        ]);
    }

    public function update(Request $request, Teknisi $teknisi)
    {
        $validate = $request->validate([
            'nama_teknisi' => 'required|max:50',
            'alamat' => 'required',
            'no_telp' => 'required|max:30',
        ]);

        $teknisi->update($validate);
        Teknisi::where('id_teknisi', $teknisi->id_teknisi)
             ->update($validate);

        return response()->json([
            'statusCode' => 200,
            'message' => 'Data Teknisi berhasil diubah!'
        ]);
    }

    public function datalaporan_servis() // view data laporan servis
    {
        $pelanggan = Pelanggan::all();
        $currentDate = Carbon::now()->toDateString();
        $antrian = Antrian::whereDate('tgl_servis', '=', $currentDate)->get();
        $data = [
            'pelanggan' => $pelanggan,
            'antrian' => $antrian
        ];
        return response()->json([
            'statusCode' => 200,
            'data' => $data
        ]);
    }
}
