<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KorelasiVegetatif extends Model
{
    use HasFactory;

    protected $table = 'korelasi_vegetatif';

    protected $fillable = [
        'kode_upload',
        'tahun',
        'kebun',
        'topografi',
        'blok',
        'keliling_crown',
        'lingkar_batang',
        'jumlah_pelepah',
        'panjang_pelepah',
    ];

    protected $casts = [
        'keliling_crown' => 'float',
        'lingkar_batang' => 'float',
        'jumlah_pelepah' => 'float',
        'panjang_pelepah' => 'float',
    ];
}
