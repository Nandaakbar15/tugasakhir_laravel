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
        Schema::create('tbl_konsol', function (Blueprint $table) {
            $table->id("id_konsol");
            $table->unsignedBigInteger("id_pelanggan");
            $table->foreign("id_pelanggan")->references("id_pelanggan")->on("tbl_pelanggan");
            $table->string("nama_konsol", 50);
            $table->string("foto");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_konsol');
    }
};
