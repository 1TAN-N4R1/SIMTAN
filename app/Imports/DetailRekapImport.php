<?php

namespace App\Imports;

use App\Models\DetailRekap;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class DetailRekapImport implements ToCollection, WithHeadingRow
{
    protected $kodeUpload;

    public function __construct($kodeUpload)
    {
        $this->kodeUpload = $kodeUpload;
    }

    public function collection(Collection $rows)
    {
        Log::info('🧠 Header yang terdeteksi oleh Excel:', $rows->first()->keys()->toArray());

        $currentDistrik = null;
        $currentKebun = null;
        $success = 0;
        $failed = 0;

        if ($rows->isNotEmpty()) {
            Log::info("[IMPORT DETAIL REKAP] Header pertama: " . json_encode($rows->first()->toArray()));
        }

        foreach ($rows as $index => $row) {
            $originalRow = $row;
            Log::info("🔍 Baris ke-{$index} asli: " . json_encode($row->toArray()));

            // ✅ Gunakan mapping pintar sebelum normalisasi
            $specialMapped = $this->mapSpecialHeaderValues($row);
            $mergedRow = collect($row)->merge($specialMapped);

            // ✅ Normalisasi key
            $row = $mergedRow->mapWithKeys(function ($val, $key) {
                $key = trim($key);
                $key = strtolower($key);

                if (str_starts_with($key, '%')) {
                    $key = 'persen_' . substr($key, 1);
                }

                $key = preg_replace('/[\s\/\(\)%]+/', '_', $key);
                $key = preg_replace('/_{2,}/', '_', $key);
                $key = trim($key, '_');

                return [$key => $val];
            });

            Log::info("🎯 Normalized headers:", $row->keys()->toArray());

            if ($index === 0) {
                Log::info("🧾 Semua key asli sebelum normalisasi:", $originalRow->keys()->toArray());
                Log::info("➡ PKK NORMAL (raw): " . json_encode($originalRow['pkk_normal'] ?? 'TIDAK ADA'));
                Log::info("➡ PKK NON VALUER/ KERDIL (raw): " . json_encode($originalRow['pkk_non_valuer_kerdil'] ?? 'TIDAK ADA'));
                Log::info("➡ PKK MATI (raw): " . json_encode($originalRow['pkk_mati'] ?? 'TIDAK ADA'));
            }

            $row = $row->merge([
                'pkk_normal'                  => $row['pkk_normal'] ?? null,
                'pkk_non_valuer'              => $row['pkk_non_valuer_kerdil'] ?? $row['pkk_non_valuer'] ?? null,
                'pkk_mati'                    => $row['pkk_mati'] ?? null,
                'persen_pkk_normal'           => $row['persen_pkk_normal'] ?? null,
                'persen_pkk_non_valuer'       => $row['persen_pkk_non_valuer_kerdil'] ?? $row['persen_pkk_non_valuer'] ?? null,
                'persen_pkk_mati'             => $row['persen_pkk_mati'] ?? null,
                'persen_tutupan_kacangan'     => $row['persen_tutupan_kacangan'] ?? $row['tutupan_kacangan'] ?? null,
                'persen_pir_pkk_kurang_baik'  => $row['persen_pir_pkk_dan_pasar_pikul_kurang_baik'] ?? $row['pir_pkk_dan_pasar_pikul_kurang_baik'] ?? null,
                'persen_area_tergenang'       => $row['persen_area_tergenang'] ?? $row['area_tergenang'] ?? null,
            ]);

            if ($row->filter()->isEmpty()) {
                Log::info("[IMPORT] ⏩ Skip baris kosong di index {$index}");
                continue;
            }

            if (
                strtoupper($row['distrik'] ?? '') === 'DISTRIK' &&
                strtoupper($row['kebun'] ?? '') === 'KEBUN'
            ) {
                Log::info("[IMPORT] ⏩ Skip baris header duplikat di index {$index}");
                continue;
            }

            if (!empty($row['distrik']) && strtoupper(trim($row['distrik'])) !== 'TOTAL') {
                $currentDistrik = strtoupper(trim($row['distrik']));
            }

            if (!empty($row['kebun']) && strtoupper(trim($row['kebun'])) !== 'TOTAL') {
                $currentKebun = strtoupper(trim($row['kebun']));
            }

            if (!$currentDistrik || !$currentKebun) {
                Log::warning("[IMPORT] ❌ Baris {$index} dilewati karena distrik/kebun kosong. Distrik: {$currentDistrik}, Kebun: {$currentKebun}");
                continue;
            }

            $pkkAwal = $this->sanitizeRibuan($row['pkk_awal'] ?? null);
            if ($pkkAwal === null) {
                Log::warning("[IMPORT] ❌ Baris {$index} dilewati: PKK Awal kosong/tidak valid. Nilai asli: " . json_encode($row['pkk_awal'] ?? null));
                continue;
            }

            try {
                $afdeling = $this->sanitizeAfdeling($row['afdeling'] ?? null);
                $isTotal = empty($afdeling) ? 1 : 0;

                $data = [
                    'kode_upload'                 => $this->kodeUpload,
                    'distrik'                     => $currentDistrik,
                    'kebun'                       => $currentKebun,
                    'afdeling'                    => $afdeling,
                    'tahun_tanam'                 => !empty($row['tahun_tanam']) ? (int) $row['tahun_tanam'] : null,
                    'luas_ha'                     => $this->sanitizeDesimal($row['luas_ha'] ?? null),
                    'pkk_awal'                    => $pkkAwal,
                    'pkk_normal'                  => $this->sanitizeRibuan($row['pkk_normal'] ?? null),
                    'pkk_non_valuer'              => $this->sanitizeRibuan($row['pkk_non_valuer'] ?? null),
                    'pkk_mati'                    => $this->sanitizeRibuan($row['pkk_mati'] ?? null),
                    'pkk_ha_kond_normal'          => $this->sanitizeDesimal($row['pkkha_kond_normal'] ?? null),
                    'persen_pkk_normal'           => $this->sanitizeDesimal($row['persen_pkk_normal']),
                    'persen_pkk_non_valuer'       => $this->sanitizeDesimal($row['persen_pkk_non_valuer']),
                    'persen_pkk_mati'             => $this->sanitizeDesimal($row['persen_pkk_mati']),
                    'persen_tutupan_kacangan'     => $this->sanitizeDesimal($row['persen_tutupan_kacangan']),
                    'persen_pir_pkk_kurang_baik'  => $this->sanitizeDesimal($row['persen_pir_pkk_kurang_baik']),
                    'persen_area_tergenang'       => $this->sanitizeDesimal($row['persen_area_tergenang']),
                    'kondisi_anak_kayu'           => $this->keepOriginalFormat($row['kondisi_anak_kayu'] ?? null),
                    'gangguan_ternak'             => $row['gangguan_ternak'] ?? null,
                    'is_total'                    => $isTotal,
                ];

                if ($index === 0) {
                    dump("🔍 Baris ke-{$index} hasil akhir normalisasi:", $row->toArray());
                    dump("📊 Data siap disimpan:", $data);
                }

                Log::info("📥 Data akan disimpan untuk baris {$index}: " . json_encode($data));
                DetailRekap::create($data);
                $success++;

                Log::info("✅ Berhasil simpan baris {$index}. [Kebun: {$currentKebun}, Distrik: {$currentDistrik}]");
            } catch (\Exception $e) {
                $failed++;
                Log::error("❌ Gagal simpan baris {$index}: " . $e->getMessage());
                Log::debug("‼️ Data yang gagal disimpan: " . json_encode($data ?? []));
            }
        }

        Log::info("[IMPORT SELESAI] ✅ Sukses: {$success} | ❌ Gagal: {$failed} | Total baris: {$rows->count()}");
    }

    private function mapSpecialHeaderValues($row): array
    {
        $mapping = [];

        foreach ($row as $key => $value) {
            $normalized = strtolower(trim($key));

            if (str_starts_with($normalized, '%') || str_contains($normalized, '%')) {
                if (str_contains($normalized, 'pkk normal')) {
                    $mapping['persen_pkk_normal'] = $value;
                } elseif (str_contains($normalized, 'non valuer') || str_contains($normalized, 'kerdil')) {
                    $mapping['persen_pkk_non_valuer'] = $value;
                } elseif (str_contains($normalized, 'pkk mati')) {
                    $mapping['persen_pkk_mati'] = $value;
                }
            }
        }

        return $mapping;
    }

    private function keepOriginalFormat($value)
    {
        if ($value === null || trim($value) === '' || $value === '-' || (is_string($value) && str_starts_with($value, '='))) {
            return null;
        }

        return preg_replace('/[^\d\.,\-]/', '', (string) $value);
    }

    private function sanitizeRibuan($value)
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_string($value)) {
            $value = str_replace([',', '.'], '', $value);
        }

        return is_numeric($value) ? (int) $value : null;
    }

    private function sanitizeDesimal($value)
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_string($value)) {
            $value = str_replace(',', '.', $value);
        }

        return is_numeric($value) ? floatval($value) : null;
    }

    private function sanitizeAfdeling($value)
    {
        if (!$value || trim($value) === '-' || strtoupper(trim($value)) === 'TOTAL') {
            return null;
        }

        return strtoupper(str_replace(' ', '', trim($value)));
    }
}
