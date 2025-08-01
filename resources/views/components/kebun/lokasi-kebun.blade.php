@props([
    'lokasiKebun' => [],
    'height' => '500px',
])

@php
    // Warna kategori umum
    $warnaKategori = [
        'kantor-kebun' => '#2E7D32', // hijau forest
        'pks' => '#F9A825', // kuning amber
        'ppk' => '#6A1B9A', // ungu gelap
        'lainnya' => '#D32F2F', // merah deep
    ];

    // Warna Kantor Afdeling per AFD
    $warnaAfdeling = [
        'AFD01' => '#1B9E77',
        'AFD02' => '#D95F02',
        'AFD03' => '#7570B3',
        'AFD04' => '#E7298A',
        'AFD05' => '#66A61E',
        'AFD06' => '#E6AB02',
        'AFD07' => '#A6761D',
        'AFD08' => '#1F78B4',
    ];
@endphp

<div class="bg-white dark:bg-black p-8 rounded-3xl shadow-md border-2 border-blue-300 col-span-1 md:col-span-3">
    @foreach ($lokasiKebun as $kebun)
        <div class="mb-12">
            {{-- Judul --}}
            <div class="flex items-center gap-4 mb-8 mt-8 justify-center">
                <div
                    class="w-14 h-14 flex items-center justify-center bg-blue-100 dark:bg-blue-950 border border-blue-300 rounded-full shadow">
                    <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white">
                    Kebun {{ $kebun['kebun'] }}
                </h2>
            </div>

            {{-- Wrapper Card Map --}}
            @php $mapId = 'map_' . $kebun['kebun'] . '_' . uniqid(); @endphp
            <div class="rounded-2xl border border-gray-300 dark:border-gray-600 overflow-hidden mb-6"
                style="height: {{ $height }};">
                {{-- Map fit card --}}
                <div id="{{ $mapId }}" class="w-full h-full"></div>
            </div>

            {{-- LEGEND --}}
            <div id="legend-{{ $mapId }}" class="flex flex-wrap justify-center gap-4 text-sm"></div>

            {{-- Leaflet --}}
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const lokasi = @json($kebun['lokasi']);
                    const warnaKategori = @json($warnaKategori);
                    const warnaAfdeling = @json($warnaAfdeling);
                    const mapId = '{{ $mapId }}';
                    const isDark = document.documentElement.classList.contains('dark');

                    const map = L.map(mapId, {
                        scrollWheelZoom: true,
                        zoomControl: true
                    });

                    // Tile layer
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 18,
                        attribution: '&copy; OpenStreetMap'
                    }).addTo(map);

                    const bounds = [];
                    const legendData = {};

                    // Marker
                    lokasi.forEach(item => {
                        const label = item.label.toUpperCase();
                        let warna = warnaKategori['lainnya'];
                        let legendKey = label;

                        if (label.includes('KANTOR AFDELING')) {
                            const afd = label.match(/AFD\d{2}/)?.[0] || 'AFD01';
                            warna = warnaAfdeling[afd] || warnaKategori['lainnya'];
                            legendKey = `KANTOR AFDELING - ${afd}`;
                        } else if (label.includes('KANTOR KEBUN')) {
                            warna = warnaKategori['kantor-kebun'];
                            legendKey = 'KANTOR KEBUN';
                        } else if (label.includes('PKS')) {
                            warna = warnaKategori['pks'];
                            legendKey = 'PKS';
                        } else if (label.includes('PPK')) {
                            warna = warnaKategori['ppk'];
                            legendKey = 'PPK';
                        }

                        if (!legendData[legendKey]) legendData[legendKey] = warna;

                        if (item.latitude && item.longitude) {
                            const icon = L.divIcon({
                                className: 'custom-marker',
                                html: `<span style="background:${warna};width:20px;height:20px;display:block;border-radius:50%;border:2px solid white;box-shadow:0 0 5px rgba(0,0,0,0.5);"></span>`,
                                iconSize: [20, 20]
                            });

                            L.marker([item.latitude, item.longitude], {
                                    icon
                                })
                                .addTo(map)
                                .bindPopup(`<div style="text-align:center;min-width:200px;">
                                    <b style="font-size:16px;">${item.label}</b><br>
                                    <small style="color:#555;">Lat: ${item.latitude}, Lng: ${item.longitude}</small><br><br>
                                    <a href="https://www.google.com/maps/search/?api=1&query=${item.latitude},${item.longitude}" target="_blank"
                                    style="color:#1E88E5; font-weight:bold; text-decoration:none;">📍 Buka di Google Maps</a>
                                </div>`);
                            bounds.push([item.latitude, item.longitude]);
                        }
                    });

                    if (bounds.length) map.fitBounds(bounds, {
                        padding: [40, 40],
                        maxZoom: 15
                    });

                    // Render Legend
                    const legendEl = document.getElementById(`legend-${mapId}`);
                    legendEl.innerHTML = '';
                    for (const [key, warna] of Object.entries(legendData)) {
                        const el = document.createElement('div');
                        el.className = 'flex items-center gap-2';
                        el.innerHTML = `
                            <span class="w-4 h-4 rounded-full shadow" style="background:${warna}"></span>
                            <span class="${isDark ? 'text-white' : 'text-gray-900'} font-semibold">${key}</span>`;
                        legendEl.appendChild(el);
                    }

                    // Responsif
                    const mapContainer = document.getElementById(mapId);
                    const observer = new ResizeObserver(() => map.invalidateSize());
                    observer.observe(mapContainer);

                    window.addEventListener('resize', () => map.invalidateSize());
                    document.addEventListener('sidebar-toggled', () => setTimeout(() => map.invalidateSize(), 400));

                    // Dark Mode Legend Update
                    window.addEventListener('theme-changed', () => {
                        const dark = document.documentElement.classList.contains('dark');
                        legendEl.querySelectorAll('span:last-child').forEach(span => {
                            span.className = dark ? 'text-white font-semibold' :
                                'text-gray-900 font-semibold';
                        });
                        map.invalidateSize();
                    });
                });
            </script>
        </div>
    @endforeach
</div>
