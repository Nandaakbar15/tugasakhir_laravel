<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembayaran;

class StatusPembayaranController extends Controller
{
    public function viewstatusPembayaran() // view status pembayaran
    {
        $pembayaran = Pembayaran::all();
        $username = Auth::user()->name;
        return view('dashboard.statuspembayaran.viewstatuspembayaran', [
            'username' => $username,
            'pembayaran' => $pembayaran
        ]);
    }
}
