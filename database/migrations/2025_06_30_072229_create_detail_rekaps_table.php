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
        Schema::create('detail_rekaps', function (Blueprint $table) {
            $table->id();
            $table->string('kode_upload')->index(); 
            $table->string('distrik'); 
            $table->string('kebun');
            $table->string('afdeling')->nullable();
            $table->integer('tahun_tanam')->nullable();

            // Nilai numerik utama
            $table->float('luas_ha');
            $table->integer('pkk_awal');
            $table->integer('pkk_normal');
            $table->integer('pkk_non_valuer')->nullable();
            $table->integer('pkk_mati')->nullable();
            $table->integer('pkk_ha_kond_normal')->nullable();

            // Kolom Persentase
            $table->float('persen_pkk_normal')->nullable();
            $table->float('persen_pkk_non_valuer')->nullable();
            $table->float('persen_pkk_mati')->nullable();
            $table->float('persen_tutupan_kacangan')->nullable();
            $table->float('persen_pir_pkk_kurang_baik')->nullable();
            $table->float('persen_area_tergenang')->nullable();

            $table->float('kondisi_anak_kayu')->nullable();
            $table->string('gangguan_ternak')->nullable();

            $table->boolean('is_total')->default(false);
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
