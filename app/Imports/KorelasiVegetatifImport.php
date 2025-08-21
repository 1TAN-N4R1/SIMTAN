<?php

namespace App\Imports;

use App\Models\KorelasiVegetatif;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Support\Facades\Log;

class KorelasiVegetatifImport implements ToCollection, WithStartRow, WithMultipleSheets
{
    protected $kodeUpload;

    public function __construct($kodeUpload)
    {
        $this->kodeUpload = $kodeUpload;
    }

    /**
     * Pilih hanya sheet pertama (index 0)
     */
    public function sheets(): array
    {
        return [
            0 => $this
        ];
    }

    /**
     * Baris awal pembacaan Excel
     */
    public function startRow(): int
    {
        return 3;
    }

    public function collection(Collection $rows)
    {
        $success = 0;
        $failed = 0;

        // Variabel untuk menyimpan nilai terakhir
        $lastTahun     = null;
        $lastKebun     = null;
        $lastTopografi = null;
        $lastBlok      = null;

        foreach ($rows as $index => $row) {
            Log::info("📄 [KORELASI VEGETATIF] Baris {$index} : " . json_encode($row->toArray()));

            // Ambil nilai, jika kosong pakai nilai terakhir
            $tahun     = $this->keepString($row[0] ?? null) ?: $lastTahun;
            $kebun     = $this->keepString($row[1] ?? null) ?: $lastKebun;
            $topografi = $this->keepString($row[2] ?? null) ?: $lastTopografi;
            $blok      = $this->keepString($row[3] ?? null) ?: $lastBlok;

            // Kolom angka
            $keliling_crown  = $this->sanitizeDesimal($row[4] ?? null);
            $lingkar_batang  = $this->sanitizeDesimal($row[5] ?? null);
            $jumlah_pelepah  = $this->sanitizeDesimal($row[6] ?? null);
            $panjang_pelepah = $this->sanitizeDesimal($row[7] ?? null);

            // Simpan nilai terakhir jika kolom tidak kosong
            if (!empty($tahun))     $lastTahun     = $tahun;
            if (!empty($kebun))     $lastKebun     = $kebun;
            if (!empty($topografi)) $lastTopografi = $topografi;
            if (!empty($blok))      $lastBlok      = $blok;

            // Cek apakah baris kosong
            $isEmptyRow = (
                empty($tahun) &&
                empty($kebun) &&
                empty($topografi) &&
                empty($blok) &&
                $keliling_crown === null &&
                $lingkar_batang === null &&
                $jumlah_pelepah === null &&
                $panjang_pelepah === null
            );

            if ($isEmptyRow) {
                Log::info("⏩ Skip baris {$index} karena kosong.");
                continue;
            }

            // Cek header duplikat
            if (
                strtoupper(trim($tahun)) === 'TAHUN' &&
                strtoupper(trim($kebun)) === 'KEBUN' &&
                strtoupper(trim($topografi)) === 'TOPOGRAFI' &&
                strtoupper(trim($blok)) === 'BLOK'
            ) {
                Log::info("⏩ Skip baris {$index} karena header duplikat.");
                continue;
            }

            try {
                KorelasiVegetatif::create([
                    'kode_upload'     => $this->kodeUpload,
                    'tahun'           => $tahun,
                    'kebun'           => $kebun,
                    'topografi'       => $topografi,
                    'blok'            => $blok,
                    'keliling_crown'  => $keliling_crown,
                    'lingkar_batang'  => $lingkar_batang,
                    'jumlah_pelepah'  => $jumlah_pelepah,
                    'panjang_pelepah' => $panjang_pelepah,
                ]);

                $success++;
                Log::info("✅ Berhasil simpan baris {$index} [Kebun: {$kebun}, Tahun: {$tahun}, Topografi: {$topografi}, Blok: {$blok}]");
            } catch (\Exception $e) {
                $failed++;
                Log::error("❌ Gagal simpan baris {$index}: " . $e->getMessage());
            }
        }

        Log::info("[IMPORT KORELASI VEGETATIF SELESAI] ✅ Sukses: {$success} | ❌ Gagal: {$failed} | Total dibaca: {$rows->count()}");
    }

    private function sanitizeDesimal($value)
    {
        if ($value === null || $value === '') {
            return null;
        }
        if (is_string($value)) {
            $value = str_replace(',', '.', $value);
        }
        return is_numeric($value) ? (float) $value : null;
    }

    private function keepString($value)
    {
        if ($value === null) {
            return null;
        }
        return trim((string) $value);
    }
}
