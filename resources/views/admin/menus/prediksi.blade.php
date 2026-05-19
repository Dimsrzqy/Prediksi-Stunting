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

<<<<<<< Updated upstream
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
=======
                    <div class="p-6">
                        <form id="prediksiFormAdmin" class="space-y-5">
                            @csrf
                            
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">{{ __('Jenis Kelamin') }} <span class="text-rose-500">*</span></label>
                                <select name="jenis_kelamin" required class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all appearance-none">
                                    <option value="" disabled selected>{{ __('Pilih Jenis Kelamin...') }}</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
>>>>>>> Stashed changes
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-2">{{ __('Umur') }} <span class="text-slate-400 font-normal">(Bulan)</span> <span class="text-rose-500">*</span></label>
                                <div class="relative">
<<<<<<< Updated upstream
                                    <input type="number" step="1" name="umur_bulan" value="{{ old('umur_bulan', $input['umur_bulan'] ?? '') }}" required class="block w-full rounded-2xl border-0 bg-slate-50 dark:bg-slate-800 dark:text-slate-100 shadow-inner ring-1 ring-inset ring-slate-200/50 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm px-5 py-4 transition-all" placeholder="Misal: 24">
                                    <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none text-slate-400 text-sm font-medium">Bln</div>
=======
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fa-regular fa-calendar text-slate-400"></i>
                                    </div>
                                    <input type="number" step="1" name="umur_bulan" required class="block w-full pl-11 rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all" placeholder="Contoh: 24">
>>>>>>> Stashed changes
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-2">{{ __('Tinggi Badan') }} <span class="text-slate-400 font-normal">(cm)</span> <span class="text-rose-500">*</span></label>
                                <div class="relative">
<<<<<<< Updated upstream
                                    <input type="number" step="0.1" name="tinggi_badan" value="{{ old('tinggi_badan', $input['tinggi_badan_cm'] ?? '') }}" required class="block w-full rounded-2xl border-0 bg-slate-50 dark:bg-slate-800 dark:text-slate-100 shadow-inner ring-1 ring-inset ring-slate-200/50 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm px-5 py-4 transition-all" placeholder="Misal: 85.5">
                                    <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none text-slate-400 text-sm font-medium">cm</div>
                                </div>
                            </div>

                            <div class="pt-6">
                                <button type="submit" class="w-full inline-flex justify-center items-center gap-2 rounded-2xl bg-indigo-600 px-8 py-4 text-base font-bold text-white shadow-lg shadow-indigo-600/30 hover:bg-indigo-700 hover:shadow-indigo-600/40 transition-all active:scale-[0.98]">
                                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                                    {{ __('Mulai Analisis AI') }}
=======
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fa-solid fa-ruler-vertical text-slate-400"></i>
                                    </div>
                                    <input type="number" step="0.1" name="tinggi_badan" required class="block w-full pl-11 rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all" placeholder="Contoh: 85.5">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">{{ __('Berat Badan (kg)') }} <span class="text-rose-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fa-solid fa-weight-scale text-slate-400"></i>
                                    </div>
                                    <input type="number" step="0.1" name="berat_badan" required class="block w-full pl-11 rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all" placeholder="Contoh: 12.5">
                                </div>
                            </div>

                            <div class="pt-4">
                                <button type="submit" id="btnSubmitAdmin" class="w-full inline-flex justify-center items-center gap-2 rounded-2xl bg-indigo-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-500/25 hover:bg-indigo-700 transition-all active:scale-95">
                                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                                    <span>{{ __('Analisis Kila AI') }}</span>
>>>>>>> Stashed changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

<<<<<<< Updated upstream
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
=======
            <!-- HASIL PREDIKSI (DYNAMIC) -->
            <div class="lg:col-span-7">
                <div id="resultBox" class="hidden bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-sm overflow-hidden animate-fade-in flex flex-col h-full">
                    <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-900/50">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shadow-sm">
                                <i class="fa-solid fa-microchip"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 tracking-tight">{{ __('Hasil Analisis AI') }}</h3>
                        </div>
                    </div>
                    
                    <div class="p-8 flex flex-col items-center justify-center flex-1 text-center">
                        <div id="statusIconBg" class="inline-flex items-center justify-center w-24 h-24 rounded-[2rem] mb-6 shadow-sm border-2">
                            <i id="statusIcon" class="fa-solid text-5xl"></i>
                        </div>
                        
                        <h4 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-2">Status Gizi (H/A)</h4>
                        <div id="hasilPrediksiText" class="text-3xl font-black text-slate-800 dark:text-slate-100 tracking-tight mb-4">
                            -
                        </div>
                        
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 mb-8">
                            <i class="fa-solid fa-tag text-slate-400 text-xs"></i>
                            <span id="labelSistemText" class="text-xs font-bold text-slate-600 dark:text-slate-300">Label AI: -</span>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 w-full mt-auto">
                            <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                                <div class="text-xs text-slate-500 mb-1 font-semibold">Gender</div>
                                <div id="inputGender" class="font-bold text-slate-800 dark:text-slate-200">-</div>
                            </div>
                            <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                                <div class="text-xs text-slate-500 mb-1 font-semibold">Umur</div>
                                <div id="inputUmur" class="font-bold text-slate-800 dark:text-slate-200">-</div>
                            </div>
                            <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                                <div class="text-xs text-slate-500 mb-1 font-semibold">Tinggi</div>
                                <div id="inputTinggi" class="font-bold text-slate-800 dark:text-slate-200">-</div>
                            </div>
                            <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                                <div class="text-xs text-slate-500 mb-1 font-semibold">Berat</div>
                                <div id="inputBerat" class="font-bold text-slate-800 dark:text-slate-200">-</div>
