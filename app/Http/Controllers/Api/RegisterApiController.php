<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterApiController extends Controller
{
    public function register(Request $request) // register
    {
        $validateData = $request->validate([
            'name' => 'required|max:50',
            'username' => 'required|max:50',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        $validateData['password'] = bcrypt($validateData['password']);

        $user = User::create($validateData);

        return response()->json([
            'statusCode' => 200,
            'message' => 'Data user berhasil ditambahkan!'
        ]);

    }
}
