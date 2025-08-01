<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAreal extends Model
{
    use HasFactory;

    protected $table = 'detail_areals'; // Nama tabel di database

    protected $fillable = [
        'kode_upload',
        'distrik',
        'kebun',
        'afdeling',
        'tbm_i_sawit',
        'tbm_i_karet',
        'tbm_ii_sawit',
        'tbm_ii_karet',
        'tbm_iii_sawit',
        'tbm_iii_karet',
        'is_total',
    ];

    protected $casts = [
        'tbm_i_sawit'    => 'float',
        'tbm_i_karet'    => 'float',
        'tbm_ii_sawit'   => 'float',
        'tbm_ii_karet'   => 'float',
        'tbm_iii_sawit'  => 'float',
        'tbm_iii_karet'  => 'float',
        'is_total' => 'boolean',
    ];
}
