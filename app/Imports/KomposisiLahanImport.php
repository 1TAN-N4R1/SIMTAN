<?php

namespace App\Imports;

use App\Models\KomposisiLahan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class KomposisiLahanImport implements ToCollection, WithHeadingRow
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

        if ($rows->isNotEmpty()) {
            Log::info("[IMPORT KOMPOSISI LAHAN] Header pertama: " . json_encode($rows->first()->toArray()));
        }

        foreach ($rows as $index => $row) {
            Log::info("🔍 KomposisiLahan - Baris ke-{$index} asli: " . json_encode($row->toArray()));

            $row = collect($row)->mapWithKeys(function ($val, $key) {
                $key = strtolower(trim($key));
                $key = str_replace([' ', '/', '%', '(', ')'], ['_', '_', 'persentase_', '', ''], $key);
                return [$key => $val];
            });

            try {
                $label = $row['label'] ?? null;
                $persentase = $this->sanitize($row['persentase'] ?? null);

                if (!$label || $persentase === null) {
                    Log::warning("[IMPORT KOMPOSISI LAHAN] ❌ Baris {$index} dilewati karena data tidak lengkap. Label: {$label}, Persentase: {$persentase}");
                    continue;
                }

                $data = [
                    'kode_upload' => $this->kodeUpload,
                    'label' => trim($label),
                    'persentase' => $persentase,
                ];

                KomposisiLahan::create($data);
                $success++;
                Log::info("✅ KomposisiLahan - Berhasil simpan baris {$index}: " . json_encode($data));
            } catch (\Exception $e) {
                $failed++;
                Log::error("❌ KomposisiLahan - Gagal simpan baris {$index}: " . $e->getMessage());
                Log::debug("‼️ Data yang gagal disimpan: " . json_encode($data ?? []));
            }
        }

        Log::info("[IMPORT KOMPOSISI LAHAN SELESAI] ✅ Sukses: {$success} | ❌ Gagal: {$failed} | Total baris: {$rows->count()}");
    }

    private function sanitize($value)
    {
        if ($value === null || trim($value) === '' || $value === '-' || (is_string($value) && str_starts_with($value, '='))) {
            return null;
        }

        $cleaned = preg_replace('/[^\d\.,\-]/', '', (string) $value);
        $cleaned = str_replace(',', '.', $cleaned);

        return is_numeric($cleaned) ? (float) $cleaned : null;
    }
}
