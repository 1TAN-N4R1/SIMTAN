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
        // Ambil semua data chart melalui ChartDataService
        $peringkatKondisiPohon = $this->chartService->getPeringkatKondisiPohonData();
        $peringkatPemeliharaan = $this->chartService->getPeringkatPemeliharaanData();
        $komposisiLahan = $this->chartService->getKomposisiLahanData();
        $luasArealTahunTanam = $this->chartService->getLuasArealTahunTanamData();
        $luasArealTahunTanamPerKebun = $this->chartService->getLuasArealTahunTanamPerKebunData();

        // Gabungkan semua array associative menjadi satu array untuk dikirim ke view
        return view('index', array_merge(
            $peringkatKondisiPohon,
            $peringkatPemeliharaan,
            $komposisiLahan,
            $luasArealTahunTanam,
            $luasArealTahunTanamPerKebun
        ));
    }
}
