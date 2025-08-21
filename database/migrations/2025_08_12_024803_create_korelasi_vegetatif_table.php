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
        Schema::create('korelasi_vegetatif', function (Blueprint $table) {
            $table->id();
            $table->string('kode_upload')->index(); 
            $table->string('tahun')->nullable();
            $table->string('kebun')->nullable();
            $table->string('topografi')->nullable();
            $table->string('blok')->nullable();

            $table->float('keliling_crown')->nullable();
            $table->float('lingkar_batang')->nullable();
            $table->float('jumlah_pelepah')->nullable();
            $table->float('panjang_pelepah')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('korelasi_vegetatif');
    }
};
