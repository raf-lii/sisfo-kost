<?php

namespace App\Http\Controllers\Pembayaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\DaftarBooking;
use App\Models\DaftarKamar;
use App\Models\DaftarPembayaran;
use Illuminate\Support\Carbon;

class iPaymuController extends Controller
{
    protected $url = 'https://sandbox.ipaymu.com';

    public function requestPayment($harga, $order_id, $nomor, $method, $paymentChannel, $email)
    {
        $body['amount']      = $harga;
        $body['notifyUrl'] = ENV("APP_URL").'/callback';
        $body['referenceId'] = $order_id;
        $body['name'] = ENV("APP_NAME");
        $body['phone'] = "0".$nomor;
        $body['email'] = $email;
        $body['paymentMethod'] = $method;
        $body['paymentChannel'] = $paymentChannel;

        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper("post") . ':' . ENV("IPAYMU_VIRTUAL_ACCOUNT") . ':' . $requestBody . ':' . ENV("IPAYMU_API_KEY");
        $signature    = hash_hmac('sha256', $stringToSign, ENV("IPAYMU_API_KEY"));
        $timestamp    = Date('YmdHis');

        return $this->connect('/api/v2/payment/direct', $jsonBody, $signature, $timestamp);
    }

    public function checkTransaction($transactionId)
    {
        $body['transactionId'] = $transactionId;

        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper("post") . ':' . ENV("IPAYMU_VIRTUAL_ACCOUNT") . ':' . $requestBody . ':' . ENV("IPAYMU_API_KEY");
        $signature    = hash_hmac('sha256', $stringToSign, ENV("IPAYMU_API_KEY"));
        $timestamp    = Date('YmdHis');

        return $this->connect('/api/v2/transaction', $jsonBody, $signature, $timestamp);
    }

    public function connect($endPoint, $body, $signature, $timestamp)
    {
        $ch = curl_init($this->url . $endPoint);

        $headers = array(
            'Content-Type: application/json',
            'va: ' . ENV("IPAYMU_VIRTUAL_ACCOUNT"),
            'signature: ' . $signature,
            'timestamp: ' . $timestamp
        );

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $err = curl_error($ch);
        $ret = curl_exec($ch);
        curl_close($ch);
        if ($err) {
            return $err;
        } else {
            return json_decode($ret, true);
        }
    }

    public function handle(Request $request)
    {
        //Make sure the sender is from iPay
        if ($request->server('HTTP_X_FORWARDED_FOR') != '120.89.93.102') return "Invalid IP Address";
        
        $trx = $request->sid;
        $pembayaran = DaftarPembayaran::where('reference', $trx)->first();

        if (!$pembayaran) return "Transaction not found";

        $bookingId = $pembayaran->booking_id;
        $daftarBooking = DaftarBooking::where('invoice_id', $bookingId)->first();
        $daftarKamar = DaftarKamar::where('id', $daftarBooking->id_kamar)->first();

        if ($request->status == "berhasil" || $request->status == "pending") {

            if($daftarBooking->status_booking == "Jatuh Tempo"){
                $daftarBooking->update([
                    'checkout' => Carbon::parse($daftarBooking->checkout)->addMonth()->format("d M Y")
                ]);
            }
            $pembayaran->update([
                'status_pembayaran' => 'Lunas'
            ]);

            $daftarBooking->update([
                'status_booking' => "Lunas"
            ]);

            return "Sukses";
        } else if ($request->status == "gagal") {
            $daftarKamar->increment("stock");

            $pembayaran->update([
                'status_pembayaran' => 'Expired'
            ]);

            $daftarBooking->update([
                'status_booking' => 'Kadaluarsa'
            ]);

            return "Sukses";
        }
    }
}