>>>>>>> Stashed changes
                            </div>
                        </div>

                    </div>
                </div>

<<<<<<< Updated upstream
                @else

                <div class="bg-white/50 dark:bg-slate-900/50 border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-[2rem] h-full flex flex-col items-center justify-center p-12 text-center min-h-[500px]">
                    <div class="w-24 h-24 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-6 text-slate-300 dark:text-slate-600">
                        <i class="fa-solid fa-chart-pie text-5xl"></i>
=======
                <div id="placeholderBox" class="bg-transparent border border-dashed border-slate-300 dark:border-slate-700 rounded-3xl h-full flex flex-col items-center justify-center p-12 text-center min-h-[400px]">
                    <div class="w-20 h-20 rounded-[2rem] bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-6 text-slate-400 dark:text-slate-500">
                        <i class="fa-solid fa-robot text-4xl"></i>
>>>>>>> Stashed changes
                    </div>
                    <h3 class="text-2xl font-bold text-slate-700 dark:text-slate-300 mb-3 tracking-tight">Kalkulator Siap Digunakan</h3>
                    <p class="text-slate-500 max-w-md font-medium">Silakan lengkapi data balita di sebelah kiri dan tekan tombol <strong class="text-indigo-600 dark:text-indigo-400">Mulai Analisis AI</strong> untuk melihat status gizi anak secara detail.</p>
                </div>
<<<<<<< Updated upstream

                @endif
=======
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
@endsection
=======

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('prediksiFormAdmin');
        const btn = document.getElementById('btnSubmitAdmin');
        const placeholderBox = document.getElementById('placeholderBox');
        const resultBox = document.getElementById('resultBox');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            btn.disabled = true;
            const originalHtml = btn.innerHTML;
            btn.innerHTML = '<div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div> <span class="ml-2">Memproses...</span>';

            const formData = new FormData(form);
            try {
                const response = await fetch('{{ route("admin.prediksi.submit") }}', {
                    method: 'POST',
                    body: formData,
                    headers: { 
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', 
                        'Accept': 'application/json' 
                    }
                });
                const result = await response.json();
                if (result.success) {
                    const data = result.data;
                    const hasil = data.hasil_prediksi;
                    const labelAsli = data.label_asli;
                    
                    placeholderBox.classList.add('hidden');
                    resultBox.classList.remove('hidden');

                    document.getElementById('hasilPrediksiText').innerText = hasil;
                    document.getElementById('labelSistemText').innerText = 'Label AI: ' + labelAsli;
                    document.getElementById('inputGender').innerText = data.input.jenis_kelamin;
                    document.getElementById('inputUmur').innerText = data.input.umur_bulan + ' Bln';
                    document.getElementById('inputTinggi').innerText = data.input.tinggi_badan_cm + ' cm';
                    document.getElementById('inputBerat').innerText = data.input.berat_badan_kg + ' kg';

                    let statusClass = 'bg-slate-100 text-slate-800 border-slate-200';
                    let icon = 'fa-circle-question';
                    const lowerHasil = hasil.toLowerCase();

                    if (lowerHasil.includes('normal')) {
                        statusClass = 'bg-emerald-100 text-emerald-800 border-emerald-200 dark:bg-emerald-950/20 dark:text-emerald-400 dark:border-emerald-900/30';
                        icon = 'fa-check-circle';
                    } else if (lowerHasil.includes('sangat pendek') || lowerHasil.includes('severely stunted')) {
                        statusClass = 'bg-red-100 text-red-800 border-red-200 dark:bg-rose-950/20 dark:text-rose-400 dark:border-rose-900/30';
                        icon = 'fa-triangle-exclamation';
                    } else if (lowerHasil.includes('pendek') || lowerHasil.includes('stunted')) {
                        statusClass = 'bg-orange-100 text-orange-800 border-orange-200 dark:bg-amber-950/20 dark:text-amber-400 dark:border-amber-900/30';
                        icon = 'fa-circle-exclamation';
                    } else if (lowerHasil.includes('tinggi')) {
                        statusClass = 'bg-blue-100 text-blue-800 border-blue-200 dark:bg-blue-950/20 dark:text-blue-400 dark:border-blue-900/30';
                        icon = 'fa-arrow-up-right-dots';
                    }

                    const statusIconBg = document.getElementById('statusIconBg');
                    statusIconBg.className = 'inline-flex items-center justify-center w-24 h-24 rounded-[2rem] mb-6 shadow-sm border-2 ' + statusClass;
                    
                    const statusIcon = document.getElementById('statusIcon');
                    statusIcon.className = 'fa-solid text-5xl ' + icon;

                    Swal.fire({ icon: 'success', title: 'Analisis Berhasil', text: 'Hasil dari Model AI telah diperbarui secara real-time.', timer: 2000, showConfirmButton: false });
                } else {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: result.pesan });
                }
            } catch (err) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menghubungi server AI.' });
            } finally {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
            }
        });
    });
</script>
@endsection
>>>>>>> Stashed changes
