<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('detail_areals', function (Blueprint $table) {
            $table->id();
            $table->string('kode_upload');
            $table->string('distrik')->nullable();
            $table->string('kebun')->nullable();
            $table->string('afdeling')->nullable();

            $table->float('tbm_i_sawit')->nullable();
            $table->float('tbm_i_karet')->nullable();
            $table->float('tbm_ii_sawit')->nullable();
            $table->float('tbm_ii_karet')->nullable();
            $table->float('tbm_iii_sawit')->nullable();
            $table->float('tbm_iii_karet')->nullable();

            $table->boolean('is_total')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_areals');
    }
};
