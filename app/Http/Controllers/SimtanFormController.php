<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SimtanFormService;
use Illuminate\Support\Facades\DB;

class SimtanFormController extends Controller
{
    public function create()
    {
        // Default kode awal (misal LK-0001)
        $kodeUpload = "LK-0001";
        return view('apps.simtanform.add', compact('kodeUpload'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'diupload_oleh' => 'required|string',
            'judul_file' => 'required|string',
            'tanggal_upload' => 'required|date',
            'kategori_file' => 'required|string',
            'periode_data' => 'required|string',
            'notes' => 'nullable|string',
            'file_upload' => 'required|file|mimes:xlsx,xls|max:2048',
        ]);

        $prefixMap = [
            'Lokasi Kebun'      => 'LK',
            'Rekap TBM'         => 'RT',
            'Komposisi Lahan'   => 'KL',
            'Rincian TBM'       => 'RB',
            'Link Youtube'      => 'LY',
            'Korelasi Vegetatif' => 'KV', 
        ];

        $kategori = $validated['kategori_file'];
        $prefix = $prefixMap[$kategori] ?? 'UK'; // Default UK jika tidak ada mapping

        // Ambil kode terakhir untuk kategori ini
        $lastRecord = DB::table('simtan_forms')
            ->where('kategori_file', $kategori)
            ->orderByDesc('id')
            ->first();

        $lastNumber = 0;
        if ($lastRecord && isset($lastRecord->kode_upload)) {
            $parts = explode('-', $lastRecord->kode_upload);
            $lastNumber = isset($parts[1]) ? intval($parts[1]) : 0;
        }

        // Buat kode baru
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        $kodeUpload = "{$prefix}-{$newNumber}";

        // Tambahkan ke data yang akan disimpan
        $validated['kode_upload'] = $kodeUpload;

        // Simpan file & data melalui service
        SimtanFormService::handleUpload($validated, $request->file('file_upload'));

        return redirect()->back()->with('success', "Form berhasil disimpan. Kode Upload: {$kodeUpload}");
    }

    /**
     * ✅ Endpoint untuk AJAX ambil kode upload berdasarkan kategori
     */
    public function getKodeUpload($kategori)
    {
        $prefixMap = [
            'Lokasi Kebun'      => 'LK',
            'Rekap TBM'         => 'RT',
            'Komposisi Lahan'   => 'KL',
            'Rincian TBM'       => 'RB',
            'Link Youtube'      => 'LY',
            'Korelasi Vegetatif' => 'KV',
        ];

        $prefix = $prefixMap[$kategori] ?? 'UK';

        // Cari kode terakhir untuk kategori ini
        $lastRecord = DB::table('simtan_forms')
            ->where('kategori_file', $kategori)
            ->orderByDesc('id')
            ->first();

        $lastNumber = 0;
        if ($lastRecord && isset($lastRecord->kode_upload)) {
            $parts = explode('-', $lastRecord->kode_upload);
            $lastNumber = isset($parts[1]) ? intval($parts[1]) : 0;
        }

        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        $kodeUpload = "{$prefix}-{$newNumber}";

        return response()->json(['kode_upload' => $kodeUpload]);
    }
}
