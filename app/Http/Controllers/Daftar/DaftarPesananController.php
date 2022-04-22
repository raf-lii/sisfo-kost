<?php

namespace App\Http\Controllers\Daftar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaftarBooking;
use Illuminate\Support\Facades\Auth;
use App\Models\PengaturanKost;
use App\Models\DaftarPembayaran;
use Illuminate\Support\Carbon;

use function PHPUnit\Framework\isNull;

class DaftarPesananController extends Controller
{
    public function create()
    {
        $data = DaftarBooking::where('username', Auth::user()->username)
                    ->join("daftar_kamars", "daftar_bookings.id_kamar", "=", "daftar_kamars.id")
                    ->select("daftar_bookings.*", "daftar_kamars.nama AS nama_kamar")
                    ->orderBy('created_at', 'desc')
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
        if($data->status_pembayaran == "Belum Lunas") return redirect(route('daftar.booking'))->with('error', "Aksi gagal invoice #$id belum lunas");

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

    public function pay($id)
    {
        $data = DaftarPembayaran::where('booking_id', $id)->select('metode', 'no_pembayaran', 'harga', 'created_at')->first();

        $template = "<div class='row'>
                <div class='col-6'>
                    <label class='fw-bold header'>ID Pembelian</label>
                    <h4 class='text-muted'>#$id</h4>
                    <label class='fw-bold header'>Jumlah Pembayaran</label>
                    <h4 class='text-muted'>Rp. " . number_format($data->harga, 0, ',', '.') . "</h4>
                </div>
                <div class='col-6 text-end'>
                    <label class='fw-bold header'>Tanggal Kadaluarsa</label>
                    <h4 class='text-muted'>" . Carbon::parse($data->created_at)->addDay() . "</h4>
                    <label class='fw-bold header'>Metode Pembayaran</label>
                    <h4 class='text-muted'>$data->metode</h4>
                </div>
            </div>";

        if($data->metode == "QRIS"){
            $send = "<div class='d-flex justify-content-center'>
                        <div class='card-header mt-2' id='no'></div>
                    </div>
                    <script src='https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js'></script>
                    <script type='text/javascript'>
                        var qr = new QRCode(document.getElementById('no'), {
                            width: 150,
                            height: 150
                        });
                        qr.makeCode('$data->no_pembayaran');
                    </script>";
        }else{
            $send = "<div class='d-flex justify-content-center'>
                        <div class='card-header mt-2' id='no'>$data->no_pembayaran</div>
                    </div>";            
        }
        return $template.$send;
    }
}
