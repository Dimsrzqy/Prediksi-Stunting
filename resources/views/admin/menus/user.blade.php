@extends('layouts.admin')

@section('title', __('Manajemen User') . ' - Prediksi Stunting')

@section('content')
<main class="flex-1 bg-slate-50/50 dark:bg-slate-950/50 p-6 md:p-8 overflow-y-auto overflow-x-hidden transition-colors duration-300">
    <div class="mx-auto max-w-7xl">
        
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">{{ __('Manajemen User') }}</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Pusat kendali hak akses untuk menambah, melihat, atau mencabut akses akun sistem.') }}</p>
            </div>
            <button onclick="openModal()" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition-all hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:scale-95">
                <i class="fa-solid fa-plus"></i> Tambah User
            </button>
        </div>

        <!-- Tabel User -->
        <div class="flex flex-col bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden transition-colors">
            <div class="flex items-center justify-between p-5 border-b border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
                <h2 class="text-lg font-bold text-slate-800 dark:text-slate-200">{{ __('Daftar Akun Server') }}</h2>
                <button onclick="fetchUsers()" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 px-3 py-1.5 text-sm font-medium text-slate-600 dark:text-slate-400 shadow-sm transition-colors hover:bg-slate-50 dark:hover:bg-slate-700">
                    <i class="fa-solid fa-rotate-right text-slate-400 dark:text-slate-500"></i> {{ __('Refresh') }}
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-800">
                    <thead class="bg-slate-50 dark:bg-slate-900/80">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 dark:text-slate-500 uppercase tracking-wider">#</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 dark:text-slate-500 uppercase tracking-wider">{{ __('Nama') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 dark:text-slate-500 uppercase tracking-wider">{{ __('Email (Login)') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 dark:text-slate-500 uppercase tracking-wider">{{ __('Nomor HP') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 dark:text-slate-500 uppercase tracking-wider">{{ __('Peran (Role)') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 dark:text-slate-500 uppercase tracking-wider text-right">{{ __('Aksi') }}</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody" class="divide-y divide-slate-200 dark:divide-slate-800 bg-white dark:bg-slate-900">
                        <!-- Render JS -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

<!-- Modal Tambah User -->
<div id="userModal" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" id="modalBackdrop"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full flex-col justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-3xl bg-white dark:bg-slate-900 text-left shadow-2xl transition-all w-full max-w-lg mb-8 sm:mb-auto sm:mt-8 border border-slate-200 dark:border-slate-800">
                
                <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-900/50">
                    <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100">{{ __('Buat Akun Baru') }}</h3>
                    <button type="button" onclick="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-full text-slate-400 dark:text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="p-6">
                    <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-900/30 rounded-2xl text-sm text-blue-700 dark:text-blue-400 flex gap-3 items-start">
                        <i class="fa-solid fa-circle-info mt-0.5 text-blue-500"></i>
                        <p>Password otomatis disetel ke <strong>Bunda123</strong>. Pengguna dapat mengubahnya nanti di profil mereka.</p>
                    </div>

                    <form id="userForm">
                        <div class="space-y-5">
                            <div>
                                 <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 ml-1">{{ __('Nama Lengkap') }} <span class="text-rose-500">*</span></label>
                                <input type="text" id="name" required class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all" placeholder="John Doe">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 ml-1">{{ __('Email') }} <span class="text-rose-500">*</span></label>
                                <input type="email" id="email" required class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all" placeholder="anda@email.com">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 ml-1">{{ __('Nomor Telepon / WhatsApp') }}</label>
                                <input type="text" id="no_hp" class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all" placeholder="0821xxxxxxx">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 ml-1">{{ __('Posisi Jabatan (Role)') }} <span class="text-rose-500">*</span></label>
                                <select id="role" required class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all appearance-none">
                                    <option value="user" selected>{{ __('User / Ibu Pasien') }}</option>
                                    <option value="admin">{{ __('Administrator Sistem') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end gap-3 pt-6 border-t border-slate-100 dark:border-slate-800">
                            <button type="button" onclick="closeModal()" class="rounded-xl px-5 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all">{{ __('Batal') }}</button>
                            <button type="submit" id="btnSave" class="rounded-xl bg-indigo-600 px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 active:scale-95 transition-all">{{ __('Simpan Akun') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        fetchUsers();
        
        document.getElementById('userForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            await saveUser();
        });
    });

    async function fetchUsers() {
        try {
            const response = await fetch('/api-users', {
                headers: { 'Accept': 'application/json' }
            });
            const data = await response.json();
            renderTable(data.data || []);
        } catch (error) {
            console.error("Gagal get users", error);
        }
    }

    function renderTable(users) {
        const tbody = document.getElementById('userTableBody');
        tbody.innerHTML = '';
        if (users.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" class="px-6 py-12 text-center text-sm text-slate-500 dark:text-slate-500"><i class="fa-solid fa-user-slash text-3xl mb-3 block opacity-20"></i> {{ __('Tidak ada pengguna lain yang terdaftar.') }}</td></tr>`;
            return;
        }

        users.forEach((user, index) => {
            const roleBadge = user.role === 'admin' 
                ? `<span class="inline-flex items-center rounded-lg bg-rose-50 dark:bg-rose-900/20 px-2.5 py-1 text-xs font-bold text-rose-700 dark:text-rose-400 ring-1 ring-inset ring-rose-600/20">{{ __('Admin Pusat') }}</span>`
                : `<span class="inline-flex items-center rounded-lg bg-blue-50 dark:bg-blue-900/20 px-2.5 py-1 text-xs font-bold text-blue-700 dark:text-blue-400 ring-1 ring-inset ring-blue-700/10">{{ __('User / Ibu') }}</span>`;

            const row = `
                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                    <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-slate-500 dark:text-slate-600">${index + 1}</td>
                    <td class="px-6 py-5 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-9 w-9 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 font-bold text-xs mr-3">
                                ${user.name.charAt(0).toUpperCase()}
                            </div>
                            <div class="text-sm font-bold text-slate-800 dark:text-slate-200">${user.name}</div>
                        </div>
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-600 dark:text-slate-400">${user.email}</td>
                    <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-600 dark:text-slate-400">${user.no_hp || '-'}</td>
                    <td class="px-6 py-5 whitespace-nowrap">${roleBadge}</td>
                    <td class="px-6 py-5 whitespace-nowrap text-sm text-right">
                        <button onclick="deleteUser('${user._id || user.id}')" class="text-rose-500 hover:text-rose-700 bg-rose-50 dark:bg-rose-900/20 hover:bg-rose-100 dark:hover:bg-rose-900/40 w-9 h-9 rounded-xl transition-all" title="Hapus Permanen">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </td>
                </tr>
            `;
            tbody.insertAdjacentHTML('beforeend', row);
        });
    }

    async function saveUser() {
        const btnSave = document.getElementById('btnSave');
        const originalText = btnSave.innerHTML;
        btnSave.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i>';
        btnSave.disabled = true;

        const payload = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            no_hp: document.getElementById('no_hp').value,
            role: document.getElementById('role').value
        };

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch('/api-users', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(payload)
            });

            if (response.ok) {
                closeModal();
                fetchUsers();
                alert('Berhasil membuat akun! Password disetel ke Bunda123');
            } else {
                const data = await response.json();
                alert('Gagal: ' + (data.message || 'Periksa isian Anda (mungkin email sudah dipakai)'));
            }
        } catch (error) {
            console.error("Gagal save user", error);
        } finally {
            btnSave.innerHTML = originalText;
            btnSave.disabled = false;
        }
    }

    async function deleteUser(id) {
        const isDark = document.documentElement.classList.contains('dark');
        
        Swal.fire({
            title: '{{ __('Hapus Data?') }}',
            text: '{{ __('Akun pengguna ini akan dihapus secara permanen.') }}',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: isDark ? '#334155' : '#94a3b8',
            confirmButtonText: '{{ __('Ya, Hapus!') }}',
            cancelButtonText: '{{ __('Batal') }}',
            background: isDark ? '#1e293b' : '#ffffff',
            color: isDark ? '#f1f5f9' : '#1e293b',
            customClass: {
                popup: 'rounded-[32px] border border-slate-200 dark:border-slate-800 shadow-2xl',
                title: 'text-xl font-bold tracking-tight',
                confirmButton: 'rounded-2xl px-6 py-3 font-bold transition-all active:scale-95',
                cancelButton: 'rounded-2xl px-6 py-3 font-bold transition-all active:scale-95'
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                try {
                    const response = await fetch('/api-users/' + id, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });

                    if (response.ok) {
                        fetchUsers();
                    } else {
                        alert('{{ __('Gagal menghapus user!') }}');
                    }
                } catch (error) {
                    console.error("Gagal delete user", error);
                }
            }
        });
    }

    function openModal() {
        document.getElementById('userForm').reset();
        document.getElementById('userModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('userModal').classList.add('hidden');
    }
</script>
@endsection
