<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DaftarKamar;
use App\Models\PengaturanKost;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\KategoriPembayaran;
use App\Models\DaftarBooking;
use App\Models\DaftarPembayaran;
use Illuminate\Support\Str;
use App\Models\TipePembayaran;
use App\Http\Controllers\Pembayaran\iPaymuController;

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
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'nomor' => 'required|numeric|min:11:max:13',
            'checkin' => 'required|date|date_format:d M Y|before:checkout',
            'checkout' => 'required|date|date_format:d M Y|after:checkin',
            'kamar' => 'required',
            'tipe' => 'required'
        ]);

        $tipe = TipePembayaran::where('id', $request->tipe)->select('kategori_pembayaran','kode_channel','nama','kode_channel', 'status')->first();
        $kamar = DaftarKamar::where('id', $request->kamar)->first();

        $checkIn = Carbon::parse($request->checkin);
        $checkOut = Carbon::parse($request->checkout);

        //Random string
        $invoiceId = Str::random("8");

        //Inisiasi iPaymuController
        $iPaymu = new iPaymuController;

        //Checkin melakukan perbandingan terhadap checkout dan dicek apakah
        //perbedaan tersebut berbentuk bulat / pecahan ( float )
        $perbedaanBulan = $checkIn->floatDiffInMonths($checkOut);

        //Check Stok Kamar
        if ($kamar->stock <= 0) return response()->json(['status' => false, 'message' => 'Kamar penuh'], 400);
        //Melakukan pengecekan apakah tanggal checkin dan checkout berjarak minimal 1 bulan
        if (!is_int($perbedaanBulan)) return response()->json(['status' => false, 'message' => 'Tanggal checkin & checkout harus kelipatan 1 bulan!'], 400);
        
        if($tipe->kategori_pembayaran == 1){ //pembayaran dompet digital
            $iPaymuRes = $iPaymu->requestPayment($kamar->harga * $perbedaanBulan + (($kamar->harga * $perbedaanBulan) * 0.025), $invoiceId, $request->nomor, 'qris', $tipe->kode_channel, $request->email);
        }else if($tipe->kategori_pembayaran == 2){ // pembayaran virtual account
            $iPaymuRes = $iPaymu->requestPayment(($kamar->harga * $perbedaanBulan) + 5000, $invoiceId, $request->nomor, 'va', $tipe->kode_channel, $request->email);
        }else if($tipe->kategori_pembayaran == 3){ //Pembayaran convenience store
            $iPaymuRes = $iPaymu->requestPayment($kamar->harga * $perbedaanBulan + (($kamar->harga * $perbedaanBulan) + 4000 * 0.0018), $invoiceId, $request->nomor, 'cstore', $tipe->kode_channel, $request->email);
        }
        
        $noPembayaran = $iPaymuRes['Data']['PaymentNo'];
        $reference = $iPaymuRes['Data']['ReferenceId'];
        $harga = $iPaymuRes['Data']['Total'];

        //Mengurangi stock kamar
        $kamar->decrement('stock');

        $daftarBooking = new DaftarBooking();
        $daftarBooking->invoice_id = $invoiceId;
        $daftarBooking->nama = $request->nama;
        $daftarBooking->email = $request->email;
        $daftarBooking->nomor = $request->nomor;
        $daftarBooking->id_kamar = $request->kamar;
        $daftarBooking->checkin = $request->checkin;
        $daftarBooking->checkout = $request->checkout;
        $daftarBooking->status_booking = "Menunggu Pembayaran";
        $daftarBooking->save();

        $daftarPembayaran = new DaftarPembayaran();
        $daftarPembayaran->booking_id = $invoiceId;
        $daftarPembayaran->harga = $harga;
        $daftarPembayaran->no_pembayaran = $noPembayaran;
        $daftarPembayaran->metode = $tipe->nama;
        $daftarPembayaran->reference = $reference;
        $daftarPembayaran->status_pembayaran = "Belum Lunas";
        $daftarPembayaran->save();

        return response()->json(['status' => true, 'bookingId' => $invoiceId]);
    }
}
