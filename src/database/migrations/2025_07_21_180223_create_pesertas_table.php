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
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peserta');
            $table->foreignId('kelas_id')->constrained('products')->onDelete('cascade'); // relasi ke tabel products
            $table->string('instruktur');
            $table->string('hari');
            $table->enum('sesi', ['pagi', 'malam']);
            $table->enum('payment', ['lunas', 'belum lunas'])->default('belum lunas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
