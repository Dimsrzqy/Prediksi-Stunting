@extends('layouts.admin')

@section('title', __('Pengaturan') . ' - StuntCheck')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50/50 dark:bg-slate-950/50 p-6 md:p-10 transition-all duration-500">
    
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-12 animate-fade-in">
            <h1 class="text-3xl font-extrabold text-slate-800 dark:text-slate-100 tracking-tight">{{ __('Pengaturan') }}</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">{{ __('Kelola preferensi akun, privasi, dan personalisasi dashboard StuntCheck.') }}</p>
        </div>

        <!-- Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            
            <!-- Menu 1: Keamanan Akun -->
            <div onclick="openSettingsModal('keamanan')" class="setting-card group animate-slide-up" style="animation-delay: 0.1s">
                <div class="card-inner">
                    <div class="icon-wrapper bg-gradient-to-br from-blue-500/10 to-indigo-500/10 text-blue-600 dark:text-blue-400">
                        <i class="fa-solid fa-shield-halved text-2xl"></i>
                    </div>
                    <div class="mt-6">
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ __('Keamanan Akun') }}</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-500 mt-2 leading-relaxed">Kelola kata sandi, autentikasi dua langkah, dan proteksi akun Anda.</p>
                    </div>
                    <div class="mt-6 flex items-center text-xs font-bold text-blue-600 dark:text-blue-400 opacity-0 group-hover:opacity-100 transition-all translate-x-[-10px] group-hover:translate-x-0">
                        <span>{{ app()->getLocale() == 'id' ? 'Kelola Sekarang' : 'Manage Now' }}</span>
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </div>
                </div>
            </div>

            <!-- Menu 2: Notifikasi -->
            <div onclick="openSettingsModal('notifikasi')" class="setting-card group animate-slide-up" style="animation-delay: 0.2s">
                <div class="card-inner">
                    <div class="icon-wrapper bg-gradient-to-br from-rose-500/10 to-pink-500/10 text-rose-600 dark:text-rose-400">
                        <i class="fa-solid fa-bell text-2xl"></i>
                    </div>
                    <div class="mt-6">
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 group-hover:text-rose-600 dark:group-hover:text-rose-400 transition-colors">{{ __('Notifikasi') }}</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-500 mt-2 leading-relaxed">Atur pemberitahuan email dan push notification untuk setiap aktivitas sistem.</p>
                    </div>
                    <div class="mt-6 flex items-center text-xs font-bold text-rose-600 dark:text-rose-400 opacity-0 group-hover:opacity-100 transition-all translate-x-[-10px] group-hover:translate-x-0">
                        <span>{{ app()->getLocale() == 'id' ? 'Atur Notifikasi' : 'Set Notifications' }}</span>
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </div>
                </div>
            </div>

            <!-- Menu 3: Tampilan -->
            <div onclick="openSettingsModal('tampilan')" class="setting-card group animate-slide-up" style="animation-delay: 0.3s">
                <div class="card-inner">
                    <div class="icon-wrapper bg-gradient-to-br from-indigo-500/10 to-purple-500/10 text-indigo-600 dark:text-indigo-400">
                        <i class="fa-solid fa-palette text-2xl"></i>
                    </div>
                    <div class="mt-6">
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ __('Tampilan') }}</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-500 mt-2 leading-relaxed">Kustomisasi tema Dark Mode, Light Mode, dan aksen warna dashboard Anda.</p>
                    </div>
                    <div class="mt-6 flex items-center text-xs font-bold text-indigo-600 dark:text-indigo-400 opacity-0 group-hover:opacity-100 transition-all translate-x-[-10px] group-hover:translate-x-0">
                        <span>{{ app()->getLocale() == 'id' ? 'Pilih Tema' : 'Choose Theme' }}</span>
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </div>
                </div>
            </div>

            <!-- Menu 4: Bahasa -->
            <div onclick="openSettingsModal('bahasa')" class="setting-card group animate-slide-up" style="animation-delay: 0.4s">
                <div class="card-inner">
                    <div class="icon-wrapper bg-gradient-to-br from-emerald-500/10 to-teal-500/10 text-emerald-600 dark:text-emerald-400">
                        <i class="fa-solid fa-language text-2xl"></i>
                    </div>
                    <div class="mt-6">
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">{{ __('Bahasa') }}</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-500 mt-2 leading-relaxed">Pilih bahasa pengantar aplikasi untuk kenyamanan penggunaan data.</p>
                    </div>
                    <div class="mt-6 flex items-center text-xs font-bold text-emerald-600 dark:text-emerald-400 opacity-0 group-hover:opacity-100 transition-all translate-x-[-10px] group-hover:translate-x-0">
                        <span>{{ app()->getLocale() == 'id' ? 'Ubah Bahasa' : 'Change Language' }}</span>
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </div>
                </div>
            </div>

            <!-- Menu 5: Sistem -->
            <div onclick="openSettingsModal('sistem')" class="setting-card group animate-slide-up" style="animation-delay: 0.5s">
                <div class="card-inner">
                    <div class="icon-wrapper bg-gradient-to-br from-amber-500/10 to-orange-500/10 text-amber-600 dark:text-amber-400">
                        <i class="fa-solid fa-server text-2xl"></i>
                    </div>
                    <div class="mt-6">
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">{{ __('Sistem') }}</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-500 mt-2 leading-relaxed">Informasi versi aplikasi, pemeliharaan data, dan pengaturan server.</p>
                    </div>
                    <div class="mt-6 flex items-center text-xs font-bold text-amber-600 dark:text-amber-400 opacity-0 group-hover:opacity-100 transition-all translate-x-[-10px] group-hover:translate-x-0">
                        <span>{{ app()->getLocale() == 'id' ? 'Detail Sistem' : 'System Detail' }}</span>
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </div>
                </div>
            </div>

            <!-- Menu 6: Data & Backup -->
            <div onclick="openSettingsModal('backup')" class="setting-card group animate-slide-up" style="animation-delay: 0.6s">
                <div class="card-inner">
                    <div class="icon-wrapper bg-gradient-to-br from-cyan-500/10 to-blue-500/10 text-cyan-600 dark:text-cyan-400">
                        <i class="fa-solid fa-database text-2xl"></i>
                    </div>
                    <div class="mt-6">
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors">{{ __('Data & Backup') }}</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-500 mt-2 leading-relaxed">Ekspor data histori prediksi dan buat cadangan basis data rutin.</p>
                    </div>
                    <div class="mt-6 flex items-center text-xs font-bold text-cyan-600 dark:text-cyan-400 opacity-0 group-hover:opacity-100 transition-all translate-x-[-10px] group-hover:translate-x-0">
                        <span>{{ app()->getLocale() == 'id' ? 'Ekspor Data' : 'Export Data' }}</span>
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<!-- Modal Overlay -->
<div id="settingsModal" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/60 dark:bg-slate-950/80 backdrop-blur-md transition-opacity duration-500" onclick="closeSettingsModal()"></div>
    
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div id="modalContent" class="relative transform overflow-hidden rounded-[40px] bg-white dark:bg-slate-900 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-white dark:border-slate-800 scale-95 opacity-0 duration-300">
            
            <!-- Modal Header -->
            <div class="px-8 py-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div id="modalIcon" class="w-12 h-12 rounded-2xl flex items-center justify-center text-xl shadow-inner"></div>
                    <h3 id="modalTitle" class="text-xl font-bold text-slate-800 dark:text-slate-100 tracking-tight"></h3>
                </div>
                <button onclick="closeSettingsModal()" class="w-10 h-10 rounded-full flex items-center justify-center text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="px-8 py-8" id="modalBody">
                <!-- Content injected by JS -->
            </div>

            <!-- Modal Footer -->
            <div id="modalFooter" class="px-8 py-6 bg-slate-50/50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row-reverse gap-3">
                <button id="modalSubmit" class="inline-flex w-full justify-center rounded-2xl px-6 py-3 text-sm font-bold text-white shadow-lg transition-all active:scale-95 sm:w-auto">Simpan Perubahan</button>
                <button onclick="closeSettingsModal()" class="inline-flex w-full justify-center rounded-2xl bg-white dark:bg-slate-800 px-6 py-3 text-sm font-bold text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 sm:w-auto transition-all active:scale-95">Tutup</button>
            </div>
        </div>
    </div>
