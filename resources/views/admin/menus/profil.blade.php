@extends('layouts.admin')

@section('title', 'Profil Saya - Prediksi Stunting')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-4 md:p-8">
    
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Profil Saya</h1>
        <p class="text-slate-500 mt-2 text-sm font-medium">Kelola informasi pribadi dan kredensial akun Anda.</p>
    </div>

    <!-- Main Content Container -->
    <div class="max-w-4xl bg-white/80 backdrop-blur-2xl rounded-[32px] shadow-[0_12px_40px_-10px_rgba(0,0,0,0.08)] ring-1 ring-slate-200/60 overflow-hidden">
        
        <!-- Header Image / Banner -->
        <div class="h-32 bg-gradient-to-r from-blue-500 to-indigo-600 relative">
            <!-- Decorative Elements -->
            <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] mix-blend-overlay"></div>
        </div>

        <div class="px-8 pb-8">
            <!-- Avatar & Quick Info -->
            <div class="relative flex justify-between items-end -mt-16 mb-8">
                <div class="flex items-end gap-6">
                    <div class="relative group">
                        <div class="w-32 h-32 rounded-[1.5rem] p-1.5 bg-white shadow-xl rotate-3 group-hover:rotate-0 transition-transform duration-300">
                            <img src="https://ui-avatars.com/api/?name=Admin+Puskesmas&background=3b82f6&color=fff&bold=true&size=128" alt="Admin Profile" class="w-full h-full rounded-2xl object-cover">
                        </div>
                        <button class="absolute bottom-2 right-2 w-10 h-10 bg-white text-slate-600 rounded-full shadow-lg border border-slate-100 flex items-center justify-center hover:text-blue-600 hover:scale-110 active:scale-95 transition-all">
                            <i class="fa-solid fa-camera"></i>
                        </button>
                    </div>
                    
                    <div class="mb-2">
                        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Admin Puskesmas</h2>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 mt-1.5 rounded-lg bg-blue-50 text-blue-600 text-xs font-bold uppercase tracking-wider">
                            <i class="fa-solid fa-user-shield"></i> Ahli Gizi
                        </span>
                    </div>
                </div>
            </div>

            <hr class="border-slate-100 mb-8">

            <!-- Form Form -->
            <form action="#" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Lengkap -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-semibold text-slate-700">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                                <i class="fa-regular fa-id-card"></i>
                            </div>
                            <input type="text" id="name" name="name" value="Admin Puskesmas" class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-sm font-medium text-slate-700 outline-none">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-semibold text-slate-700">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                            <input type="email" id="email" name="email" value="admin@puskesmas.id" class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-sm font-medium text-slate-700 outline-none">
                        </div>
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="space-y-2">
                        <label for="phone" class="block text-sm font-semibold text-slate-700">Nomor Telepon</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <input type="text" id="phone" name="phone" value="081234567890" class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-sm font-medium text-slate-700 outline-none">
                        </div>
                    </div>

                    <!-- Jabatan / Peran -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">Jabatan / Peran</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-briefcase"></i>
                            </div>
                            <input type="text" value="Ahli Gizi" disabled class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-100 text-slate-500 transition-all text-sm font-medium cursor-not-allowed">
                        </div>
                    </div>
                </div>

                <div class="pt-6 mt-6 border-t border-slate-100 flex justify-end gap-3">
                    <button type="button" class="px-6 py-3 rounded-xl text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 active:scale-95 transition-all">
                        Batal
                    </button>
                    <button type="button" onclick="alert('Pembaruan profil berhasil disimpan!')" class="px-6 py-3 rounded-xl text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-500/30 active:scale-95 transition-all flex items-center gap-2">
                        <i class="fa-solid fa-check"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
