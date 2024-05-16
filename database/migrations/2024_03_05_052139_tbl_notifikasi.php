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
        Schema::create('tbl_notifikasi', function (Blueprint $table) {
            $table->id("id_notifikasi");
            $table->unsignedBigInteger("id_teknisi");
            $table->unsignedBigInteger("id_pelanggan");
            $table->foreign("id_teknisi")->references("id_teknisi")->on("tbl_teknisi");
            $table->foreign("id_pelanggan")->references("id_pelanggan")->on("tbl_pelanggan");
            $table->text("isi_notifikasi");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_notifikasi');
    }
};
