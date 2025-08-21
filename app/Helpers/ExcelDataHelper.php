<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ExcelDataHelper
{
    /**
     * Mengembalikan info nama kebun dan distrik berdasarkan kode
     */
    public static function getInfoKebun($kodeKebun, $kodeDistrik, $luas)
    {
        $kodeKebun = strtoupper(trim($kodeKebun));
        $kodeDistrik = strtoupper(trim($kodeDistrik));

        $namaDistrik = [
            '1DL1' => 'Distrik Labuhan Batu I',
            '1DL2' => 'Distrik Labuhan Batu II',
            '1DL3' => 'Distrik Labuhan Batu III',
            '1DS1' => 'Distrik Deli Serdang I',
            '1DS2' => 'Distrik Deli Serdang II',
            '1DSH' => 'Distrik Asahan',
        ];

        $namaKebun = [
            '1KSD' => 'Kebun Sei Daun',
            '1KSK' => 'Kebun Sei Kebara',
            '1KAN' => 'Kebun Aek Nabara Utara',
            '1KAS' => 'Kebun Aek Nabara Selatan',
            '1KLJ' => 'Kebun Labuhan Haji',
            '1KMM' => 'Kebun Mambang Muda',
            '1KMS' => 'Kebun Merbau Selatan',
            '1KRP' => 'Kebun Rantau Prapat',
            '1KBB' => 'Kebun Bandar Betsy',
            '1KBN' => 'Kebun Bangun',
            '1KDH' => 'Kebun Dusun Hulu',
            '1KGM' => 'Kebun Gunung Monaco',
            '1KGP' => 'Kebun Gunung Pamela',
            '1KGR' => 'Kebun Gunung Para',
            '1KSA' => 'Kebun Silau Dunia',
            '1KBU' => 'Kebun Batang Toru',
            '1KHG' => 'Kebun Hapesong',
            '1KRB' => 'Kebun Rambutan',
            '1KSG' => 'Kebun Sarang Giting',
            '1KSP' => 'Kebun Sei Putih',
            '1KTR' => 'Kebun Tanah Raja',
            '1KAM' => 'Kebun Ambalutu',
            '1KDP' => 'Kebun Sei Dadap',
            '1KHP' => 'Kebun Huta Padang',
            '1KPM' => 'Kebun Pulau Mandi',
            '1KSL' => 'Kebun Sei Silau',
        ];

        return [
            'nama' => $namaKebun[$kodeKebun] ?? $kodeKebun,
            'distrik' => $namaDistrik[$kodeDistrik] ?? $kodeDistrik,
            'luas' => $luas,
            'kode_kebun' => $kodeKebun,
        ];
    }

    /**
     * Data peringkat kondisi pohon (chart peringkatKondisiPohonChart)
     */
    public static function formatKondisiPohonData(Collection $data): array
    {
        $formatted = $data->map(function ($item) {
            return [
                'kebun' => $item->kebun,
                'normal' => $item->persen_pkk_normal,
                'non_valuer' => $item->persen_pkk_non_valuer,
                'mati' => $item->persen_pkk_mati,
            ];
        })->values();

        Log::info('✅ Formatted data:', $formatted->toArray());

        return [
            'peringkatKondisiPohonChartData' => $formatted->toArray()
        ];
    }


    /**
     * Data peringkat pemeliharaan (chart peringkatPemeliharaanChart)
     */
    public static function formatPemeliharaanData(Collection $data): array
    {
        $formatted = $data->map(function ($item) {
            return [
                'kebun' => $item->kebun,
                'kacangan' => (float) $item->persen_tutupan_kacangan,
                'pemeliharaan' => (float) $item->persen_pir_pkk_kurang_baik,
                'tergenang' => (float) $item->persen_area_tergenang,
                'anak_kayu' => (float) $item->kondisi_anak_kayu,
            ];
        })->values();

        Log::info('✅ Formatted data pemeliharaan:', $formatted->toArray());

        return [
            'peringkatPemeliharaanChartData' => $formatted->toArray()
        ];
    }

    /**
     * Data korelasi vegetatif (chart korelasiVegetatif)
     */
    public static function formatKorelasiVegetatifData(Collection $data): array
    {
        $labels = [];
        $lingkarBatang = [];
        $jumlahPelepah = [];
        $panjangPelepah = [];

        foreach ($data as $item) {
            // Skip kalau semua nilai numerik null
            if (
                $item->lingkar_batang === null &&
                $item->jumlah_pelepah === null &&
                $item->panjang_pelepah === null
            ) {
                continue;
            }

            $labels[] = $item->kebun . ' - ' . $item->topografi;
            $lingkarBatang[] = (float) $item->lingkar_batang;
            $jumlahPelepah[] = (float) $item->jumlah_pelepah;
            $panjangPelepah[] = (float) $item->panjang_pelepah;
        }

        return [
            'korelasiVegetatifLabels' => $labels,
            'korelasiVegetatifLingkarBatang' => $lingkarBatang,
            'korelasiVegetatifJumlahPelepah' => $jumlahPelepah,
            'korelasiVegetatifPanjangPelepah' => $panjangPelepah,
        ];
    }

    /**
     * Data kondisi pohon (chart kondisiPohonChart)
     */
    public static function getKondisiPohonData(Collection $collection)
    {
        $totalRow = $collection->first();
        if (!$totalRow) return [];

        return [
            'PKK NORMAL' => (float) $totalRow['persen_pkk_normal'] ?? 0,
            'PKK NON VALUER/ KERDIL' => (float) $totalRow['persen_pkk_non_valuer'] ?? 0,
            'PKK MATI' => (float) $totalRow['persen_pkk_mati'] ?? 0,
        ];
    }

    /**
     * Data areal tanaman (chart arealTanamanChart)
     */
    public static function getArealTanamanData(Collection $collection)
    {
        $totalRow = $collection->first();
        if (!$totalRow) return [];

        return [
            'Kacangan' => (float) ($totalRow['persen_tutupan_kacangan'] ?? 0),
            'Pemeliharaan yang Kurang Baik' => (float) ($totalRow['persen_pir_pkk_kurang_baik'] ?? 0),
            'Areal Tergenang' => (float) ($totalRow['persen_area_tergenang'] ?? 0),
            'Anak Kayu' => (float) ($totalRow['kondisi_anak_kayu'] ?? 0),
        ];
    }


    /**
     * Data komoditas kebun untuk TBM
     */
    public static function getKomoditasData(Collection $collection, $kodeKebun)
    {
        return $collection
            ->filter(function ($row) use ($kodeKebun) {
                return strtoupper(trim($row['kebun'] ?? '')) === strtoupper($kodeKebun)
                    && strtoupper(trim($row['tbm'] ?? '')) === 'TBM';
            })
            ->map(function ($row) {
                return [
                    'afdeling' => $row['afdeling'] ?? '-',
                    'sawit' => isset($row['sawit']) ? (float) $row['sawit'] : 0,
                    'karet' => isset($row['karet']) ? (float) $row['karet'] : 0,
                ];
            })
            ->values();
    }

    /**
     * Data komoditas per afdeling (untuk chart perafdeling)
     */
    public static function getKomoditasPerAfdelingData($data)
    {
        $result = [];

        foreach ($data as $item) {
            $afdeling = $item['afdeling'] ?? $item->afdeling ?? 'A1';
            $result[] = [
                'label' => 'Sawit',
                'afdeling' => $afdeling,
                'value' => (float) ($item['sawit'] ?? $item->luas_sawit ?? 0),
            ];
            $result[] = [
                'label' => 'Karet',
                'afdeling' => $afdeling,
                'value' => (float) ($item['karet'] ?? $item->luas_karet ?? 0),
            ];
        }

        return $result;
    }

    /**
     * Lokasi Kebun
     */

    public static function getLokasiKebun(Collection $collection)
    {
        if ($collection->isEmpty()) {
            return [];
        }

        return $collection
            ->groupBy('kebun')
            ->map(function ($items, $kebun) {
                return [
                    'kebun' => $kebun,
                    'lokasi' => $items->filter(function ($item) {
                        return !empty($item->latitude) && !empty($item->longitude);
                    })
                        ->map(function ($item) {
                            $namaLokasi = $item->nama_lokasi;
                            $jenisLokasi = strtoupper($item->jenis_lokasi);

                            $isAfd = str_contains($namaLokasi, 'AFD') && $jenisLokasi === 'KANTOR AFDELING';
                            $label = $isAfd ? "{$jenisLokasi} - {$namaLokasi}" : $namaLokasi;

                            if ($isAfd) {
                                $kategori = 'kantor-afdeling';
                            } elseif ($jenisLokasi === 'KANTOR KEBUN') {
                                $kategori = 'kantor-kebun';
                            } else {
                                $kategori = 'lainnya';
                            }

                            return [
                                'label' => $label,
                                'kategori' => $kategori,
                                'latitude' => (float) $item->latitude,
                                'longitude' => (float) $item->longitude,
                            ];
                        })
                        ->values()
                ];
            })
            ->values();
    }

    /**
     * Normalisasi key untuk collection Excel (jika dibutuhkan di tempat lain)
     */
    public static function normalizeKeys(Collection $row)
    {
        return $row->mapWithKeys(function ($val, $key) {
            $key = strtolower(trim($key));
            $key = str_replace([' ', '/', '%', '(', ')'], ['_', '_', 'persen_', '', ''], $key);
            return [$key => $val];
        });
    }
}
