<?php

namespace App\Services;

use App\Models\DetailRekap;
use App\Models\KomposisiLahan;
use App\Models\DetailAreal;
use App\Models\LokasiKebun;
use App\Models\LinkKebunTBM;
use App\Helpers\ExcelDataHelper;
use Illuminate\Support\Facades\Log;

class ChartDataService
{
    /**
     * Chart: Peringkat Kondisi Pohon
     */
    public function getPeringkatKondisiPohonData()
    {
        $rekap = DetailRekap::where('is_total', true)
            ->orderBy('kebun')
            ->get(['kebun', 'persen_pkk_normal', 'persen_pkk_non_valuer', 'persen_pkk_mati']);

        $rekapTerbaik = $rekap->sortByDesc('persen_pkk_normal')->values();

        return [
            'namaKebunTerbaik' => $rekapTerbaik->pluck('kebun'),
            'persenTerbaik' => $rekapTerbaik->pluck('persen_pkk_normal')->map(fn($v) => round($v, 2)),
            'pkkNormal' => $rekapTerbaik->pluck('persen_pkk_normal'),
            'pkkNonvaluer' => $rekapTerbaik->pluck('persen_pkk_non_valuer')->map(fn($v) => round($v, 2)),
            'pkkMati' => $rekapTerbaik->pluck('persen_pkk_mati'),
        ];
    }

    /**
     * Chart: Peringkat Pemeliharaan
     */
    public function getPeringkatPemeliharaanData()
    {
        $data = DetailRekap::where('is_total', true)
            ->orderBy('kebun')
            ->get([
                'kebun',
                'persen_tutupan_kacangan',
                'persen_pir_pkk_kurang_baik',
                'persen_area_tergenang',
                'kondisi_anak_kayu',
            ]);

        if ($data->isEmpty()) return [];

        $maxTutupanKacangan = $data->max('persen_tutupan_kacangan');
        $minPirPKKKurangBaik = $data->min('persen_pir_pkk_kurang_baik');
        $minAreaTergenang = $data->min('persen_area_tergenang');
        $minKondisiAnakKayu = $data->min('kondisi_anak_kayu');

        foreach ($data as $item) {
            $normTutupanKacangan = $maxTutupanKacangan > 0 ? $item->persen_tutupan_kacangan / $maxTutupanKacangan : 0;
            $normPirPKKKurangBaik = ($item->persen_pir_pkk_kurang_baik > 0 && $minPirPKKKurangBaik > 0) ? $minPirPKKKurangBaik / $item->persen_pir_pkk_kurang_baik : 1;
            $normAreaTergenang = ($item->persen_area_tergenang > 0 && $minAreaTergenang > 0) ? $minAreaTergenang / $item->persen_area_tergenang : 1;
            $normKondisiAnakKayu = ($item->kondisi_anak_kayu > 0 && $minKondisiAnakKayu > 0) ? $minKondisiAnakKayu / $item->kondisi_anak_kayu : 1;

            $item->score = round(
                $normTutupanKacangan * 0.4 +
                    $normPirPKKKurangBaik * 0.25 +
                    $normAreaTergenang * 0.2 +
                    $normKondisiAnakKayu * 0.15,
                4
            );
        }

        $sorted = $data->sortByDesc('score')->values();

        return [
            'namaKebunTerbaik' => $sorted->pluck('kebun'),
            'kacangan' => $sorted->pluck('persen_tutupan_kacangan'),
            'pemeliharaanKurangBaik' => $sorted->pluck('persen_pir_pkk_kurang_baik')->map(fn($v) => round($v, 2)),
            'arealTergenang' => $sorted->pluck('persen_area_tergenang'),
            'anakKayu' => $sorted->pluck('kondisi_anak_kayu')->map(fn($v) => round($v, 2)),
        ];
    }

    /**
     * Chart: Komposisi Lahan
     */
    public function getKomposisiLahanData()
    {
        $komposisi = KomposisiLahan::select('label', 'persentase')->get();

        return [
            'komposisiLabels' => $komposisi->pluck('label'),
            'komposisiSeries' => $komposisi->pluck('persentase')->map(fn($v) => round($v, 2)),
        ];
    }

