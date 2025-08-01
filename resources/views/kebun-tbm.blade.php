<x-layout.default>

    <script defer src="/assets/js/apexcharts.js"></script>
    <div x-data="{ showAll: false }">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Dashboard</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Data Distrik & Kebun TBM</span>
            </li>
        </ul>
        <div class="pt-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6 text-white">
                <!-- 1DL1 -->
                <div class="panel bg-gradient-to-r from-cyan-500 to-cyan-400">
                    <div class="flex justify-between">
                        <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Distrik Labuhan Batu I</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                            <a href="javascript:;" @click="toggle">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                    <circle cx="5" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle cx="19" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                </svg>
                            </a>
                            <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                                <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                <li><a href="javascript:;" @click="toggle">Edit Report</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex items-center mt-5">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">1DL1</div>
                        <div class="badge bg-white/30">1DLAB I</div>
                    </div>
                    <div class="flex items-center font-semibold mt-5">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2 shrink-0">
                            <path opacity="0.5"
                                d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                stroke="currentColor" stroke-width="1.5"></path>
                            <path
                                d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                stroke="currentColor" stroke-width="1.5"></path>
                        </svg>
                        Luas : 34,38 Ha
                    </div>
                </div>

                <!-- 1DL2 -->
                <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                    <div class="flex justify-between">
                        <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Distrik Labuhan Batu II</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                            <a href="javascript:;" @click="toggle">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                    <circle cx="5" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle cx="19" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                </svg>
                            </a>
                            <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">

                                <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="flex items-center mt-5">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">1DL2</div>
                        <div class="badge bg-white/30">1DLAB II</div>
                    </div>
                    <div class="flex items-center font-semibold mt-5">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2 shrink-0">
                            <path opacity="0.5"
                                d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                stroke="currentColor" stroke-width="1.5"></path>
                            <path
                                d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                stroke="currentColor" stroke-width="1.5"></path>
                        </svg>
                        Luas : 830, 12 Ha
                    </div>
                </div>

                <!-- 1DL3 -->
                <div class="panel bg-gradient-to-r from-blue-500 to-blue-400">
                    <div class="flex justify-between">
                        <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Distrik Labuhan Batu III</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                            <a href="javascript:;" @click="toggle">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                    <circle cx="5" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle cx="19" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                </svg>
                            </a>
                            <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                                <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="flex items-center mt-5">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">1DL3</div>
                        <div class="badge bg-white/30">1DLAB III </div>
                    </div>
                    <div class="flex items-center font-semibold mt-5">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2 shrink-0">
                            <path opacity="0.5"
                                d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                stroke="currentColor" stroke-width="1.5"></path>
                            <path
                                d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                stroke="currentColor" stroke-width="1.5"></path>
                        </svg>
                        Luas : 3.136,68 Ha
                    </div>
                </div>

                <!-- 1DS1 -->
                <div class="panel bg-gradient-to-r from-fuchsia-500 to-fuchsia-400">
                    <div class="flex justify-between">
                        <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Distrik Deli Serdang I</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                            <a href="javascript:;" @click="toggle">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                    <circle cx="5" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle cx="19" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                </svg>
                            </a>
                            <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                                <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="flex items-center mt-5">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">1DS1</div>
                        <div class="badge bg-white/30">1DSER I</div>
                    </div>
                    <div class="flex items-center font-semibold mt-5">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2 shrink-0">
                            <path opacity="0.5"
                                d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                stroke="currentColor" stroke-width="1.5"></path>
                            <path
                                d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                stroke="currentColor" stroke-width="1.5"></path>
                        </svg>
                        Luas : 3.160,57 Ha
                    </div>
                </div>

                <!-- 1DS2 -->
                <div class="panel bg-gradient-to-r from-fuchsia-500 to-fuchsia-400">
                    <div class="flex justify-between">
                        <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Distrik Deli Serdang II</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                            <a href="javascript:;" @click="toggle">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                    <circle cx="5" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle cx="19" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                </svg>
                            </a>
                            <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                                <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="flex items-center mt-5">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">1DS2</div>
                        <div class="badge bg-white/30">1DSER II</div>
                    </div>
                    <div class="flex items-center font-semibold mt-5">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2 shrink-0">
                            <path opacity="0.5"
                                d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                stroke="currentColor" stroke-width="1.5"></path>
                            <path
                                d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                stroke="currentColor" stroke-width="1.5"></path>
                        </svg>
                        Luas : 2.338,73 Ha
                    </div>
                </div>

                <!-- 1DSH -->
                <div class="panel bg-gradient-to-r from-fuchsia-500 to-fuchsia-400">
                    <div class="flex justify-between">
                        <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Distrik Asahan</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                            <a href="javascript:;" @click="toggle">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                    <circle cx="5" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle cx="19" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                </svg>
                            </a>
                            <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                                <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="flex items-center mt-5">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">1DSH</div>
                        <div class="badge bg-white/30">1DASAH</div>
                    </div>
                    <div class="flex items-center font-semibold mt-5">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2 shrink-0">
                            <path opacity="0.5"
                                d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                stroke="currentColor" stroke-width="1.5"></path>
                            <path
                                d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                stroke="currentColor" stroke-width="1.5"></path>
                        </svg>
                        Luas : 22.868,23 Ha
                    </div>
                </div>


            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                @foreach ($groupedKebun as $distrik => $kebuns)
                    <div>
                        <div class="flex items-center mb-5 font-bold">
                            <span class="text-lg">{{ $distrik }}</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 md:mb-5">
                            @foreach ($kebuns as $kebun)
                                <div class="panel">
                                    <div class="flex items-center font-semibold mb-5">
                                        <div class="shrink-0 w-10 h-10 rounded-full grid place-content-center">
                                            @include('components.icons.pohon')
                                        </div>
                                        <div class="ltr:ml-2 rtl:mr-2">
                                            <h6 class="text-dark dark:text-white-light">{{ $kebun->kebun }}</h6>
                                            <p class="text-white-dark text-xs">{{ $kebun->nama_kebun }}</p>
                                        </div>
                                    </div>

                                    <div class="mb-5 overflow-hidden">
                                        <div x-ref="kebunTBM"></div>
                                    </div>

                                    <div class="flex justify-between items-center font-bold text-base">
                                        Luas : {{ number_format($kebun->luas_ha, 2, ',', '.') }} Ha
                                        <a href="{{ route('kebun-tbm.show', ['kodeView' => $distrik . '_' . $kebun->kebun]) }}"
                                            class="text-white bg-success hover:bg-green-600 focus:outline-none font-medium rounded text-xs px-2 py-1 transition">
                                            Lihat
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- <!-- Live Prices -->
                <div>
                    <div class="flex items-center mb-5 font-bold">
                        <span class="text-lg">Live Prices</span>
                        <a href="javascript:;"
                            class="ltr:ml-auto rtl:mr-auto text-primary hover:text-black dark:hover:text-white-dark">
                            See All
                        </a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
                        <!-- Binance -->
                        <div class="panel">
                            <div class="flex items-center font-semibold mb-5">
                                <div class="shrink-0 w-10 h-10 rounded-full grid place-content-center">
                                    <svg width="100%" height="100%" viewBox="0 0 1024 1024"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="Icon">
                                            <circle cx="512" cy="512" r="512" style="fill: #f3ba2f" />
                                            <path class="st1 fill-white"
                                                d="M404.9 468 512 360.9l107.1 107.2 62.3-62.3L512 236.3 342.6 405.7z" />
                                            <path transform="rotate(-45.001 298.629 511.998)" class="st1 fill-white"
                                                d="M254.6 467.9h88.1V556h-88.1z" />
                                            <path class="st1 fill-white"
                                                d="M404.9 556 512 663.1l107.1-107.2 62.4 62.3h-.1L512 787.7 342.6 618.3l-.1-.1z" />
                                            <path transform="rotate(-45.001 725.364 512.032)" class="st1 fill-white"
                                                d="M681.3 468h88.1v88.1h-88.1z" />
                                            <path class="st1 fill-white"
                                                d="M575.2 512 512 448.7l-46.7 46.8-5.4 5.3-11.1 11.1-.1.1.1.1 63.2 63.2 63.2-63.3z" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="ltr:ml-2 rtl:mr-2">
                                    <h6 class="text-dark dark:text-white-light">BNB</h6>
                                    <p class="text-white-dark text-xs">Binance</p>
                                </div>
                            </div>
                            <div class="mb-5 overflow-hidden">
                                <div x-ref="binance"></div>
                            </div>
                            <div class="flex justify-between items-center font-bold text-base">
                                $21,000
                                <span class="text-danger font-normal text-sm">-1.25%</span>
                            </div>
                        </div>

                        <!-- Tether -->
                        <div class="panel">
                            <div class="flex items-center font-semibold mb-5">
                                <div class="shrink-0 w-10 h-10 rounded-full grid place-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                        viewBox="0 0 2000 2000">
                                        <path
                                            d="M1000,0c552.26,0,1000,447.74,1000,1000S1552.24,2000,1000,2000,0,1552.38,0,1000,447.68,0,1000,0"
                                            fill="#53ae94" />
                                        <path
                                            d="M1123.42,866.76V718H1463.6V491.34H537.28V718H877.5V866.64C601,879.34,393.1,934.1,393.1,999.7s208,120.36,484.4,133.14v476.5h246V1132.8c276-12.74,483.48-67.46,483.48-133s-207.48-120.26-483.48-133m0,225.64v-0.12c-6.94.44-42.6,2.58-122,2.58-63.48,0-108.14-1.8-123.88-2.62v0.2C633.34,1081.66,451,1039.12,451,988.22S633.36,894.84,877.62,884V1050.1c16,1.1,61.76,3.8,124.92,3.8,75.86,0,114-3.16,121-3.8V884c243.8,10.86,425.72,53.44,425.72,104.16s-182,93.32-425.72,104.18"
                                            fill="#fff" />
                                    </svg>
                                </div>
                                <div class="ltr:ml-2 rtl:mr-2">
                                    <h6 class="text-dark dark:text-white-light">USDT</h6>
                                    <p class="text-white-dark text-xs">Tether</p>
                                </div>
                            </div>
                            <div class="mb-5 overflow-hidden">
                                <div x-ref="tether"></div>
                            </div>
                            <div class="flex justify-between items-center font-bold text-base">
                                $20,000
                                <a href="javascript:;"
                                    class="text-white bg-success hover:bg-green-600 focus:outline-none font-medium rounded text-xs px-2 py-1 transition">
                                    Lihat
                                </a> +0.25%</span>
                            </div>
                        </div>

                        <!-- Solana -->
                        <div class="panel">
                            <div class="flex items-center font-semibold mb-5">
                                <div class="shrink-0 w-10 h-10 bg-warning rounded-full p-2 grid place-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="100%" height="100%" viewBox="0 0 508.07 398.17">
                                        <defs>
                                            <linearGradient id="linear-gradient" x1="463" y1="205.16"
                                                x2="182.39" y2="742.62" gradientTransform="translate(0 -198)"
                                                gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#00ffa3" />
                                                <stop offset="1" stop-color="#dc1fff" />
                                            </linearGradient>
                                            <linearGradient id="linear-gradient-2" x1="340.31" y1="141.1"
                                                x2="59.71" y2="678.57" xlink:href="#linear-gradient" />
                                            <linearGradient id="linear-gradient-3" x1="401.26" y1="172.92"
                                                x2="120.66" y2="710.39" xlink:href="#linear-gradient" />
                                        </defs>
                                        <path class="cls-1 fill-[url(#linear-gradient)]"
                                            d="M84.53,358.89A16.63,16.63,0,0,1,96.28,354H501.73a8.3,8.3,0,0,1,5.87,14.18l-80.09,80.09a16.61,16.61,0,0,1-11.75,4.86H10.31A8.31,8.31,0,0,1,4.43,439Z"
                                            transform="translate(-1.98 -55)" />
                                        <path class="cls-2 fill-[url(#linear-gradient)]"
                                            d="M84.53,59.85A17.08,17.08,0,0,1,96.28,55H501.73a8.3,8.3,0,0,1,5.87,14.18l-80.09,80.09a16.61,16.61,0,0,1-11.75,4.86H10.31A8.31,8.31,0,0,1,4.43,140Z"
                                            transform="translate(-1.98 -55)" />
                                        <path class="cls-3 fill-[url(#linear-gradient)]"
                                            d="M427.51,208.42a16.61,16.61,0,0,0-11.75-4.86H10.31a8.31,8.31,0,0,0-5.88,14.18l80.1,80.09a16.6,16.6,0,0,0,11.75,4.86H501.73a8.3,8.3,0,0,0,5.87-14.18Z"
                                            transform="translate(-1.98 -55)" />
                                    </svg>
                                </div>
                                <div class="ltr:ml-2 rtl:mr-2">
                                    <h6 class="text-dark dark:text-white-light">SOL</h6>
                                    <p class="text-white-dark text-xs">Solana</p>
                                </div>
                            </div>
                            <div class="mb-5 overflow-hidden">
                                <div x-ref="solana"></div>
                            </div>
                            <div class="flex justify-between items-center font-bold text-base">
                                $21,000
                                <span class="text-danger font-normal text-sm">-1.25%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                <div class="grid gap-6 xl:grid-flow-row">
                    <!-- Previous Statement -->
                    <div class="panel overflow-hidden">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-lg font-bold">Previous Statement</div>
                                <div class="text-success"> Paid on June 27, 2022 </div>
                            </div>
                            <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                                <a href="javascript:;" @click="toggle">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                        <circle cx="5" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <circle cx="19" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                    </svg>
                                </a>
                                <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                    class="ltr:right-0 rtl:left-0">
                                    <li><a href="javascript:;" @click="toggle">View Report</a>
                                    </li>
                                    <li><a href="javascript:;" @click="toggle">Edit Report</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="relative mt-10">
                            <div class="absolute -bottom-12 ltr:-right-12 rtl:-left-12 w-24 h-24">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="text-success opacity-20 w-full h-full">
                                    <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <path d="M8.5 12.5L10.5 14.5L15.5 9.5" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                                <div>
                                    <div class="text-primary">Card Limit</div>
                                    <div class="mt-2 font-semibold text-2xl">$50,000.00</div>
                                </div>
                                <div>
                                    <div class="text-primary">Spent</div>
                                    <div class="mt-2 font-semibold text-2xl">$15,000.00</div>
                                </div>
                                <div>
                                    <div class="text-primary">Minimum</div>
                                    <div class="mt-2 font-semibold text-2xl">$2,500.00</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Current Statement -->
                    <div class="panel overflow-hidden">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-lg font-bold">Current Statement</div>
                                <div class="text-danger"> Must be paid before July 27, 2022
                                </div>
                            </div>
                            <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                                <a href="javascript:;" @click="toggle">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                        <circle cx="5" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <circle cx="19" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                    </svg>
                                </a>
                                <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                    class="ltr:right-0 rtl:left-0">
                                    <li><a href="javascript:;" @click="toggle">View Report</a>
                                    </li>
                                    <li><a href="javascript:;" @click="toggle">Edit Report</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="relative mt-10">
                            <div class="absolute -bottom-12 ltr:-right-12 rtl:-left-12 w-24 h-24">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="text-danger opacity-20 w-24 h-full">
                                    <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <path d="M12 7V13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    <circle cx="12" cy="16" r="1" fill="currentColor" />
                                </svg>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                                <div>
                                    <div class="text-primary">Card Limit</div>
                                    <div class="mt-2 font-semibold text-2xl">$50,000.00</div>
                                </div>
                                <div>
                                    <div class="text-primary">Spent</div>
                                    <div class="mt-2 font-semibold text-2xl">$30,500.00</div>
                                </div>
                                <div>
                                    <div class="text-primary">Minimum</div>
                                    <div class="mt-2 font-semibold text-2xl">$8,000.00</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Recent Transactions -->
                <div class="panel">
                    <div class="mb-5 text-lg font-bold">Recent Transactions</div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="ltr:rounded-l-md rtl:rounded-r-md">ID</th>
                                    <th>DATE</th>
                                    <th>NAME</th>
                                    <th>AMOUNT</th>
                                    <th class="text-center ltr:rounded-r-md rtl:rounded-l-md">
                                        STATUS
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="font-semibold">#01</td>
                                    <td class="whitespace-nowrap">Oct 08, 2021</td>
                                    <td class="whitespace-nowrap">Eric Page</td>
                                    <td>$1,358.75</td>
                                    <td class="text-center">
                                        <span
                                            class="badge bg-success/20 text-success rounded-full hover:top-0">Completed</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">#02</td>
                                    <td class="whitespace-nowrap">Dec 18, 2021</td>
                                    <td class="whitespace-nowrap">Nita Parr</td>
                                    <td>-$1,042.82</td>
                                    <td class="text-center">
                                        <span class="badge bg-info/20 text-info rounded-full hover:top-0">In
                                            Process</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">#03</td>
                                    <td class="whitespace-nowrap">Dec 25, 2021</td>
                                    <td class="whitespace-nowrap">Carl Bell</td>
                                    <td>$1,828.16</td>
                                    <td class="text-center">
                                        <span
                                            class="badge bg-danger/20 text-danger rounded-full hover:top-0">Pending</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">#04</td>
                                    <td class="whitespace-nowrap">Nov 29, 2021</td>
                                    <td class="whitespace-nowrap">Dan Hart</td>
                                    <td>$1,647.55</td>
                                    <td class="text-center">
                                        <span
                                            class="badge bg-success/20 text-success rounded-full hover:top-0">Completed</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">#05</td>
                                    <td class="whitespace-nowrap">Nov 24, 2021</td>
                                    <td class="whitespace-nowrap">Jake Ross</td>
                                    <td>$927.43</td>
                                    <td class="text-center">
                                        <span
                                            class="badge bg-success/20 text-success rounded-full hover:top-0">Completed</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">#06</td>
                                    <td class="whitespace-nowrap">Jan 26, 2022</td>
                                    <td class="whitespace-nowrap">Anna Bell</td>
                                    <td>$250.00</td>
                                    <td class="text-center">
                                        <span class="badge bg-info/20 text-info rounded-full hover:top-0">In
                                            Process</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <script>
            document.addEventListener("alpine:init", () => {
                // kebunTBM
                Alpine.data("kebunTBM", () => ({
                    init() {
                        const KSD = null;
                        const ethereum = null;
                        const litecoin = null;
                        const binance = null;
                        const tether = null;
                        const solana = null;

                        setTimeout(() => {
                            this.KSD = new ApexCharts(this.$refs.KSD, this.KSDOptions);
                            this.KSD.render();

                            this.ethereum = new ApexCharts(this.$refs.ethereum, this
                                .ethereumOptions);
                            this.ethereum.render();

                            this.litecoin = new ApexCharts(this.$refs.litecoin, this
                                .litecoinOptions);
                            this.litecoin.render();

                            this.binance = new ApexCharts(this.$refs.binance, this.binanceOptions);
                            this.binance.render();

                            this.tether = new ApexCharts(this.$refs.tether, this.tetherOptions);
                            this.tether.render();

                            this.solana = new ApexCharts(this.$refs.solana, this.solanaOptions);
                            this.solana.render();
                        }, 300);

                    },

                    get KSDOptions() {
                        return {
                            series: [{
                                data: [21, 9, 36, 12, 44, 25, 59, 41, 25, 66]
                            }],
                            chart: {
                                height: 45,
                                type: 'line',
                                sparkline: {
                                    enabled: true
                                },
                            },
                            stroke: {
                                width: 2
                            },
                            markers: {
                                size: 0
                            },
                            colors: ['#00ab55'],
                            grid: {
                                padding: {
                                    top: 0,
                                    bottom: 0,
                                    left: 0
                                }
                            },
                            tooltip: {
                                x: {
                                    show: false
                                },
                                y: {
                                    title: {
                                        formatter: formatter = () => {
                                            return '';
                                        },
                                    },
                                },
                            },
                            responsive: [{
                                breakPoint: 576,
                                options: {
                                    chart: {
                                        height: 95
                                    },
                                    grid: {
                                        padding: {
                                            top: 45,
                                            bottom: 0,
                                            left: 0
                                        }
                                    }
                                }
                            }],
                        }
                    },

                    get ethereumOptions() {
                        return {
                            series: [{
                                data: [44, 25, 59, 41, 66, 25, 21, 9, 36, 12]
                            }],
                            chart: {
                                height: 45,
                                type: 'line',
                                sparkline: {
                                    enabled: true
                                },
                            },
                            stroke: {
                                width: 2
                            },
                            markers: {
                                size: 0
                            },
                            colors: ['#e7515a'],
                            grid: {
                                padding: {
                                    top: 0,
                                    bottom: 0,
                                    left: 0
                                }
                            },
                            tooltip: {
                                x: {
                                    show: false
                                },
                                y: {
                                    title: {
                                        formatter: formatter = () => {
                                            return '';
                                        },
                                    },
                                },
                            },
                            responsive: [{
                                breakPoint: 576,
                                options: {
                                    chart: {
                                        height: 95
                                    },
                                    grid: {
                                        padding: {
                                            top: 45,
                                            bottom: 0,
                                            left: 0
                                        }
                                    }
                                }
                            }],
                        }
                    },

                    get litecoinOptions() {
                        return {
                            series: [{
                                data: [9, 21, 36, 12, 66, 25, 44, 25, 41, 59]
                            }],
                            chart: {
                                height: 45,
                                type: 'line',
                                sparkline: {
                                    enabled: true
                                },
                            },
                            stroke: {
                                width: 2
                            },
                            markers: {
                                size: 0
                            },
                            colors: ['#00ab55'],
                            grid: {
                                padding: {
                                    top: 0,
                                    bottom: 0,
                                    left: 0
                                }
                            },
                            tooltip: {
                                x: {
                                    show: false
                                },
                                y: {
                                    title: {
                                        formatter: formatter = () => {
                                            return '';
                                        },
                                    },
                                },
                            },
                            responsive: [{
                                breakPoint: 576,
                                options: {
                                    chart: {
                                        height: 95
                                    },
                                    grid: {
                                        padding: {
                                            top: 45,
                                            bottom: 0,
                                            left: 0
                                        }
                                    }
                                }
                            }],
                        }
                    },

                    get binanceOptions() {
                        return {
                            series: [{
                                data: [25, 44, 25, 59, 41, 21, 36, 12, 19, 9]
                            }],
                            chart: {
                                height: 45,
                                type: 'line',
                                sparkline: {
                                    enabled: true
                                },
                            },
                            stroke: {
                                width: 2
                            },
                            markers: {
                                size: 0
                            },
                            colors: ['#e7515a'],
                            grid: {
                                padding: {
                                    top: 0,
                                    bottom: 0,
                                    left: 0
                                }
                            },
                            tooltip: {
                                x: {
                                    show: false
                                },
                                y: {
                                    title: {
                                        formatter: formatter = () => {
                                            return '';
                                        },
                                    },
                                },
                            },
                            responsive: [{
                                breakPoint: 576,
                                options: {
                                    chart: {
                                        height: 95
                                    },
                                    grid: {
                                        padding: {
                                            top: 45,
                                            bottom: 0,
                                            left: 0
                                        }
                                    }
                                }
                            }],
                        }
                    },

                    get tetherOptions() {
                        return {
                            series: [{
                                data: [21, 59, 41, 44, 25, 66, 9, 36, 25, 12]
                            }],
                            chart: {
                                height: 45,
                                type: 'line',
                                sparkline: {
                                    enabled: true
                                },
                            },
                            stroke: {
                                width: 2
                            },
                            markers: {
                                size: 0
                            },
                            colors: ['#00ab55'],
                            grid: {
                                padding: {
                                    top: 0,
                                    bottom: 0,
                                    left: 0
                                }
                            },
                            tooltip: {
                                x: {
                                    show: false
                                },
                                y: {
                                    title: {
                                        formatter: formatter = () => {
                                            return '';
                                        },
                                    },
                                },
                            },
                            responsive: [{
                                breakPoint: 576,
                                options: {
                                    chart: {
                                        height: 95
                                    },
                                    grid: {
                                        padding: {
                                            top: 45,
                                            bottom: 0,
                                            left: 0
                                        }
                                    }
                                }
                            }],
                        }
                    },

                    get solanaOptions() {
                        return {
                            series: [{
                                data: [21, -9, 36, -12, 44, 25, 59, -41, 66, -25]
                            }],
                            chart: {
                                height: 45,
                                type: 'line',
                                sparkline: {
                                    enabled: true
                                },
                            },
                            stroke: {
                                width: 2
                            },
                            markers: {
                                size: 0
                            },
                            colors: ['#e7515a'],
                            grid: {
                                padding: {
                                    top: 0,
                                    bottom: 0,
                                    left: 0
                                }
                            },
                            tooltip: {
                                x: {
                                    show: false
                                },
                                y: {
                                    title: {
                                        formatter: formatter = () => {
                                            return '';
                                        },
                                    },
                                },
                            },
                            responsive: [{
                                breakPoint: 576,
                                options: {
                                    chart: {
                                        height: 95
                                    },
                                    grid: {
                                        padding: {
                                            top: 45,
                                            bottom: 0,
                                            left: 0
                                        }
                                    }
                                }
                            }],
                        }
                    }
                }));
            });
        </script> --}}
</x-layout.default>
