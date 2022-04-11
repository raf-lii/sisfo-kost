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
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users,username|min:6|max:255',
            'password' => 'required|min:8|max:255'
        ]);

        $user = new User;
        $user->name = $request->nama;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = "Member";
        $user->save();

        return redirect(route('login'))->with("success", "Berhasil melakukan pendaftaran, silakan masuk");
    }
}
