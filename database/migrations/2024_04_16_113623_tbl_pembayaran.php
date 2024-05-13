<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_pembayaran', function (Blueprint $table) {
            $table->id("id_pembayaran");
            $table->unsignedBigInteger("id_pelanggan");
            $table->unsignedBigInteger("id_antrian");
            $table->foreign("id_pelanggan")->references("id_pelanggan")->on("tbl_pelanggan");
            $table->foreign("id_antrian")->references("id_antrian")->on("tbl_antrian");
            $table->string("nama");
            $table->string("email");
            $table->string("no_telp");
            $table->biginteger("jumlah_pembayaran");
            $table->date("tgl_pembayaran");
            $table->enum('status', ['Unpaid', 'Paid']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pembayaran');
    }
};
