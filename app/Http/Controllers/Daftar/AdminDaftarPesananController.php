<?php

namespace App\Http\Controllers\Daftar;

use App\Http\Controllers\Controller;
use App\Models\DaftarBooking;
use Illuminate\Http\Request;

class AdminDaftarPesananController extends Controller
{
    public function create()
    {
        //melakukan join terhadap table daftar_kamars berdasarkan id_kamar dari daftar_booking dan id dari daftar_kamars
        $data = DaftarBooking::join("daftar_kamars", "daftar_bookings.id_kamar", "=", "daftar_kamars.id")
            ->select("daftar_bookings.*", "daftar_kamars.nama AS nama_kamar")
            ->paginate(10);
            
        return view("Components.Daftar.admin-daftar-pesanan", ['datas' => $data]);
    }

    public function show($id)
    {
        //Melakukan pencarian berdasarkan invoice id dan melakukan join pada table daftar_kamars berdasarkan id_kamar dari daftar_booking dan id dari daftar_kamars
        //lalu melakukan join pada table daftar_pembayarans berdasarkan invoice id dari daftar_bookings dan
        //booking id dari daftar pembayarans
        $data = DaftarBooking::where('invoice_id', $id)
                ->join("daftar_kamars", "daftar_bookings.id_kamar", "=", "daftar_kamars.id")
                ->join("daftar_pembayarans", "daftar_bookings.invoice_id", "=", "daftar_pembayarans.booking_id")
                ->select("invoice_id", "daftar_kamars.nama AS kamar", "daftar_bookings.nama", "email", "nomor", "checkin", "checkout", "daftar_pembayarans.harga",
                             "no_pembayaran","daftar_bookings.created_at", "daftar_pembayarans.status_pembayaran", "daftar_pembayarans.metode")
                ->first();

        $send = '<div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Invoice Id</th>
                                <td>#'.$data->invoice_id.'</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>'.$data->nama.'</td>
                            </tr>
                            <tr>
                                <th>Kamar</th>
                                <td>'.$data->kamar.'</td>
                            </tr>
                            <tr>
                                <th>Check-in</th>
                                <td>'.$data->checkin.'</td>
                            </tr>
                            <tr>
                                <th>Check-out</th>
                                <td>'.$data->checkout.'</td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>Rp. '.number_format($data->harga, 0, ',', '.').'</td>
                            </tr>
                            <tr>
                                <th>Metode</th>
                                <td>'.$data->metode.'</td>
                            </tr>
                            <tr>
                                <th>Nomor Pembayaran</th>
                                <td>'.$data->no_pembayaran.'</td>
                            </tr>
                            <tr>
                                <th>Status Pembayaran</th>
                                <td>'.$data->status_pembayaran.'</td>
                            </tr>
                            <tr>
                                <th>Tanggal transaksi</th>
                                <td>'.$data->created_at.'</td>
                            </tr>
                        </tbody>
                    </table>
                </div>';

        //Mengembalikan dalam format html
        return $send;
    }
}
