@extends('layouts.admin')

@section('title', __('Prediksi AI Cepat') . ' - StuntCheck')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50/50 dark:bg-slate-950/50 p-6 lg:p-10 transition-colors duration-300">
    <div class="w-full max-w-7xl mx-auto">

        <div class="mb-10 flex flex-col gap-2">
            <h1 class="text-3xl font-black text-slate-800 dark:text-slate-100 tracking-tight">{{ __('Prediksi Cepat AI') }}</h1>
            <p class="text-base text-slate-500 dark:text-slate-400 font-medium max-w-2xl">{{ __('Cek status gizi anak secara instan dengan teknologi Kila AI. Data ini tidak akan disimpan ke dalam riwayat Anda.') }}</p>
        </div>

        @if(session('error'))
        <div class="mb-8 rounded-2xl bg-rose-50 dark:bg-rose-900/20 p-5 border border-rose-100 dark:border-rose-900/30 transition-all animate-fade-in flex items-start gap-4 shadow-sm">
            <div class="flex-shrink-0 mt-0.5">
                <i class="fa-solid fa-circle-exclamation text-rose-500 text-xl"></i>
            </div>
            <div class="flex-1">
                <h3 class="text-base font-bold text-rose-800 dark:text-rose-400">Gagal Memproses Prediksi</h3>
                <p class="mt-1 text-sm text-rose-700 dark:text-rose-300">{{ session('error') }}</p>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

            <div class="lg:col-span-4 xl:col-span-4">
                <div class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-sm border border-slate-200/70 dark:border-slate-800 overflow-hidden animate-fade-in">

                    <div class="p-8">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center">
                                <i class="fa-solid fa-clipboard-list text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100">{{ __('Data Balita') }}</h3>
                                <p class="text-xs text-slate-500 font-medium mt-1">Lengkapi form di bawah ini</p>
                            </div>
                        </div>

                        <form action="{{ url('admin-prediksi') }}" method="POST" class="space-y-6">
                            @csrf

                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-2">{{ __('Jenis Kelamin') }} <span class="text-rose-500">*</span></label>
                                <select name="jenis_kelamin" required class="block w-full rounded-2xl border-0 bg-slate-50 dark:bg-slate-800 dark:text-slate-100 shadow-inner ring-1 ring-inset ring-slate-200/50 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm px-5 py-4 transition-all appearance-none cursor-pointer">
                                    <option value="" disabled {{ old('jenis_kelamin', $input['jenis_kelamin'] ?? '') == '' ? 'selected' : '' }}>{{ __('Pilih Jenis Kelamin...') }}</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $input['jenis_kelamin'] ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $input['jenis_kelamin'] ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-2">{{ __('Umur') }} <span class="text-slate-400 font-normal">(Bulan)</span> <span class="text-rose-500">*</span></label>
                                <div class="relative">
                                    <input type="number" step="1" name="umur_bulan" value="{{ old('umur_bulan', $input['umur_bulan'] ?? '') }}" required class="block w-full rounded-2xl border-0 bg-slate-50 dark:bg-slate-800 dark:text-slate-100 shadow-inner ring-1 ring-inset ring-slate-200/50 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm px-5 py-4 transition-all" placeholder="Misal: 24">
                                    <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none text-slate-400 text-sm font-medium">Bln</div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-2">{{ __('Tinggi Badan') }} <span class="text-slate-400 font-normal">(cm)</span> <span class="text-rose-500">*</span></label>
                                <div class="relative">
                                    <input type="number" step="0.1" name="tinggi_badan" value="{{ old('tinggi_badan', $input['tinggi_badan_cm'] ?? '') }}" required class="block w-full rounded-2xl border-0 bg-slate-50 dark:bg-slate-800 dark:text-slate-100 shadow-inner ring-1 ring-inset ring-slate-200/50 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm px-5 py-4 transition-all" placeholder="Misal: 85.5">
                                    <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none text-slate-400 text-sm font-medium">cm</div>
                                </div>
                            </div>

                            <div class="pt-6">
                                <button type="submit" class="w-full inline-flex justify-center items-center gap-2 rounded-2xl bg-indigo-600 px-8 py-4 text-base font-bold text-white shadow-lg shadow-indigo-600/30 hover:bg-indigo-700 hover:shadow-indigo-600/40 transition-all active:scale-[0.98]">
                                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                                    {{ __('Mulai Analisis AI') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 xl:col-span-8">
                @if(isset($result) && $result)
                <div class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-sm border border-slate-200/70 dark:border-slate-800 overflow-hidden animate-fade-in flex flex-col h-full relative">

                    <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-emerald-50 dark:bg-emerald-900/10 blur-3xl pointer-events-none"></div>

                    <div class="p-8 md:p-12 flex flex-col items-center justify-center flex-1 text-center relative z-10">

                        <h4 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-6">{{ __('Hasil Prediksi Kila AI') }}</h4>

                        <div class="inline-flex items-center justify-center w-32 h-32 rounded-full {{ $status_class }} mb-8 shadow-xl shadow-current/10 border-4 border-white dark:border-slate-800">
                            <i class="fa-solid {{ $icon }} text-6xl drop-shadow-sm"></i>
                        </div>

                        <div class="text-5xl md:text-6xl font-black text-slate-800 dark:text-slate-100 tracking-tight mb-6">
                            {{ $hasil_prediksi }}
                        </div>

                        <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 mb-12">
                            <i class="fa-solid fa-robot text-slate-400 text-sm"></i>
                            <span class="text-sm font-bold text-slate-600 dark:text-slate-300">Label AI: {{ $label_sistem }}</span>
                        </div>

                        <div class="w-full max-w-2xl bg-slate-50/80 dark:bg-slate-800/50 rounded-3xl p-6 md:p-8 border border-slate-100 dark:border-slate-700/50">
                            <h5 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6 text-left">{{ __('Berdasarkan Data') }}</h5>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                                <div>
                                    <div class="text-sm text-slate-500 font-medium mb-1">Gender</div>
                                    <div class="font-black text-slate-800 dark:text-slate-200 text-lg">{{ $input['jenis_kelamin'] }}</div>
                                </div>
                                <div>
                                    <div class="text-sm text-slate-500 font-medium mb-1">Umur</div>
                                    <div class="font-black text-slate-800 dark:text-slate-200 text-lg">{{ $input['umur_bulan'] }} <span class="text-sm font-bold text-slate-400">Bln</span></div>
                                </div>
                                <div>
                                    <div class="text-sm text-slate-500 font-medium mb-1">Tinggi</div>
                                    <div class="font-black text-slate-800 dark:text-slate-200 text-lg">{{ $input['tinggi_badan_cm'] }} <span class="text-sm font-bold text-slate-400">cm</span></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                @else

                <div class="bg-white/50 dark:bg-slate-900/50 border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-[2rem] h-full flex flex-col items-center justify-center p-12 text-center min-h-[500px]">
                    <div class="w-24 h-24 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-6 text-slate-300 dark:text-slate-600">
                        <i class="fa-solid fa-chart-pie text-5xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-700 dark:text-slate-300 mb-3 tracking-tight">Kalkulator Siap Digunakan</h3>
                    <p class="text-slate-500 max-w-md font-medium">Silakan lengkapi data balita di sebelah kiri dan tekan tombol <strong class="text-indigo-600 dark:text-indigo-400">Mulai Analisis AI</strong> untuk melihat status gizi anak secara detail.</p>
                </div>

                @endif
            </div>

        </div>

    </div>
</main>

<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(-15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>
@endsection