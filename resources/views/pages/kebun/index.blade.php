<x-layout.default>
    <script defer src="/assets/js/apexcharts.js"></script>

    <div x-data="{ showAll: false }" class="px-4 sm:px-6 lg:px-8 pt-6">
        {{-- Breadcrumb --}}
        <nav class="text-sm mb-6 text-gray-600">
            <ul class="flex space-x-2 rtl:space-x-reverse">
                <li><a href="#" class="text-primary hover:underline">Dashboard</a></li>
                <li class="before:content-['/'] ltr:before:mx-1 rtl:before:mx-1 text-gray-400">Data Distrik & Kebun TBM
                </li>
                <li class="before:content-['/'] ltr:before:mx-1 rtl:before:mx-1 font-semibold text-gray-800">Detail Kebun
                </li>
            </ul>
        </nav>

        {{-- Info Kebun --}}
        <x-kebun.info-kebun :infoKebun="$infoKebun" />

        {{-- Grid 3 Chart --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            {{-- Chart 1: Donut - Kondisi Pohon --}}
            <x-kebun.grafik-kondisi-pohon :data="$kondisiPohon" />

            {{-- Chart 2 : Bar Stacked - Detail Areal --}}
            <x-kebun.grafik-detail-areal :categories="$categories" :series="$series" />
            {{-- <x-kebun.grafik-detail-areal :labels="$labels" :detailAreal="$detailAreal" /> --}}

            {{-- Chart 3 : Bar Vertikal - Areal Tanaman --}}
            <x-kebun.grafik-areal-tanaman :data="$arealTanaman" />
        </div>

        {{-- Grid Peta dan Youtube --}}
        <div class="grid grid-cols-1 gap-6 mt-10">
            <x-kebun.lokasi-kebun :lokasiKebun="$lokasiKebun" height="400px" />

            {{-- Youtube --}}
            <x-kebun.youtube-kebun :link="$linkKebunTBM->link_playlist ?? null" :judul="'Playlist Kebun ' . ($infoKebun->nama_kebun ?? '')" :keterangan="'Klik untuk membuka playlist video TBM dari kebun ini'" />
        </div>

        {{-- Running Text --}}
        <marquee
            class="fixed bottom-0 left-0 w-full bg-green-50 p-2 text-center text-sm text-green-800 font-medium shadow z-50">
            One PTPN One Culture
        </marquee>
    </div>
</x-layout.default>
