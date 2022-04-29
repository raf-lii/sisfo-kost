<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DaftarBooking;
use App\Models\PengaturanKost;
use App\Models\DaftarKamar;
use App\Models\KategoriPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PerpanjangController extends Controller
{
    public function create($id){
        
        $data = DaftarBooking::where('id', $id)
                ->where('status_booking', 'Jatuh Tempo')
                ->first();

        if(!$data) return back()->with('error', 'Pesanan anda saat ini belum jatuh tempo');

        $daftarKamar = DaftarKamar::where('id', $data->id_kamar)->first();
        $dataKost = PengaturanKost::pluck('deskripsi');
        
        $checkout = Carbon::parse($data->checkout)->addMonth()->format("d M Y");

        return view('Components.Dashboard.perpanjang', [
            'data' => $data,
            'DataKamar' => $daftarKamar,
            'NamaKost' => $dataKost[0],
            'AlamatKost' => $dataKost[2],
            'CheckIn' => $data->checkin,
            'CheckOut' => $checkout,
            'BiayaSewa' => $daftarKamar->harga,
            'KategoriPembayaran' => KategoriPembayaran::where('status', 'active')->get()
        ]);
    }
}
