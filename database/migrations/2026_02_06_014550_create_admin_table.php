// database/migrations/xxxx_xx_xx_create_admin_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('username', 50);
            $table->string('password', 255);
            $table->datetime('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};