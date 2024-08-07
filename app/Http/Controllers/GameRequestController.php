<?php

namespace App\Http\Controllers;

use App\Models\Game_request;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class GameRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // view data game
    {
        $username = Auth::user()->name;
        $game = Game_request::paginate(4)->withQueryString();
        return view('dashboard.datagame.viewdatagame', [
            'game' => $game,
            'username' => $username
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() // view tambah data game
    {
        $username = Auth::user()->name;
        return view('dashboard.datagame.tambah', [
            'username' => $username
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // tambah data game
    {
        // Validate the request data, including the image file
        $validatedData = $request->validate([
            'nama_game' => 'required|max:50',
            'developer' => 'required|max:50',
            'tgl_rilis' => 'required|date',
            'platform' => 'required|max:50',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules for image upload
        ]);

        $file = $request->file('foto');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('images', $fileName, 'public');
        $validatedData['foto'] = '/storage/' . $path;

        Game_request::create($validatedData);
        return redirect('/dashboard')->with('success', 'Data Game berhasil di tambah!');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game_request $game_request) // view edit data game
    {
        $username = Auth::user()->name;
        return view('dashboard.datagame.ubah', [
            'game_request' => $game_request,
            'username' => $username
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game_request $game_request)
    {
        $validate = $request->validate([
            'nama_game' => 'required|max:50',
            'developer' => 'required|max:50',
            'tgl_rilis' => 'required|date',
            'platform' => 'required|max:50',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if($request->gambarLama) {
                Storage::delete($request->gambarLama);
            }
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $fileName, 'public');
            $validate['foto'] = '/storage/' . $path;
        } else {
            $validatedData['foto'] = $game_request->foto;
        }

        $game_request->update($validate);

        return redirect('/dashboard')->with('success', 'Data Game berhasil di ubah!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game_request $game_request) // hapus data game
    {
        $game_request->delete();
        return redirect('/dashboard')->with('success', 'Data Game berhasil di hapus!');
    }

    public function carigame(Request $request) // cari data game
    {
        $username = Auth::user()->name;
        $cariGame = $request->input('cariGame');
        $game = Game_request::query()
                ->where('nama_game', 'like', '%' . $cariGame . '%')
                ->paginate(5);
        return view('dashboard.datagame.viewdatagame', [
            'game' => $game,
            'username' => $username
        ]);
    }
}
