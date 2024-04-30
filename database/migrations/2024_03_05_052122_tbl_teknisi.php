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
        Schema::create('tbl_teknisi', function (Blueprint $table) {
            $table->id("id_teknisi");
            $table->string("nama_teknisi", 50);
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
        Schema::dropIfExists('tbl_teknisi');
    }
};
