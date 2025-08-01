@props(['data'])

<div x-data="chartKondisiPohon()" x-init="init"
    class="bg-white dark:bg-black p-6 rounded-3xl shadow-md border-2 border-blue-300">
    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4 text-center">
        Kondisi Pohon
    </h2>

    @if (count($data))
        <div x-ref="pieChart" class="w-full max-w-[480px] mx-auto min-h-[280px]"></div>
    @else
        <div class="text-center text-gray-500 dark:text-gray-400 py-20">
            Data belum tersedia untuk chart ini.
        </div>
    @endif
</div>

@push('scripts')
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("chartKondisiPohon", () => ({
                chartInstance: null,
                dataMap: @json($data),

                init() {
                    this.renderChart();
                    window.addEventListener('theme-changed', this.renderChart.bind(this));
                },

                renderChart() {
                    if (this.chartInstance) this.chartInstance.destroy();

                    const isDark = document.documentElement.classList.contains('dark');

                    const options = {
                        series: Object.values(this.dataMap),
                        labels: Object.keys(this.dataMap),
                        chart: {
                            type: 'pie',
                            height: 360,
                            toolbar: {
                                show: false
                            },
                            background: 'transparent'
                        },
                        colors: ['#1E88E5', '#FF9800', '#E53935', '#8E24AA', '#43A047'],
                        stroke: {
                            show: false
                        },
                        legend: {
                            position: 'bottom',
                            fontSize: '12px',
                            labels: {
                                colors: isDark ? '#e5e7eb' : '#374151'
                            },
                            itemMargin: {
                                horizontal: 8,
                                vertical: 4
                            }
                        },
                        tooltip: {
                            theme: isDark ? 'dark' : 'light',
                            y: {
                                formatter: val => `${val}%`
                            }
                        },
                        theme: {
                            mode: isDark ? 'dark' : 'light'
                        },
                        grid: {
                            borderColor: isDark ? '#191e3a' : '#e0e6ed'
                        },
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                    height: 300
                                },
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }]
                    };

                    this.chartInstance = new ApexCharts(this.$refs.pieChart, options);
                    this.chartInstance.render();
                }
            }));
        });
    </script>
@endpush
