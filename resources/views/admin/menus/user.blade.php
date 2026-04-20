@extends('layouts.admin')

@section('title', 'Manajemen User - Prediksi Stunting')

@section('content')
<main class="flex-1 bg-slate-50/50 p-6 md:p-8 overflow-y-auto overflow-x-hidden">
    <div class="mx-auto max-w-7xl">
        
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Manajemen Pengguna</h1>
                <p class="mt-1 text-sm text-slate-500">Pusat kendali hak akses untuk menambah, melihat, atau mencabut akses akun sistem.</p>
            </div>
            <button onclick="openModal()" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition-all hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:scale-95">
                <i class="fa-solid fa-plus"></i> Tambah Pengguna
            </button>
        </div>

        <!-- Tabel User -->
        <div class="flex flex-col bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="flex items-center justify-between p-5 border-b border-slate-200 bg-slate-50/50">
                <h2 class="text-lg font-bold text-slate-800">Daftar Akun Server</h2>
                <button onclick="fetchUsers()" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-600 shadow-sm transition-colors hover:bg-slate-50">
                    <i class="fa-solid fa-rotate-right text-slate-400"></i> Refresh
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">#</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Email (Login)</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Nomor HP</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Peran (Role)</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody" class="divide-y divide-slate-200 bg-white">
                        <!-- Render JS -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

<!-- Modal Tambah User -->
<div id="userModal" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" id="modalBackdrop"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full flex-col justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all w-full max-w-lg mb-8 sm:mb-auto sm:mt-8">
                
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                    <h3 class="text-lg font-bold text-slate-800">Form Pembuatan Akun Baru</h3>
                    <button type="button" onclick="closeModal()" class="text-slate-400 hover:text-slate-500">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>

                <div class="p-6">
                    <div class="mb-4 p-3 bg-blue-50 border border-blue-100 rounded-lg text-sm text-blue-700 flex gap-3 items-start">
                        <i class="fa-solid fa-circle-info mt-0.5"></i>
                        <p>Password akan otomatis di-generate menjadi <strong>Bunda123</strong> untuk mempercepat antrean kerja Anda. Mereka dapat merubahnya di Aplikasi.</p>
                    </div>

                    <form id="userForm">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap <span class="text-rose-500">*</span></label>
                                <input type="text" id="name" required class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border" placeholder="John Doe">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Email <span class="text-rose-500">*</span></label>
                                <input type="email" id="email" required class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border" placeholder="anda@email.com">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Nomor Telepon / WhatsApp</label>
                                <input type="text" id="telepon" class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border" placeholder="0821xxxxxxx">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Posisi Jabatan (Role) <span class="text-rose-500">*</span></label>
                                <select id="role" required class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border bg-white">
                                    <option value="user" selected>User / Ibu Pasien</option>
                                    <option value="admin">Administrator Sistem</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end gap-3 pt-5 border-t border-slate-100">
                            <button type="button" onclick="closeModal()" class="rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 border border-slate-300 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Batal</button>
                            <button type="submit" id="btnSave" class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Simpan Akun</button>
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
            tbody.innerHTML = '<tr><td colspan="6" class="px-6 py-8 text-center text-sm text-slate-500">Tidak ada pengguna yang terdaftar selain Anda.</td></tr>';
            return;
        }

        users.forEach((user, index) => {
            const roleBadge = user.role === 'admin' 
                ? '<span class="inline-flex items-center rounded-md bg-rose-50 px-2 py-1 text-xs font-medium text-rose-700 ring-1 ring-inset ring-rose-600/20">Admin Pusat</span>'
                : '<span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">User / Ibu</span>';

            const row = `
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">${index + 1}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 font-semibold">${user.name}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">${user.email}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">${user.telepon || '-'}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${roleBadge}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm whitespace-nowrap">
                        <button onclick="deleteUser('${user._id || user.id}')" class="text-rose-600 hover:text-rose-900 bg-rose-50 hover:bg-rose-100 p-2 rounded-lg transition-colors" title="Hapus Permanen">
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
        btnSave.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Menyimpan...';
        btnSave.disabled = true;

        const payload = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            telepon: document.getElementById('telepon').value,
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
        if (!confirm('Anda yakin ingin menghapus akun ini secara permanen? Seluruh aksesnya akan dicabut seketika!')) return;
        
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
                alert('Gagal menghapus user!');
            }
        } catch (error) {
            console.error("Gagal delete user", error);
        }
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
