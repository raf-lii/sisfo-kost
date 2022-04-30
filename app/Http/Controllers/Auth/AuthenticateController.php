<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    public function create()
    {
        return view("Auth.login");
    }

    public function store(Request $request)
    {
        //Melakukan validasi terhadap request
        $credential = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        //Request yang valid akan membuat program melakukan percobaan login
        if (Auth::attempt($credential)) {
            //Melakukan generate session
            $request->session()->regenerate();

            //redirect user ke halaman "/" atau dashboard
            return redirect()->intended('/');
        }

        //Jika percobaan login gagal maka akan dibawa kembali ke halaman sebelumnya dengan membawa pesan error
        return back()->with('error', 'Harap periksa data anda kembali!.');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        //Menonaktifkan session
        $request->session()->invalidate();
        //Melakukan generate ulang token
        $request->session()->regenerateToken();

        //Melakukan redirect user kembali ke halaman login
        return redirect(route('login'));
    }     
}
