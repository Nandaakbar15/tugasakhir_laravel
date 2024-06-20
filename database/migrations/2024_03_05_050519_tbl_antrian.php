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
        Schema::create('tbl_antrian', function (Blueprint $table) {
            $table->id("id_antrian");
            $table->unsignedBigInteger("id_konsol");
            $table->unsignedBigInteger("id_pelanggan");
            $table->foreign("id_konsol")->references("id_konsol")->on("tbl_konsol");
            $table->foreign("id_pelanggan")->references("id_pelanggan")->on("tbl_pelanggan");
            $table->string("nama_pelanggan", 50);
            $table->string("no_antrian", 50);
            $table->date("tgl_servis");
            $table->enum("status_servis", ["belum selesai", "sudah selesai"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_antrian');
    }
};
