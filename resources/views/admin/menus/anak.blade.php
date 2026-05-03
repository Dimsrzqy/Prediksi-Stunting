@extends('layouts.admin')

@section('title', 'Data Anak - Prediksi Stunting')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50/50 dark:bg-slate-950/50 p-6 md:p-8 transition-colors duration-300">
    <div class="mx-auto max-w-7xl">
        <!-- HEADER HALAMAN -->
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">Manajemen Data Anak</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Kelola daftar anak untuk pencatatan prediksi stunting dan pemantauan.</p>
            </div>

            <a href="{{ route('anak.export') }}" class="flex items-center gap-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2.5 text-sm font-bold text-slate-700 dark:text-slate-300 shadow-sm transition-all hover:bg-slate-50 dark:hover:bg-slate-800 hover:border-indigo-200 dark:hover:border-indigo-900 hover:text-indigo-600 dark:hover:text-indigo-400">
                <i class="fa-solid fa-file-excel text-emerald-600 dark:text-emerald-500"></i>
                Ekspor Excel
            </a>

            <button onclick="openModal('tambah')" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition-all hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 active:scale-95">
                <i class="fa-solid fa-plus"></i>
                Tambah Data Anak
            </button>
        </div>

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

        <!-- TABEL DATA -->
        <div class="flex flex-col bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-sm overflow-hidden transition-colors">
            <div class="flex items-center justify-between p-5 border-b border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
                <h2 class="text-lg font-bold text-slate-800 dark:text-slate-200 tracking-tight">Daftar Anak</h2>
                <button onclick="fetchDataAnak()" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2 text-sm font-bold text-slate-600 dark:text-slate-400 shadow-sm transition-all hover:bg-slate-50 dark:hover:bg-slate-700 active:scale-95">
                    <i class="fa-solid fa-rotate-right text-slate-400 dark:text-slate-500"></i> Refresh
                </button>
            </div>

            <div class="overflow-x-auto relative no-scrollbar">
                <div id="tableLoading" class="absolute inset-0 bg-white/80 dark:bg-slate-900/80 z-20 flex items-center justify-center backdrop-blur-sm hidden transition-all">
                    <div class="flex flex-col items-center">
                        <i class="fa-solid fa-circle-notch fa-spin text-3xl text-indigo-600 mb-3"></i>
                        <span class="text-sm font-bold text-slate-600 dark:text-slate-400">Memuat data...</span>
                    </div>
                </div>

                <table class="w-full text-left text-sm text-slate-600 dark:text-slate-400">
                    <thead class="bg-slate-50 dark:bg-slate-900/80 text-[11px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-500 border-b border-slate-200 dark:border-slate-800">
                        <tr>
                            <th scope="col" class="px-6 py-4">NIK</th>
                            <th scope="col" class="px-6 py-4">Nama Anak</th>
                            <th scope="col" class="px-6 py-4">Tgl Lahir / Usia</th>
                            <th scope="col" class="px-6 py-4">Jenis Kelamin</th>
                            <th scope="col" class="px-6 py-4">Orang Tua</th>
                            <th scope="col" class="px-6 py-4">Data Lahir</th>
                            <th scope="col" class="px-6 py-4">Pemeriksaan Terakhir</th>
                            <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="divide-y divide-slate-100 dark:divide-slate-800 bg-white dark:bg-slate-900 transition-colors">
                        <!-- Data injected by JS -->
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="hidden py-20 px-6 text-center transition-all">
                <div class="flex flex-col items-center justify-center">
                    <div class="bg-slate-100 dark:bg-slate-800 h-20 w-20 rounded-3xl flex items-center justify-center mb-5 shadow-inner">
                        <i class="fa-solid fa-child-reaching text-3xl text-slate-300 dark:text-slate-600"></i>
                    </div>
                    <p class="font-bold text-xl text-slate-800 dark:text-slate-200 tracking-tight">Belum Ada Data Anak</p>
                    <p class="text-sm text-slate-500 dark:text-slate-500 mt-2 max-w-xs mx-auto">Silakan tambahkan data anak untuk mulai melakukan pemantauan stunting.</p>
                </div>
            </div>

        </div>
    </div>
