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
        //Melakukan pencarian user berdasarkan id
        $user = User::where('id', $id)->first();
        
        //Jika user tidak ditemukan akan dibawa kehalaman sebelumnya dengan membawa pesan error
        if(!$user) return back()->with('error', 'User tidak ditemukan');

        //Melakukan penghapusan user yang telah dicari
        $user->delete();

        //Membawa user kehalaman sebelumnya dengan membawa pesan success
        return back()->with('success', 'Berhasil menghapus user');
    }
}
