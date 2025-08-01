<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LokasiKebun extends Model
{
    protected $table = 'lokasi_kebuns';

    protected $fillable = [
        'kode_upload',
        'distrik',
        'kebun',
        'jenis_lokasi',
        'nama_lokasi',
        'latitude',
        'longitude',
    ];
}
