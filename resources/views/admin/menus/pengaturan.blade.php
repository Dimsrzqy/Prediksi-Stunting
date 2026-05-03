@extends('layouts.admin')

@section('title', 'Pengaturan - Prediksi Stunting')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-4 md:p-8">
    
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Pengaturan</h1>
        <p class="text-slate-500 mt-2 text-sm font-medium">Sesuaikan preferensi sistem dan tampilan aplikasi.</p>
    </div>

    <div class="max-w-4xl grid grid-cols-1 md:grid-cols-12 gap-8">
        
        <!-- Sidebar Navigation Settings -->
        <div class="md:col-span-4">
            <div class="bg-white rounded-[24px] shadow-sm ring-1 ring-slate-100 p-2 space-y-1">
                <button class="w-full flex items-center gap-3 px-4 py-3 bg-slate-100 text-slate-800 rounded-2xl font-bold text-sm transition-all text-left">
                    <div class="w-8 h-8 rounded-xl bg-blue-500 text-white flex items-center justify-center shadow-sm">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    Keamanan Akun
                </button>
                <button class="w-full flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-slate-50 hover:text-slate-800 rounded-2xl font-semibold text-sm transition-all text-left">
                    <div class="w-8 h-8 rounded-xl bg-slate-100 text-slate-500 flex items-center justify-center">
                        <i class="fa-regular fa-bell"></i>
                    </div>
                    Notifikasi
                </button>
                <button class="w-full flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-slate-50 hover:text-slate-800 rounded-2xl font-semibold text-sm transition-all text-left">
                    <div class="w-8 h-8 rounded-xl bg-slate-100 text-slate-500 flex items-center justify-center">
                        <i class="fa-solid fa-palette"></i>
                    </div>
                    Tampilan
                </button>
            </div>
        </div>

        <!-- Main Settings Content -->
        <div class="md:col-span-8">
            <div class="bg-white rounded-[32px] shadow-sm ring-1 ring-slate-100 overflow-hidden">
                
                <div class="p-6 md:p-8">
                    <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-shield-halved text-blue-500"></i> Keamanan & Privasi
                    </h3>
                    
                    <!-- Ubah Password -->
                    <div class="space-y-4 mb-8">
                        <h4 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Ubah Kata Sandi</h4>
                        <div class="space-y-3">
                            <input type="password" placeholder="Kata Sandi Saat Ini" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-sm font-medium outline-none">
                            <input type="password" placeholder="Kata Sandi Baru" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-sm font-medium outline-none">
                            <input type="password" placeholder="Konfirmasi Kata Sandi Baru" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-sm font-medium outline-none">
                        </div>
                        <button type="button" onclick="alert('Kata sandi berhasil diubah!')" class="mt-4 px-6 py-2.5 rounded-xl text-sm font-bold text-white bg-slate-800 hover:bg-slate-900 active:scale-95 transition-all">
                            Perbarui Kata Sandi
                        </button>
                    </div>

                    <hr class="border-slate-100 my-8">

                    <!-- Preferensi -->
                    <div class="space-y-6">
                        <h4 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Preferensi Keamanan</h4>
                        
                        <!-- Toggle 1 -->
                        <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <div>
                                <h5 class="text-sm font-bold text-slate-800">Autentikasi Dua Langkah (2FA)</h5>
                                <p class="text-[12px] text-slate-500 mt-1 leading-snug">Tambahkan lapisan keamanan ekstra dengan memverifikasi login menggunakan kode OTP.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" value="" class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-500"></div>
                            </label>
                        </div>

                        <!-- Toggle 2 -->
                        <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <div>
                                <h5 class="text-sm font-bold text-slate-800">Sesi Login Terbatas</h5>
                                <p class="text-[12px] text-slate-500 mt-1 leading-snug">Otomatis logout setelah 30 menit tidak ada aktivitas di dashboard.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" value="" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-500"></div>
                            </label>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection
