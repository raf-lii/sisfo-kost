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
        Schema::create('daftar_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string("username");
            $table->string("booking_id");
            $table->bigInteger("harga");
            $table->string("no_pembayaran");
            $table->string("metode");
            $table->string("reference");
            $table->enum("status_pembayaran", ["Lunas", "Belum Lunas", "Expired"]);
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
        Schema::dropIfExists('daftar_pembayarans');
    }
};
