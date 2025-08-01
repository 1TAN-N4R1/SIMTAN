<?php

namespace App\Imports;

use App\Models\DetailAreal;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class DetailArealImport implements ToCollection
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

        if ($rows->count() < 2) {
            Log::warning("[IMPORT DETAIL AREAL] File terlalu sedikit baris (kurang dari 2).");
            return;
        }

        $currentDistrik = null;
        $currentKebun = null;

        foreach ($rows->slice(1) as $index => $row) {
            $rowArray = $row->toArray();

            if (collect($rowArray)->filter()->isEmpty()) {
                continue;
            }

            $distrik  = $rowArray[0] ?? null;
            $kebun    = $rowArray[1] ?? null;
            $afdeling = $rowArray[2] ?? null;

            if ($distrik !== null && trim($distrik) !== '') {
                $currentDistrik = trim($distrik);
            }

            if ($kebun !== null && trim($kebun) !== '') {
                $currentKebun = trim($kebun);
            }

            // ✅ Deteksi baris TOTAL
            if (strtoupper(trim($distrik)) === 'TOTAL') {
                try {
                    $data = [
                        'kode_upload'    => $this->kodeUpload,
                        'distrik'        => 'TOTAL',
                        'kebun'          => null,
                        'afdeling'       => null,
                        'tbm_i_sawit'    => $this->sanitize($rowArray[3] ?? null),
                        'tbm_i_karet'    => $this->sanitize($rowArray[4] ?? null),
                        'tbm_ii_sawit'   => $this->sanitize($rowArray[5] ?? null),
                        'tbm_ii_karet'   => $this->sanitize($rowArray[6] ?? null),
                        'tbm_iii_sawit'  => $this->sanitize($rowArray[7] ?? null),
                        'tbm_iii_karet'  => $this->sanitize($rowArray[8] ?? null),
                    ];

                    DetailAreal::create($data);
                    $success++;
                    Log::info("✅ Baris TOTAL disimpan: " . json_encode($data));
                } catch (\Exception $e) {
                    $failed++;
                    Log::error("❌ Gagal simpan baris TOTAL: " . $e->getMessage());
                }
                continue;
            }

            // ✅ Skip jika tidak ada afdeling & bukan TOTAL
            if (!$afdeling || is_numeric($afdeling)) {
                Log::warning("🚫 Baris " . ($index + 2) . " dilewati karena afdeling tidak valid: " . json_encode($rowArray));
                continue;
            }

            try {
                $data = [
                    'kode_upload'    => $this->kodeUpload,
                    'distrik'        => $currentDistrik,
                    'kebun'          => $currentKebun,
                    'afdeling'       => trim($afdeling),
                    'tbm_i_sawit'    => $this->sanitize($rowArray[3] ?? null),
                    'tbm_i_karet'    => $this->sanitize($rowArray[4] ?? null),
                    'tbm_ii_sawit'   => $this->sanitize($rowArray[5] ?? null),
                    'tbm_ii_karet'   => $this->sanitize($rowArray[6] ?? null),
                    'tbm_iii_sawit'  => $this->sanitize($rowArray[7] ?? null),
                    'tbm_iii_karet'  => $this->sanitize($rowArray[8] ?? null),
                ];

                DetailAreal::create($data);
                $success++;
                Log::info("✅ Baris " . ($index + 2) . " berhasil simpan: " . json_encode($data));
            } catch (\Exception $e) {
                $failed++;
                Log::error("❌ Gagal simpan baris " . ($index + 2) . ": " . $e->getMessage());
            }
        }

        Log::info("[IMPORT DETAIL AREAL SELESAI] ✅ Sukses: {$success} | ❌ Gagal: {$failed}");
    }

    private function sanitize($value)
    {
        if ($value === null || trim((string) $value) === '' || $value === '-') {
            return 0;
        }

        $cleaned = preg_replace('/[^\d\.,\-]/', '', (string) $value);
        $cleaned = str_replace(',', '.', $cleaned);

        return is_numeric($cleaned) ? (float) $cleaned : 0;
    }
}
