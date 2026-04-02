@extends('layouts.admin')

@section('title', 'Manajemen Menu Makanan & Nutrisi')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50/50 p-6 md:p-8">
    <div class="mx-auto max-w-7xl">
        
        <!-- HEADER HALAMAN -->
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Manajemen Gizi Spesifik</h1>
                <p class="mt-1 text-sm text-slate-500">Kelola master data Menu Makanan dan Kategori Nutrisi untuk pencegahan stunting.</p>
            </div>
            
            <!-- Tab Navigation (Desktop & Mobile) -->
            <div class="bg-white p-1 rounded-xl shadow-sm border border-slate-200 inline-flex">
                <button onclick="switchTab('makanan')" id="tabMakananBtn" class="px-5 py-2 text-sm font-semibold rounded-lg bg-indigo-50 text-indigo-600 transition-colors">
                    <i class="fa-solid fa-utensils mr-2"></i>Menu Makanan
                </button>
                <button onclick="switchTab('nutrisi')" id="tabNutrisiBtn" class="px-5 py-2 text-sm font-medium rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-50 transition-colors">
                    <i class="fa-solid fa-leaf mr-2"></i>Kategori Nutrisi
                </button>
            </div>
        </div>

        <!-- NOTIFICATION CONTAINER -->
        <div id="notificationWrapper" class="hidden mb-6 rounded-lg bg-green-50 p-4 border border-green-200">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fa-solid fa-check-circle text-green-400"></i>
                </div>
                <div class="ml-3">
                    <h3 id="notificationMessage" class="text-sm font-medium text-green-800">Berhasil!</h3>
                </div>
                <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1.5">
                        <button onclick="closeNotification()" type="button" class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB CONTENT: MAKANAN -->
        <div id="tabMakanan" class="block">
            <!-- Toolbar -->
            <div class="mb-4 flex justify-between items-center">
                <h2 class="text-lg font-bold text-slate-800">Daftar Rekomendasi Menu Makanan</h2>
                <button onclick="openModalMakanan('tambah')" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition-all hover:bg-indigo-700">
                    <i class="fa-solid fa-plus"></i> Tambah Menu Makanan
                </button>
            </div>
            
            <!-- Table Makanan -->
            <div class="flex flex-col bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden relative">
                <!-- Loading State -->
                <div id="makananLoading" class="absolute inset-0 bg-white/80 z-10 flex items-center justify-center backdrop-blur-sm hidden">
                    <div class="flex flex-col items-center">
                        <i class="fa-solid fa-circle-notch fa-spin text-3xl text-indigo-600 mb-2"></i>
                        <span class="text-sm font-medium text-slate-600">Memuat data...</span>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4 font-semibold">Nama Makanan</th>
                                <th class="px-6 py-4 font-semibold">Kategori Nutrisi</th>
                                <th class="px-6 py-4 font-semibold">Deskripsi / Saran</th>
                                <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="makananBody" class="divide-y divide-slate-100">
                            <!-- Injected by JS -->
                        </tbody>
                    </table>
                </div>
                
                <div id="makananEmptyState" class="hidden py-12 px-6 text-center text-slate-500">
                    <div class="flex flex-col items-center justify-center">
                        <div class="bg-indigo-50 h-16 w-16 rounded-full flex items-center justify-center mb-3 text-indigo-300">
                            <i class="fa-solid fa-utensils text-2xl"></i>
                        </div>
                        <p class="font-semibold text-slate-700 mb-1">Belum ada Menu Makanan</p>
                        <p class="text-sm">Silakan buat menu makanan pertama Anda.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB CONTENT: NUTRISI -->
        <div id="tabNutrisi" class="hidden">
            <!-- Toolbar -->
            <div class="mb-4 flex justify-between items-center">
                <h2 class="text-lg font-bold text-slate-800">Daftar Kategori Nutrisi (Master Data)</h2>
                <button onclick="openModalNutrisi('tambah')" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition-all hover:bg-indigo-700">
                    <i class="fa-solid fa-plus"></i> Tambah Kategori
                </button>
            </div>
            
            <!-- Table Nutrisi -->
            <div class="flex flex-col bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden relative">
                <!-- Loading State -->
                <div id="nutrisiLoading" class="absolute inset-0 bg-white/80 z-10 flex items-center justify-center backdrop-blur-sm hidden">
                    <div class="flex flex-col items-center">
                        <i class="fa-solid fa-circle-notch fa-spin text-3xl text-indigo-600 mb-2"></i>
                        <span class="text-sm font-medium text-slate-600">Memuat data...</span>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4 font-semibold w-16">ID</th>
                                <th class="px-6 py-4 font-semibold">Nama Kategori Nutrisi</th>
                                <th class="px-6 py-4 font-semibold text-center w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="nutrisiBody" class="divide-y divide-slate-100">
                            <!-- Injected by JS -->
                        </tbody>
                    </table>
                </div>

                <div id="nutrisiEmptyState" class="hidden py-12 px-6 text-center text-slate-500">
                    <div class="flex flex-col items-center justify-center">
                        <div class="bg-green-50 h-16 w-16 rounded-full flex items-center justify-center mb-3 text-green-300">
                            <i class="fa-solid fa-leaf text-2xl"></i>
                        </div>
                        <p class="font-semibold text-slate-700 mb-1">Belum ada Kategori Nutrisi</p>
                        <p class="text-sm">Silakan buat kategori pertama Anda.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<!-- ============================================== -->
