<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DetailRekapImport;

class SimtanForm extends Model
{
    protected $fillable = [
        'kode_upload',
        'diupload_oleh',
        'judul_file',
        'tanggal_upload',
        'kategori_file',
        'periode_data',
        'notes',
        'file_path',
    ];

    public static function simpanForm(array $validated, $uploadedFile)
    {
        // Simpan file ke storage
        $path = $uploadedFile->store('uploads');

        // Simpan data input user
        self::create([
            'kode_upload' => $validated['kode_upload'],
            'diupload_oleh' => $validated['diupload_oleh'],
            'judul_file' => $validated['judul_file'],
            'tanggal_upload' => $validated['tanggal_upload'],
            'kategori_file' => $validated['kategori_file'],
            'periode_data' => $validated['periode_data'],
            'notes' => $validated['notes'] ?? '',
            'file_path' => $path,
        ]);
    }
}
