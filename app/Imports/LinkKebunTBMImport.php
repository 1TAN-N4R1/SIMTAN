<?php

namespace App\Imports;

use App\Models\LinkKebunTBM;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LinkKebunTBMImport implements ToModel, WithHeadingRow
{
    protected $kodeUpload;
    protected $currentDistrik = null; // simpan distrik terakhir

    public function __construct($kodeUpload)
    {
        $this->kodeUpload = $kodeUpload;
    }

    public function model(array $row)
    {
        // Kalau distrik kosong karena merge, gunakan distrik sebelumnya
        if (!empty($row['distrik'])) {
            $this->currentDistrik = $row['distrik'];
        }

        if (empty($row['kebun']) || empty($row['link_playlist'])) {
            return null;
        }

        return new LinkKebunTBM([
            'kode_upload'   => $this->kodeUpload,
            'distrik'       => $this->currentDistrik,
            'kebun'         => $row['kebun'],
            'link_playlist' => $row['link_playlist'],
        ]);
    }
}
