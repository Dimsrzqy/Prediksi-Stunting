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

        <!-- QUICK ACTIONS & INFO SECTION -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Papan Informasi Panduan -->
            <div class="lg:col-span-2 bg-gradient-to-br from-indigo-600 to-violet-700 rounded-3xl p-8 text-white relative overflow-hidden shadow-lg shadow-indigo-200">
                <!-- Background decoration -->
                <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-1/4 translate-y-1/4">
                    <i class="fa-solid fa-stethoscope" style="font-size: 20rem;"></i>
                </div>
                
                <div class="relative z-10">
                    <span class="inline-block px-3 py-1 bg-white/20 rounded-full text-xs font-bold uppercase tracking-wider mb-4 border border-white/30 backdrop-blur-sm">
                        Panduan Penggunaan
                    </span>
                    <h2 class="text-2xl font-bold mb-3">Pencegahan Stunting Dimulai dari Data yang Baik</h2>
                    <p class="text-indigo-100 mb-6 max-w-lg leading-relaxed">
                        Sistem ini dirancang untuk mendata dan memantau status stunting pada anak melalui manajemen gizi terpadu. Agar sistem bekerja optimal, ikuti urutan berikut:
                    </p>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3 bg-white/10 p-3 rounded-xl backdrop-blur-sm border border-white/10">
                            <div class="flex-shrink-0 h-8 w-8 rounded-full bg-white text-indigo-600 flex items-center justify-center font-bold text-sm">1</div>
                            <span class="font-medium text-white shadow-sm">Masukkan <strong class="text-yellow-300">Data Profil Ibu</strong> terlebih dahulu secara akurat.</span>
                        </li>
                        <li class="flex items-center gap-3 bg-white/10 p-3 rounded-xl backdrop-blur-sm border border-white/10">
                            <div class="flex-shrink-0 h-8 w-8 rounded-full bg-white text-indigo-600 flex items-center justify-center font-bold text-sm">2</div>
                            <span class="font-medium text-white shadow-sm">Tambahkan <strong class="text-blue-300">Data Anak</strong> dan tautkan ke Profil Ibu.</span>
                        </li>
                    </ul>

                    <div class="flex gap-4">
                        <a href="{{ route('ibu.index') }}" class="bg-white text-indigo-600 px-6 py-2.5 rounded-xl font-bold hover:bg-slate-50 transition-colors shadow-sm inline-flex items-center gap-2">
                            Mulai Input Data <i class="fa-solid fa-arrow-right text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity / Access -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm flex flex-col">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-bolt text-amber-500"></i> Pintasan Cepat
                </h3>
                
                <div class="flex-1 flex flex-col gap-3">
                    <a href="{{ route('makanan.index') }}" class="flex items-center p-4 border border-slate-100 rounded-2xl hover:border-indigo-300 hover:bg-indigo-50 transition-all group">
                        <div class="h-10 w-10 flex-shrink-0 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-utensils"></i>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-bold text-slate-700 group-hover:text-indigo-700">Rekomendasi Makanan</p>
                            <p class="text-xs text-slate-500 mt-0.5">Atur menu sehat balita</p>
                        </div>
                        <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-indigo-400"></i>
                    </a>

                    <a href="{{ route('anak.index') }}" class="flex items-center p-4 border border-slate-100 rounded-2xl hover:border-blue-300 hover:bg-blue-50 transition-all group">
                        <div class="h-10 w-10 flex-shrink-0 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-child-reaching"></i>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-bold text-slate-700 group-hover:text-blue-700">Pantau Data Anak</p>
                            <p class="text-xs text-slate-500 mt-0.5">Lihat list anak terbaru</p>
                        </div>
                        <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-blue-400"></i>
                    </a>
                </div>
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

        fetchStats();
    });
</script>
@endsection
