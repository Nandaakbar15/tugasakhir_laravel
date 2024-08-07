<?php

namespace App\Http\Controllers;

use App\Models\ProfilToko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KelolaProfilTokoController extends Controller
{
    public function kelolaprofil_toko()
    {
        $profilToko = ProfilToko::all();
        $username = Auth::user()->name;
        return view('dashboard.kelolaprofiltoko.kelolaprofiltoko', [
            'username' => $username,
            'profilToko' => $profilToko
        ]);
    }

    public function editprofil_toko(ProfilToko $profiltoko_request)
    {
        $username = Auth::user()->name;
        return view('dashboard.kelolaprofiltoko.ubahprofiltoko', [
            'username' => $username,
            'profiltoko_request' => $profiltoko_request
        ]);
    }

    public function updateprofiltoko(Request $request, ProfilToko $profiltoko_request)
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

        return redirect('/dashboard')->with('success', 'Profil Toko berhasil diubah!');
    }

}
