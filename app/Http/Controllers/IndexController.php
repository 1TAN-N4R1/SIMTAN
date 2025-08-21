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
     * - komposisi lahan
     * - peringkat kondisi pohon
     * - peringkat pemeliharaan
     * - korelasi vegetatiif
     * - luas areal tahun tanam
     * - luas areal tahun tanam per kebun
     */
    public function index()
    {
        // Ambil semua data chart melalui ChartDataService
        $komposisiLahan = $this->chartService->getKomposisiLahanData();
        $peringkatKondisiPohon = $this->chartService->getPeringkatKondisiPohonData();
        $peringkatPemeliharaan = $this->chartService->getPeringkatPemeliharaanData();
        $korelasiVegetatif = $this->chartService->getKorelasiVegetatifChartData();
        $luasArealTahunTanam = $this->chartService->getLuasArealTahunTanamData();
        $luasArealTahunTanamPerKebun = $this->chartService->getLuasArealTahunTanamPerKebunData();

        // Gabungkan semua array associative menjadi satu array untuk dikirim ke view
        return view('index', array_merge(
            $komposisiLahan,
            $peringkatKondisiPohon,
            $peringkatPemeliharaan,
            $korelasiVegetatif,
            $luasArealTahunTanam,
            $luasArealTahunTanamPerKebun
        ));
    }
}
