<?php

namespace App\Http\Controllers\Daftar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaftarBooking;
use Illuminate\Support\Facades\Auth;

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
}
