<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teknisi;
use App\Models\Pelanggan;
use App\Models\Antrian;
use App\Models\ProfilToko;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

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

    public function profilToko()
    {
        $profil_toko = ProfilToko::all();
        $data = [
            $profil_toko
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

    public function editprofilToko(Request $request, ProfilToko $profiltoko_request)
    {
        $validatedData = $request->validate([
            'nama_toko' => 'required|max:50',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Change 'required' to 'nullable' for the 'foto' field
        ]);

        // Mengehandle file jika upload file atau gambar baru
        if ($request->hasFile('foto')) {
            // Hapus foto jika masih ada
            if ($profiltoko_request->foto) {
            Storage::delete($profiltoko_request->foto);
            }

            // Upload gambar baru
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $fileName, 'public');
            $validatedData['foto'] = '/storage/' . $path;
        } else {
            // Jika tidak ada file yang di upload, simpan di folder yang sama
            $validatedData['foto'] = $profiltoko_request->foto;
        }

        // Update data profil toko ke database
        $profiltoko_request->update($validatedData);

        return response()->json([
            'statusCode' => 200,
            'message' => 'Profil Toko berhasil diubah!'
        ]);
    }

    public function cari_laporan_servis(Request $request)
    {
        $query = Antrian::query();

        if($request->has('nama_pelanggan') or  $request->has('tgl_servis')) {
            $query->where('nama_pelanggan', 'like', '%' . $request->input('nama_pelanggan') . '%')
                  ->orWhere('tgl_servis', 'like', '%' . $request->input('tgl_servis') . '%');
        }

        $antrian = $query->get();

        $data = [
            $antrian
        ];

        return response()->json([
            'statusCode' => 200,
            'data' => $data
        ]);
    }
}
