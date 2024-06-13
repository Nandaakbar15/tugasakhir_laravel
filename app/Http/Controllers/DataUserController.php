<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pelanggan;
use App\Models\Teknisi;
use Illuminate\Support\Facades\Auth;

class DataUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $username = Auth::user()->name;
        $pelanggan = Pelanggan::all();
        $teknisi = Teknisi::all();
        return view('dashboard.datauser.viewdatauser', [
            'pelanggan' => $pelanggan,
            'teknisi' => $teknisi,
            'username' => $username
        ]);
    }

    public function cariUser(Request $request) // cari user teknisi atau pelanggan
    {
        $username = Auth::user()->name;
        $cariUser = $request->input('cari_user');

        $pelanggan = Pelanggan::query() // query mencari data pelanggan
                     ->where('nama_pelanggan', 'like', '%' . $cariUser . '%')
                     ->orWhere('email', 'like', '%' . $cariUser . '%')
                     ->get();

        $teknisi  = Teknisi::query() // query mencari data teknisi
                    ->where('nama_teknisi', 'like', '%' . $cariUser . '%')
                    ->orWhere('alamat', 'like', '%' . $cariUser . '%')
                    ->get();

        return view('dashboard.datauser.viewdatauser', [
            'username' => $username,
            'pelanggan' => $pelanggan,
            'teknisi' => $teknisi
        ]);
    }
}
