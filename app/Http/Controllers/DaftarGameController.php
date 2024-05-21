<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game_request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DaftarGameController extends Controller
{
    public function daftar_game() // view daftar game
    {
        $game = Game_request::all();
        return view('dashboardpelanggan.daftargame.daftargame', [
            'game' => $game
        ]);
    }

    public function tambahGame(Request $request) // logika untuk tombol tambah ke list
    {
        $user = User::find(Auth::user()->gameList);

        $idGame = $request->input("id_game");

        $game = Game_request::find($idGame);
        if(!$game) {
            return redirect()->with("error", "Game tidak tersedia atau tidak ditemukan!");
        }

        // Check if the game is already in the user's list
        if ($user->gameList()->where('game_request_id', $idGame)->exists()) {
            return redirect('pelanggan/servis')->with("error", "Game sudah ada di dalam list!");
        }

        // Add game to the user's list
        $user->gameList()->attach($idGame);

        // Tambah game ke list
        $gameList = session()->get('game', []);
        $gameList[$idGame] = [
            'id_game' => $game->id_game,
            'nama_game' => $game->nama_game,
            'developer' => $game->developer,
            'tgl_rilis' => $game->tgl_rilis,
            'platform' => $game->platform,
            'foto' => $game->foto
        ];
        session()->put('game', $gameList);

        return redirect('/pelanggan/servis')->with("success", "Game ditambahkan ke list!");
    }

    public function deleteListGame(Request $request) // hapus game dari list
    {
        $idGame = $request->input("id_game");
        $gameList = session()->get('game', []);
        if(isset($gameList[$idGame])) {
            unset($gameList[$idGame]);
            session()->put('game', $gameList);
        }
        return redirect()->route('/pelanggan/servis')->with("success", "Game dihapus dari list!");
    }
}
