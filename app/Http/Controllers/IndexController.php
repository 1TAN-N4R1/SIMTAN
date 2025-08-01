<?php

namespace App\Http\Controllers;

use App\Services\ChartDataService;

class IndexController extends Controller
{
    /**
     * Service untuk mengambil data chart
     *
     * @var ChartDataService
     */
    protected $chartService;

    /**
     * Inject dependency ChartDataService
     */
    public function __construct(ChartDataService $chartService)
    {
        $this->chartService = $chartService;
    }

    /**
     * Menampilkan halaman utama dengan chart:
     * - peringkat kondisi pohon
     * - peringkat pemeliharaan
     * - komposisi lahan
     * - luas areal tahun tanam
     * - luas areal tahun tanam per kebun
     */
    public function index()
    {
        // Ambil data chart peringkat kondisi pohon
        $peringkatKondisiPohon = $this->chartService->getPeringkatKondisiPohonData();

        // Ambil data chart peringkat kondisi pohon
        $peringkatPemeliharaan = $this->chartService->getPeringkatPemeliharaanData();

        // Ambil data chart komposisi lahan
        $komposisiLahan = $this->chartService->getKomposisiLahanData();

        // Ambil data chart luas areal tahun tanam
        $luasArealTahunTanam = $this->chartService->getLuasArealTahunTanamData();

        // Ambil data chart luas areal tahun tanam per kebun
        $luasArealTahunTanamPerKebun = $this->chartService->getLuasArealTahunTanamPerKebunData();

        // Gabungkan semua data dan kirim ke view index
        return view('index', array_merge(
            $peringkatKondisiPohon,
            $peringkatPemeliharaan,
            $komposisiLahan,
            $luasArealTahunTanam,
            $luasArealTahunTanamPerKebun,
        ));
    }
}
