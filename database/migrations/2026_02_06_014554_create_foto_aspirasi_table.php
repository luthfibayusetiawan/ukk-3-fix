<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('foto_aspirasi', function (Blueprint $table) {
            $table->id('id_foto');
            $table->unsignedBigInteger('id_aspirasi');
            $table->string('path_foto', 255);

            // Foreign key
            $table->foreign('id_aspirasi')->references('id_aspirasi')->on('aspirasi')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foto_aspirasi');
    }
};