</div>

<style>
    .setting-card { @apply cursor-pointer transition-all duration-300 active:scale-[0.97]; }
    .card-inner { @apply bg-white dark:bg-slate-900 p-8 md:p-10 rounded-[32px] border border-white dark:border-slate-800 shadow-[0_8px_30px_rgba(0,0,0,0.04)] dark:shadow-none transition-all duration-300; }
    .setting-card:hover .card-inner { @apply shadow-[0_20px_50px_rgba(0,0,0,0.08)] dark:bg-slate-800/80 -translate-y-1.5; }
    .icon-wrapper { @apply w-16 h-16 rounded-3xl flex items-center justify-center transition-all duration-300; }
    .setting-card:hover .icon-wrapper { @apply scale-110 shadow-lg shadow-current/5 bg-white dark:bg-slate-700; }

    /* Forms */
    .pill-input {
        @apply w-full px-5 py-4 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/50 text-slate-700 dark:text-slate-200 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-sm font-bold outline-none shadow-inner;
    }
    
    /* iOS Switch */
    .ios-switch { @apply relative inline-block w-12 h-7 flex-shrink-0; }
    .ios-switch input { @apply opacity-0 w-0 h-0; }
    .ios-slider { @apply absolute cursor-pointer inset-0 bg-slate-200 dark:bg-slate-700 transition-all rounded-full; }
    .ios-slider:before { @apply absolute content-[''] h-5.5 w-5.5 left-[3px] bottom-[3px] bg-white transition-all rounded-full shadow-sm; }
    input:checked + .ios-slider { @apply bg-emerald-500; }
    input:checked + .ios-slider:before { transform: translateX(20px); }

    /* Theme Option */
    .theme-opt { @apply p-4 rounded-3xl border-2 transition-all flex flex-col items-center gap-3; }
    .theme-opt.active { @apply border-blue-500 bg-blue-50/50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400; }
    .theme-opt:not(.active) { @apply border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 text-slate-500; }

    /* Lang Option */
    .lang-opt { @apply w-full flex items-center justify-between p-5 rounded-[24px] border transition-all duration-300; }
    .lang-opt.active { @apply border-emerald-500/30 bg-emerald-50/50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 shadow-[0_10px_25px_-10px_rgba(16,185,129,0.2)]; }
    .lang-opt:not(.active) { @apply border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-800/50 text-slate-700 dark:text-slate-300; }
    .lang-opt:hover:not(.active) { @apply bg-emerald-50 dark:bg-emerald-900/10 border-emerald-200 dark:border-emerald-800 text-emerald-600 dark:text-emerald-400 translate-x-2; }

    @keyframes slide-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-slide-up { animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    .animate-fade-in { animation: fade-in 0.8s ease-out forwards; }
</style>

<script>
    const modal = document.getElementById('settingsModal');
    const modalContent = document.getElementById('modalContent');
    const modalTitle = document.getElementById('modalTitle');
    const modalIcon = document.getElementById('modalIcon');
    const modalBody = document.getElementById('modalBody');
    const modalSubmit = document.getElementById('modalSubmit');

    function openSettingsModal(type) {
        modal.classList.remove('hidden');
        modalSubmit.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);

        const currentLocale = '{{ app()->getLocale() }}';

        switch(type) {
            case 'keamanan':
                modalTitle.innerText = '{{ __("Keamanan Akun") }}';
                modalIcon.className = 'w-12 h-12 rounded-2xl flex items-center justify-center text-xl shadow-inner bg-blue-50 text-blue-600';
                modalIcon.innerHTML = '<i class="fa-solid fa-shield-halved"></i>';
                modalSubmit.className = 'inline-flex w-full justify-center rounded-2xl px-6 py-3 text-sm font-bold text-white shadow-lg transition-all active:scale-95 sm:w-auto bg-blue-600 hover:bg-blue-700';
                modalBody.innerHTML = `
                    <div class="space-y-5">
                        <div class="group">
                            <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-4">Kata Sandi Lama</label>
                            <input type="password" class="pill-input" placeholder="••••••••">
                        </div>
                        <div class="group">
                            <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-4">Kata Sandi Baru</label>
                            <input type="password" class="pill-input" placeholder="••••••••">
                        </div>
                        <div class="flex items-center justify-between p-5 rounded-[28px] bg-blue-50/50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800">
                            <div>
                                <p class="text-[14px] font-black text-blue-800 dark:text-blue-400">Autentikasi 2 Langkah</p>
                                <p class="text-[11px] font-bold text-blue-600 dark:text-blue-500">Gunakan kode OTP untuk proteksi ekstra.</p>
                            </div>
                            <label class="ios-switch">
                                <input type="checkbox" checked>
                                <span class="ios-slider"></span>
                            </label>
                        </div>
                    </div>
                `;
                break;
            
            case 'notifikasi':
                modalTitle.innerText = '{{ __("Notifikasi") }}';
                modalIcon.className = 'w-12 h-12 rounded-2xl flex items-center justify-center text-xl shadow-inner bg-rose-50 text-rose-600';
                modalIcon.innerHTML = '<i class="fa-solid fa-bell"></i>';
                modalSubmit.className = 'inline-flex w-full justify-center rounded-2xl px-6 py-3 text-sm font-bold text-white shadow-lg transition-all active:scale-95 sm:w-auto bg-rose-600 hover:bg-rose-700';
                modalBody.innerHTML = `
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-6 rounded-[28px] bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                            <div>
                                <p class="text-[14px] font-black text-slate-800 dark:text-slate-200">Email Prediksi</p>
                                <p class="text-[11px] font-bold text-slate-500">Rekapitulasi mingguan via email.</p>
                            </div>
                            <label class="ios-switch">
                                <input type="checkbox" checked>
                                <span class="ios-slider"></span>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-6 rounded-[28px] bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                            <div>
                                <p class="text-[14px] font-black text-slate-800 dark:text-slate-200">Push Notification</p>
                                <p class="text-[11px] font-bold text-slate-500">Pemberitahuan instan di dashboard.</p>
                            </div>
                            <label class="ios-switch">
                                <input type="checkbox">
                                <span class="ios-slider"></span>
                            </label>
                        </div>
                    </div>
                `;
                break;

            case 'tampilan':
                modalTitle.innerText = '{{ __("Tampilan") }}';
                modalIcon.className = 'w-12 h-12 rounded-2xl flex items-center justify-center text-xl shadow-inner bg-indigo-50 text-indigo-600';
                modalIcon.innerHTML = '<i class="fa-solid fa-palette"></i>';
                modalSubmit.className = 'inline-flex w-full justify-center rounded-2xl px-6 py-3 text-sm font-bold text-white shadow-lg transition-all active:scale-95 sm:w-auto bg-indigo-600 hover:bg-indigo-700';
                const isDark = document.documentElement.classList.contains('dark');
                modalBody.innerHTML = `
                    <div class="grid grid-cols-2 gap-5">
                        <button onclick="setGlobalTheme('light')" class="theme-opt ${!isDark ? 'active' : ''}">
                            <div class="w-full h-20 bg-slate-100 rounded-2xl flex items-center justify-center border border-slate-200">
                                <i class="fa-solid fa-sun text-2xl text-amber-500"></i>
                            </div>
                            <span class="text-xs font-black uppercase tracking-widest">Light Mode</span>
                        </button>
                        <button onclick="setGlobalTheme('dark')" class="theme-opt ${isDark ? 'active' : ''}">
                            <div class="w-full h-20 bg-slate-800 rounded-2xl flex items-center justify-center border border-slate-700">
                                <i class="fa-solid fa-moon text-2xl text-blue-400"></i>
                            </div>
                            <span class="text-xs font-black uppercase tracking-widest">Dark Mode</span>
                        </button>
                    </div>
                `;
                break;

            case 'bahasa':
                modalTitle.innerText = '{{ __("Bahasa") }}';
                modalIcon.className = 'w-12 h-12 rounded-2xl flex items-center justify-center text-xl shadow-inner bg-emerald-50 text-emerald-600';
                modalIcon.innerHTML = '<i class="fa-solid fa-language"></i>';
                modalSubmit.classList.add('hidden');
                modalBody.innerHTML = `
                    <div class="space-y-4">
                        <a href="{{ route('set-language', 'id') }}" class="lang-opt ${currentLocale === 'id' ? 'active' : ''}">
                            <div class="flex items-center gap-4">
                                <span class="text-2xl">🇮🇩</span>
                                <span class="text-[15px] font-black transition-colors">Bahasa Indonesia</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-[10px] font-bold opacity-40 uppercase tracking-widest">ID</span>
                                ${currentLocale === 'id' ? '<i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>' : '<div class="w-5 h-5 rounded-full border-2 border-slate-200"></div>'}
                            </div>
                        </a>
                        <a href="{{ route('set-language', 'en') }}" class="lang-opt ${currentLocale === 'en' ? 'active' : ''}">
                            <div class="flex items-center gap-4">
                                <span class="text-2xl">🇺🇸</span>
                                <span class="text-[15px] font-black transition-colors">English (US)</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-[10px] font-bold opacity-40 uppercase tracking-widest">US</span>
                                ${currentLocale === 'en' ? '<i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>' : '<div class="w-5 h-5 rounded-full border-2 border-slate-200"></div>'}
                            </div>
                        </a>
                    </div>
                `;
                break;

            case 'sistem':
                modalTitle.innerText = '{{ __("Sistem") }}';
                modalIcon.className = 'w-12 h-12 rounded-2xl flex items-center justify-center text-xl shadow-inner bg-amber-50 text-amber-600';
                modalIcon.innerHTML = '<i class="fa-solid fa-server"></i>';
                modalSubmit.classList.add('hidden');
                modalBody.innerHTML = `
                    <div class="bg-slate-50 dark:bg-slate-800/50 rounded-[28px] p-6 space-y-4 border border-slate-100 dark:border-slate-800">
                        <div class="flex justify-between border-b border-slate-200 dark:border-slate-700 pb-3">
                            <span class="text-xs font-bold text-slate-500">Versi Aplikasi</span>
                            <span class="text-xs font-black text-slate-800 dark:text-slate-200">v2.4.0-stable</span>
                        </div>
                        <div class="flex justify-between border-b border-slate-200 dark:border-slate-700 pb-3">
                            <span class="text-xs font-bold text-slate-500">Status Server</span>
                            <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Online
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-xs font-bold text-slate-500">Environment</span>
                            <span class="text-xs font-black text-slate-800 dark:text-slate-200">Production</span>
                        </div>
                    </div>
                `;
                break;

            case 'backup':
                modalTitle.innerText = '{{ __("Data & Backup") }}';
                modalIcon.className = 'w-12 h-12 rounded-2xl flex items-center justify-center text-xl shadow-inner bg-cyan-50 text-cyan-600';
                modalIcon.innerHTML = '<i class="fa-solid fa-database"></i>';
                modalSubmit.classList.add('hidden');
                modalBody.innerHTML = `
                    <div class="space-y-4">
                        <button class="w-full flex items-center justify-between p-5 rounded-[28px] bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 hover:shadow-lg hover:border-cyan-500/30 transition-all group">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 flex items-center justify-center"><i class="fa-solid fa-file-excel"></i></div>
                                <div class="text-left">
                                    <p class="text-[13px] font-black">Ekspor Laporan Excel</p>
                                    <p class="text-[10px] font-bold text-slate-400">Seluruh data histori prediksi.</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-download text-slate-300 group-hover:text-cyan-500"></i>
                        </button>
                        <button class="w-full flex items-center justify-between p-5 rounded-[28px] bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800 hover:shadow-lg hover:border-cyan-500/30 transition-all group">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/30 text-blue-600 flex items-center justify-center"><i class="fa-solid fa-file-csv"></i></div>
                                <div class="text-left">
                                    <p class="text-[13px] font-black">Ekspor Laporan CSV</p>
                                    <p class="text-[10px] font-bold text-slate-400">Kompatibel dengan sistem lain.</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-download text-slate-300 group-hover:text-cyan-500"></i>
                        </button>
                        <button class="w-full mt-4 py-4 rounded-2xl bg-slate-800 dark:bg-slate-700 text-white font-black text-xs uppercase tracking-widest hover:bg-slate-900 transition-all">
                            Buat Cadangan Database Baru
                        </button>
                    </div>
                `;
                break;
        }
    }

    function closeSettingsModal() {
        modalContent.classList.add('scale-95', 'opacity-0');
        modalContent.classList.remove('scale-100', 'opacity-100');
        setTimeout(() => { modal.classList.add('hidden'); }, 300);
    }

    function setGlobalTheme(mode) {
        if (mode === 'dark') {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }
        closeSettingsModal();
    }

    modalSubmit.onclick = () => {
        alert('Pengaturan berhasil diperbarui!');
        closeSettingsModal();
    }
</script>
@endsection
