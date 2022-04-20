<?php

namespace App\Http\Controllers\Daftar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaftarBooking;
use Illuminate\Support\Facades\Auth;
use App\Models\PengaturanKost;
use Illuminate\Support\Carbon;

use function PHPUnit\Framework\isNull;

class DaftarPesananController extends Controller
{
    public function create()
    {
        $data = DaftarBooking::where('username', Auth::user()->username)
                    ->join("daftar_kamars", "daftar_bookings.id_kamar", "=", "daftar_kamars.id")
                    ->select("daftar_bookings.*", "daftar_kamars.nama AS nama_kamar")
                    ->get();

        return view('Components.Daftar.daftar-pesanan', ['datas' => $data]);
    }

    public function show($id)
    {
        $data = DaftarBooking::where('invoice_id', $id)
                    ->where('daftar_bookings.username', Auth::user()->username)
                    ->join("daftar_pembayarans", "daftar_bookings.invoice_id", "=", "daftar_pembayarans.booking_id")
                    ->join("daftar_kamars", "daftar_bookings.id_kamar", "=", "daftar_kamars.id")
                    ->select("invoice_id", "daftar_kamars.nama AS kamar", "daftar_bookings.nama", "email", "nomor", "checkin", "checkout", "daftar_pembayarans.harga",
                             "no_pembayaran","daftar_bookings.created_at", "daftar_pembayarans.status_pembayaran")
                    ->first();

        if($data == []) return redirect(route('daftar.booking'))->with('error', 'Invoice tidak ditemukan!');

        $checkIn = Carbon::parse($data->checkin);
        $checkOut = Carbon::parse($data->checkout);
        $jangkaWaktu = $checkIn->floatDiffInMonths($checkOut);


        $dataKost = PengaturanKost::pluck('deskripsi');

        return view('Components.Daftar.detail-pesanan', [
            'data' => $data,
            'alamatKost' => $dataKost[2],
            'jangkaWaktu' => $jangkaWaktu
        ]);
    }
}
