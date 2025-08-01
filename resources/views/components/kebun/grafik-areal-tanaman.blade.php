@props(['data'])

<div class="bg-white dark:bg-black p-6 rounded-3xl shadow-md border-2 border-blue-300 col-span-1 md:col-span-1">
    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4 text-center">
        Areal Tanaman
    </h2>

    <div x-data="chartArealTanaman()" x-init="init">
        <div x-ref="chart"></div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("chartArealTanaman", () => ({
                chart: null,

                // Data dari controller
                dataMap: @json($data),

                init() {
                    this.renderChart();
                    window.addEventListener('theme-changed', this.renderChart.bind(this));
                },

                renderChart() {
                    if (this.chart) this.chart.destroy();

                    const isDark = document.documentElement.classList.contains('dark');

                    // Warna unik per kategori
                    const warna = ['#8BC34A', '#FF9800', '#F44336', '#795548'];

                    // Generate dataset per kategori agar legend tampil
                    const series = Object.entries(this.dataMap).map(([label, value], index) => ({
                        name: label,
                        data: [value],
                        color: warna[index % warna.length]
                    }));

                    this.chart = new ApexCharts(this.$refs.chart, {
                        chart: {
                            type: 'bar',
                            height: 300,
                            toolbar: {
                                show: false
                            },
                            stacked: false
                        },
                        series: series,
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '40%'
                            }
                        },
                        xaxis: {
                            categories: [''],
                            labels: {
                                style: {
                                    colors: isDark ? '#e5e7eb' : '#374151',
                                }
                            },
                            axisBorder: {
                                color: isDark ? '#191e3a' : '#e0e6ed'
                            }
                        },
                        yaxis: {
                            max: 100,
                            labels: {
                                formatter: val => `${val}%`,
                                style: {
                                    colors: isDark ? '#e5e7eb' : '#374151',
                                }
                            }
                        },
                        tooltip: {
                            theme: isDark ? 'dark' : 'light',
                            y: {
                                formatter: val => `${val}%`
                            }
                        },
                        legend: {
                            position: 'top',
                            fontSize: '12px',
                            labels: {
                                colors: isDark ? '#e5e7eb' : '#374151',
                            }
                        },
                        fill: {
                            opacity: 0.9
                        },
                        grid: {
                            borderColor: isDark ? '#191e3a' : '#e0e6ed',
                        }
                    });

                    this.chart.render();
                }
            }));
        });
    </script>
@endpush
