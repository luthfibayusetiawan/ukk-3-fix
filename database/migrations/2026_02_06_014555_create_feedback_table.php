<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id('id_feedback');
            $table->unsignedBigInteger('id_aspirasi');
            $table->unsignedBigInteger('id_admin');
            $table->text('pesan');
            $table->datetime('created_at')->nullable();

            // Foreign keys
            $table->foreign('id_aspirasi')->references('id_aspirasi')->on('aspirasi')->onDelete('cascade');
            $table->foreign('id_admin')->references('id_admin')->on('admin')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
