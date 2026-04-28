<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Menu Makanan Gizi Spesifik - Prediksi Stunting</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                        },
                        slate: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-600 antialiased overflow-hidden">
    <!-- Main Layout Wrapper -->
    <div class="flex h-screen w-full">
        
        <!-- SIDEBAR -->
        <aside class="hidden w-64 flex-shrink-0 flex-col bg-slate-900 transition-all duration-300 md:flex z-40 relative">
            <!-- Logo Section -->
            <div class="flex items-center justify-center py-6 border-b border-slate-800">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/20 text-emerald-400">
                        <i class="fa-solid fa-leaf text-xl"></i>
                    </div>
                    <h2 class="text-xl font-bold tracking-wide text-white">
                        Stunting<span class="text-emerald-500">App</span>
                    </h2>
                </div>
            </div>
            
            <!-- Navigation Links -->
            <nav class="flex-1 overflow-y-auto mt-6 px-4 pb-4 scrollbar-thin scrollbar-thumb-slate-700">
                <ul class="space-y-2">
                    <li>
                        <!-- route('dashboard') -->
                        <a href="#" class="group flex items-center rounded-xl px-4 py-3 text-slate-400 transition-colors hover:bg-slate-800 hover:text-white">
                            <i class="fa-solid fa-chart-pie w-6 text-center text-lg group-hover:text-emerald-400 transition-colors"></i>
                            <span class="ml-3 font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <!-- route('children.index') -->
                        <a href="#" class="group flex items-center rounded-xl px-4 py-3 text-slate-400 transition-colors hover:bg-slate-800 hover:text-white">
                            <i class="fa-solid fa-child-reaching w-6 text-center text-lg group-hover:text-emerald-400 transition-colors"></i>
                            <span class="ml-3 font-medium">Data Anak</span>
                        </a>
                    </li>
                    
                    <!-- Menu Header (Kategori) -->
                    <li class="pt-4 pb-2">
                        <span class="px-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Manajemen Gizi</span>
                    </li>
                    
                    <li>
                        <!-- ACTIVE STATE ROUTE (Menu Makanan) -->
                        <a href="#" class="flex items-center rounded-xl px-4 py-3 bg-emerald-600 text-white shadow-lg shadow-emerald-600/20 transition-all hover:bg-emerald-500">
                            <i class="fa-solid fa-utensils w-6 text-center text-lg"></i>
                            <span class="ml-3 font-semibold">Menu Makanan</span>
                        </a>
                    </li>
                    
                    <li class="pt-4 pb-2">
                        <span class="px-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Sistem</span>
                    </li>
                    
                    <li>
                        <!-- route('settings.index') -->
                        <a href="#" class="group flex items-center rounded-xl px-4 py-3 text-slate-400 transition-colors hover:bg-slate-800 hover:text-white">
                            <i class="fa-solid fa-gear w-6 text-center text-lg group-hover:text-emerald-400 transition-colors"></i>
                            <span class="ml-3 font-medium">Pengaturan</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <!-- Bottom Profile / System Alert (Opsional) -->
            <div class="px-4 py-4 border-t border-slate-800">
                <div class="flex items-center gap-3 px-2">
                    <div class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span class="text-xs text-slate-400">Sistem berjalan normal</span>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA FORMATING -->
        <div class="flex flex-1 flex-col overflow-hidden relative">
            
            <!-- TOPBAR -->
            <header class="flex items-center justify-between border-b border-slate-200 bg-white px-6 py-4 shadow-sm z-30">
                
                <!-- Left Section (Mobile Menu & Breadcrumbs) -->
                <div class="flex items-center gap-4">
                    <!-- Hamburger (Visible on Mobile) -->
                    <button class="text-slate-500 hover:text-emerald-600 focus:outline-none md:hidden transition-colors rounded-lg p-1 hover:bg-slate-100">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>

                    <!-- Breadcrumbs -->
                    <nav class="hidden md:flex items-center text-sm font-medium text-slate-500">
                        <a href="#" class="hover:text-emerald-600 transition-colors">Manajemen Gizi</a>
                        <i class="fa-solid fa-chevron-right text-[10px] mx-3 text-slate-300"></i>
                        <span class="text-slate-800">Menu Makanan</span>
                    </nav>
                </div>

                <!-- Right Section (Search, Notifications, Profile) -->
                <div class="flex items-center gap-5 md:gap-6">
                    <!-- Search Bar -->
                    <div class="relative hidden sm:block">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fa-solid fa-magnifying-glass text-slate-400"></i>
                        </div>
                        <input type="text" class="w-48 lg:w-64 rounded-full border border-slate-200 bg-slate-50 py-2 pl-10 pr-4 text-sm text-slate-700 transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-200" placeholder="Cari menu...">
                    </div>

                    <!-- Notification -->
                    <button class="relative text-slate-400 hover:text-emerald-600 transition-colors">
                        <i class="fa-regular fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                    </button>

                    <!-- Profile Dropdown Trigger -->
                    <div class="flex cursor-pointer items-center gap-3 border-l border-slate-200 pl-5 group">
                        <!-- {{ Auth::user()->name }} dan {{ Auth::user()->avatar }} -->
                        <img src="https://ui-avatars.com/api/?name=Admin+Puskesmas&background=10b981&color=fff&bold=true" alt="Admin Profile" class="h-9 w-9 rounded-full object-cover ring-2 ring-transparent transition-all group-hover:ring-emerald-500/50">
                        <div class="hidden md:block">
                            <p class="text-sm font-bold text-slate-700 leading-tight">Admin Puskesmas</p>
                            <p class="text-[11px] font-medium text-emerald-600">Ahli Gizi</p>
                        </div>
                        <i class="fa-solid fa-angle-down text-xs text-slate-400 transition-transform group-hover:rotate-180"></i>
                    </div>
                </div>
            </header>

            <!-- PAGE CONTENT MAIN -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50/50 p-6 md:p-8">
                
                <div class="mx-auto max-w-7xl">
                    <!-- HEADER HALAMAN -->
                    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Manajemen Menu Makanan Gizi Spesifik</h1>
                            <p class="mt-1 text-sm text-slate-500">Kelola daftar rekomendasi menu makanan pendamping untuk pencegahan dan penanganan stunting.</p>
                        </div>
                        <!-- Tombol Tambah Menu -->
                        <!-- {{ route('menus.create') }} -->
                        <a href="#" class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition-all hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 active:scale-95">
                            <i class="fa-solid fa-plus"></i>
                            Tambah Menu Makanan
                        </a>
                    </div>

                    <!-- CARD RINGKASAN STATISTIK -->
                    <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                        
                        <!-- Card 1: Total Menu -->
                        <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md group">
                            <div class="absolute -right-4 -top-4 rounded-full bg-emerald-50 p-8 opacity-50 transition-transform group-hover:scale-110"></div>
                            <div class="relative flex items-center gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                                    <i class="fa-solid fa-utensils text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Total Menu</p>
                                    <!-- Variabel Blade: {{ $totalMenus }} -->
                                    <h3 class="mt-0.5 text-2xl font-bold text-slate-800">32 <span class="text-sm font-medium text-slate-400">Resep</span></h3>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Rata-rata Kalori -->
                        <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md group">
                            <div class="absolute -right-4 -top-4 rounded-full bg-orange-50 p-8 opacity-50 transition-transform group-hover:scale-110"></div>
                            <div class="relative flex items-center gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-100 text-orange-600">
                                    <i class="fa-solid fa-fire text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Rata-rata Kalori</p>
                                    <!-- Variabel Blade: {{ $avgCalories }} -->
                                    <h3 class="mt-0.5 text-2xl font-bold text-slate-800">245 <span class="text-sm font-medium text-slate-400">kkal/porsi</span></h3>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Menu Tinggi Protein -->
                        <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md group">
                            <div class="absolute -right-4 -top-4 rounded-full bg-blue-50 p-8 opacity-50 transition-transform group-hover:scale-110"></div>
                            <div class="relative flex items-center gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                                    <i class="fa-solid fa-dna text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Tinggi Protein</p>
                                    <!-- Variabel Blade: {{ $highProteinCount }} -->
                                    <h3 class="mt-0.5 text-2xl font-bold text-slate-800">18 <span class="text-sm font-medium text-slate-400">Menu</span></h3>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4: Estimasi Biaya Rata-rata -->
                        <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md group">
                            <div class="absolute -right-4 -top-4 rounded-full bg-teal-50 p-8 opacity-50 transition-transform group-hover:scale-110"></div>
                            <div class="relative flex items-center gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-teal-100 text-teal-600">
                                    <i class="fa-solid fa-money-bill-wave text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Rata-rata Biaya</p>
                                    <!-- Variabel Blade: {{ number_format($avgCost, 0, ',', '.') }} -->
                                    <h3 class="mt-0.5 text-2xl font-bold text-slate-800"><span class="text-sm font-semibold text-slate-500 mr-1">Rp</span>12.5k</h3>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <!-- TABEL DATA -->
                    <div class="flex flex-col bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                        
                        <!-- Table Header/Toolbar -->
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 p-5 border-b border-slate-200 bg-slate-50/50">
                            <h2 class="text-lg font-bold text-slate-800">Daftar Menu Tersedia</h2>
                            <div class="flex items-center gap-2">
                                <button class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-600 shadow-sm transition-colors hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-1">
                                    <i class="fa-solid fa-filter text-slate-400"></i> Kategori
                                </button>
                                <button class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-600 shadow-sm transition-colors hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-1">
                                    <i class="fa-solid fa-download text-slate-400"></i> Export
                                </button>
                            </div>
                        </div>

                        <!-- Table Wrapper -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm text-slate-600">
                                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500 border-b border-slate-200">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 font-semibold">Foto & Nama Menu</th>
                                        <th scope="col" class="px-6 py-4 font-semibold">Kategori</th>
                                        <th scope="col" class="px-6 py-4 font-semibold">Kandungan Gizi / Porsi</th>
                                        <th scope="col" class="px-6 py-4 font-semibold">Estimasi Biaya</th>
                                        <th scope="col" class="px-6 py-4 font-semibold text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 bg-white">
                                    
                                    <!-- ============================================== -->
                                    <!-- TEMPLATE BLADE LOOPING UNTUK TABEL             -->
                                    <!-- ============================================== -->
                                    <!-- @forelse ($menus as $menu) -->
                                    
                                    <!-- Data Dummy 1 -->
                                    <tr class="group transition-colors hover:bg-slate-50/70">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <!-- Gambar Makanan: Menggunakan asset storage jika ada -->
                                                <!-- src="{{ asset('storage/' . $menu->foto) }}" -->
                                                <div class="relative h-14 w-14 flex-shrink-0 overflow-hidden rounded-xl border border-slate-200 shadow-sm">
                                                    <img class="h-full w-full object-cover transition-transform group-hover:scale-105" src="https://images.unsplash.com/photo-1512058564366-18510be2db19?ixlib=rb-1.2.1&auto=format&fit=crop&w=150&q=80" alt="Bubur Ayam Sayuran">
                                                </div>
                                                <div class="flex flex-col">
                                                    <!-- {{ $menu->nama_makanan }} -->
                                                    <span class="text-base font-bold text-slate-800 line-clamp-1">Bubur Ayam Kampung Sayuran</span>
                                                    <!-- {{ $menu->kode_menu ?? '#MN-01' }} -->
                                                    <span class="text-xs font-medium text-slate-500 mt-0.5">ID: #MN-081</span>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            <!-- {{ $menu->kategori }} -->
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700 border border-emerald-200/50">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                MPASI 6-12 Bulan
                                            </span>
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col gap-1.5 text-xs">
                                                <div class="flex items-center text-slate-600 w-32 justify-between">
                                                    <span class="flex items-center gap-1"><i class="fa-solid fa-fire text-orange-500 w-3"></i> Kalori:</span>
                                                    <!-- {{ $menu->kalori }} -->
                                                    <span class="font-bold text-slate-800">180 kcal</span>
                                                </div>
                                                <div class="flex items-center text-slate-600 w-32 justify-between">
                                                    <span class="flex items-center gap-1"><i class="fa-solid fa-dna text-blue-500 w-3"></i> Protein:</span>
                                                    <!-- {{ $menu->protein }} -->
                                                    <span class="font-bold text-slate-800">12 g</span>
                                                </div>
                                                <div class="flex items-center text-slate-600 w-32 justify-between">
                                                    <span class="flex items-center gap-1"><i class="fa-solid fa-droplet text-red-500 w-3"></i> Zat Besi:</span>
                                                    <!-- {{ $menu->zat_besi }} -->
                                                    <span class="font-bold text-slate-800">3.5 mg</span>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col">
                                                <!-- Rp {{ number_format($menu->estimasi_biaya, 0, ',', '.') }} -->
                                                <span class="text-[15px] font-bold text-slate-800">Rp 12.000</span>
                                                <span class="text-[11px] text-slate-500">/ porsi standar</span>
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <!-- Action Buttons: Edit -->
                                                <!-- href="{{ route('menus.edit', $menu->id) }}" -->
                                                <a href="#" class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600 transition-colors hover:bg-blue-600 hover:text-white" title="Edit Data">
                                                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                                                </a>
                                                <!-- Action Buttons: Delete -->
                                                <!-- action="{{ route('menus.destroy', $menu->id) }}" -->
                                                <form action="#" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="inline-block">
                                                    <!-- @csrf @method('DELETE') -->
                                                    <button type="submit" class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-50 text-rose-600 transition-colors hover:bg-rose-600 hover:text-white" title="Hapus Data">
                                                        <i class="fa-solid fa-trash-can text-sm"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Data Dummy 2 -->
                                    <tr class="group transition-colors hover:bg-slate-50/70">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <div class="relative h-14 w-14 flex-shrink-0 overflow-hidden rounded-xl border border-slate-200 shadow-sm">
                                                    <img class="h-full w-full object-cover transition-transform group-hover:scale-105" src="https://images.unsplash.com/photo-1548128156-cedebfb4a946?ixlib=rb-1.2.1&auto=format&fit=crop&w=150&q=80" alt="Sup Ikan Tuna">
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="text-base font-bold text-slate-800 line-clamp-1">Sup Bening Kacang Merah & Ikan Teri</span>
                                                    <span class="text-xs font-medium text-slate-500 mt-0.5">ID: #MN-082</span>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-orange-100 px-2.5 py-1 text-xs font-semibold text-orange-700 border border-orange-200/50">
                                                <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                                Balita > 1 Tahun
                                            </span>
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col gap-1.5 text-xs">
                                                <div class="flex items-center text-slate-600 w-32 justify-between">
                                                    <span class="flex items-center gap-1"><i class="fa-solid fa-fire text-orange-500 w-3"></i> Kalori:</span>
                                                    <span class="font-bold text-slate-800">220 kcal</span>
                                                </div>
                                                <div class="flex items-center text-slate-600 w-32 justify-between">
                                                    <span class="flex items-center gap-1"><i class="fa-solid fa-dna text-blue-500 w-3"></i> Protein:</span>
                                                    <span class="font-bold text-slate-800">18 g</span>
                                                </div>
                                                <div class="flex items-center text-slate-600 w-32 justify-between">
                                                    <span class="flex items-center gap-1"><i class="fa-solid fa-droplet text-red-500 w-3"></i> Zat Besi:</span>
                                                    <span class="font-bold text-slate-800">5.2 mg</span>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col">
                                                <span class="text-[15px] font-bold text-slate-800">Rp 15.000</span>
                                                <span class="text-[11px] text-slate-500">/ porsi standar</span>
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="#" class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600 transition-colors hover:bg-blue-600 hover:text-white" title="Edit Data">
                                                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                                                </a>
                                                <button type="submit" class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-50 text-rose-600 transition-colors hover:bg-rose-600 hover:text-white" title="Hapus Data">
                                                    <i class="fa-solid fa-trash-can text-sm"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- @empty -->
                                    <!-- Opsional: Handling jika data kosong di Blade -->
                                    <!-- 
                                    <tr>
                                        <td colspan="5" class="py-12 px-6 text-center text-slate-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="bg-slate-100 h-16 w-16 rounded-full flex items-center justify-center mb-3">
                                                    <i class="fa-solid fa-utensils text-2xl text-slate-400"></i>
                                                </div>
                                                <p class="font-semibold text-slate-700 mb-1">Belum ada data menu makanan</p>
                                                <p class="text-sm">Silakan tambahkan menu makanan bergizi baru.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    -->
                                    <!-- @endforelse -->
                                    
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="flex flex-col sm:flex-row items-center justify-between border-t border-slate-200 bg-slate-50 px-6 py-4">
                            <span class="text-sm text-slate-500 mb-4 sm:mb-0">
                                Menampilkan <span class="font-semibold text-slate-700">1</span> sampai <span class="font-semibold text-slate-700">10</span> dari <span class="font-semibold text-slate-700">32</span> data
                            </span>
                            
                            <!-- Dummy Pagination UI, Replace with {{ $menus->links() }} -->
                            <div class="flex items-center gap-1">
                                <button class="flex h-8 items-center justify-center rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-500 hover:bg-slate-50 disabled:opacity-50" disabled>
                                    Terbaru
                                </button>
                                <button class="flex h-8 w-8 items-center justify-center rounded-lg border border-emerald-500 bg-emerald-600 text-sm font-semibold text-white">
                                    1
                                </button>
                                <button class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-300 bg-white text-sm text-slate-600 hover:bg-slate-50 hover:text-emerald-600 hover:border-emerald-500 transition-colors">
                                    2
                                </button>
                                <button class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-300 bg-white text-sm text-slate-600 hover:bg-slate-50 hover:text-emerald-600 hover:border-emerald-500 transition-colors">
                                    3
                                </button>
                                <span class="px-1 text-slate-400">...</span>
                                <button class="flex h-8 items-center justify-center rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-600 hover:bg-slate-50 hover:text-emerald-600 hover:border-emerald-500 transition-colors">
                                    Selanjutnya
                                </button>
                            </div>
                        </div>
                    </div><!-- End of Table Section -->

                    <!-- Footer (Opsional) -->
                    <footer class="mt-8 text-center text-sm text-slate-500 pb-8">
                        &copy; {{ date('Y') }} Prediksi Stunting App. Dirancang dengan <i class="fa-solid fa-heart text-rose-500 mx-1"></i> untuk masa depan generasi.
                    </footer>

                </div>
            </main>
        </div>
    </div>
</body>
</html>