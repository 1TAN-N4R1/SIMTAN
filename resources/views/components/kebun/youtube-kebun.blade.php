@props([
    'link' => null,
    'judul' => 'Playlist Kebun',
    'keterangan' => 'Klik untuk membuka playlist YouTube',
])

@if ($link)
    <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl shadow-lg border border-gray-200 dark:border-gray-700">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 text-center">
            🎥 {{ $judul }}
        </h2>

        @php
            // Ambil ID playlist dari link YouTube
            preg_match('/list=([a-zA-Z0-9_\-]+)/', $link, $matches);
            $playlistId = $matches[1] ?? null;
        @endphp

        @if ($playlistId)
            {{-- Embed iframe langsung --}}
            <div class="relative w-full overflow-hidden rounded-2xl" style="padding-top: 56.25%;">
                <iframe class="absolute top-0 left-0 w-full h-full rounded-2xl"
                    src="https://www.youtube.com/embed/videoseries?list={{ $playlistId }}" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
        @else
            <a href="{{ $link }}" target="_blank" class="block text-center text-blue-500 underline">
                Lihat playlist di YouTube
            </a>
        @endif

        <p class="text-sm text-gray-600 dark:text-gray-400 mt-3 text-center">
            {{ $keterangan }}
        </p>
    </div>
@else
    <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-3xl text-center">
        <p class="text-gray-500 dark:text-gray-400">🎥 Playlist belum tersedia</p>
    </div>
@endif
