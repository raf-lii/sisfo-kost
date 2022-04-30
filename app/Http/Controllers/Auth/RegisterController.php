<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view("Auth.register");
    }

    public function store(Request $request)
    {
        //Melakukan validasi terhadap request
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users,username|min:6|max:255',
            'password' => 'required|min:8|max:255'
        ]);

        //Melakukan input data user yang valid ke dalam table user
        $user = new User;
        $user->name = $request->nama;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = "Member";
        $user->save();

        //Meredirect user ke halaman login dengan membawa pesan success
        return redirect(route('login'))->with("success", "Berhasil melakukan pendaftaran, silakan masuk");
    }
}
