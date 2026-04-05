<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('histori_status', function (Blueprint $table) {
            $table->id('id_histori');
            $table->unsignedBigInteger('id_aspirasi');
            $table->string('status', 20);
            $table->datetime('tanggal');

            // Foreign key
            $table->foreign('id_aspirasi')->references('id_aspirasi')->on('aspirasi')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('histori_status');
    }
};
