@extends('layouts.admin')

@section('title', 'Manajemen Menu Makanan - Prediksi Stunting')

@section('content')
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50/50 p-6 md:p-8">
                
                <div class="mx-auto max-w-7xl">
                    <!-- HEADER HALAMAN -->
                    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Manajemen Menu Makanan Gizi Spesifik</h1>
                            <p class="mt-1 text-sm text-slate-500">Kelola daftar rekomendasi menu makanan pendamping untuk pencegahan dan penanganan stunting.</p>
                        </div>
                        <!-- Tombol Tambah Menu -->
                        <a href="#" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition-all hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:scale-95">
                            <i class="fa-solid fa-plus"></i>
                            Tambah Menu Makanan
                        </a>
                    </div>

                    <!-- CARD RINGKASAN STATISTIK -->
                    <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                        
                        <!-- Card 1: Total Menu -->
                        <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md group">
                            <div class="absolute -right-4 -top-4 rounded-full bg-indigo-50 p-8 opacity-50 transition-transform group-hover:scale-110"></div>
                            <div class="relative flex items-center gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                                    <i class="fa-solid fa-utensils text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Total Menu</p>
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
                                <button class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-600 shadow-sm transition-colors hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1">
                                    <i class="fa-solid fa-filter text-slate-400"></i> Kategori
                                </button>
                                <button class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-600 shadow-sm transition-colors hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1">
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
                                    
                                    <!-- Data Dummy 1 -->
                                    <tr class="group transition-colors hover:bg-slate-50/70">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <!-- Gambar Makanan: Menggunakan asset storage jika ada -->
                                                <div class="relative h-14 w-14 flex-shrink-0 overflow-hidden rounded-xl border border-slate-200 shadow-sm">
                                                    <img class="h-full w-full object-cover transition-transform group-hover:scale-105" src="https://images.unsplash.com/photo-1512058564366-18510be2db19?ixlib=rb-1.2.1&auto=format&fit=crop&w=150&q=80" alt="Bubur Ayam Sayuran">
                                                </div>
                                                <div class="flex flex-col">
                                                    <!-- @{{ $menu->nama_makanan }} -->
                                                    <span class="text-base font-bold text-slate-800 line-clamp-1">Bubur Ayam Kampung Sayuran</span>
                                                    <!-- @{{ $menu->kode_menu ?? '#MN-01' }} -->
                                                    <span class="text-xs font-medium text-slate-500 mt-0.5">ID: #MN-081</span>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            <!-- @{{ $menu->kategori }} -->
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-indigo-100 px-2.5 py-1 text-xs font-semibold text-indigo-700 border border-indigo-200/50">
                                                <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                                                MPASI 6-12 Bulan
                                            </span>
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col gap-1.5 text-xs">
                                                <div class="flex items-center text-slate-600 w-32 justify-between">
                                                    <span class="flex items-center gap-1"><i class="fa-solid fa-fire text-orange-500 w-3"></i> Kalori:</span>
                                                    <!-- @{{ $menu->kalori }} -->
                                                    <span class="font-bold text-slate-800">180 kcal</span>
                                                </div>
                                                <div class="flex items-center text-slate-600 w-32 justify-between">
                                                    <span class="flex items-center gap-1"><i class="fa-solid fa-dna text-blue-500 w-3"></i> Protein:</span>
                                                    <!-- @{{ $menu->protein }} -->
                                                    <span class="font-bold text-slate-800">12 g</span>
                                                </div>
                                                <div class="flex items-center text-slate-600 w-32 justify-between">
                                                    <span class="flex items-center gap-1"><i class="fa-solid fa-droplet text-red-500 w-3"></i> Zat Besi:</span>
                                                    <!-- @{{ $menu->zat_besi }} -->
                                                    <span class="font-bold text-slate-800">3.5 mg</span>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col">
                                                <!-- Rp @{{ number_format($menu->estimasi_biaya, 0, ',', '.') }} -->
                                                <span class="text-[15px] font-bold text-slate-800">Rp 12.000</span>
                                                <span class="text-[11px] text-slate-500">/ porsi standar</span>
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <!-- Action Buttons: Edit -->
                                                <!-- href="@{{ route('menus.edit', $menu->id) }}" -->
                                                <a href="#" class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600 transition-colors hover:bg-blue-600 hover:text-white" title="Edit Data">
                                                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                                                </a>
                                                <!-- Action Buttons: Delete -->
                                                <!-- action="@{{ route('menus.destroy', $menu->id) }}" -->
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
                                    
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="flex flex-col sm:flex-row items-center justify-between border-t border-slate-200 bg-slate-50 px-6 py-4">
                            <span class="text-sm text-slate-500 mb-4 sm:mb-0">
                                Menampilkan <span class="font-semibold text-slate-700">1</span> sampai <span class="font-semibold text-slate-700">10</span> dari <span class="font-semibold text-slate-700">32</span> data
                            </span>
                            
                            <!-- Dummy Pagination UI, Replace with @{{ $menus->links() }} -->
                            <div class="flex items-center gap-1">
                                <button class="flex h-8 items-center justify-center rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-500 hover:bg-slate-50 disabled:opacity-50" disabled>
                                    Terbaru
                                </button>
                                <button class="flex h-8 w-8 items-center justify-center rounded-lg border border-indigo-500 bg-indigo-600 text-sm font-semibold text-white">
                                    1
                                </button>
                                <button class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-300 bg-white text-sm text-slate-600 hover:bg-slate-50 hover:text-indigo-600 hover:border-indigo-500 transition-colors">
                                    2
                                </button>
                                <button class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-300 bg-white text-sm text-slate-600 hover:bg-slate-50 hover:text-indigo-600 hover:border-indigo-500 transition-colors">
                                    3
                                </button>
                                <span class="px-1 text-slate-400">...</span>
                                <button class="flex h-8 items-center justify-center rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-600 hover:bg-slate-50 hover:text-indigo-600 hover:border-indigo-500 transition-colors">
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

@endsection