<!-- MODAL MAKANAN FORM                             -->
<!-- ============================================== -->
<div id="modalMakanan" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-slate-100">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg font-semibold leading-6 text-slate-900 mb-4 flex items-center gap-2" id="modalMakananTitle">
                                <i class="fa-solid fa-utensils text-indigo-600"></i> Tambah Menu Makanan
                            </h3>
                            <form id="formMakanan" class="space-y-4">
                                <input type="hidden" id="makananId" name="id">
                                
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Nama Makanan <span class="text-rose-500">*</span></label>
                                    <input type="text" id="nama_makanan" name="nama_makanan" required class="mt-1 block w-full rounded-lg border-slate-300 border px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Kategori Nutrisi <span class="text-rose-500">*</span></label>
                                    <select id="id_nutrisi" name="id_nutrisi" required class="mt-1 block w-full rounded-lg border-slate-300 border px-3 py-2.5 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 bg-white sm:text-sm">
                                        <option value="" disabled selected>Memuat data...</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Deskripsi / Saran</label>
                                    <textarea id="deskripsi" name="deskripsi" rows="3" class="mt-1 block w-full rounded-lg border-slate-300 border px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"></textarea>
                                </div>
                                
                                <p id="makananFormError" class="hidden text-sm text-red-500 mt-2 bg-red-50 p-2 rounded"></p>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" onclick="submitMakanan()" id="btnSubmitMakanan" class="inline-flex w-full justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">Simpan Data</button>
                    <button type="button" onclick="closeModalMakanan()" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL NUTRISI FORM                             -->
