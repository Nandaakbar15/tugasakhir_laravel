<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game_request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DataGameApiController extends Controller
{
    public function index() // get all data game
    {
        $game = Game_request::all();
        $data = [
            'game' => $game
        ];
        return response()->json([
            'statusCode' => 200,
            'data' => $data
        ]);
    }

    public function store(Request $request) // post data game / tambah data game
    {
        $user = auth()->user();

        $id_pelanggan = $user->pelanggan->id_pelanggan;
        // Validate the request data, including the image file
        $validatedData = $request->validate([
            'nama_game' => 'required|max:50',
            'developer' => 'required|max:50',
            'tgl_rilis' => 'required|date',
            'platform' => 'required|max:50',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules for image upload
        ]);

        $validatedData['id_pelanggan'] = $id_pelanggan;

         // Handle file upload
         if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $fileName, 'public');
            $validatedData['foto'] = '/storage/' . $path;
            }

        // Create the game request record
        Game_request::create($validatedData);
        return response()->json([
            'statusCode' => 200,
            'message' => 'Data Game berhasil di tambah!'
        ]);
    }

    public function update(Request $request, Game_request $game_request) // update data game
    {
        $validate = $request->validate([
            'nama_game' => 'required|max:50',
            'developer' => 'required|max:50',
            'tgl_rilis' => 'required|date',
            'platform' => 'required|max:50',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

         // Handle file upload
         if ($request->hasFile('foto')) {
            if($request->gambarLama) {
                Storage::delete($request->gambarLama);
            }
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $fileName, 'public');
            $validatedData['foto'] = '/storage/' . $path;
        }

        $game_request->update($validate);
        Game_request::where('id_game', $game_request->id_game)
                 ->update($validate);
        return response()->json([
            'statusCode' => 200,
            'message' => 'Data Game berhasil diubah!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game_request $game_request) // hapus data game
    {
        $game_request->delete();
        return response()->json([
            'statusCode' => 200,
            'message' => 'Data Game berhasil dihapus!'
        ]);
    }

    public function carigame() // cari data game
    {
        $game = Game_request::latest()->filter()->get();
        $data = [
            'game' => $game
        ];
        return response()->json([
            'statusCode' => 200,
            'data' => $data
        ]);
    }
}
