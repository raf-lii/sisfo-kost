<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengaturanKost;
use App\Models\DaftarKamar;

class IndexController extends Controller
{
    public function create()
    {
        $dataKost = PengaturanKost::pluck('deskripsi');
        return view("Components.Dashboard.index", 
        [
            'namaKost' => $dataKost[0],
            'deskripsiKost' => $dataKost[1],
            'alamatKost' => $dataKost[2],
            'daftarKamar' => DaftarKamar::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kamar' => 'required',
            'checkIn' => 'required|date|date_format:d M Y|before:checkOut',
            'checkOut' => 'required|date|date_format:d M Y|after:checkIn'
        ]);

        $kamar = DaftarKamar::where('id', $request->kamar)->firstOrFail();

        return "<p>Check In : $request->checkIn</p>".
               "<p>Check Out : $request->checkOut</p>".
               "<p class='fw-bold fs-1'>Harus Dibayar</p>".
               "<p>Biaya Deposit : 0</p>".
               "<p>Harga Sewa : $kamar->harga</p>".
               "<br>".
               "<p class='fw-bold'>Total pembayaran : $kamar->harga ";
    }
}
