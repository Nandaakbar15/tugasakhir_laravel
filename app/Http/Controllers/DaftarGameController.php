<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game_request;

class DaftarGameController extends Controller
{
    public function daftar_game()
    {
        $game = Game_request::all();
        return view('dashboardpelanggan.daftargame.daftargame', [
            'game' => $game
        ]);
    }

    public function tambahGame(Request $request)
    {

    }
}
