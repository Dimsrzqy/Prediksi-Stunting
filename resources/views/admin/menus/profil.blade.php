@extends('layouts.admin')

@section('title', 'Profil Saya - Prediksi Stunting')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 dark:bg-slate-950/50 p-4 md:p-8 transition-colors duration-300">
    
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-800 dark:text-slate-100 tracking-tight">Profil Saya</h1>
        <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm font-medium">Kelola informasi pribadi dan kredensial akun Anda.</p>
    </div>

    <!-- Main Content Container -->
    <div class="max-w-4xl bg-white/80 dark:bg-slate-900/80 backdrop-blur-2xl rounded-[32px] shadow-[0_12px_40px_-10px_rgba(0,0,0,0.08)] ring-1 ring-slate-200/60 dark:ring-slate-800/60 overflow-hidden transition-all">
        
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
                        <div class="w-32 h-32 rounded-[1.5rem] p-1.5 bg-white dark:bg-slate-800 shadow-xl rotate-3 group-hover:rotate-0 transition-all duration-300 overflow-hidden">
                            @php
                                $avatarUrl = auth()->user()->avatar 
                                    ? asset('storage/' . auth()->user()->avatar) 
                                    : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=3b82f6&color=fff&bold=true&size=128';
                            @endphp
                            <img id="profileImage" src="{{ $avatarUrl }}" alt="Profile Avatar" class="w-full h-full rounded-2xl object-cover transition-transform duration-500 group-hover:scale-110">
                            
                            <!-- Loading Overlay -->
                            <div id="uploadLoader" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
                                <i class="fa-solid fa-circle-notch fa-spin text-white text-2xl"></i>
                            </div>
                        </div>
                        
                        <!-- Hidden File Input -->
                        <input type="file" id="avatarInput" class="hidden" accept="image/*">
                        
                        <button type="button" onclick="document.getElementById('avatarInput').click()" class="absolute bottom-2 right-2 w-10 h-10 bg-white dark:bg-slate-700 text-slate-600 dark:text-slate-200 rounded-full shadow-lg border border-slate-100 dark:border-slate-600 flex items-center justify-center hover:text-blue-600 dark:hover:text-blue-400 hover:scale-110 active:scale-95 transition-all z-10">
                            <i class="fa-solid fa-camera"></i>
                        </button>
                    </div>
                    
                    <div class="mb-2">
                        <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">{{ auth()->user()->name }}</h2>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 mt-1.5 rounded-lg bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-xs font-bold uppercase tracking-wider">
                            <i class="fa-solid fa-user-shield"></i> {{ ucfirst(auth()->user()->role) }}
                        </span>
                    </div>
                </div>
            </div>

            <hr class="border-slate-100 dark:border-slate-800 mb-8">

            <!-- Form -->
            <form id="profileForm" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Lengkap -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 dark:text-slate-500">
                                <i class="fa-regular fa-id-card"></i>
                            </div>
                            <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" required class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/50 dark:text-slate-200 focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-sm font-medium outline-none">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 dark:text-slate-500">
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                            <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/50 dark:text-slate-200 focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-sm font-medium outline-none">
                        </div>
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="space-y-2">
                        <label for="no_hp" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Nomor Telepon</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 dark:text-slate-500">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <input type="text" id="no_hp" name="no_hp" value="{{ auth()->user()->no_hp }}" class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/50 dark:text-slate-200 focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-sm font-medium outline-none">
                        </div>
                    </div>

                    <!-- Jabatan / Peran -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Jabatan / Peran</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 dark:text-slate-500">
                                <i class="fa-solid fa-briefcase"></i>
                            </div>
                            <input type="text" value="{{ ucfirst(auth()->user()->role) }}" disabled class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-100 dark:bg-slate-900 text-slate-500 dark:text-slate-600 transition-all text-sm font-medium cursor-not-allowed">
                        </div>
                    </div>
                </div>

                <div class="pt-6 mt-6 border-t border-slate-100 dark:border-slate-800 flex justify-end gap-3">
                    <button type="button" onclick="window.location.reload()" class="px-6 py-3 rounded-xl text-sm font-bold text-slate-600 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 active:scale-95 transition-all">
                        Reset
                    </button>
                    <button type="submit" id="btnSave" class="px-6 py-3 rounded-xl text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-500/30 active:scale-95 transition-all flex items-center gap-2">
                        <i class="fa-solid fa-check"></i> <span id="btnText">Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
// Handle Avatar Upload
document.getElementById('avatarInput').addEventListener('change', async function(e) {
    if (!this.files || !this.files[0]) return;
    
    const loader = document.getElementById('uploadLoader');
    const profileImage = document.getElementById('profileImage');
    const formData = new FormData();
    formData.append('avatar', this.files[0]);
    formData.append('_token', '{{ csrf_token() }}');

    loader.classList.add('opacity-100');
    
    try {
        const response = await fetch('{{ route("profil.avatar") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const data = await response.json();

        if (response.ok) {
            profileImage.src = data.url;
            alert(data.message || 'Foto profil berhasil diperbarui!');
        } else {
            alert('Gagal: ' + (data.message || 'Terjadi kesalahan.'));
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan koneksi saat mengunggah foto.');
    } finally {
        loader.classList.remove('opacity-100');
    }
});

// Handle Profile Form
document.getElementById('profileForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const btn = document.getElementById('btnSave');
    const btnText = document.getElementById('btnText');
    const originalText = btnText.innerText;
    
    btn.disabled = true;
    btnText.innerText = 'Menyimpan...';
    
    const formData = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        no_hp: document.getElementById('no_hp').value,
        _token: '{{ csrf_token() }}'
    };

    try {
        const response = await fetch('{{ route("profil.update") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(formData)
        });

        const data = await response.json();

        if (response.ok) {
            alert(data.message || 'Profil berhasil diperbarui!');
            window.location.reload();
        } else {
            alert('Gagal: ' + (data.message || 'Terjadi kesalahan.'));
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan koneksi.');
    } finally {
        btn.disabled = false;
        btnText.innerText = originalText;
    }
});
</script>
@endsection
