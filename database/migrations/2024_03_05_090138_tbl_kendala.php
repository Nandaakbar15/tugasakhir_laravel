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
        Schema::create('tbl_kendala', function (Blueprint $table) {
            $table->id("id_kerusakan");
            $table->unsignedBigInteger('id_konsol');
            $table->unsignedBigInteger("id_pelanggan");
            $table->foreign("id_pelanggan")->references("id_pelanggan")->on("tbl_pelanggan");
            $table->foreign("id_konsol")->references("id_konsol")->on("tbl_konsol");
            $table->string("kendala_kerusakan", 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_kendala');
    }
};
