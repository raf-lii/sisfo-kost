<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_bookings', function (Blueprint $table) {
            $table->id();
            $table->string("invoice_id");
            $table->string("nama");
            $table->string("email");
            $table->bigInteger("nomor");
            $table->integer("id_kamar");
            $table->string("checkin");
            $table->string("checkout");
            $table->enum("status_booking",["Kadaluarsa", "Menunggu Pembayaran", "Lunas"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_bookings');
    }
};
