<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DaftarBooking;
use App\Models\DaftarKamar;
use Illuminate\Support\Carbon;

class updateBooking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateBooking';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Mendapatkan data dengan status booking lunas
        $bookingLunas = DaftarBooking::where('status_booking', 'Lunas')
                        ->orWhere('status_booking', 'Jatuh Tempo')
                        ->latest()->get();
        
        foreach($bookingLunas as $data){
            //Melakukan pengecekan apakah tanggal checkout tersisa 7 hari lagi
            if(Carbon::now()->diffInDays($data->checkout) <= 7 && $data->status_booking == "Lunas"){
                
                DaftarBooking::where('id', $data->id)->update([
                    'status_booking' => 'Jatuh Tempo'
                ]);

            //Melakukan pengecekan apakah tanggal checkout sama dengan hari ini dan berstatus jatuh tempo (tidak perpanjang)
            }else if(Carbon::now()->diffinDays($data->checkout) == 0 && $data->status_booking == "Jatuh Tempo"){

                DaftarBooking::where('id', $data->id)->update([
                    'status_booking' => 'Selesai'
                ]);
                
                DaftarKamar::where('id', $data->id_kamar)->increment("stock");
            }
        }

    }
}
