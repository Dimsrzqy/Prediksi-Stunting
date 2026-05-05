@extends('layouts.admin')

@section('title', __('Dashboard') . ' - Prediksi Stunting')

@section('content')
<style>
    /* iOS Style Utilities */
    .ios-bg {
        background-color: #F2F2F7;
    }

    .dark .ios-bg {
        background-color: #020617;
    }

    /* slate-950 */

    .ios-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        box-shadow: 0 8px 32px -8px rgba(0, 0, 0, 0.06);
        border-radius: 28px;
    }

    .dark .ios-card {
        background: rgba(30, 41, 59, 0.4);
        /* slate-800/40 */
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: 0 8px 32px -8px rgba(0, 0, 0, 0.4);
    }

    .ios-icon-box {
        border-radius: 22px;
        box-shadow: inset 0 2px 4px rgba(255, 255, 255, 0.4), 0 8px 16px -4px rgba(0, 0, 0, 0.15);
    }

    .text-gradient {
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>

<main class="flex-1 overflow-x-hidden overflow-y-auto ios-bg p-4 md:p-8 relative no-scrollbar transition-colors duration-300">
    <!-- Decorative Ambient Glows -->
    <div class="fixed top-0 right-0 w-96 h-96 bg-blue-300 dark:bg-blue-900 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-[100px] opacity-30 dark:opacity-20 pointer-events-none transform translate-x-1/3 -translate-y-1/3 transition-all duration-500"></div>
    <div class="fixed bottom-0 left-0 w-96 h-96 bg-pink-300 dark:bg-pink-900 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-[100px] opacity-30 dark:opacity-20 pointer-events-none transform -translate-x-1/3 translate-y-1/3 transition-all duration-500"></div>

    <div class="mx-auto max-w-7xl relative z-10">

        <!-- HEADER -->
        <div class="mb-10 px-2 mt-4">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-slate-800 dark:text-slate-100 transition-colors">
                {{ __('Halo,') }} <span class="bg-gradient-to-r from-blue-600 to-indigo-500 text-gradient">{{ Auth::user()->name }}</span> ✨
            </h1>
            <p class="mt-2 text-base text-slate-500 dark:text-slate-400 max-w-2xl font-medium transition-colors">
                {{ __('Ringkasan pemantauan stunting dan metrik kesehatan hari ini.') }}
            </p>
        </div>

        <!-- STATS WIDGETS -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-10">

            <!-- Widget 1: Anak -->
            <div class="ios-card p-6 flex flex-col justify-between transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_20px_40px_-10px_rgba(59,130,246,0.2)] dark:hover:shadow-[0_20px_40px_-10px_rgba(59,130,246,0.4)] group cursor-pointer">
                <div class="flex justify-between items-start mb-6">
                    <div class="ios-icon-box flex h-16 w-16 items-center justify-center bg-gradient-to-br from-blue-400 to-blue-600 text-white">
                        <i class="fa-solid fa-child-reaching text-2xl"></i>
                    </div>
                    <div class="h-8 w-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 opacity-0 group-hover:opacity-100 transition-all">
                        <i class="fa-solid fa-arrow-right -rotate-45 text-sm"></i>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-500 dark:text-slate-500 mb-1 text-sm uppercase tracking-wider">{{ __('Total Anak') }}</h3>
                    <div class="flex items-end gap-2">
                        <span id="statAnak" class="text-4xl font-extrabold text-slate-800 dark:text-slate-100 tracking-tight transition-colors">...</span>
                        <span class="text-xs font-bold text-blue-600 dark:text-blue-400 bg-blue-100 dark:bg-blue-900/30 px-2 py-1 rounded-lg mb-1.5 transition-colors">{{ __('Data Aktif') }}</span>
                    </div>
                </div>
            </div>

            <!-- Widget 2: Ibu -->
            <div class="ios-card p-6 flex flex-col justify-between transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_20px_40px_-10px_rgba(236,72,153,0.2)] dark:hover:shadow-[0_20px_40px_-10px_rgba(236,72,153,0.4)] group cursor-pointer">
                <div class="flex justify-between items-start mb-6">
                    <div class="ios-icon-box flex h-16 w-16 items-center justify-center bg-gradient-to-br from-pink-400 to-rose-500 text-white">
                        <i class="fa-solid fa-person-breastfeeding text-2xl"></i>
                    </div>
                    <div class="h-8 w-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 opacity-0 group-hover:opacity-100 transition-all">
                        <i class="fa-solid fa-arrow-right -rotate-45 text-sm"></i>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-500 dark:text-slate-500 mb-1 text-sm uppercase tracking-wider">{{ __('Data Ibu') }}</h3>
                    <div class="flex items-end gap-2">
                        <span id="statIbu" class="text-4xl font-extrabold text-slate-800 dark:text-slate-100 tracking-tight transition-colors">...</span>
                        <span class="text-xs font-bold text-pink-600 dark:text-pink-400 bg-pink-100 dark:bg-pink-900/30 px-2 py-1 rounded-lg mb-1.5 transition-colors">{{ __('Terdaftar') }}</span>
                    </div>
                </div>
            </div>

            <!-- Widget 3: Makanan -->
            <div class="ios-card p-6 flex flex-col justify-between transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_20px_40px_-10px_rgba(99,102,241,0.2)] dark:hover:shadow-[0_20px_40px_-10px_rgba(99,102,241,0.4)] group cursor-pointer">
                <div class="flex justify-between items-start mb-6">
                    <div class="ios-icon-box flex h-16 w-16 items-center justify-center bg-gradient-to-br from-indigo-400 to-violet-600 text-white">
                        <i class="fa-solid fa-bowl-rice text-2xl"></i>
                    </div>
                    <div class="h-8 w-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 opacity-0 group-hover:opacity-100 transition-all">
                        <i class="fa-solid fa-arrow-right -rotate-45 text-sm"></i>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-500 dark:text-slate-500 mb-1 text-sm uppercase tracking-wider">{{ __('Menu Makanan') }}</h3>
                    <div class="flex items-end gap-2">
                        <span id="statMakanan" class="text-4xl font-extrabold text-slate-800 dark:text-slate-100 tracking-tight transition-colors">...</span>
                        <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400 bg-indigo-100 dark:bg-indigo-900/30 px-2 py-1 rounded-lg mb-1.5 transition-colors">{{ __('Variasi') }}</span>
                    </div>
                </div>
            </div>

            <!-- Widget 4: Nutrisi -->
            <div class="ios-card p-6 flex flex-col justify-between transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_20px_40px_-10px_rgba(16,185,129,0.2)] dark:hover:shadow-[0_20px_40px_-10px_rgba(16,185,129,0.4)] group cursor-pointer">
                <div class="flex justify-between items-start mb-6">
                    <div class="ios-icon-box flex h-16 w-16 items-center justify-center bg-gradient-to-br from-emerald-400 to-teal-500 text-white">
                        <i class="fa-solid fa-leaf text-2xl"></i>
                    </div>
                    <div class="h-8 w-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 opacity-0 group-hover:opacity-100 transition-all">
                        <i class="fa-solid fa-arrow-right -rotate-45 text-sm"></i>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-500 dark:text-slate-500 mb-1 text-sm uppercase tracking-wider">{{ __('Master Nutrisi') }}</h3>
                    <div class="flex items-end gap-2">
                        <span id="statNutrisi" class="text-4xl font-extrabold text-slate-800 dark:text-slate-100 tracking-tight transition-colors">...</span>
                        <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-100 dark:bg-emerald-900/30 px-2 py-1 rounded-lg mb-1.5 transition-colors">{{ __('Kategori') }}</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- CHART SECTION -->
        <div class="ios-card p-6 md:p-8 mb-8 transition-all">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <div>
                    <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100 tracking-tight transition-colors">{{ __('Tren Prediksi') }}</h3>
                    <p id="subtitleChart" class="text-slate-500 dark:text-slate-400 font-medium mt-1 transition-colors">{{ __('Status gizi anak dalam 12 bulan terakhir') }}</p>
                </div>
                <div class="mt-4 sm:mt-0 flex p-1 bg-slate-200/50 dark:bg-slate-800/50 backdrop-blur rounded-full transition-colors">
                    <button id="btnMinggu" class="px-5 py-2 hover:text-slate-800 dark:hover:text-slate-100 text-slate-500 dark:text-slate-400 rounded-full text-sm font-bold transition-all">{{ __('Minggu') }}</button>
                    <button id="btnBulan" class="px-5 py-2 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-100 rounded-full text-sm font-bold shadow-sm transition-all">{{ __('Bulan') }}</button>
                </div>
            </div>

            <div class="relative w-full h-80 lg:h-96">
                <canvas id="stuntingChart"></canvas>
            </div>
        </div>

    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        let stuntingChartInstance = null;
        let currentFilter = 'bulan';

        async function fetchStats() {
            try {
                // Fetch Data Anak
                const resAnak = await fetch('/api-anak', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const anak = await resAnak.json();
                document.getElementById('statAnak').innerText = (anak.data || []).length;

                // Fetch Data Ibu
                const resIbu = await fetch('/api-ibu', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const responseIbu = await resIbu.json();
                document.getElementById('statIbu').innerText = (responseIbu.data || []).length;

                // Fetch Data Makanan (Silahkan disesuaikan jika API berbeda)
                const resMakanan = await fetch('/api-makanan', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const makanan = await resMakanan.json();
                document.getElementById('statMakanan').innerText = (makanan.data || []).length;

                // Fetch Data Nutrisi (Silahkan disesuaikan jika API berbeda)
                const resNutrisi = await fetch('/api-nutrisi', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const nutrisi = await resNutrisi.json();
                document.getElementById('statNutrisi').innerText = (nutrisi.data || []).length;

            } catch (err) {
                console.error("Gagal load widget stats", err);
            }
        }

        async function fetchChart(filter = 'bulan') {
            currentFilter = filter;
            try {
                const isDark = document.documentElement.classList.contains('dark');
                const res = await fetch(`/api-chart-histori?filter=${filter}`);
                const chartData = await res.json();

                if (chartData.datasets) {
                    chartData.datasets.forEach((ds, index) => {
                        ds.tension = 0.4;
                        ds.borderWidth = 3;
                        ds.pointRadius = 4;
                        ds.pointHoverRadius = 6;
                    });
                }

                const ctx = document.getElementById('stuntingChart').getContext('2d');
                if (stuntingChartInstance) stuntingChartInstance.destroy();

                const textColor = isDark ? '#94a3b8' : '#64748b';
                const gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';

                stuntingChartInstance = new Chart(ctx, {
                    type: 'line',
                    data: chartData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: textColor
                                }
                            },
                            y: {
                                beginAtZero: true,
                                border: {
                                    display: false
                                },
                                grid: {
                                    color: gridColor
                                },
                                ticks: {
                                    precision: 0,
                                    color: textColor
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    usePointStyle: true,
                                    padding: 20,
                                    color: isDark ? '#e2e8f0' : '#1e293b',
                                    font: {
                                        family: "'Inter', sans-serif",
                                        weight: '600'
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: isDark ? 'rgba(15, 23, 42, 0.9)' : 'rgba(255,255,255,0.9)',
                                titleColor: isDark ? '#f8fafc' : '#1e293b',
                                bodyColor: isDark ? '#94a3b8' : '#475569',
                                borderColor: isDark ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.1)',
                                borderWidth: 1,
                                padding: 12,
                                boxPadding: 6,
                                usePointStyle: true,
                                titleFont: {
                                    size: 13,
                                    family: "'Inter', sans-serif"
                                }
                            }
                        }
                    }
                });
            } catch (err) {
                console.error("Gagal load chart data", err);
            }
        }

        // Toggles Chart Filter
        const btnMinggu = document.getElementById('btnMinggu');
        const btnBulan = document.getElementById('btnBulan');
        const subtitleChart = document.getElementById('subtitleChart');

        function updateButtonStyles() {
            const isDark = document.documentElement.classList.contains('dark');
            if (currentFilter === 'minggu') {
                btnMinggu.className = `px-5 py-2 ${isDark ? 'bg-slate-700 text-slate-100' : 'bg-white text-slate-800'} rounded-full text-sm font-bold shadow-sm transition-all`;
                btnBulan.className = `px-5 py-2 hover:text-slate-800 dark:hover:text-slate-100 text-slate-500 dark:text-slate-400 rounded-full text-sm font-bold transition-all`;
            } else {
                btnBulan.className = `px-5 py-2 ${isDark ? 'bg-slate-700 text-slate-100' : 'bg-white text-slate-800'} rounded-full text-sm font-bold shadow-sm transition-all`;
                btnMinggu.className = `px-5 py-2 hover:text-slate-800 dark:hover:text-slate-100 text-slate-500 dark:text-slate-400 rounded-full text-sm font-bold transition-all`;
            }
        }

        btnMinggu.addEventListener('click', () => {
            currentFilter = 'minggu';
            subtitleChart.innerText = "{{ __('Status gizi anak dalam 7 hari terakhir') }}";
            updateButtonStyles();
            fetchChart('minggu');
        });

        btnBulan.addEventListener('click', () => {
            currentFilter = 'bulan';
            subtitleChart.innerText = "{{ __('Status gizi anak dalam 12 bulan terakhir') }}";
            updateButtonStyles();
            fetchChart('bulan');
        });

        // Listen for theme toggle to update chart
        const themeToggleBtn = document.getElementById('themeToggle');
        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', () => {
                setTimeout(() => {
                    updateButtonStyles();
                    fetchChart(currentFilter);
                }, 50);
            });
        }

        fetchStats();
        fetchChart('bulan');
    });
</script>
@endsection