<?php

namespace App\Http\Controllers\Pembayaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipePembayaran;
use App\Models\KategoriPembayaran;

class TipePembayaranController extends Controller
{
    public function create()
    {
        $data = TipePembayaran::join("kategori_pembayarans", "tipe_pembayarans.kategori_pembayaran", "kategori_pembayarans.id")
                            ->select("tipe_pembayarans.*", "kategori_pembayarans.nama AS nama_kategori")
                            ->paginate(10);

        return view('Components.Pembayaran.admin-tipe-pembayaran', [
            'datas' => $data,
            'kategoris' => KategoriPembayaran::get()
        ]);
    }

    public function show(Request $request)
    {
        $tipePembayaran = TipePembayaran::where('kategori_pembayaran', $request->kategoriPembayaran)
                          ->where('status', 'active')
                          ->select("id","nama")->get();

        return response()->json([
            'data' => $tipePembayaran
        ]);
    }

    public function patch($id, $status)
    {
        $tipePembayaran = TipePembayaran::where('id', $id)->update([
            'status' => $status
        ]);

        return back()->with('success', 'Berhasil update status tipe pembayaran');
    }

    public function destroy($id)
    {
        $tipePembayaran = TipePembayaran::where('id', $id)->delete();

        return back()->with('success', 'Berhasil hapus tipe pembayaran');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_pembayaran' => 'required',
            'nama' => 'required',
            'kode_channel' => 'required',
        ]);

        $tipePembayaran = new TipePembayaran();
        $tipePembayaran->kategori_pembayaran = $request->kategori_pembayaran;
        $tipePembayaran->nama = $request->nama;
        $tipePembayaran->kode_channel = $request->kode_channel;
        $tipePembayaran->status = "active";
        $tipePembayaran->save();

        return back()->with('success', 'Berhasil menambahkan tipe pembayaran');
    }
}
