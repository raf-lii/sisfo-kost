<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DaftarKamar;
use App\Models\PengaturanKost;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\KategoriPembayaran;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'kamar' => 'required',
            'checkIn' => 'required|date|date_format:d M Y|before:checkOut',
            'checkOut' => 'required|date|date_format:d M Y|after:checkIn'            
        ]);

        if($request->kamar == "undefined") return redirect(route('dashboard'))->with('error', 'Harap pilih kamar terlebih dahulu');
        
        $daftarKamar = DaftarKamar::where('id', $request->kamar)->first();
        $dataKost = PengaturanKost::pluck('deskripsi');

        $checkIn = Carbon::parse($request->checkIn);
        $checkOut = Carbon::parse($request->checkOut);
        
        //Checkin melakukan perbandingan terhadap checkout dan dicek apakah
        //perbedaan tersebut berbentuk bulat / pecahan ( float )
        $perbedaanBulan = $checkIn->floatDiffInMonths($checkOut);
        if(!is_int($perbedaanBulan)) return redirect(route('dashboard'))->with('error', 'Tanggal checkin & checkout harus kelipatan 1 bulan!');

        //Melakukan pengecekan apakah tanggal checkin dan checkout berjarak minimal 1 bulan
        if($checkIn->floatDiffInMonths($checkOut) < 1) return redirect(route('dashboard'))->with('error', 'Minimal pemesanan 1 bulan!');
        
        //Check Stok Kamar
        if($daftarKamar->stock <= 0) return redirect(route('dashboard'))->with('error', 'Kamar yang anda pilih telah penuh');

        $totalSewa = $perbedaanBulan * $daftarKamar->harga;

        return view('Components.Dashboard.booking', [
            'DataKamar' => $daftarKamar, 
            'NamaKost' => $dataKost[0], 
            'AlamatKost' => $dataKost[2],
            'CheckIn' => $request->checkIn,
            'CheckOut' => $request->checkOut,
            'PerbedaanBulan' => $perbedaanBulan,
            'BiayaSewa' => $totalSewa,
            'KategoriPembayaran' => KategoriPembayaran::where('status', 'active')->get()
        ]);
    }
}
