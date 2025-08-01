<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRekap extends Model
{
    use HasFactory;

    protected $table = 'detail_rekaps';

    protected $fillable = [
        'kode_upload',
        'distrik',
        'kebun',
        'afdeling',
        'tahun_tanam',
        'luas_ha',
        'pkk_awal',
        'pkk_normal',
        'pkk_non_valuer',
        'pkk_mati',
        'pkk_ha_kond_normal',
        'persen_pkk_normal',
        'persen_pkk_non_valuer',
        'persen_pkk_mati',
        'persen_tutupan_kacangan',
        'persen_pir_pkk_kurang_baik',
        'persen_area_tergenang',
        'kondisi_anak_kayu',
        'gangguan_ternak',
        'is_total',
    ];

    protected $casts = [
        // 'tahun_tanam' => 'integer',
        'luas_ha' => 'float',
        'pkk_awal' => 'integer',
        'pkk_normal' => 'integer',
        'pkk_non_valuer' => 'integer',
        'pkk_mati' => 'integer',
        'pkk_ha_kond_normal' => 'integer',
        'persen_pkk_normal' => 'float',
        'persen_pkk_non_valuer' => 'float',
        'persen_pkk_mati' => 'float',
        'persen_tutupan_kacangan' => 'float',
        'persen_pir_pkk_kurang_baik' => 'float',
        'persen_area_tergenang' => 'float',
        'kondisi_anak_kayu' => 'float',
        'gangguan_ternak' => 'string',
        'is_total' => 'boolean',
    ];
}
