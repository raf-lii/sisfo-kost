<?php

namespace App\Http\Controllers\Pengaturan;

use App\Http\Controllers\Controller;
use App\Models\PengaturanKost;
use Illuminate\Http\Request;

class PengaturanKostController extends Controller
{
    public function create()
    {
        $data = PengaturanKost::pluck('deskripsi');
        
        return view('Components.Pengaturan.admin-pengaturan-kost', ['data' => $data]);
    }

    public function patch(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'alamat' => 'required'
        ]);

        PengaturanKost::where('nama', "NAMA_KOST")->update([
            'deskripsi' => $request->nama
        ]);

        PengaturanKost::where('nama', 'DESKRIPSI_KOST')->update([
            'deskripsi' => $request->deskripsi
        ]);

        PengaturanKost::where('nama', 'ALAMAT_KOST')->update([
            'deskripsi' => $request->alamat
        ]);

        return back()->with('success', 'Berhasil update data kost');
    }
}
