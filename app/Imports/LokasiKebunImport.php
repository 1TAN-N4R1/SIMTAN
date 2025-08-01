<?php

namespace App\Imports;

use App\Models\LokasiKebun;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class LokasiKebunImport implements ToCollection
{
    protected $kodeUpload;

    public function __construct($kodeUpload)
    {
        $this->kodeUpload = $kodeUpload;
    }

    public function collection(Collection $rows)
    {
        $success = 0;
        $failed = 0;

        $currentDistrik = null;
        $currentKebun = null;
        $lastJenisLokasi = null; // ✅ untuk simpan jenis lokasi terakhir

        foreach ($rows->slice(1) as $index => $row) {
            $rowArray = $row->toArray();

            // Skip baris kosong total
            if (collect($rowArray)->filter()->isEmpty()) {
                continue;
            }

            $distrik      = $rowArray[0] ?? null;
            $kebun        = $rowArray[1] ?? null;
            $jenisLokasi  = $rowArray[2] ?? null;
            $namaLokasi   = $rowArray[3] ?? null;
            $latitude     = $rowArray[4] ?? null;
            $longitude    = $rowArray[5] ?? null;

            // Simpan distrik terakhir jika ada
            if (!empty(trim($distrik))) {
                $currentDistrik = trim($distrik);
            }

            // Simpan kebun terakhir jika ada
            if (!empty(trim($kebun))) {
                $currentKebun = trim($kebun);
            }

            // Jika jenis lokasi ada, simpan; jika kosong pakai yang terakhir
            if (!empty(trim($jenisLokasi))) {
                $lastJenisLokasi = trim($jenisLokasi);
            } else {
                $jenisLokasi = $lastJenisLokasi;
            }

            if (!$currentDistrik || !$currentKebun || !$namaLokasi) {
                Log::warning("⚠️ Baris " . ($index + 2) . " dilewati: distrik/kebun/nama_lokasi kosong.");
                continue;
            }

            try {
                LokasiKebun::create([
                    'kode_upload'  => $this->kodeUpload,
                    'distrik'      => $currentDistrik,
                    'kebun'        => $currentKebun,
                    'jenis_lokasi' => $jenisLokasi ?? '-',
                    'nama_lokasi'  => trim($namaLokasi),
                    'latitude'     => $this->toFloat($latitude),
                    'longitude'    => $this->toFloat($longitude),
                ]);

                $success++;
            } catch (\Exception $e) {
                $failed++;
                Log::error("❌ Gagal simpan baris " . ($index + 2) . ": " . $e->getMessage());
            }
        }

        Log::info("[IMPORT LOKASI KEBUN SELESAI] ✅ Sukses: {$success} | ❌ Gagal: {$failed}");
    }

    private function toFloat($value)
    {
        if ($value === null || trim((string)$value) === '' || $value === '-') {
            return null;
        }

        $cleaned = preg_replace('/[^\d\.\-]/', '', str_replace(',', '.', (string) $value));
        return is_numeric($cleaned) ? (float) $cleaned : null;
    }
}