<!-- ============================================== -->
<div id="modalNutrisi" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-slate-100">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg font-semibold leading-6 text-slate-900 mb-4 flex items-center gap-2" id="modalNutrisiTitle">
                                <i class="fa-solid fa-leaf text-green-600"></i> Tambah Kategori Nurisi
                            </h3>
                            <form id="formNutrisi" class="space-y-4">
                                <input type="hidden" id="nutrisiId" name="id">
                                
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Nama Nutrisi <span class="text-rose-500">*</span></label>
                                    <input type="text" id="nama_nutrisi" name="nama_nutrisi" required class="mt-1 block w-full rounded-lg border-slate-300 border px-3 py-2 shadow-sm focus:border-green-500 focus:outline-none focus:ring-1 focus:ring-green-500 sm:text-sm">
                                </div>
                                
                                <p id="nutrisiFormError" class="hidden text-sm text-red-500 mt-2 bg-red-50 p-2 rounded"></p>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" onclick="submitNutrisi()" id="btnSubmitNutrisi" class="inline-flex w-full justify-center rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">Simpan Data</button>
                    <button type="button" onclick="closeModalNutrisi()" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">Batal</button>
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
    
    // Master data
    let globalNutrisiData = [];

    // --- INIT ---
    document.addEventListener("DOMContentLoaded", () => {
        // Load data on start
        loadAllData();
    });

    async function loadAllData() {
        // Harus load nutrisi dulu karena Makanan butuh select id_nutrisi
        await fetchNutrisiData();
        await fetchMakananData();
    }

    // ==========================================
    // NOTIFICATION
    // ==========================================
    function showNotification(message, isError = false) {
        const wrapper = document.getElementById('notificationWrapper');
        const msgBlock = document.getElementById('notificationMessage');
        const iconBlock = wrapper.querySelector('i');

        msgBlock.innerText = message;
        if (isError) {
            wrapper.className = "mb-6 rounded-lg bg-red-50 p-4 border border-red-200";
            msgBlock.className = "text-sm font-medium text-red-800";
            iconBlock.className = "fa-solid fa-circle-exclamation text-red-400";
        } else {
            wrapper.className = "mb-6 rounded-lg bg-green-50 p-4 border border-green-200";
            msgBlock.className = "text-sm font-medium text-green-800";
            iconBlock.className = "fa-solid fa-check-circle text-green-400";
        }
        
        wrapper.classList.remove('hidden');
        setTimeout(() => wrapper.classList.add('hidden'), 4000);
    }
    function closeNotification() {
        document.getElementById('notificationWrapper').classList.add('hidden');
    }

    // ==========================================
    // TABS LOGIC
    // ==========================================
    function switchTab(tabId) {
        // Reset classes
        const btnClassesActive = "px-5 py-2 text-sm font-semibold rounded-lg bg-indigo-50 text-indigo-600 transition-colors";
        const btnClassesInactive = "px-5 py-2 text-sm font-medium rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-50 transition-colors";

        document.getElementById('tabMakananBtn').className = (tabId === 'makanan') ? btnClassesActive : btnClassesInactive;
        document.getElementById('tabNutrisiBtn').className = (tabId === 'nutrisi') ? btnClassesActive : btnClassesInactive;

        document.getElementById('tabMakanan').style.display = (tabId === 'makanan') ? 'block' : 'none';
        document.getElementById('tabNutrisi').style.display = (tabId === 'nutrisi') ? 'block' : 'none';
    }


    // ==========================================
    // LOGIKA: KATEGORI NUTRISI
    // ==========================================
    let isEditNutrisi = false;

    async function fetchNutrisiData() {
        document.getElementById('nutrisiLoading').classList.remove('hidden');
        try {
            const res = await fetch(API_NUTRISI, { headers: { 'Accept': 'application/json' }});
            const data = await res.json();
            globalNutrisiData = data.data || [];
            
            // Populasikan HTML Tabel
            renderNutrisiTable(globalNutrisiData);
            
            // Populasikan Dropdown Makanan
            populateSelectNutrisi();
        } catch(e) { console.error(e); }
        finally { document.getElementById('nutrisiLoading').classList.add('hidden'); }
    }

    function renderNutrisiTable(dataArray) {
        const tbody = document.getElementById('nutrisiBody');
        if (dataArray.length === 0) {
            tbody.innerHTML = '';
            document.getElementById('nutrisiEmptyState').classList.remove('hidden');
            return;
        }
        document.getElementById('nutrisiEmptyState').classList.add('hidden');
        
        tbody.innerHTML = dataArray.map((item, idx) => `
            <tr class="group transition-colors hover:bg-slate-50/70">
                <td class="px-6 py-4 font-medium text-slate-500">#${item.id}</td>
                <td class="px-6 py-4 font-bold text-slate-800">
                    <i class="fa-solid fa-caret-right text-green-500 mr-2 text-xs"></i> 
                    ${item.nama_nutrisi}
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center gap-2">
                        <button onclick='openModalNutrisi("edit", ${JSON.stringify(item).replace(/'/g, "&#39;")})' class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white" title="Edit">
                            <i class="fa-solid fa-pen-to-square text-sm"></i>
                        </button>
                        <button onclick='deleteNutrisi(${item.id})' class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white" title="Hapus">
                            <i class="fa-solid fa-trash-can text-sm"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');
    }

    function populateSelectNutrisi() {
        const sel = document.getElementById('id_nutrisi');
        sel.innerHTML = '<option value="" disabled selected>Pilih Kategori...</option>' + 
            globalNutrisiData.map(n => `<option value="${n.id}">${n.nama_nutrisi}</option>`).join('');
    }

    function openModalNutrisi(mode, data = null) {
        const form = document.getElementById('formNutrisi');
        document.getElementById('nutrisiFormError').classList.add('hidden');
        
        if (mode === 'tambah') {
            isEditNutrisi = false;
            document.getElementById('modalNutrisiTitle').innerHTML = '<i class="fa-solid fa-leaf text-green-600"></i> Tambah Kategori Nutrisi';
            form.reset();
            document.getElementById('nutrisiId').value = '';
        } else {
            isEditNutrisi = true;
            document.getElementById('modalNutrisiTitle').innerHTML = '<i class="fa-solid fa-pen text-green-600"></i> Edit Kategori Nutrisi';
            document.getElementById('nutrisiId').value = data.id;
            document.getElementById('nama_nutrisi').value = data.nama_nutrisi;
        }
        document.getElementById('modalNutrisi').classList.remove('hidden');
    }
    function closeModalNutrisi() {
        document.getElementById('modalNutrisi').classList.add('hidden');
    }

    async function submitNutrisi() {
        const form = document.getElementById('formNutrisi');
        if (!form.checkValidity()) { form.reportValidity(); return; }

        const dataObj = Object.fromEntries(new FormData(form).entries());
        const endpoint = isEditNutrisi ? `${API_NUTRISI}/${dataObj.id}` : API_NUTRISI;
        const method = isEditNutrisi ? 'PUT' : 'POST';
        const rawBtn = document.getElementById('btnSubmitNutrisi').innerHTML;

        try {
            document.getElementById('btnSubmitNutrisi').innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-1"></i>';
            document.getElementById('btnSubmitNutrisi').disabled = true;

            const res = await fetch(endpoint, {
                method: method,
                headers: { 'Accept': 'application/json', 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
                body: JSON.stringify(dataObj)
            });
            const result = await res.json();
            
            if (res.ok) {
                closeModalNutrisi();
                showNotification(result.pesan);
                await fetchNutrisiData(); // reload
                await fetchMakananData(); // reload makanan krn label bs ganti
            } else throw new Error(result.message || result.pesan);
        } catch (e) {
            const errEl = document.getElementById('nutrisiFormError');
            errEl.innerText = e.message; errEl.classList.remove('hidden');
        } finally {
            document.getElementById('btnSubmitNutrisi').innerHTML = rawBtn;
            document.getElementById('btnSubmitNutrisi').disabled = false;
        }
    }

    async function deleteNutrisi(id) {
        if(!confirm('Yakin ingin menghapus? (Makanan yang terkait kategori ini mungkin error jika tidak ada CASCADE)')) return;
        try {
            const res = await fetch(`${API_NUTRISI}/${id}`, { method: 'DELETE', headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN }});
            if(res.ok) {
                showNotification('Data Nutrisi berhasil dihapus');
                fetchNutrisiData(); fetchMakananData();
            } else showNotification('Gagal menghapus', true);
        } catch(e) {}
    }


    // ==========================================
    // LOGIKA: MENU MAKANAN
    // ==========================================
    let isEditMakanan = false;

    async function fetchMakananData() {
        document.getElementById('makananLoading').classList.remove('hidden');
        try {
            const res = await fetch(API_MAKANAN, { headers: { 'Accept': 'application/json' }});
            const data = await res.json();
            renderMakananTable(data.data || []);
        } catch(e) { console.error(e); }
        finally { document.getElementById('makananLoading').classList.add('hidden'); }
    }

    function renderMakananTable(dataArray) {
        const tbody = document.getElementById('makananBody');
        if (dataArray.length === 0) {
            tbody.innerHTML = '';
            document.getElementById('makananEmptyState').classList.remove('hidden');
            return;
        }
        document.getElementById('makananEmptyState').classList.add('hidden');
        
        tbody.innerHTML = dataArray.map(item => {
            // Label nutrisi
            const namaNutrisi = item.nutrisi ? item.nutrisi.nama_nutrisi : '<span class="text-rose-400">Tdk diketahui</span>';
            return `
            <tr class="group transition-colors hover:bg-slate-50/70">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 flex items-center justify-center rounded-lg bg-indigo-50 text-indigo-500">
                            <i class="fa-solid fa-bowl-food"></i>
                        </div>
                        <span class="font-bold text-slate-800">${item.nama_makanan}</span>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">
                        ${namaNutrisi}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <p class="text-xs text-slate-500 max-w-xs truncate" title="${item.deskripsi || ''}">
                        ${item.deskripsi || '-'}
                    </p>
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center gap-2">
                        <button onclick='openModalMakanan("edit", ${JSON.stringify(item).replace(/'/g, "&#39;")})' class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white" title="Edit">
                            <i class="fa-solid fa-pen-to-square text-sm"></i>
                        </button>
                        <button onclick='deleteMakanan(${item.id})' class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white" title="Hapus">
                            <i class="fa-solid fa-trash-can text-sm"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `}).join('');
    }

    function openModalMakanan(mode, data = null) {
        const form = document.getElementById('formMakanan');
        document.getElementById('makananFormError').classList.add('hidden');
        
        if (mode === 'tambah') {
            isEditMakanan = false;
            document.getElementById('modalMakananTitle').innerHTML = '<i class="fa-solid fa-utensils text-indigo-600"></i> Tambah Menu Makanan';
            form.reset();
            document.getElementById('makananId').value = '';
        } else {
            isEditMakanan = true;
            document.getElementById('modalMakananTitle').innerHTML = '<i class="fa-solid fa-pen text-indigo-600"></i> Edit Menu Makanan';
            document.getElementById('makananId').value = data.id;
            document.getElementById('nama_makanan').value = data.nama_makanan;
            document.getElementById('id_nutrisi').value = data.id_nutrisi;
            document.getElementById('deskripsi').value = data.deskripsi || '';
        }
        document.getElementById('modalMakanan').classList.remove('hidden');
    }

    function closeModalMakanan() {
        document.getElementById('modalMakanan').classList.add('hidden');
    }

    async function submitMakanan() {
        const form = document.getElementById('formMakanan');
        if (!form.checkValidity()) { form.reportValidity(); return; }

        const dataObj = Object.fromEntries(new FormData(form).entries());
        const endpoint = isEditMakanan ? `${API_MAKANAN}/${dataObj.id}` : API_MAKANAN;
        const method = isEditMakanan ? 'PUT' : 'POST';
        const rawBtn = document.getElementById('btnSubmitMakanan').innerHTML;

        try {
            document.getElementById('btnSubmitMakanan').innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-1"></i>';
            document.getElementById('btnSubmitMakanan').disabled = true;

            const res = await fetch(endpoint, {
                method: method,
                headers: { 'Accept': 'application/json', 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
                body: JSON.stringify(dataObj)
            });
            const result = await res.json();
            
            if (res.ok) {
                closeModalMakanan();
                showNotification(result.pesan);
                await fetchMakananData(); // reload
            } else throw new Error(result.message || result.pesan);
        } catch (e) {
            const errEl = document.getElementById('makananFormError');
            errEl.innerText = e.message; errEl.classList.remove('hidden');
        } finally {
            document.getElementById('btnSubmitMakanan').innerHTML = rawBtn;
            document.getElementById('btnSubmitMakanan').disabled = false;
        }
    }

    async function deleteMakanan(id) {
        if(!confirm('Yakin ingin menghapus menu ini?')) return;
        try {
            const res = await fetch(`${API_MAKANAN}/${id}`, { method: 'DELETE', headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN }});
            if(res.ok) {
                showNotification('Menu berhasil dihapus');
                fetchMakananData();
            } else showNotification('Gagal menghapus', true);
        } catch(e) {}
    }
</script>
@endsection