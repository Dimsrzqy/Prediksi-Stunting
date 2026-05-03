@extends('layouts.admin')

@section('title', 'Dashboard Utama - Prediksi Stunting')

@section('content')
<style>
    /* iOS Style Utilities */
    .ios-bg { background-color: #F2F2F7; }
    .ios-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        box-shadow: 0 8px 32px -8px rgba(0,0,0,0.06);
        border-radius: 28px;
    }
    .ios-icon-box {
        border-radius: 22px;
        box-shadow: inset 0 2px 4px rgba(255,255,255,0.4), 0 8px 16px -4px rgba(0,0,0,0.15);
    }
    .text-gradient {
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    /* Sembunyikan scrollbar tapi tetap bisa scroll */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<main class="flex-1 overflow-x-hidden overflow-y-auto ios-bg p-4 md:p-8 relative no-scrollbar">
    <!-- Decorative Ambient Glows -->
    <div class="fixed top-0 right-0 w-96 h-96 bg-blue-300 rounded-full mix-blend-multiply filter blur-[100px] opacity-30 pointer-events-none transform translate-x-1/3 -translate-y-1/3"></div>
    <div class="fixed bottom-0 left-0 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-[100px] opacity-30 pointer-events-none transform -translate-x-1/3 translate-y-1/3"></div>

    <div class="mx-auto max-w-7xl relative z-10">
        
        <!-- HEADER -->
        <div class="mb-10 px-2 mt-4">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-slate-800">
                Halo, <span class="bg-gradient-to-r from-blue-600 to-indigo-500 text-gradient">{{ Auth::user()->name }}</span> ✨
            </h1>
            <p class="mt-2 text-base text-slate-500 max-w-2xl font-medium">
                Ringkasan pemantauan stunting dan metrik kesehatan hari ini.
            </p>
        </div>

        <!-- STATS WIDGETS -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-10">
            
            <!-- Widget 1: Anak -->
            <div class="ios-card p-6 flex flex-col justify-between transition-transform duration-300 hover:-translate-y-1 hover:shadow-[0_20px_40px_-10px_rgba(59,130,246,0.2)] group cursor-pointer">
                <div class="flex justify-between items-start mb-6">
                    <div class="ios-icon-box flex h-16 w-16 items-center justify-center bg-gradient-to-br from-blue-400 to-blue-600 text-white">
                        <i class="fa-solid fa-child-reaching text-2xl"></i>
                    </div>
                    <div class="h-8 w-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 opacity-0 group-hover:opacity-100 transition-opacity">
                        <i class="fa-solid fa-arrow-right -rotate-45 text-sm"></i>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-500 mb-1 text-sm uppercase tracking-wider">Total Anak</h3>
                    <div class="flex items-end gap-2">
                        <span id="statAnak" class="text-4xl font-extrabold text-slate-800 tracking-tight">...</span>
                        <span class="text-xs font-bold text-blue-600 bg-blue-100 px-2 py-1 rounded-lg mb-1.5">Data Aktif</span>
                    </div>
                </div>
            </div>

            <!-- Widget 2: Ibu -->
            <div class="ios-card p-6 flex flex-col justify-between transition-transform duration-300 hover:-translate-y-1 hover:shadow-[0_20px_40px_-10px_rgba(236,72,153,0.2)] group cursor-pointer">
                <div class="flex justify-between items-start mb-6">
                    <div class="ios-icon-box flex h-16 w-16 items-center justify-center bg-gradient-to-br from-pink-400 to-rose-500 text-white">
                        <i class="fa-solid fa-person-breastfeeding text-2xl"></i>
                    </div>
                    <div class="h-8 w-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 opacity-0 group-hover:opacity-100 transition-opacity">
                        <i class="fa-solid fa-arrow-right -rotate-45 text-sm"></i>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-500 mb-1 text-sm uppercase tracking-wider">Data Ibu</h3>
                    <div class="flex items-end gap-2">
                        <span id="statIbu" class="text-4xl font-extrabold text-slate-800 tracking-tight">...</span>
                        <span class="text-xs font-bold text-pink-600 bg-pink-100 px-2 py-1 rounded-lg mb-1.5">Terdaftar</span>
                    </div>
                </div>
            </div>

            <!-- Widget 3: Makanan -->
            <div class="ios-card p-6 flex flex-col justify-between transition-transform duration-300 hover:-translate-y-1 hover:shadow-[0_20px_40px_-10px_rgba(99,102,241,0.2)] group cursor-pointer">
                <div class="flex justify-between items-start mb-6">
                    <div class="ios-icon-box flex h-16 w-16 items-center justify-center bg-gradient-to-br from-indigo-400 to-violet-600 text-white">
                        <i class="fa-solid fa-bowl-rice text-2xl"></i>
                    </div>
                    <div class="h-8 w-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 opacity-0 group-hover:opacity-100 transition-opacity">
                        <i class="fa-solid fa-arrow-right -rotate-45 text-sm"></i>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-500 mb-1 text-sm uppercase tracking-wider">Menu Makanan</h3>
                    <div class="flex items-end gap-2">
                        <span id="statMakanan" class="text-4xl font-extrabold text-slate-800 tracking-tight">...</span>
                        <span class="text-xs font-bold text-indigo-600 bg-indigo-100 px-2 py-1 rounded-lg mb-1.5">Variasi</span>
                    </div>
                </div>
            </div>

            <!-- Widget 4: Nutrisi -->
            <div class="ios-card p-6 flex flex-col justify-between transition-transform duration-300 hover:-translate-y-1 hover:shadow-[0_20px_40px_-10px_rgba(16,185,129,0.2)] group cursor-pointer">
                <div class="flex justify-between items-start mb-6">
                    <div class="ios-icon-box flex h-16 w-16 items-center justify-center bg-gradient-to-br from-emerald-400 to-teal-500 text-white">
                        <i class="fa-solid fa-leaf text-2xl"></i>
                    </div>
                    <div class="h-8 w-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 opacity-0 group-hover:opacity-100 transition-opacity">
                        <i class="fa-solid fa-arrow-right -rotate-45 text-sm"></i>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-500 mb-1 text-sm uppercase tracking-wider">Master Nutrisi</h3>
                    <div class="flex items-end gap-2">
                        <span id="statNutrisi" class="text-4xl font-extrabold text-slate-800 tracking-tight">...</span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-100 px-2 py-1 rounded-lg mb-1.5">Kategori</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- CHART SECTION -->
        <div class="ios-card p-6 md:p-8 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <div>
                    <h3 class="text-2xl font-bold text-slate-800 tracking-tight">Tren Prediksi</h3>
                    <p id="subtitleChart" class="text-slate-500 font-medium mt-1">Status gizi anak dalam 12 bulan terakhir</p>
                </div>
                <div class="mt-4 sm:mt-0 flex p-1 bg-slate-200/50 backdrop-blur rounded-full">
                    <button id="btnMinggu" class="px-5 py-2 hover:text-slate-800 text-slate-500 rounded-full text-sm font-bold transition-all">Minggu</button>
                    <button id="btnBulan" class="px-5 py-2 bg-white text-slate-800 rounded-full text-sm font-bold shadow-sm transition-all">Bulan</button>
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
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let stuntingChartInstance = null;
        
        async function fetchStats() {
            try {
                // Fetch Data Anak
                const resAnak = await fetch('/api-anak', { headers: { 'Accept': 'application/json' }});
                const anak = await resAnak.json();
                document.getElementById('statAnak').innerText = (anak.data || []).length;

                // Fetch Data Ibu
                const resIbu = await fetch('/api-ibu', { headers: { 'Accept': 'application/json' }});
                const ibu = await resIbu.json();
                document.getElementById('statIbu').innerText = (Array.isArray(ibu) ? ibu : []).length;

                // Fetch Data Makanan
                const resMakanan = await fetch('/api-makanan', { headers: { 'Accept': 'application/json' }});
                const makanan = await resMakanan.json();
                document.getElementById('statMakanan').innerText = (makanan.data || []).length;

                // Fetch Data Nutrisi
                const resNutrisi = await fetch('/api-nutrisi', { headers: { 'Accept': 'application/json' }});
                const nutrisi = await resNutrisi.json();
                document.getElementById('statNutrisi').innerText = (nutrisi.data || []).length;

            } catch (err) {
                console.error("Gagal load widget stats", err);
            }
        }

        async function fetchChart(filter = 'bulan') {
            try {
                const res = await fetch(`/api-chart-histori?filter=${filter}`);
                const chartData = await res.json();

                // Customisasi Chart untuk style iOS
                if(chartData.datasets) {
                    chartData.datasets.forEach((ds, index) => {
                        ds.tension = 0.4; // Smooth curve
                        ds.borderWidth = 3;
                        ds.pointRadius = 4;
                        ds.pointHoverRadius = 6;
                    });
                }

                const ctx = document.getElementById('stuntingChart').getContext('2d');
                
                if (stuntingChartInstance) {
                    stuntingChartInstance.destroy();
                }

                stuntingChartInstance = new Chart(ctx, {
                    type: 'line',
                    data: chartData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false,
                        },
                        scales: {
                            x: {
                                grid: { display: false }
                            },
                            y: {
                                beginAtZero: true,
                                border: { display: false },
                                grid: { color: 'rgba(0,0,0,0.05)' },
                                ticks: { precision: 0 }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    usePointStyle: true,
                                    padding: 20,
                                    font: { family: "'Inter', sans-serif", weight: '600' }
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(255,255,255,0.9)',
                                titleColor: '#1e293b',
                                bodyColor: '#475569',
                                borderColor: 'rgba(0,0,0,0.1)',
                                borderWidth: 1,
                                padding: 12,
                                boxPadding: 6,
                                usePointStyle: true,
                                titleFont: { size: 13, family: "'Inter', sans-serif" }
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

        btnMinggu.addEventListener('click', () => {
            btnMinggu.className = "px-5 py-2 bg-white text-slate-800 rounded-full text-sm font-bold shadow-sm transition-all";
            btnBulan.className = "px-5 py-2 hover:text-slate-800 text-slate-500 rounded-full text-sm font-bold transition-all";
            subtitleChart.innerText = "Status gizi anak dalam 7 hari terakhir";
            fetchChart('minggu');
        });

        btnBulan.addEventListener('click', () => {
            btnBulan.className = "px-5 py-2 bg-white text-slate-800 rounded-full text-sm font-bold shadow-sm transition-all";
            btnMinggu.className = "px-5 py-2 hover:text-slate-800 text-slate-500 rounded-full text-sm font-bold transition-all";
            subtitleChart.innerText = "Status gizi anak dalam 12 bulan terakhir";
            fetchChart('bulan');
        });

        fetchStats();
        fetchChart('bulan');
    });
</script>
@endsection
