<?php

namespace App\Http\Controllers\Daftar;

use App\Http\Controllers\Controller;
use App\Models\DaftarBooking;
use Illuminate\Http\Request;

class AdminDaftarPesananController extends Controller
{
    public function create()
    {
        $data = DaftarBooking::join("daftar_kamars", "daftar_bookings.id_kamar", "=", "daftar_kamars.id")
            ->select("daftar_bookings.*", "daftar_kamars.nama AS nama_kamar")
            ->get();
            
        return view("Components.Daftar.admin-daftar-pesanan", ['datas' => $data]);
    }
}
