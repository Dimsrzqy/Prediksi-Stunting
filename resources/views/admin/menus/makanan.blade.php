@extends('layouts.admin')

@section('title', __('Data Gizi & Menu') . ' - StuntCheck')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50/50 dark:bg-slate-950/50 p-6 md:p-8 transition-colors duration-300">
    <div class="mx-auto max-w-7xl">

        <!-- HEADER HALAMAN -->
        <div class="mb-8 flex flex-col gap-6 sm:flex-row sm:items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">{{ __('Manajemen Gizi Spesifik') }}</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400 font-medium">{{ __('Kelola master data Menu Makanan dan Kategori Nutrisi secara terintegrasi.') }}</p>
            </div>
        </div>

        <!-- NOTIFICATION CONTAINER -->
        <div id="notificationWrapper" class="hidden mb-6 rounded-2xl p-4 border transition-all animate-fade-in">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i id="notificationIcon" class="fa-solid fa-check-circle text-emerald-400"></i>
                </div>
                <div class="ml-3">
                    <h3 id="notificationMessage" class="text-sm font-bold text-emerald-800 dark:text-emerald-400">Berhasil!</h3>
                </div>
                <div class="ml-auto pl-3">
                    <button onclick="closeNotification()" type="button" class="inline-flex rounded-lg p-1.5 hover:bg-black/5 dark:hover:bg-white/5 transition-colors">
                        <i class="fa-solid fa-xmark text-slate-400"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT: DAFTAR MAKANAN & NUTRISI -->
        <div class="block animate-fade-in">
            <!-- Toolbar -->
            <div class="mb-4 flex justify-between items-center">
                <h2 class="text-lg font-bold text-slate-800 dark:text-slate-200 tracking-tight ml-1">{{ __('Daftar Rekomendasi Menu & Gizi') }}</h2>
                <button onclick="openModalMakanan('tambah')" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-indigo-500/20 transition-all hover:bg-indigo-700 active:scale-95">
                    <i class="fa-solid fa-plus"></i> {{ __('Tambah Data') }}
                </button>
            </div>

            <!-- Table Master -->
            <div class="flex flex-col bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-sm overflow-hidden relative transition-colors">
                <!-- Loading State -->
                <div id="makananLoading" class="absolute inset-0 bg-white/80 dark:bg-slate-900/80 z-20 flex items-center justify-center backdrop-blur-sm hidden">
                    <div class="flex flex-col items-center">
                        <i class="fa-solid fa-circle-notch fa-spin text-3xl text-indigo-600 mb-2"></i>
                        <span class="text-sm font-bold text-slate-600 dark:text-slate-400">{{ __('Memuat data...') }}</span>
                    </div>
                </div>

                <div class="overflow-x-auto no-scrollbar">
                    <table class="w-full text-left text-sm text-slate-600 dark:text-slate-400">
                        <thead class="bg-slate-50 dark:bg-slate-900/80 text-[11px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-500 border-b border-slate-200 dark:border-slate-800">
                            <tr>
                                <th class="px-6 py-4">{{ __('Nama Makanan') }}</th>
                                <th class="px-6 py-4">{{ __('Kategori Nutrisi') }}</th>
                                <th class="px-6 py-4">{{ __('Deskripsi / Saran') }}</th>
                                <th class="px-6 py-4 text-center">{{ __('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody id="makananBody" class="divide-y divide-slate-100 dark:divide-slate-800 transition-colors">
                            <!-- Injected by JS -->
                        </tbody>
                    </table>
                </div>

                <div id="makananEmptyState" class="hidden py-20 px-6 text-center transition-all">
                    <div class="flex flex-col items-center justify-center">
                        <div class="bg-indigo-50 dark:bg-indigo-900/30 h-20 w-20 rounded-3xl flex items-center justify-center mb-5 text-indigo-300 dark:text-indigo-600 shadow-inner">
                            <i class="fa-solid fa-utensils text-3xl"></i>
                        </div>
                        <p class="font-bold text-xl text-slate-800 dark:text-slate-200 tracking-tight">{{ __('Belum Ada Data') }}</p>
                        <p class="text-sm text-slate-500 dark:text-slate-500 mt-2">{{ __('Silakan klik tambah data untuk memasukkan menu makanan dan kategori nutrisi.') }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<!-- MODAL MAKANAN & NUTRISI FORM -->
<div id="modalMakanan" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/60 dark:bg-slate-950/80 backdrop-blur-sm transition-opacity"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-[32px] bg-white dark:bg-slate-900 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-slate-200 dark:border-slate-800">
                <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-900/50">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-2xl bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center shadow-sm">
                            <i id="makananIcon" class="fa-solid fa-utensils"></i>
                        </div>
                        <h3 id="modalMakananTitle" class="text-xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">{{ __('Tambah Data Gizi') }}</h3>
                    </div>
                    <button type="button" onclick="closeModalMakanan()" class="w-8 h-8 flex items-center justify-center rounded-full text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="px-6 py-6">
                    <form id="formMakanan" class="space-y-5">
                        @csrf
                        <input type="hidden" id="makananId" name="id">

                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">{{ __('Nama Makanan') }} <span class="text-rose-500">*</span></label>
                            <input type="text" id="nama_makanan" name="nama_makanan" required class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all" placeholder="{{ __('Contoh: Bubur Kacang Hijau') }}">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">{{ __('Kategori Nutrisi') }} <span class="text-rose-500">*</span></label>
                            <div class="flex gap-2 relative">
                                <div class="relative w-full">
                                    <input type="hidden" id="id_nutrisi" name="id_nutrisi" required>

                                    <input type="text" id="search_nutrisi" autocomplete="off"
                                        class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all"
                                        placeholder="{{ __('Ketik nama nutrisi...') }}">

                                    <ul id="dropdown_nutrisi" class="absolute z-20 w-full mt-1 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl shadow-xl max-h-48 overflow-y-auto hidden divide-y divide-slate-100 dark:divide-slate-700">
                                    </ul>
                                </div>

                                <button type="button" onclick="tambahKategoriCepat()" class="inline-flex items-center justify-center px-4 rounded-2xl bg-emerald-100 text-emerald-700 hover:bg-emerald-200 dark:bg-emerald-900/30 dark:text-emerald-400 dark:hover:bg-emerald-900/50 font-bold transition-colors" title="Tambah Kategori Nutrisi Baru">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                            <p class="text-[11px] text-slate-500 mt-1 ml-1">{{ __('Ketik untuk mencari, atau klik tombol') }} <strong class="text-emerald-600 dark:text-emerald-400">+</strong> {{ __('jika belum tersedia.') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">{{ __('Deskripsi / Saran Penyajian') }}</label>
                            <textarea id="deskripsi" name="deskripsi" rows="3" class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all" placeholder="{{ __('Tuliskan saran atau deskripsi gizi...') }}"></textarea>
                        </div>

                        <div id="makananErrorWrapper" class="hidden">
                            <p id="makananFormError" class="text-xs font-bold text-rose-600 dark:text-rose-400 mt-4 bg-rose-50 dark:bg-rose-900/20 p-3 rounded-xl border border-rose-100 dark:border-rose-900/30"></p>
                        </div>
                    </form>
                </div>

                <div class="px-6 py-5 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row-reverse gap-3">
                    <button type="button" onclick="submitMakanan()" id="btnSubmitMakanan" class="inline-flex w-full justify-center rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/25 hover:bg-indigo-700 sm:w-auto transition-all active:scale-95">{{ __('Simpan Data') }}</button>
                    <button type="button" onclick="closeModalMakanan()" class="inline-flex w-full justify-center rounded-2xl bg-white dark:bg-slate-800 px-6 py-3 text-sm font-bold text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 sm:w-auto transition-all active:scale-95">{{ __('Batal') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // --- VARIABLES ---
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const API_MAKANAN = '/api-makanan';
    const API_NUTRISI = '/api-nutrisi';

    let globalNutrisiData = [];
    let globalMakananData = []; // VARIABEL BARU: Untuk menyimpan data makanan
    let isEditMakanan = false;

    document.addEventListener("DOMContentLoaded", () => {
        loadAllData();
    });

    async function loadAllData() {
        await fetchNutrisiData();
        await fetchMakananData();
    }

    function showNotification(message, isError = false) {
        const wrapper = document.getElementById('notificationWrapper');
        const msgBlock = document.getElementById('notificationMessage');
        const iconBlock = document.getElementById('notificationIcon');

        if (!wrapper || !msgBlock || !iconBlock) return;

        msgBlock.innerText = message;
        if (isError) {
            wrapper.className = "mb-6 rounded-2xl bg-rose-50 dark:bg-rose-900/20 p-4 border border-rose-100 dark:border-rose-900/30 text-rose-700 dark:text-rose-400 transition-all";
            iconBlock.className = "fa-solid fa-circle-exclamation";
        } else {
            wrapper.className = "mb-6 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20 p-4 border border-emerald-100 dark:border-emerald-900/30 text-emerald-700 dark:text-emerald-400 transition-all";
            iconBlock.className = "fa-solid fa-check-circle";
        }

        wrapper.classList.remove('hidden');
        setTimeout(() => wrapper.classList.add('hidden'), 4000);
    }

    function closeNotification() {
        const wrapper = document.getElementById('notificationWrapper');
        if (wrapper) wrapper.classList.add('hidden');
    }

    // --- LOGIKA KATEGORI NUTRISI ---
    async function fetchNutrisiData() {
        try {
            const res = await fetch(API_NUTRISI, {
                headers: {
                    'Accept': 'application/json'
                }
            });
            const data = await res.json();
            globalNutrisiData = data.data || [];
            setupSearchableDropdown();
        } catch (e) {
            console.error("Gagal memuat nutrisi", e);
        }
    }

    function setupSearchableDropdown() {
        const searchInput = document.getElementById('search_nutrisi');
        const hiddenInput = document.getElementById('id_nutrisi');
        const dropdown = document.getElementById('dropdown_nutrisi');

        if (!searchInput || !dropdown) return;

        searchInput.addEventListener('input', function() {
            const keyword = this.value.toLowerCase();
            const filteredData = globalNutrisiData.filter(n => n.nama_nutrisi.toLowerCase().includes(keyword));
            renderDropdownItems(filteredData);
            dropdown.classList.remove('hidden');
        });

        searchInput.addEventListener('focus', function() {
            renderDropdownItems(globalNutrisiData);
            dropdown.classList.remove('hidden');
        });

        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
                const isMatch = globalNutrisiData.find(n => n.nama_nutrisi === searchInput.value);
                if (!isMatch) {
                    if (hiddenInput) hiddenInput.value = '';
                    searchInput.value = '';
                }
            }
        });
    }

    function renderDropdownItems(data) {
        const dropdown = document.getElementById('dropdown_nutrisi');
        if (!dropdown) return;

        if (data.length === 0) {
            dropdown.innerHTML = '<li class="px-4 py-3 text-sm text-slate-500 text-center italic">Tidak ditemukan</li>';
            return;
        }

        // Amankan tanda kutip pada nama nutrisi agar tidak error saat diklik
        dropdown.innerHTML = data.map(n => {
            const safeName = n.nama_nutrisi.replace(/'/g, "&#39;").replace(/"/g, "&quot;");
            return `<li onclick="pilihNutrisi('${n._id || n.id}', '${safeName}')" class="px-4 py-3 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/40 hover:text-indigo-700 cursor-pointer transition-colors">${n.nama_nutrisi}</li>`;
        }).join('');
    }

    function pilihNutrisi(id, nama) {
        // Kembalikan entity HTML (seperti &#39;) ke aslinya saat dimasukkan ke input form
        const decodeHtml = (html) => {
            const txt = document.createElement("textarea");
            txt.innerHTML = html;
            return txt.value;
        };

        const hiddenInput = document.getElementById('id_nutrisi');
        const searchInput = document.getElementById('search_nutrisi');
        const dropdown = document.getElementById('dropdown_nutrisi');

        if (hiddenInput) hiddenInput.value = id;
        if (searchInput) searchInput.value = decodeHtml(nama);
        if (dropdown) dropdown.classList.add('hidden');
    }

    async function tambahKategoriCepat() {
        const namaNutrisi = prompt("Masukkan Nama Kategori Nutrisi Baru:");
        if (!namaNutrisi || namaNutrisi.trim() === '') return;

        try {
            const res = await fetch(API_NUTRISI, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                body: JSON.stringify({
                    nama_nutrisi: namaNutrisi.trim()
                })
            });
            const result = await res.json();

            if (res.ok) {
                showNotification('Kategori baru berhasil ditambahkan!');
                await fetchNutrisiData();
                const newId = result.data._id || result.data.id;
                const hiddenInput = document.getElementById('id_nutrisi');
                const searchInput = document.getElementById('search_nutrisi');

                if (hiddenInput) hiddenInput.value = newId;
                if (searchInput) searchInput.value = namaNutrisi.trim();
            } else {
                alert('Gagal menambahkan: ' + (result.message || result.pesan));
            }
        } catch (e) {
            alert('Terjadi kesalahan koneksi.');
        }
    }

    // --- LOGIKA MENU MAKANAN ---
    async function fetchMakananData() {
        const loading = document.getElementById('makananLoading');
        if (loading) loading.classList.remove('hidden');

        try {
            const res = await fetch(API_MAKANAN, {
                headers: {
                    'Accept': 'application/json'
                }
            });
            const data = await res.json();

            globalMakananData = data.data || []; // Simpan data ke memori
            renderMakananTable(globalMakananData); // Render tabel
        } catch (e) {
            console.error(e);
        } finally {
            if (loading) loading.classList.add('hidden');
        }
    }

    function renderMakananTable(dataArray) {
        const tbody = document.getElementById('makananBody');
        const emptyState = document.getElementById('makananEmptyState');

        if (!tbody) return;

        if (dataArray.length === 0) {
            tbody.innerHTML = '';
            if (emptyState) emptyState.classList.remove('hidden');
            return;
        }
        if (emptyState) emptyState.classList.add('hidden');

        tbody.innerHTML = dataArray.map(item => {
            const namaNutrisi = item.nutrisi ? item.nutrisi.nama_nutrisi : '<span class="text-rose-400">Tanpa Kategori</span>';
            const itemId = item._id || item.id;

            return `
            <tr class="group transition-colors hover:bg-slate-50/70 dark:hover:bg-slate-800/40">
                <td class="px-6 py-5 whitespace-nowrap">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 flex items-center justify-center rounded-xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 shadow-sm">
                            <i class="fa-solid fa-bowl-food"></i>
                        </div>
                        <span class="font-bold text-slate-800 dark:text-slate-200 tracking-tight">${item.nama_makanan}</span>
                    </div>
                </td>
                <td class="px-6 py-5 whitespace-nowrap">
                    <span class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50 px-2.5 py-1 text-[10px] font-black text-emerald-700 ring-1 ring-emerald-600/20 uppercase tracking-wider">
                        ${namaNutrisi}
                    </span>
                </td>
                <td class="px-6 py-5">
                    <p class="text-xs font-medium text-slate-500 max-w-xs truncate" title="${item.deskripsi || ''}">
                        ${item.deskripsi || '-'}
                    </p>
                </td>
                <td class="px-6 py-5 text-center whitespace-nowrap">
                    <div class="flex items-center justify-center gap-2">
                        <button onclick="openModalMakanan('edit', '${itemId}')" class="w-9 h-9 flex items-center justify-center rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all">
                            <i class="fa-solid fa-pen-to-square text-sm"></i>
                        </button>
                        <button onclick="deleteMakanan('${itemId}')" class="w-9 h-9 flex items-center justify-center rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition-all">
                            <i class="fa-solid fa-trash-can text-sm"></i>
                        </button>
                    </div>
                </td>
            </tr>
            `;
        }).join('');
    }

    // --- MANAJEMEN MODAL ---
    function openModalMakanan(mode, id = null) {
        const errorWrapper = document.getElementById('makananErrorWrapper');
        if (errorWrapper) errorWrapper.classList.add('hidden');

        const form = document.getElementById('formMakanan');
        const title = document.getElementById('modalMakananTitle');
        const inId = document.getElementById('makananId');
        const inNama = document.getElementById('nama_makanan');
        const inDesc = document.getElementById('deskripsi');
        const inNutrisi = document.getElementById('id_nutrisi');
        const inSearch = document.getElementById('search_nutrisi');

        if (mode === 'tambah') {
            isEditMakanan = false;
            if (title) title.innerText = 'Tambah Data Gizi';
            if (form) form.reset();

            if (inId) inId.value = '';
            if (inNutrisi) inNutrisi.value = '';
            if (inSearch) inSearch.value = '';
        } else {
            isEditMakanan = true;
            if (title) title.innerText = 'Edit Data Gizi';

            // Logika Baru: Tarik data dari Array berdasarkan ID
            const data = globalMakananData.find(m => (m._id || m.id) == id);

            if (data) {
                if (inId) inId.value = data._id || data.id;
                if (inNama) inNama.value = data.nama_makanan;
                if (inDesc) inDesc.value = data.deskripsi || '';

                const nutrisiId = data.id_nutrisi;
                if (inNutrisi) inNutrisi.value = nutrisiId;

                // Set isi pencarian dropdown
                const foundNutrisi = globalNutrisiData.find(n => (n._id || n.id) == nutrisiId);
                if (inSearch) inSearch.value = foundNutrisi ? foundNutrisi.nama_nutrisi : '';
            }
        }

        const modal = document.getElementById('modalMakanan');
        if (modal) modal.classList.remove('hidden');
    }

    function closeModalMakanan() {
        const modal = document.getElementById('modalMakanan');
        if (modal) modal.classList.add('hidden');
    }

    async function submitMakanan() {
        const form = document.getElementById('formMakanan');
        if (!form || !form.checkValidity()) {
            if (form) form.reportValidity();
            return;
        }

        const dataObj = Object.fromEntries(new FormData(form).entries());
        const endpoint = isEditMakanan ? `${API_MAKANAN}/${dataObj.id}` : API_MAKANAN;
        const method = isEditMakanan ? 'PUT' : 'POST';
        const btn = document.getElementById('btnSubmitMakanan');

        try {
            if (btn) {
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
                btn.disabled = true;
            }

            const res = await fetch(endpoint, {
                method: method,
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                body: JSON.stringify(dataObj)
            });
            const result = await res.json();

            if (res.ok) {
                closeModalMakanan();
                showNotification(result.pesan || 'Berhasil menyimpan data');
                await fetchMakananData(); // Render ulang tabel
            } else throw new Error(result.message || result.pesan);
        } catch (e) {
            const errText = document.getElementById('makananFormError');
            const errWrap = document.getElementById('makananErrorWrapper');
            if (errText) errText.innerText = e.message;
            if (errWrap) errWrap.classList.remove('hidden');
        } finally {
            if (btn) {
                btn.innerHTML = 'Simpan Data';
                btn.disabled = false;
            }
        }
    }

    async function deleteMakanan(id) {
        const isDark = document.documentElement.classList.contains('dark');

        Swal.fire({
            title: 'Hapus Data?',
            text: 'Data gizi ini akan dihapus secara permanen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: isDark ? '#334155' : '#94a3b8',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
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
                try {
                    const res = await fetch(`${API_MAKANAN}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        }
                    });
                    if (res.ok) {
                        showNotification('Data berhasil dihapus');
                        fetchMakananData();
                    } else showNotification('Gagal menghapus data', true);
                } catch (e) {
                    showNotification('Terjadi kesalahan koneksi.', true);
                }
            }
        });
    }
</script>

<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.4s ease-out forwards;
    }
</style>
@endsection