<?php

namespace App\Http\Controllers\Pembayaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipePembayaran;

class TipePembayaranController extends Controller
{
    public function show(Request $request)
    {
        $tipePembayaran = TipePembayaran::where('kategori_pembayaran', $request->kategoriPembayaran)->get();

        return response()->json([
            'data' => $tipePembayaran
        ]);
    }
}
