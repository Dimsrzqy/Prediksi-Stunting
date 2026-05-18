@extends('layouts.admin')

@section('title', __('Prediksi AI Cepat') . ' - StuntCheck')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50/50 dark:bg-slate-950/50 p-6 md:p-8 transition-colors duration-300">
    <div class="mx-auto max-w-5xl">

        <!-- HEADER HALAMAN -->
        <div class="mb-8 flex flex-col gap-6 sm:flex-row sm:items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">{{ __('Prediksi AI Cepat') }}</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400 font-medium">{{ __('Gunakan kalkulator pintar Kila AI untuk memprediksi stunting secara instan tanpa menyimpan data ke riwayat.') }}</p>
            </div>
        </div>

        @if(session('error'))
        <div class="mb-6 rounded-2xl bg-rose-50 dark:bg-rose-900/20 p-4 border border-rose-100 dark:border-rose-900/30 transition-all animate-fade-in">
            <div class="flex items-start">
                <div class="flex-shrink-0 mt-0.5">
                    <i class="fa-solid fa-circle-exclamation text-rose-500"></i>
                </div>
                <div class="ml-3 flex-1">
                    <h3 class="text-sm font-bold text-rose-800 dark:text-rose-400">Gagal Memproses Prediksi</h3>
                    <p class="mt-1 text-sm text-rose-700 dark:text-rose-300">{{ session('error') }}</p>
                </div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- FORM INPUT -->
            <div class="lg:col-span-5">
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-sm overflow-hidden animate-fade-in">
                    <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center gap-3 bg-slate-50/50 dark:bg-slate-900/50">
                        <div class="w-10 h-10 rounded-2xl bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center shadow-sm">
                            <i class="fa-solid fa-calculator"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 tracking-tight">{{ __('Input Data Balita') }}</h3>
                    </div>

                    <div class="p-6">
                        <form action="{{ url('admin-prediksi') }}" method="POST" class="space-y-5">
                            @csrf
                            
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">{{ __('Jenis Kelamin') }} <span class="text-rose-500">*</span></label>
                                <select name="jenis_kelamin" required class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all appearance-none">
                                    <option value="" disabled {{ old('jenis_kelamin', $input['jenis_kelamin'] ?? '') == '' ? 'selected' : '' }}>{{ __('Pilih Jenis Kelamin...') }}</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $input['jenis_kelamin'] ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $input['jenis_kelamin'] ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">{{ __('Umur (Bulan)') }} <span class="text-rose-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fa-regular fa-calendar text-slate-400"></i>
                                    </div>
                                    <input type="number" step="1" name="umur_bulan" value="{{ old('umur_bulan', $input['umur_bulan'] ?? '') }}" required class="block w-full pl-11 rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all" placeholder="Contoh: 24">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">{{ __('Tinggi Badan (cm)') }} <span class="text-rose-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fa-solid fa-ruler-vertical text-slate-400"></i>
                                    </div>
                                    <input type="number" step="0.1" name="tinggi_badan" value="{{ old('tinggi_badan', $input['tinggi_badan_cm'] ?? '') }}" required class="block w-full pl-11 rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all" placeholder="Contoh: 85.5">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">{{ __('Berat Badan (kg)') }} <span class="text-rose-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fa-solid fa-weight-scale text-slate-400"></i>
                                    </div>
                                    <input type="number" step="0.1" name="berat_badan" value="{{ old('berat_badan', $input['berat_badan_kg'] ?? '') }}" required class="block w-full pl-11 rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all" placeholder="Contoh: 12.5">
                                </div>
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="w-full inline-flex justify-center items-center gap-2 rounded-2xl bg-indigo-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-500/25 hover:bg-indigo-700 transition-all active:scale-95">
                                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                                    {{ __('Analisis Kila AI') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- HASIL PREDIKSI -->
            <div class="lg:col-span-7">
                @if(isset($result) && $result)
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-sm overflow-hidden animate-fade-in flex flex-col h-full">
                    <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-900/50">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shadow-sm">
                                <i class="fa-solid fa-microchip"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 tracking-tight">{{ __('Hasil Analisis AI') }}</h3>
                        </div>
                    </div>
                    
                    <div class="p-8 flex flex-col items-center justify-center flex-1 text-center">
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-[2rem] {{ $status_class }} mb-6 shadow-sm border-2">
                            <i class="fa-solid {{ $icon }} text-5xl"></i>
                        </div>
                        
                        <h4 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-2">Status Gizi (H/A)</h4>
                        <div class="text-3xl font-black text-slate-800 dark:text-slate-100 tracking-tight mb-4">
                            {{ $hasil_prediksi }}
                        </div>
                        
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 mb-8">
                            <i class="fa-solid fa-tag text-slate-400 text-xs"></i>
                            <span class="text-xs font-bold text-slate-600 dark:text-slate-300">Label AI: {{ $label_sistem }}</span>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 w-full mt-auto">
                            <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                                <div class="text-xs text-slate-500 mb-1 font-semibold">Gender</div>
                                <div class="font-bold text-slate-800 dark:text-slate-200">{{ $input['jenis_kelamin'] }}</div>
                            </div>
                            <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                                <div class="text-xs text-slate-500 mb-1 font-semibold">Umur</div>
                                <div class="font-bold text-slate-800 dark:text-slate-200">{{ $input['umur_bulan'] }} Bln</div>
                            </div>
                            <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                                <div class="text-xs text-slate-500 mb-1 font-semibold">Tinggi</div>
                                <div class="font-bold text-slate-800 dark:text-slate-200">{{ $input['tinggi_badan_cm'] }} cm</div>
                            </div>
                            <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                                <div class="text-xs text-slate-500 mb-1 font-semibold">Berat</div>
                                <div class="font-bold text-slate-800 dark:text-slate-200">{{ $input['berat_badan_kg'] }} kg</div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="bg-transparent border border-dashed border-slate-300 dark:border-slate-700 rounded-3xl h-full flex flex-col items-center justify-center p-12 text-center min-h-[400px]">
                    <div class="w-20 h-20 rounded-[2rem] bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-6 text-slate-400 dark:text-slate-500">
                        <i class="fa-solid fa-robot text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-700 dark:text-slate-300 mb-2 tracking-tight">Belum Ada Analisis</h3>
                    <p class="text-slate-500 max-w-sm">Masukkan data balita pada formulir di samping, lalu klik tombol Analisis Kila AI untuk melihat hasil prediksi secara real-time.</p>
                </div>
                @endif
            </div>

        </div>

    </div>
</main>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.5s ease-out forwards;
    }
</style>
@endsection
