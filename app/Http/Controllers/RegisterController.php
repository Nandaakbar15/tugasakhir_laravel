<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function register() // view untuk register
    {
        return view('register');
    }

    public function cekRegister(Request $request) // validasi register
    {
        $validateData = $request->validate([
            'name' => 'required|max:50',
            'username' => 'required|max:50',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        $validateData['password'] = bcrypt($validateData['password']);

        $user = User::create($validateData);

        // event(new Registered($user));

        return redirect('/login')->with('success', 'Data user berhasil di tambah! Verifikasi email anda sebelum login!');
    }
}
