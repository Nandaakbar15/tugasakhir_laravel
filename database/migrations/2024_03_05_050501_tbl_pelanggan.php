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
        Schema::create('tbl_pelanggan', function (Blueprint $table) {
            $table->id("id_pelanggan");
            $table->string("nama_pelanggan", 50);
            $table->string("email", 50);
            $table->text("alamat");
            $table->string("no_telp", 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pelanggan');
    }
};
