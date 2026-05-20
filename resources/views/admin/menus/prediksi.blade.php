@extends('layouts.admin')

@section('title', __('Prediksi AI Cepat') . ' - StuntCheck')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50/50 dark:bg-slate-950/50 p-6 lg:p-10 transition-colors duration-300">
    <div class="w-full max-w-7xl mx-auto">

        <div class="mb-10 flex flex-col gap-2">
            <h1 class="text-3xl font-black text-slate-800 dark:text-slate-100 tracking-tight">{{ __('Prediksi Cepat AI') }}</h1>
            <p class="text-base text-slate-500 dark:text-slate-400 font-medium max-w-2xl">{{ __('Cek status gizi anak secara instan dengan teknologi Kila AI. Data ini tidak akan disimpan ke dalam riwayat Anda.') }}</p>
        </div>

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

                        <form id="prediksiFormAdmin" class="space-y-5">
                            @csrf
                            
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">{{ __('Jenis Kelamin') }} <span class="text-rose-500">*</span></label>
                                <select name="jenis_kelamin" required class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all appearance-none cursor-pointer">
                                    <option value="" disabled selected>{{ __('Pilih Jenis Kelamin...') }}</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">{{ __('Umur') }} <span class="text-slate-400 font-normal">(Bulan)</span> <span class="text-rose-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fa-regular fa-calendar text-slate-400"></i>
                                    </div>
                                    <input type="number" step="1" name="umur_bulan" required class="block w-full pl-11 rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all" placeholder="Contoh: 24">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">{{ __('Tinggi Badan') }} <span class="text-slate-400 font-normal">(cm)</span> <span class="text-rose-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fa-solid fa-ruler-vertical text-slate-400"></i>
                                    </div>
                                    <input type="number" step="0.1" name="tinggi_badan" required class="block w-full pl-11 rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all" placeholder="Contoh: 85.5">
                                </div>
                            </div>

                            <div class="pt-4">
                                <button type="submit" id="btnSubmitAdmin" class="w-full inline-flex justify-center items-center gap-2 rounded-2xl bg-indigo-600 px-6 py-4 text-base font-bold text-white shadow-lg shadow-indigo-600/30 hover:bg-indigo-700 hover:shadow-indigo-600/40 transition-all active:scale-[0.98]">
                                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                                    <span>{{ __('Mulai Analisis AI') }}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- HASIL PREDIKSI (DYNAMIC) -->
            <div class="lg:col-span-8 xl:col-span-8">
                <div id="resultBox" class="hidden bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-[2rem] shadow-sm overflow-hidden animate-fade-in flex-col h-full relative">
                    
                    <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-indigo-50 dark:bg-indigo-900/10 blur-3xl pointer-events-none"></div>

                    <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-900/50 relative z-10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center shadow-sm">
                                <i class="fa-solid fa-microchip"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 tracking-tight">{{ __('Hasil Analisis AI') }}</h3>
                        </div>
                    </div>
                    
                    <div class="p-8 md:p-12 flex flex-col items-center justify-center flex-1 text-center relative z-10">
                        <h4 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-6">Status Gizi (H/A)</h4>
                        
                        <div id="statusIconBg" class="inline-flex items-center justify-center w-32 h-32 rounded-full mb-8 shadow-xl border-4">
                            <i id="statusIcon" class="fa-solid text-6xl drop-shadow-sm"></i>
                        </div>
                        
                        <div id="hasilPrediksiText" class="text-5xl md:text-6xl font-black text-slate-800 dark:text-slate-100 tracking-tight mb-6">
                            -
                        </div>
                        
                        <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 mb-12">
                            <i class="fa-solid fa-robot text-slate-400 text-sm"></i>
                            <span id="labelSistemText" class="text-sm font-bold text-slate-600 dark:text-slate-300">Label AI: -</span>
                        </div>

                        <div class="w-full max-w-2xl bg-slate-50/80 dark:bg-slate-800/50 rounded-3xl p-6 md:p-8 border border-slate-100 dark:border-slate-700/50">
                            <h5 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6 text-left">{{ __('Berdasarkan Data') }}</h5>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                                <div>
                                    <div class="text-sm text-slate-500 mb-1 font-medium">Gender</div>
                                    <div id="inputGender" class="font-black text-slate-800 dark:text-slate-200 text-lg">-</div>
                                </div>
                                <div>
                                    <div class="text-sm text-slate-500 mb-1 font-medium">Umur</div>
                                    <div class="font-black text-slate-800 dark:text-slate-200 text-lg"><span id="inputUmur">-</span> <span class="text-sm font-bold text-slate-400">Bln</span></div>
                                </div>
                                <div>
                                    <div class="text-sm text-slate-500 mb-1 font-medium">Tinggi</div>
                                    <div class="font-black text-slate-800 dark:text-slate-200 text-lg"><span id="inputTinggi">-</span> <span class="text-sm font-bold text-slate-400">cm</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="placeholderBox" class="bg-white/50 dark:bg-slate-900/50 border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-[2rem] h-full flex flex-col items-center justify-center p-12 text-center min-h-[500px]">
                    <div class="w-24 h-24 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-6 text-slate-300 dark:text-slate-600">
                        <i class="fa-solid fa-chart-pie text-5xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-700 dark:text-slate-300 mb-3 tracking-tight">Kalkulator Siap Digunakan</h3>
                    <p class="text-slate-500 max-w-md font-medium">Silakan lengkapi data balita di sebelah kiri dan tekan tombol <strong class="text-indigo-600 dark:text-indigo-400">Mulai Analisis AI</strong> untuk melihat status gizi anak secara detail.</p>
                </div>
            </div>

        </div>
    </div>
