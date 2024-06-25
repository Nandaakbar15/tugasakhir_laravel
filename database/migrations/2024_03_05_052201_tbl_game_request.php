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
        Schema::create('tbl_game_request', function (Blueprint $table) {
            $table->id("id_game");
            $table->string("nama_game", 50);
            $table->string("developer", 50);
            $table->date("tgl_rilis");
            $table->string("platform", 30);
            $table->string("foto");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_game_request');
    }
};
