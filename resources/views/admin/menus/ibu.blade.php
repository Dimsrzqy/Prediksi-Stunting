@extends('layouts.admin')

@section('title', 'Data Profil Ibu - Prediksi Stunting')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50/50 dark:bg-slate-950/50 p-6 md:p-8 transition-colors duration-300">
    <div class="mx-auto max-w-7xl">
        <!-- HEADER HALAMAN -->
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">Manajemen Data Ibu</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400 font-medium">Kelola master data Profil Ibu. Buat profil di sini sebelum mendaftarkan data anak.</p>
            </div>
            <!-- Tombol Ekspor Excel -->
            <a href="{{ route('ibu.export') }}" class="flex items-center gap-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2.5 text-sm font-bold text-slate-700 dark:text-slate-300 shadow-sm transition-all hover:bg-slate-50 dark:hover:bg-slate-800 hover:border-indigo-200 dark:hover:border-indigo-900 hover:text-indigo-600 dark:hover:text-indigo-400">
                <i class="fa-solid fa-file-excel text-emerald-600 dark:text-emerald-500"></i>
                Ekspor Excel
            </a>
            <button onclick="openModal('tambah')" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition-all hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 active:scale-95">
                <i class="fa-solid fa-plus"></i>
                Tambah Profil Ibu
            </button>
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

        <!-- TABEL DATA -->
        <div class="flex flex-col bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-sm overflow-hidden transition-colors">
            <!-- Table Header -->
            <div class="flex items-center justify-between p-5 border-b border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
                <h2 class="text-lg font-bold text-slate-800 dark:text-slate-200 tracking-tight">Daftar Profil Ibu</h2>
                <button onclick="fetchDataIbu()" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2 text-sm font-bold text-slate-600 dark:text-slate-400 shadow-sm transition-all hover:bg-slate-50 dark:hover:bg-slate-700 active:scale-95">
                    <i class="fa-solid fa-rotate-right text-slate-400 dark:text-slate-500"></i> Refresh
                </button>
            </div>

            <!-- Table Wrapper -->
            <div class="overflow-x-auto relative no-scrollbar">
                <!-- Loading State -->
                <div id="tableLoading" class="absolute inset-0 bg-white/80 dark:bg-slate-900/80 z-20 flex items-center justify-center backdrop-blur-sm hidden transition-all">
                    <div class="flex flex-col items-center">
                        <i class="fa-solid fa-circle-notch fa-spin text-3xl text-indigo-600 mb-3"></i>
                        <span class="text-sm font-bold text-slate-600 dark:text-slate-400">Memuat data...</span>
                    </div>
                </div>

                <table class="w-full text-left text-sm text-slate-600 dark:text-slate-400">
                    <thead class="bg-slate-50 dark:bg-slate-900/80 text-[11px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-500 border-b border-slate-200 dark:border-slate-800">
                        <tr>
                            <th scope="col" class="px-6 py-4">Nama Ibu</th>
                            <th scope="col" class="px-6 py-4">Usia</th>
                            <th scope="col" class="px-6 py-4">Tinggi (cm)</th>
                            <th scope="col" class="px-6 py-4">Pendidikan</th>
                            <th scope="col" class="px-6 py-4">Pekerjaan</th>
                            <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="divide-y divide-slate-100 dark:divide-slate-800 bg-white dark:bg-slate-900 transition-colors">
                        <!-- Data will be injected here via Javascript -->
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="hidden py-20 px-6 text-center transition-all">
                <div class="flex flex-col items-center justify-center">
                    <div class="bg-slate-100 dark:bg-slate-800 h-20 w-20 rounded-3xl flex items-center justify-center mb-5 shadow-inner">
                        <i class="fa-solid fa-person-dress text-3xl text-slate-300 dark:text-slate-600"></i>
                    </div>
                    <p class="font-bold text-xl text-slate-800 dark:text-slate-200 tracking-tight">Belum Ada Profil Ibu</p>
                    <p class="text-sm text-slate-500 dark:text-slate-500 mt-2 max-w-xs mx-auto">Silakan buat profil ibu kandung terlebih dahulu sebelum mendaftarkan data anak.</p>
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
            <div class="relative transform overflow-hidden rounded-[32px] bg-white dark:bg-slate-900 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-slate-200 dark:border-slate-800">

                <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-900/50">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-2xl bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center shadow-sm">
                            <i id="modalIcon" class="fa-solid fa-person-dress"></i>
                        </div>
                        <h3 id="modalTitle" class="text-xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">Tambah Profil Ibu</h3>
                    </div>
                    <button type="button" onclick="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-full text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="px-6 py-6">
                    <form id="ibuForm" class="space-y-5">
                        @csrf
                        <input type="hidden" id="profilId" name="id">

                        <div>
                            <label for="nama_ibu" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Nama Lengkap Ibu <span class="text-rose-500">*</span></label>
                            <input type="text" id="nama_ibu" name="nama_ibu" required class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all" placeholder="Nama Ibu">
                        </div>

                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <label for="usia_ibu" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Usia (Tahun) <span class="text-rose-500">*</span></label>
                                <input type="number" id="usia_ibu" name="usia_ibu" min="15" required class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all" placeholder="25">
                            </div>
                            <div>
                                <label for="tinggi_ibu" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Tinggi (cm) <span class="text-rose-500">*</span></label>
                                <input type="number" step="0.1" id="tinggi_ibu" name="tinggi_ibu" min="100" required class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all" placeholder="155.5">
                            </div>
                        </div>

                        <div>
                            <label for="pendidikan_ibu" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Pendidikan Terakhir <span class="text-rose-500">*</span></label>
                            <select id="pendidikan_ibu" name="pendidikan_ibu" required class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all appearance-none">
                                <option value="" disabled selected>Pilih Pendidikan...</option>
                                <option value="Tidak Sekolah/Belum Lulus SD">Tidak Sekolah/Belum Lulus SD</option>
                                <option value="SD/Sederajat">SD/Sederajat</option>
                                <option value="SMP/Sederajat">SMP/Sederajat</option>
                                <option value="SMA/SMK/Sederajat">SMA/SMK/Sederajat</option>
                                <option value="Diploma/Sarjana">Diploma/Sarjana/Pascasarjana</option>
                            </select>
                        </div>

                        <div>
                            <label for="pekerjaan_ibu" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Pekerjaan <span class="text-rose-500">*</span></label>
                            <select id="pekerjaan_ibu" name="pekerjaan_ibu" required class="block w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border transition-all appearance-none">
                                <option value="" disabled selected>Pilih Pekerjaan...</option>
                                <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                                <option value="Wiraswasta/Pekerja Lepas">Wiraswasta/Pekerja Lepas</option>
                                <option value="Karyawan Swasta">Karyawan Swasta</option>
                                <option value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
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
    const API_IBU = '/api-ibu';

    const formModal = document.getElementById('formModal');
    const ibuForm = document.getElementById('ibuForm');
    const tableBody = document.getElementById('tableBody');
    const tableLoading = document.getElementById('tableLoading');
    const emptyState = document.getElementById('emptyState');
    const notifWrapper = document.getElementById('notificationWrapper');
    const notifMsg = document.getElementById('notificationMessage');
    const notifIcon = document.getElementById('notificationIcon');

    let isEditMode = false;

    document.addEventListener("DOMContentLoaded", () => {
        fetchDataIbu();
    });

    async function fetchDataIbu() {
        tableLoading.classList.remove('hidden');
        emptyState.classList.add('hidden');

        try {
            const res = await fetch(API_IBU, {
                headers: {
                    'Accept': 'application/json'
                }
            });
            const responseData = await res.json();
            const dataArray = responseData.data || responseData;

            if (Array.isArray(dataArray) && dataArray.length > 0) {
                renderTable(dataArray);
                emptyState.classList.add('hidden');
            } else {
                tableBody.innerHTML = '';
                emptyState.classList.remove('hidden');
            }
        } catch (error) {
            showNotification("Gagal mengambil data dari server", true);
        } finally {
            tableLoading.classList.add('hidden');
        }
    }

    function renderTable(dataArray) {
        let html = '';
        dataArray.forEach(ibu => {
            html += `
                <tr class="group transition-colors hover:bg-slate-50/70 dark:hover:bg-slate-800/40">
                    <td class="px-6 py-5 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 flex items-center justify-center rounded-xl bg-pink-50 dark:bg-pink-900/30 text-pink-500 dark:text-pink-400 shadow-sm">
                                <i class="fa-solid fa-person-breastfeeding"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-bold text-slate-800 dark:text-slate-200 tracking-tight">${ibu.nama_ibu}</span>
                                <span class="text-[10px] text-indigo-500 dark:text-indigo-400 font-black uppercase tracking-wider">${ibu.anak ? (ibu.anak.length + ' ANAK TERDAFTAR') : 'BELUM ADA ANAK'}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap">
                        <span class="font-bold text-slate-700 dark:text-slate-300 text-sm">${ibu.usia_ibu}</span> <span class="text-[10px] font-bold text-slate-400">THN</span>
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap">
                        <span class="font-bold text-slate-700 dark:text-slate-300 text-sm">${ibu.tinggi_ibu}</span> <span class="text-[10px] font-bold text-slate-400">CM</span>
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap">
                        <span class="text-sm font-semibold text-slate-600 dark:text-slate-400">${ibu.pendidikan_ibu}</span>
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap">
                        <span class="text-sm font-semibold text-slate-600 dark:text-slate-400">${ibu.pekerjaan_ibu}</span>
                    </td>
                    <td class="px-6 py-5 text-center whitespace-nowrap">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick='openModal("edit", ${JSON.stringify(ibu).replace(/'/g, "&#39;")})' class="w-9 h-9 flex items-center justify-center rounded-xl bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 transition-all hover:bg-blue-600 hover:text-white" title="Edit Data">
                                <i class="fa-solid fa-pen-to-square text-sm"></i>
                            </button>
                            <button onclick='deleteData("${ibu._id || ibu.id}")' class="w-9 h-9 flex items-center justify-center rounded-xl bg-rose-50 dark:bg-rose-900/30 text-rose-600 dark:text-rose-400 transition-all hover:bg-rose-600 hover:text-white" title="Hapus Data">
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
            document.getElementById('modalTitle').innerText = 'Tambah Profil Ibu';
            document.getElementById('modalIcon').className = 'fa-solid fa-person-dress';
            ibuForm.reset();
            document.getElementById('profilId').value = '';
        } else if (mode === 'edit' && data) {
            isEditMode = true;
            document.getElementById('modalTitle').innerText = 'Edit Profil Ibu';
            document.getElementById('modalIcon').className = 'fa-solid fa-pen';

            document.getElementById('profilId').value = data._id || data.id;
            document.getElementById('nama_ibu').value = data.nama_ibu || '';
            document.getElementById('usia_ibu').value = data.usia_ibu || '';
            document.getElementById('tinggi_ibu').value = data.tinggi_ibu || '';

            const setSelectVal = (id, val) => {
                const el = document.getElementById(id);
                if (!val) {
                    el.value = '';
                    return;
                }
                const isExists = Array.from(el.options).some(o => o.value == val);
                if (!isExists) el.add(new Option(val, val));
                el.value = val;
            };

            setSelectVal('pendidikan_ibu', data.pendidikan_ibu);
            setSelectVal('pekerjaan_ibu', data.pekerjaan_ibu);
        }
        formModal.classList.remove('hidden');
    }

    function closeModal() {
        formModal.classList.add('hidden');
    }

    async function submitForm() {
        if (!ibuForm.checkValidity()) {
            ibuForm.reportValidity();
            return;
        }

        const formData = new FormData(ibuForm);
        const dataObj = Object.fromEntries(formData.entries());

        let targetUrl = API_IBU;
        let pMethod = 'POST';

        if (isEditMode) {
            targetUrl = `${API_IBU}/${dataObj.id}`;
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
                showNotification("Profil Ibu berhasil disimpan!");
                fetchDataIbu();
            } else {
                throw new Error(result.message || "Gagal menyimpan data.");
            }
        } catch (error) {
            const errEl = document.getElementById('formError');
            errEl.innerText = error.message;
            document.getElementById('formErrorWrapper').classList.remove('hidden');
        } finally {
            btnSubmit.innerHTML = 'Simpan Data';
            btnSubmit.disabled = false;
        }
    }

    async function deleteData(id) {
        if (!confirm('Hapus profil ibu ini?')) return;

        try {
            const res = await fetch(`${API_IBU}/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            });

            if (res.ok) {
                showNotification("Data berhasil dihapus!");
                fetchDataIbu();
            } else {
                const result = await res.json();
                showNotification(result.message || "Gagal menghapus data", true);
            }
        } catch (error) {
            showNotification("Kesalahan sistem", true);
        }
    }

    function showNotification(message, isError = false) {
        notifMsg.innerText = message;
        if (isError) {
            notifWrapper.className = "mb-6 rounded-2xl bg-rose-50 dark:bg-rose-900/20 p-4 border border-rose-100 dark:border-rose-900/30 text-rose-700 dark:text-rose-400 transition-all";
            notifIcon.className = "fa-solid fa-circle-exclamation";
        } else {
            notifWrapper.className = "mb-6 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20 p-4 border border-emerald-100 dark:border-emerald-900/30 text-emerald-700 dark:text-emerald-400 transition-all";
            notifIcon.className = "fa-solid fa-check-circle";
        }
        notifWrapper.classList.remove('hidden');
        setTimeout(() => closeNotification(), 4000);
    }

    function closeNotification() {
        notifWrapper.classList.add('hidden');
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