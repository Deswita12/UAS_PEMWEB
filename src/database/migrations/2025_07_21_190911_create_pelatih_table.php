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
        Schema::create('pelatihs', function (Blueprint $table) {
             $table->id();
            $table->string('nama_pelatih');
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->timestamps();
        });

        // Tambahkan kolom pelatih_id ke tabel products
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('pelatih_id')->nullable()->constrained('pelatihs')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatih');
    }
};
