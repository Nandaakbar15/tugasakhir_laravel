<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login() // view login
    {
        return view('login');
    }

    public function cekLogin(Request $request) // mengecek login
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

          if(Auth::attempt($validate)) {
            $request->session()->regenerate();

            if(auth()->user()->role === 'admin'){
                return redirect()->intended('/dashboard'); // jika usernya adalah admin maka masuk ke halaman dashboard admin
            }   else {
                return redirect()->intended('/pelanggan/dashboardpelanggan'); // jika usernya bukan admin maka masuk ke halaman pelanggan
            }
    }

        return back()->with('loginError', 'Login gagal! Email atau Password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
