<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('komposisi_lahans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_upload');
            $table->string('label');
            $table->float('persentase', 5, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komposisi_lahans');
    }
};
