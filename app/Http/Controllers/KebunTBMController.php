<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ChartDataService;
use Illuminate\Support\Facades\Log;
use App\Models\DetailRekap;

class KebunTBMController extends Controller
{
    protected ChartDataService $chartService;

    public function __construct(ChartDataService $chartService)
    {
        $this->chartService = $chartService;
    }

    /**
     * Menampilkan halaman utama kebun TBM dengan grouping distrik
     */
    public function index()
    {
        $rekap = DetailRekap::where('is_total', true)
            ->get()
            ->sortBy(function ($item) {
                return [$item->distrik, $item->kebun];
            });

        $groupedKebun = $rekap->groupBy('distrik');

        return view('kebun-tbm', compact('groupedKebun'));
    }

    /**
     * Menampilkan halaman detail grafik TBM berdasarkan kode kebun
     */
    public function show(string $kodeView)
    {
        try {
            [$kodeDistrik, $kodeKebun] = explode('_', strtoupper($kodeView));

            $infoKebun     = $this->chartService->getInfoKebunData($kodeKebun);
            $kondisiPohon  = $this->chartService->getKondisiPohonData($kodeKebun);
            $arealTanaman  = $this->chartService->getArealTanamanData($kodeKebun);
            $detailAreal   = $this->chartService->getDetailArealData($kodeKebun);
            $lokasiKebun   = $this->chartService->getLokasiKebunData($kodeKebun);
            $linkKebunTBM  = $this->chartService->getLinkKebunTBMData($kodeKebun);

            return view('pages.kebun.index', [
                'infoKebun'     => $infoKebun,
                'kondisiPohon'  => $kondisiPohon,
                'arealTanaman'  => $arealTanaman,
                'lokasiKebun'   => $lokasiKebun,
                'categories'    => $detailAreal['categories'],
                'series'        => $detailAreal['series'],
                'linkKebunTBM'  => $linkKebunTBM
            ]);
        } catch (\Throwable $e) {
            Log::error('[KEBUN TBM] Gagal menampilkan data TBM: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data grafik kebun.');
        }
    }
}
