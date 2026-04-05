<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirasi', function (Blueprint $table) {
            $table->id('id_aspirasi');
            $table->string('nisn', 10);
            $table->unsignedBigInteger('id_kategori');
            $table->string('lokasi', 50);
            $table->text('keterangan');
            $table->string('jenis', 20); // 'kerusakan' atau 'saran'
            $table->string('status', 20)->default('Menunggu'); // 'Menunggu', 'Proses', 'Selesai'
            $table->datetime('created_at')->nullable();

            // Foreign keys
            $table->foreign('nisn')->references('nisn')->on('siswa')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirasi');
    }
};
