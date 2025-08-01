<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomposisiLahan extends Model
{
    use HasFactory;

    protected $table = 'komposisi_lahans';

    protected $fillable = ['kode_upload', 'label', 'persentase'];
}
