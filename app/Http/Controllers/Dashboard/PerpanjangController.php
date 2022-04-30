<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DaftarBooking;
use App\Models\PengaturanKost;
use App\Models\DaftarKamar;
use App\Models\DaftarPembayaran;
use App\Models\TipePembayaran;
use App\Models\KategoriPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Pembayaran\iPaymuController;

class PerpanjangController extends Controller
{
    public function create($id){
        
        $data = DaftarBooking::where('daftar_bookings.id', $id)
                ->join('daftar_pembayarans', 'daftar_pembayarans.booking_id', 'daftar_bookings.invoice_id')
                ->where('status_booking', 'Jatuh Tempo')
                ->where('daftar_pembayarans.status_pembayaran', 'Lunas')
                ->first();
        
        if(!$data) return redirect(route('daftar.booking'))->with('error', 'Pesanan anda saat ini belum jatuh tempo');

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

    public function store($id, Request $request)
    {
        if(!$id) return redirect(route('daftar.booking'));
        if($request->tipe == "") return back()->with('error', 'Harap memilih tipe pembayaran');

        $DaftarPembayaran = DaftarPembayaran::where('id', $id)->first();
        $tipe = TipePembayaran::where('id', $request->tipe)->select('kategori_pembayaran', 'kode_channel', 'nama', 'kode_channel', 'status')->first();
        $DaftarBooking = DaftarBooking::where('invoice_id', $DaftarPembayaran->booking_id)->first();
        $kamar = DaftarKamar::where('id', $DaftarBooking->id_kamar)->first();

        //Inisiasi iPaymuController
        $iPaymu = new iPaymuController;

        if ($tipe->kategori_pembayaran == 1) { //pembayaran dompet digital
            $iPaymuRes = $iPaymu->requestPayment($kamar->harga + ($kamar->harga * 0.025), $DaftarBooking->invoice_id, $DaftarBooking->nomor, 'qris', $tipe->kode_channel, $DaftarBooking->email);
        } else if ($tipe->kategori_pembayaran == 2) { // pembayaran virtual account
            $iPaymuRes = $iPaymu->requestPayment($kamar->harga + 5000, $DaftarBooking->invoice_id, $DaftarBooking->nomor, 'va', $tipe->kode_channel, $DaftarBooking->email);
        } else if ($tipe->kategori_pembayaran == 3) { //Pembayaran convenience store
            $iPaymuRes = $iPaymu->requestPayment($kamar->harga + ($kamar->harga + 4000 * 0.0018), $DaftarBooking->invoice_id, $DaftarBooking->nomor, 'cstore', $tipe->kode_channel, $DaftarBooking->email);
        }
        $noPembayaran = $iPaymuRes['Data']['PaymentNo'];
        $reference = $iPaymuRes['Data']['ReferenceId'];
        $harga = $iPaymuRes['Data']['Total'];

        $DaftarPembayaran->update([
            'harga' => $harga,
            'no_pembayaran' => $noPembayaran,
            'reference' => $reference,
            'metode' => $tipe->nama,
            'status_pembayaran' => 'Belum Lunas',
            'created_at' => now()
        ]);

        return redirect(route('daftar.booking'))->with('success', 'Berhasil melakukan perpanjang kamar silakan melakukan pembayaran');
    }
}