</main>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(-15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>

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
                // Determine API route (Make sure to use correct route for prediction)
                const url = '{{ route("admin.prediksi.submit") ?? url("admin-prediksi") }}';
                const response = await fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: { 
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', 
                        'Accept': 'application/json' 
                    }
                });
                const result = await response.json();
                
                // Usually admin-prediksi returns HTML if not AJAX, so we should expect JSON if the controller was updated. 
                // Wait, if it doesn't return JSON, this will fail. Let's make sure it returns JSON.
                if (result.success || result.status === 'success' || result.data) {
                    const data = result.data || result;
                    const hasil = data.hasil_prediksi || data.status_stunting || '';
                    const labelAsli = data.label_asli || data.keterangan || hasil;
                    
                    placeholderBox.classList.add('hidden');
                    resultBox.classList.remove('hidden');
                    resultBox.classList.add('flex');

                    document.getElementById('hasilPrediksiText').innerText = hasil;
                    document.getElementById('labelSistemText').innerText = 'Label AI: ' + labelAsli;
                    document.getElementById('inputGender').innerText = data.input?.jenis_kelamin || formData.get('jenis_kelamin');
                    document.getElementById('inputUmur').innerText = data.input?.umur_bulan || formData.get('umur_bulan');
                    document.getElementById('inputTinggi').innerText = data.input?.tinggi_badan_cm || data.input?.tinggi_badan || formData.get('tinggi_badan');

                    let statusClass = 'bg-slate-100 text-slate-800 border-slate-200 dark:bg-slate-800 dark:text-slate-200 dark:border-slate-700';
                    let icon = 'fa-circle-question';
                    const lowerHasil = hasil.toLowerCase();

                    if (lowerHasil.includes('normal')) {
                        statusClass = 'bg-emerald-100 text-emerald-800 border-emerald-200 border-white dark:border-slate-800 dark:bg-emerald-950/20 dark:text-emerald-400';
                        icon = 'fa-check-circle text-emerald-600 dark:text-emerald-400';
                    } else if (lowerHasil.includes('sangat stunting') || lowerHasil.includes('sangat pendek') || lowerHasil.includes('severely')) {
                        statusClass = 'bg-red-100 text-red-800 border-red-200 border-white dark:border-slate-800 dark:bg-rose-950/20 dark:text-rose-400';
                        icon = 'fa-triangle-exclamation text-red-600 dark:text-rose-400';
                    } else if (lowerHasil.includes('stunting') || lowerHasil.includes('pendek') || lowerHasil.includes('berisiko')) {
                        statusClass = 'bg-orange-100 text-orange-800 border-orange-200 border-white dark:border-slate-800 dark:bg-amber-950/20 dark:text-amber-400';
                        icon = 'fa-circle-exclamation text-orange-600 dark:text-amber-400';
                    } else if (lowerHasil.includes('tinggi')) {
                        statusClass = 'bg-blue-100 text-blue-800 border-blue-200 border-white dark:border-slate-800 dark:bg-blue-950/20 dark:text-blue-400';
                        icon = 'fa-arrow-up-right-dots text-blue-600 dark:text-blue-400';
                    }

                    const statusIconBg = document.getElementById('statusIconBg');
                    statusIconBg.className = 'inline-flex items-center justify-center w-32 h-32 rounded-full mb-8 shadow-xl border-4 ' + statusClass;
                    
                    const statusIcon = document.getElementById('statusIcon');
                    statusIcon.className = 'fa-solid text-6xl drop-shadow-sm ' + icon;

                    Swal.fire({ icon: 'success', title: 'Analisis Berhasil', text: 'Hasil dari Model AI telah diperbarui secara real-time.', timer: 2000, showConfirmButton: false });
                } else {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: result.pesan || result.message || 'Terjadi kesalahan.' });
                }
            } catch (err) {
                console.error(err);
                
                // Fallback to traditional form submission if API doesn't return JSON or fails
                form.action = '{{ url("admin-prediksi") }}';
                form.method = 'POST';
                form.submit();
                
            } finally {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
            }
        });
    });
</script>
@endsection
