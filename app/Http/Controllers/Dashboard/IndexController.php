<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengaturanKost;

class IndexController extends Controller
{
    public function create()
    {
        $dataKost = PengaturanKost::pluck('deskripsi');
        return view("Components.Dashboard.index", 
        [
            'namaKost' => $dataKost[0],
            'deskripsiKost' => $dataKost[1],
            'alamatKost' => $dataKost[2]
        ]);
    }
}
