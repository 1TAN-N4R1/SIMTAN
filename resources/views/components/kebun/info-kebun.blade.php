@props([
    'infoKebun' => [
        'distrik' => 'Nama Distrik',
        'nama' => 'Nama Kebun',
        'luas' => 0,
        'kode_kebun' => '-', // Tambahan untuk ditampilkan
    ],
])

@php
    $luas = is_numeric($infoKebun['luas']) ? (float) $infoKebun['luas'] : 0;
    $luasFormatted = number_format($luas, 2, ',', '.');
@endphp

<div class="mb-6">
    <h2 class="text-xl md:text-2xl font-bold text-gray-900">
        {{ $infoKebun['kode_kebun'] }}
    </h2>
    <p class="text-md md:text-lg text-green-700 mt-1">
        {{ $infoKebun['nama'] }}
        <span class="text-green-600 font-semibold">
            ({{ $luasFormatted }} Ha)
        </span>
    </p>
    {{-- <p class="text-sm text-gray-500 mt-1">
        Kode Kebun: <span class="font-mono">{{ $infoKebun['kode_kebun'] }}</span>
    </p> --}}
</div>
