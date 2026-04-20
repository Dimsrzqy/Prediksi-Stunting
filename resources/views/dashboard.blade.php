@extends('layouts.admin')

@section('title', 'Dashboard Utama - Prediksi Stunting')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50/50 p-6 md:p-8">
    <div class="mx-auto max-w-7xl">
        
        <!-- HEADER -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-slate-800">
                Selamat Datang, <span class="text-indigo-600">{{ Auth::user()->name }}</span>! 👋
            </h1>
            <p class="mt-2 text-sm text-slate-500 max-w-2xl">
                Pantau statistik data puskesmas, pertumbuhan anak, rekam medis ibu, serta manajemen gizi secara real-time melalui dashboard interaktif ini.
            </p>
        </div>

        <!-- STATS WIDGETS -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
            
            <!-- Widget 1: Anak -->
            <div class="relative overflow-hidden rounded-2xl bg-white p-6 shadow-sm border border-slate-100 group transition-all hover:shadow-md">
                <div class="absolute -right-6 -top-6 rounded-full bg-blue-50 p-8 transition-transform group-hover:scale-110">
                    <i class="fa-solid fa-child-reaching text-4xl text-blue-200"></i>
                </div>
                <div class="relative">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <i class="fa-solid fa-children text-lg"></i>
                        </div>
                        <h3 class="font-semibold text-slate-600">Total Anak</h3>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <span id="statAnak" class="text-3xl font-bold text-slate-800">...</span>
                        <span class="text-xs font-medium text-slate-400 uppercase tracking-wide">Terdaftar</span>
                    </div>
                </div>
            </div>

            <!-- Widget 2: Ibu -->
            <div class="relative overflow-hidden rounded-2xl bg-white p-6 shadow-sm border border-slate-100 group transition-all hover:shadow-md">
                <div class="absolute -right-6 -top-6 rounded-full bg-pink-50 p-8 transition-transform group-hover:scale-110">
                    <i class="fa-solid fa-person-breastfeeding text-4xl text-pink-200"></i>
                </div>
                <div class="relative">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-pink-50 text-pink-500">
                            <i class="fa-solid fa-person-dress text-lg"></i>
                        </div>
                        <h3 class="font-semibold text-slate-600">Data Ibu</h3>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <span id="statIbu" class="text-3xl font-bold text-slate-800">...</span>
                        <span class="text-xs font-medium text-slate-400 uppercase tracking-wide">Profil</span>
                    </div>
                </div>
            </div>

            <!-- Widget 3: Makanan -->
            <div class="relative overflow-hidden rounded-2xl bg-white p-6 shadow-sm border border-slate-100 group transition-all hover:shadow-md">
                <div class="absolute -right-6 -top-6 rounded-full bg-indigo-50 p-8 transition-transform group-hover:scale-110">
                    <i class="fa-solid fa-bowl-rice text-4xl text-indigo-200"></i>
                </div>
                <div class="relative">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                            <i class="fa-solid fa-utensils text-lg"></i>
                        </div>
                        <h3 class="font-semibold text-slate-600">Menu Makanan</h3>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <span id="statMakanan" class="text-3xl font-bold text-slate-800">...</span>
                        <span class="text-xs font-medium text-slate-400 uppercase tracking-wide">Rekomendasi</span>
                    </div>
                </div>
            </div>

            <!-- Widget 4: Nutrisi -->
            <div class="relative overflow-hidden rounded-2xl bg-white p-6 shadow-sm border border-slate-100 group transition-all hover:shadow-md">
                <div class="absolute -right-6 -top-6 rounded-full bg-green-50 p-8 transition-transform group-hover:scale-110">
                    <i class="fa-solid fa-seedling text-4xl text-green-200"></i>
                </div>
                <div class="relative">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-50 text-green-600">
                            <i class="fa-solid fa-leaf text-lg"></i>
                        </div>
                        <h3 class="font-semibold text-slate-600">Master Nutrisi</h3>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <span id="statNutrisi" class="text-3xl font-bold text-slate-800">...</span>
                        <span class="text-xs font-medium text-slate-400 uppercase tracking-wide">Kategori</span>
                    </div>
                </div>
            </div>

        </div>



        <!-- CHART SECTION -->
        <div class="mt-8 bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">
            <div class="mb-4">
                <h3 class="text-xl font-bold text-slate-800">Grafik Histori Prediksi Stunting</h3>
                <p class="text-sm text-slate-500">Pemantauan klasifikasi hasil prediksi anak selama 12 bulan terakhir</p>
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

        async function fetchChart() {
            try {
                const res = await fetch('/api-chart-histori');
                const chartData = await res.json();

                const ctx = document.getElementById('stuntingChart').getContext('2d');
                new Chart(ctx, {
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
                            y: {
                                beginAtZero: true,
                                ticks: { precision: 0 }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                            }
                        }
                    }
                });
            } catch (err) {
                console.error("Gagal load chart data", err);
            }
        }

        fetchStats();
        fetchChart();
    });
</script>
@endsection
