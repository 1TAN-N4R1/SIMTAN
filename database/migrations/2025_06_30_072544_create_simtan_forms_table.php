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
        Schema::create('simtan_forms', function (Blueprint $table) {
            $table->id();
            $table->string('kode_upload');
            $table->string('diupload_oleh');
            $table->string('judul_file');
            $table->date('tanggal_upload');
            $table->string('kategori_file');
            $table->string('periode_data');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_rekaps');
    }
};
