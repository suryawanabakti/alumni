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
        Schema::create('informasi_lokers', function (Blueprint $table) {
            $table->id();
            $table->string('gambar')->nullable();
            $table->string('perusahaan')->nullable();
            $table->enum('jenis', ['Full Time', 'Paruh waktu', 'Kontrak', 'Kasual'])->nullable();
            $table->string('alamat')->nullable();
            $table->integer('gaji')->nullable();
            $table->string('judul');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_lokers');
    }
};