    /**
     * Chart: Luas Areal Tahun Tanam
     */
    public function getLuasArealTahunTanamData()
    {
        $data = DetailRekap::where('is_total', false) // hanya data detail, bukan total
            ->whereNotNull('tahun_tanam')             // pastikan tahun tidak null
            ->where('tahun_tanam', '!=', 0)           // hindari data 0000
            ->selectRaw('tahun_tanam as tahun, SUM(luas_ha) as total_luas')
            ->groupBy('tahun_tanam')
            ->orderBy('tahun_tanam')
            ->get();

        return [
            'tahunTanam' => $data->pluck('tahun'),
            'totalLuas' => $data->pluck('total_luas')->map(fn($v) => round($v, 2)),
        ];
    }

    /**
     * Chart: Luas Areal Tahun Tanam per Kebun
     */
    public function getLuasArealTahunTanamPerKebunData()
    {
        $data = DetailRekap::whereNotNull('tahun_tanam')
            ->orWhere('is_total', 1) // pastikan TOTAL tetap masuk meskipun tahun_tanam null
            ->whereNotNull('luas_ha')
            ->get();

        // Hitung total luas per kebun untuk urutan (gunakan hanya is_total == 1)
        $kebunTotals = $data->where('is_total', 1)
            ->filter(fn($item) => !empty($item->kebun))
            ->groupBy(fn($item) => strtoupper(trim($item->kebun)))
            ->map(fn($items) => $items->sum('luas_ha'));

        // Urutkan nama kebun dari yang terluas (hanya yang ada is_total)
        $namaKebun = $kebunTotals->sortDesc()->keys()->values();

        $seriesMap = [];

        foreach ($data as $row) {
            $isTotal = (int) $row->is_total === 1;
            $kebun = strtoupper(trim($row->kebun ?? ''));

            // Lewatkan jika nama kebun kosong
            if (empty($kebun)) continue;

            // Label: TOTAL atau AFD - Tahun
            $label = $isTotal ? 'TOTAL' : "{$row->afdeling} - {$row->tahun_tanam}";

            // Inisialisasi label (series)
            if (!isset($seriesMap[$label])) {
                // Pakai semua kebun yang sudah muncul di namaKebun
                $seriesMap[$label] = array_fill_keys($namaKebun->toArray(), 0);
            }

            // Jika kebun belum ada di map label ini, tambahkan
            if (!array_key_exists($kebun, $seriesMap[$label])) {
                $seriesMap[$label][$kebun] = 0;

                // Tambahkan juga ke semua label lain agar konsisten
                foreach ($seriesMap as &$otherLabel) {
                    if (!array_key_exists($kebun, $otherLabel)) {
                        $otherLabel[$kebun] = 0;
                    }
                }

                // Tambahkan juga ke daftar kebun global
                if (!$namaKebun->contains($kebun)) {
                    $namaKebun->push($kebun);
                }
            }

            // Tambahkan luasnya
            $seriesMap[$label][$kebun] += $row->luas_ha;
        }

        // Pisahkan dan simpan TOTAL di akhir
        $totalSeries = [];
        if (isset($seriesMap['TOTAL'])) {
            $totalSeries['TOTAL'] = $seriesMap['TOTAL'];
            unset($seriesMap['TOTAL']);
        }

        // Urutkan label series non-TOTAL berdasarkan AFD dan tahun tanam
        $orderedSeriesMap = collect($seriesMap)->sortKeysUsing(function ($a, $b) {
            preg_match('/AFD(\d+)\s*-\s*(\d+)/', $a, $matchA);
            preg_match('/AFD(\d+)\s*-\s*(\d+)/', $b, $matchB);

            $afdA = isset($matchA[1]) ? (int)$matchA[1] : 999;
            $afdB = isset($matchB[1]) ? (int)$matchB[1] : 999;

            if ($afdA === $afdB) {
                $yearA = isset($matchA[2]) ? (int)$matchA[2] : 0;
                $yearB = isset($matchB[2]) ? (int)$matchB[2] : 0;
                return $yearA <=> $yearB;
            }

            return $afdA <=> $afdB;
        })->toArray();

        // Gabungkan kembali TOTAL di akhir
        $orderedSeriesMap = $orderedSeriesMap + $totalSeries;

        // Susun data akhir untuk ApexChart
        $series = [];
        foreach ($orderedSeriesMap as $label => $values) {
            // Urutkan sesuai namaKebun
            $sortedValues = [];
            foreach ($namaKebun as $kebun) {
                $sortedValues[] = $values[$kebun] ?? 0;
            }

            $series[] = [
                'name' => $label,
                'data' => $sortedValues
            ];
        }

        return [
            'namaKebunTerluas' => $namaKebun->toArray(), // Label X (kebun)
            'series' => $series // Data series per AFD-TT & TOTAL
        ];
    }

