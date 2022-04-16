<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengaturanKost;
use App\Models\DaftarKamar;
use Illuminate\Support\Carbon;

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

    public function show(Request $request)
    {
        $request->validate([
            'kamar' => 'required',
            'checkIn' => 'required|date|date_format:d M Y|before:checkOut',
            'checkOut' => 'required|date|date_format:d M Y|after:checkIn'
        ]);

        $kamar = DaftarKamar::where('id', $request->kamar)->firstOrFail();
        $checkIn = Carbon::parse($request->checkIn);
        $checkOut = Carbon::parse($request->checkOut);
        
        $perbedaanBulan = $checkIn->floatDiffInMonths($checkOut);
        if (!is_int($perbedaanBulan)) return response()->json(['status' => false, 'message' => 'Tanggal checkin & checkout harus kelipatan 1 bulan!'], 400);

        $hargaSewa = $kamar->harga * $perbedaanBulan;

        return "<div class='alert alert-secondary mt-2'>".
               "<p>Check In : $request->checkIn</p>".
               "<p>Check Out : $request->checkOut</p>".
               "<p class='fw-bold fs-1'>Harus Dibayar</p>".
               "<p>Biaya Deposit : 0</p>".
               "<p>Harga Sewa : $hargaSewa ($perbedaanBulan Bulan)</p>".
               "<br>".
               "<p class='fw-bold'>Total pembayaran : $hargaSewa ".
               "</div>";
    }
}
