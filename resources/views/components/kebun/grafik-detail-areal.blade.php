@props(['series', 'categories'])

<div class="bg-white dark:bg-black p-6 rounded-3xl shadow-md border-2 border-blue-300 col-span-1 md:col-span-1">
    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4 text-center">
        Detail Areal TU TK TBM I-III<br>Kelapa Sawit dan Karet
    </h2>

    <div x-data="chartDetailAreal()" x-init="init">
        <div x-ref="chart"></div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("chartDetailAreal", () => ({
                series: @js($series),
                categories: @js($categories),
                chart: null,

                init() {
                    this.renderChart();
                    window.addEventListener('theme-changed', this.updateTheme.bind(this));
                },

                renderChart() {
                    if (this.chart) {
                        this.chart.destroy();
                    }

                    const isDark = document.documentElement.classList.contains('dark');

                    this.chart = new ApexCharts(this.$refs.chart, {
                        chart: {
                            type: 'bar',
                            height: 300,
                            stacked: true,
                            toolbar: {
                                show: false
                            },
                        },
                        colors: [
                            '#60A5FA', '#9333EA', '#F87171', '#6366F1',
                            '#3B82F6', '#1E40AF', '#7C3AED', '#F43F5E'
                        ],
                        series: this.series,
                        xaxis: {
                            categories: this.categories,
                            axisBorder: {
                                color: isDark ? '#191e3a' : '#e0e6ed'
                            },
                            labels: {
                                style: {
                                    colors: isDark ? '#e5e7eb' : '#374151',
                                }
                            }
                        },
                        legend: {
                            position: 'top',
                            fontSize: '12px',
                            labels: {
                                colors: isDark ? '#e5e7eb' : '#374151',
                            }
                        },
                        tooltip: {
                            theme: isDark ? 'dark' : 'light',
                            y: {
                                formatter: val => `${val} Ha`
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
                },

                updateTheme() {
                    this.renderChart();
                }
            }));
        });
    </script>
@endpush
