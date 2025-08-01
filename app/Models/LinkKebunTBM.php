<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkKebunTBM extends Model
{
    use HasFactory;

    protected $table = 'link_kebun_tbm';

    protected $fillable = [
        'kode_upload',
        'distrik',
        'kebun',
        'link_playlist',
    ];
}
