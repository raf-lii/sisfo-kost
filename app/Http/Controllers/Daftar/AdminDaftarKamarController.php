<?php

namespace App\Http\Controllers\Daftar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaftarKamar;

class AdminDaftarKamarController extends Controller
{
    public function create()
    {
        return view('Components.Daftar.admin-daftar-kamar', ['datas' => DaftarKamar::orderBy('created_at', 'desc')->paginate(10)]);
    }

    public function destroy($id)
    {
        $data = DaftarKamar::where('id', $id)->first();

        if(!$data) return back()->with('error', 'Kamar tidak ditemukan');

        unlink(public_path($data->gambar));

        $data->delete();

        return back()->with('success', 'Berhasil menghapus kamar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'thumbnail' => 'required|file|mimes:jpg,png',
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $file = $request->file('thumbnail');
        $folder = 'assets/kamar';
        $file->move($folder, $file->getClientOriginalName());

        $daftarKamar = new DaftarKamar();
        $daftarKamar->nama = $request->nama;
        $daftarKamar->harga = $request->harga;
        $daftarKamar->stock = $request->stock;
        $daftarKamar->gambar = "/" . $folder . "/" . $file->getClientOriginalName();
        $daftarKamar->save();

        return back()->with('success', 'Berhasil menambahkan kamar');
    }

    public function show($id)
    {
        $kamar = DaftarKamar::where('id', $id)->first();

        $send = "<form action='".route('admin.update.kamar')."' method='POST'>
                <input type='hidden' name='_token' value='".csrf_token()."'>
                <input type='hidden' name='id' value='$id'>
                <div class='mb-3 row'>
                    <label class='col-lg-2 col-form-label'>Nama</label>
                    <div class='col-lg-10'>
                        <input type='text' class='form-control' name='nama' value='$kamar->nama'>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label class='col-lg-2 col-form-label'>Harga</label>
                    <div class='col-lg-10'>
                        <input type='number' class='form-control' name='harga' value='$kamar->harga'>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label class='col-lg-2 col-form-label'>Stock</label>
                    <div class='col-lg-10'>
                        <input type='number' class='form-control' name='stock' value='$kamar->stock'>
                    </div>
                </div>
                <button type='submit' class='btn btn-primary'>Submit</button>
                </form>";

        return $send;
    }

    public function patch(Request $request)
    {
        $kamar = DaftarKamar::where('id', $request->id)->first();

        $kamar->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stock' => $request->stock
        ]);

        return back()->with('success', 'Berhasil update kamar');
    }
}