    /**
     * Info Kebun Data
     */
    public function getInfoKebunData($kodeKebun)
    {
        $row = DetailRekap::where('kebun', strtoupper($kodeKebun))
            ->where('is_total', true)
            ->first();

        if (!$row) {
            return [
                'distrik' => '-',
                'nama' => '-',
                'luas' => 0,
                'kode_kebun' => strtoupper($kodeKebun),
            ];
        }

        return \App\Helpers\ExcelDataHelper::getInfoKebun(
            $row->kebun,
            $row->kode_distrik ?? $row->distrik ?? '-',
            $row->luas_ha ?? 0
        );
    }

    /**
     * Chart: Kondisi Pohon
     */
    public function getKondisiPohonData($kodeKebun)
    {
        $data = DetailRekap::where('kebun', strtoupper($kodeKebun))
            ->where('is_total', true)
            ->get();

        return ExcelDataHelper::getKondisiPohonData($data);
    }

    /**
     * Chart: Detail Areal
     */
    public function getDetailArealData($kodeKebun)
    {
        $data = DetailAreal::where('kebun', strtoupper($kodeKebun))->get();

        $categories = [
            'Sawit - TBM I',
            'Karet - TBM I',
            'Sawit - TBM II',
            'Karet - TBM II',
            'Sawit - TBM III',
            'Karet - TBM III',
        ];

        $afdelings = $data->pluck('afdeling')->unique()->values();
        $warnaAfd = [
            '#60A5FA',
            '#3B82F6',
            '#1E40AF',
            '#6366F1',
            '#7C3AED',
            '#9333EA',
            '#A855F7',
            '#D946EF',
            '#EC4899',
            '#F43F5E',
            '#F87171',
        ];

        $series = [];

        foreach ($afdelings as $i => $afd) {
            $row = $data->firstWhere('afdeling', $afd);
            if (!$row) continue;

            $series[] = [
                'name' => strtoupper($afd),
                'data' => [
                    (float) ($row->tbm_i_sawit ?? 0),
                    (float) ($row->tbm_i_karet ?? 0),
                    (float) ($row->tbm_ii_sawit ?? 0),
                    (float) ($row->tbm_ii_karet ?? 0),
                    (float) ($row->tbm_iii_sawit ?? 0),
                    (float) ($row->tbm_iii_karet ?? 0),
                ],
            ];
        }

        return [
            'categories' => $categories,
            'series' => $series,
        ];
    }

    /**
     * Chart: Areal Tanaman
     */
    public function getArealTanamanData($kodeKebun)
    {
        $data = DetailRekap::where('kebun', strtoupper($kodeKebun))
            ->where('is_total', true)
            ->get();

        return ExcelDataHelper::getArealTanamanData($data);
    }

    /**
     * Lokasi Kebun
     */
    public function getLokasiKebunData($kodeKebun)
    {
        $data = LokasiKebun::where('kebun', strtoupper($kodeKebun))->get();
        return ExcelDataHelper::getLokasiKebun($data);
    }

    /**
     * Link Kebun TBM
     */
    public function getLinkKebunTBMData($kodeKebun)
    {
        return LinkKebunTBM::where('kebun', strtoupper($kodeKebun))
            ->select('distrik', 'kebun', 'link_playlist')
            ->first(); // ambil satu record per kebun
    }
}