</main>

<!-- MODAL FORM -->
<div id="formModal" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/60 dark:bg-slate-950/80 backdrop-blur-sm transition-opacity"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-[32px] bg-white dark:bg-slate-900 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-xl border border-slate-200 dark:border-slate-800">

                <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-900/50">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-2xl bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center shadow-sm">
                            <i id="modalIcon" class="fa-solid fa-child-reaching"></i>
                        </div>
                        <h3 id="modalTitle" class="text-xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">Tambah Data Anak</h3>
                    </div>
                    <button type="button" onclick="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-full text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="px-6 py-6 max-h-[70vh] overflow-y-auto no-scrollbar">
                    <form id="anakForm" class="space-y-6">
                        @csrf
                        <input type="hidden" id="anakId" name="id">

                        <div class="space-y-5">
                            <!-- Field: Orang Tua -->
                            <div>
                                <label for="id_ibu" class="flex justify-between items-center text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">
                                    <span>Orang Tua / Ibu Kandung <span class="text-rose-500">*</span></span>
                                    <a href="{{ route('ibu.index') }}" class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">Kelola Ibu</a>
                                </label>
                                <select id="id_ibu" name="id_ibu" required class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all appearance-none">
                                    <option value="" disabled selected>Memuat data orang tua...</option>
                                </select>
                            </div>

                            <!-- Field: NIK & Nama -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="nik" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">NIK <span class="text-rose-500">*</span></label>
                                    <input type="text" id="nik" name="nik" required class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all" placeholder="16 digit NIK">
                                </div>
                                <div>
                                    <label for="nama_anak" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Nama Lengkap <span class="text-rose-500">*</span></label>
                                    <input type="text" id="nama_anak" name="nama_anak" required class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all" placeholder="Nama Anak">
                                </div>
                            </div>

                            <!-- Field: Tgl Lahir & JK -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="tgl_lahir" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Tanggal Lahir <span class="text-rose-500">*</span></label>
                                    <input type="date" id="tgl_lahir" name="tgl_lahir" required class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all">
                                </div>
                                <div>
                                    <label for="jenis_kelamin" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Jenis Kelamin <span class="text-rose-500">*</span></label>
                                    <select id="jenis_kelamin" name="jenis_kelamin" required class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all appearance-none">
                                        <option value="" disabled selected>Pilih...</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Sub-header: Data Lahir -->
                            <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                                <h4 class="text-sm font-black uppercase tracking-widest text-slate-400 dark:text-slate-600 mb-4 ml-1">Spesifikasi Lahir</h4>
                                <div class="grid grid-cols-2 gap-5">
                                    <div>
                                        <label for="bb_lahir" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">BB Lahir (kg)</label>
                                        <input type="number" step="0.01" id="bb_lahir" name="bb_lahir" placeholder="3.2" class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all">
                                    </div>
                                    <div>
                                        <label for="tb_lahir" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">TB Lahir (cm)</label>
                                        <input type="number" step="0.1" id="tb_lahir" name="tb_lahir" placeholder="50.5" class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all">
                                    </div>
                                </div>
                            </div>

                            <!-- Sub-header: Pemeriksaan -->
                            <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                                <h4 class="text-sm font-black uppercase tracking-widest text-slate-400 dark:text-slate-600 mb-4 ml-1">Pemeriksaan Terakhir</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div>
                                        <label for="berat_badan" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">BB (kg)</label>
                                        <input type="number" step="0.01" id="berat_badan" name="berat_badan" class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all">
                                    </div>
                                    <div>
                                        <label for="tinggi_badan" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">TB (cm)</label>
                                        <input type="number" step="0.1" id="tinggi_badan" name="tinggi_badan" class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all">
                                    </div>
                                    <div>
                                        <label for="tgl_pemeriksaan" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Tanggal</label>
                                        <input type="date" id="tgl_pemeriksaan" name="tgl_pemeriksaan" class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="formErrorWrapper" class="hidden">
                            <p id="formError" class="text-xs font-bold text-rose-600 dark:text-rose-400 mt-4 bg-rose-50 dark:bg-rose-900/20 p-3 rounded-xl border border-rose-100 dark:border-rose-900/30"></p>
                        </div>
                    </form>
                </div>

                <div class="px-6 py-5 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row-reverse gap-3">
                    <button type="button" onclick="submitForm()" id="btnSubmit" class="inline-flex w-full justify-center rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/25 hover:bg-indigo-700 sm:w-auto transition-all active:scale-95">Simpan Data</button>
                    <button type="button" onclick="closeModal()" class="inline-flex w-full justify-center rounded-2xl bg-white dark:bg-slate-800 px-6 py-3 text-sm font-bold text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 sm:w-auto transition-all active:scale-95">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const ENDPOINT = '/api-anak';
    const ENDPOINT_IBU = '/api-ibu';

    const formModal = document.getElementById('formModal');
    const anakForm = document.getElementById('anakForm');
    const tableBody = document.getElementById('tableBody');
    const tableLoading = document.getElementById('tableLoading');
    const emptyState = document.getElementById('emptyState');
    const notificationWrapper = document.getElementById('notificationWrapper');
    const notificationMessage = document.getElementById('notificationMessage');
    const notificationIcon = document.getElementById('notificationIcon');

    let isEditMode = false;
    let dataIbuArr = [];

    document.addEventListener("DOMContentLoaded", () => {
        loadDataDependencies();
    });

    async function loadDataDependencies() {
        tableLoading.classList.remove('hidden');
        await fetchPilihanIbu();
        await fetchDataAnak();
    }

    async function fetchPilihanIbu() {
        try {
            const res = await fetch(ENDPOINT_IBU, {
                headers: {
                    'Accept': 'application/json'
                }
            });
            const result = await res.json();
            dataIbuArr = result.data || result || [];

            const dropdown = document.getElementById('id_ibu');
            if (dataIbuArr.length === 0) {
                dropdown.innerHTML = '<option value="" disabled selected>Belum ada data Ibu. Tambahkan di menu Data Ibu.</option>';
            } else {
                dropdown.innerHTML = '<option value="" disabled selected>Pilih orang tua...</option>' +
                    dataIbuArr.map(n => `<option value="${n._id || n.id}">${n.nama_ibu}</option>`).join('');
            }
        } catch (error) {
            console.error("Gagal load pilihan Ibu", error);
        }
    }

    async function fetchDataAnak() {
        emptyState.classList.add('hidden');
        tableLoading.classList.remove('hidden');
        try {
            const res = await fetch(ENDPOINT, {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            });
            const response = await res.json();

            if (response.data && response.data.length > 0) {
                renderTable(response.data);
                emptyState.classList.add('hidden');
            } else {
                tableBody.innerHTML = '';
                emptyState.classList.remove('hidden');
            }
        } catch (error) {
            console.error("Gagal", error);
            showNotification("Gagal mengambil data dari server", true);
        } finally {
            tableLoading.classList.add('hidden');
        }
    }

    function renderTable(dataArray) {
        let html = '';
        dataArray.forEach(anak => {
            let umurText = '-';
            if (anak.tgl_lahir) {
                const birthDate = new Date(anak.tgl_lahir);
                const today = new Date();
                let months = (today.getFullYear() - birthDate.getFullYear()) * 12;
                months -= birthDate.getMonth();
                months += today.getMonth();
                umurText = months > 0 ? `${months} Bulan` : 'Baru Lahir';
            }

            const genderBadge = (anak.jenis_kelamin === 'L' || anak.jenis_kelamin === 'Laki-laki') ?
                `<span class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 dark:bg-blue-900/30 px-2.5 py-1 text-[11px] font-black text-blue-700 dark:text-blue-400 ring-1 ring-blue-600/20"><i class="fa-solid fa-mars"></i> LAKI-LAKI</span>` :
                `<span class="inline-flex items-center gap-1.5 rounded-lg bg-pink-50 dark:bg-pink-900/30 px-2.5 py-1 text-[11px] font-black text-pink-700 dark:text-pink-400 ring-1 ring-pink-600/20"><i class="fa-solid fa-venus"></i> PEREMPUAN</span>`;

            const namaIbu = anak.ibu ? anak.ibu.nama_ibu : (anak.nama_ortu ? `${anak.nama_ortu} <span class="text-[10px] text-amber-500 font-bold uppercase">(Belum Link)</span>` : '<span class="text-rose-400">N/A</span>');

            const bbLahir = anak.bb_lahir ? `${anak.bb_lahir} kg` : '-';
            const tbLahir = anak.tb_lahir ? `${anak.tb_lahir} cm` : '-';
            const beratBadan = anak.berat_badan ? `${anak.berat_badan} kg` : '-';
            const tinggiBadan = anak.tinggi_badan ? `${anak.tinggi_badan} cm` : '-';
            const tglPeriksa = anak.tgl_pemeriksaan ? anak.tgl_pemeriksaan.split('T')[0] : '-';

            html += `
            <tr class="group transition-colors hover:bg-slate-50/70 dark:hover:bg-slate-800/40">
                <td class="px-6 py-5 whitespace-nowrap">
                    <span class="font-bold text-slate-500 dark:text-slate-600 text-xs">${anak.nik || '-'}</span>
                </td>
                <td class="px-6 py-5 whitespace-nowrap">
                    <span class="font-bold text-slate-800 dark:text-slate-200 tracking-tight">${anak.nama_anak}</span>
                </td>
                <td class="px-6 py-5 whitespace-nowrap">
                    <div class="flex flex-col">
                        <span class="font-bold text-slate-700 dark:text-slate-300 text-sm">${anak.tgl_lahir || '-'}</span>
                        <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 dark:text-slate-500 mt-1">${umurText}</span>
                    </div>
                </td>
                <td class="px-6 py-5 whitespace-nowrap">
                    ${genderBadge}
                </td>
                <td class="px-6 py-5 whitespace-nowrap">
                    <span class="text-sm font-semibold text-slate-600 dark:text-slate-400">${namaIbu}</span>
                </td>
                
                <td class="px-6 py-5 whitespace-nowrap">
                    <div class="flex flex-col text-[11px] font-bold">
                        <span class="text-slate-600 dark:text-slate-400"><span class="text-slate-400 dark:text-slate-500">BB:</span> ${bbLahir}</span>
                        <span class="text-slate-600 dark:text-slate-400 mt-0.5"><span class="text-slate-400 dark:text-slate-500">TB:</span> ${tbLahir}</span>
                    </div>
                </td>

                <td class="px-6 py-5 whitespace-nowrap">
                    <div class="flex flex-col text-[11px] font-bold">
                        <span class="text-indigo-600 dark:text-indigo-400 whitespace-nowrap"><i class="fa-regular fa-calendar-check mr-1"></i> ${tglPeriksa}</span>
                        <span class="text-slate-600 dark:text-slate-400 mt-0.5">BB: ${beratBadan} | TB: ${tinggiBadan}</span>
                    </div>
                </td>

                <td class="px-6 py-5 text-center whitespace-nowrap">
                    <div class="flex items-center justify-center gap-2">
                        <button onclick='openModal("edit", ${JSON.stringify(anak).replace(/'/g, "&#39;")})' class="w-9 h-9 flex items-center justify-center rounded-xl bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 transition-all hover:bg-blue-600 hover:text-white" title="Edit Data">
                            <i class="fa-solid fa-pen-to-square text-sm"></i>
                        </button>
                        <button onclick='deleteData("${anak._id || anak.id}")' class="w-9 h-9 flex items-center justify-center rounded-xl bg-rose-50 dark:bg-rose-900/30 text-rose-600 dark:text-rose-400 transition-all hover:bg-rose-600 hover:text-white" title="Hapus Data">
                            <i class="fa-solid fa-trash-can text-sm"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `;
        });
        tableBody.innerHTML = html;
    }

    function openModal(mode, data = null) {
        document.getElementById('formErrorWrapper').classList.add('hidden');
        if (mode === 'tambah') {
            isEditMode = false;
            document.getElementById('modalTitle').innerText = 'Tambah Data Anak';
            document.getElementById('modalIcon').className = 'fa-solid fa-child-reaching';
            anakForm.reset();
            document.getElementById('anakId').value = '';
        } else if (mode === 'edit' && data) {
            isEditMode = true;
            document.getElementById('modalTitle').innerText = 'Edit Data Anak';
            document.getElementById('modalIcon').className = 'fa-solid fa-pen';

            document.getElementById('anakId').value = data._id || data.id;
            document.getElementById('id_ibu').value = data.id_ibu || '';
            document.getElementById('nik').value = data.nik || '';
            document.getElementById('nama_anak').value = data.nama_anak || '';
            document.getElementById('tgl_lahir').value = data.tgl_lahir || '';
            document.getElementById('jenis_kelamin').value = (data.jenis_kelamin === 'Laki-laki' ? 'L' : (data.jenis_kelamin === 'Perempuan' ? 'P' : data.jenis_kelamin)) || '';

            document.getElementById('bb_lahir').value = data.bb_lahir || '';
            document.getElementById('tb_lahir').value = data.tb_lahir || '';
            document.getElementById('berat_badan').value = data.berat_badan || '';
            document.getElementById('tinggi_badan').value = data.tinggi_badan || '';

            let tglPeriksa = data.tgl_pemeriksaan ? data.tgl_pemeriksaan.split('T')[0] : '';
            document.getElementById('tgl_pemeriksaan').value = tglPeriksa;
        }
        formModal.classList.remove('hidden');
    }

    function closeModal() {
        formModal.classList.add('hidden');
    }

    async function submitForm() {
        if (!anakForm.checkValidity()) {
            anakForm.reportValidity();
            return;
        }

        const formData = new FormData(anakForm);
        const dataObj = Object.fromEntries(formData.entries());

        let targetUrl = ENDPOINT;
        let pMethod = 'POST';

        if (isEditMode) {
            targetUrl = `${ENDPOINT}/${dataObj.id}`;
            pMethod = 'PUT';
        }

        const btnSubmit = document.getElementById('btnSubmit');
        const originalText = btnSubmit.innerHTML;
        btnSubmit.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i>';
        btnSubmit.disabled = true;

        try {
            const res = await fetch(targetUrl, {
                method: pMethod,
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                body: JSON.stringify(dataObj)
            });

            const result = await res.json();

            if (res.ok || res.status === 201) {
                closeModal();
                showNotification("Data berhasil disimpan!");
                fetchDataAnak();
            } else {
                throw new Error(result.message || result.pesan || "Gagal menyimpan data.");
            }
        } catch (error) {
            const errorEl = document.getElementById('formError');
            errorEl.innerText = error.message;
            document.getElementById('formErrorWrapper').classList.remove('hidden');
        } finally {
            btnSubmit.innerHTML = 'Simpan Data';
            btnSubmit.disabled = false;
        }
    }

    async function deleteData(id) {
        if (!confirm('Hapus data anak ini?')) return;

        try {
            const res = await fetch(`${ENDPOINT}/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            });

            if (res.ok) {
                showNotification("Data berhasil dihapus!");
                fetchDataAnak();
            } else {
                showNotification("Gagal menghapus data", true);
            }
        } catch (error) {
            showNotification("Kesalahan sistem", true);
        }
    }

    function showNotification(message, isError = false) {
        notificationMessage.innerText = message;
        const wrapper = notificationWrapper;
        if (isError) {
            wrapper.className = "mb-6 rounded-2xl bg-rose-50 dark:bg-rose-900/20 p-4 border border-rose-100 dark:border-rose-900/30 text-rose-700 dark:text-rose-400 transition-all";
            notificationIcon.className = "fa-solid fa-circle-exclamation";
        } else {
            wrapper.className = "mb-6 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20 p-4 border border-emerald-100 dark:border-emerald-900/30 text-emerald-700 dark:text-emerald-400 transition-all";
            notificationIcon.className = "fa-solid fa-check-circle";
        }
        wrapper.classList.remove('hidden');
        setTimeout(() => closeNotification(), 4000);
    }

    function closeNotification() {
        notificationWrapper.classList.add('hidden');
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