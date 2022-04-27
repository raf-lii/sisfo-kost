<?php

namespace App\Http\Controllers\Daftar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminDaftarUserController extends Controller
{
    public function create()
    {
        return view('Components.Daftar.admin-daftar-pengguna', ['datas' => User::orderBy('created_at', 'desc')->paginate(10)]);
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        
        if(!$user) return back()->with('error', 'User tidak ditemukan');

        $user->delete();

        return back()->with('success', 'Berhasil menghapus user');
    }
}
