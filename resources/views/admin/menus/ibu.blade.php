@extends('layouts.admin')

@section('title', 'Data Profil Ibu - Prediksi Stunting')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50/50 p-6 md:p-8">
    <div class="mx-auto max-w-7xl">
        <!-- HEADER HALAMAN -->
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Manajemen Data Ibu</h1>
                <p class="mt-1 text-sm text-slate-500">Kelola master data Profil Ibu. Buat profil di sini sebelum mendaftarkan anak Anda.</p>
            </div>
            <!-- Tombol Tambah Profil Ibu -->
            <button onclick="openModal('tambah')" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition-all hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:scale-95">
                <i class="fa-solid fa-plus"></i>
                Tambah Profil Ibu
            </button>
        </div>

        <!-- NOTIFICATION CONTAINER -->
        <div id="notificationWrapper" class="hidden mb-6 rounded-lg p-4 border transition-all">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i id="notificationIcon" class="fa-solid fa-check-circle text-green-400"></i>
                </div>
                <div class="ml-3">
                    <h3 id="notificationMessage" class="text-sm font-medium text-green-800">Berhasil!</h3>
                </div>
                <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1.5">
                        <button onclick="closeNotification()" type="button" class="inline-flex rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABEL DATA -->
        <div class="flex flex-col bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <!-- Table Header -->
            <div class="flex items-center justify-between p-5 border-b border-slate-200 bg-slate-50/50">
                <h2 class="text-lg font-bold text-slate-800">Daftar Profil Ibu</h2>
                <button onclick="fetchDataIbu()" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-600 shadow-sm transition-colors hover:bg-slate-50">
                    <i class="fa-solid fa-rotate-right text-slate-400"></i> Refresh
                </button>
            </div>

            <!-- Table Wrapper -->
            <div class="overflow-x-auto relative">
                <!-- Loading State -->
                <div id="tableLoading" class="absolute inset-0 bg-white/80 z-10 flex items-center justify-center backdrop-blur-sm hidden">
                    <div class="flex flex-col items-center">
                        <i class="fa-solid fa-circle-notch fa-spin text-3xl text-indigo-600 mb-2"></i>
                        <span class="text-sm font-medium text-slate-600">Memuat data...</span>
                    </div>
                </div>

                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500 border-b border-slate-200">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-semibold">Nama Ibu</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Usia Ibu</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Tinggi Ibu</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Pendidikan</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Pekerjaan</th>
                            <th scope="col" class="px-6 py-4 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="divide-y divide-slate-100 bg-white">
                        <!-- Data will be injected here via Javascript -->
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="hidden py-12 px-6 text-center text-slate-500">
                <div class="flex flex-col items-center justify-center">
                    <div class="bg-slate-100 h-16 w-16 rounded-full flex items-center justify-center mb-3">
                        <i class="fa-solid fa-person-dress text-2xl text-slate-400"></i>
                    </div>
                    <p class="font-semibold text-slate-700 mb-1">Belum ada profil ibu</p>
                    <p class="text-sm text-slate-500 max-w-md mt-2">Buat Profil Orang Tua / Ibu terlebih dahulu sebelum memasukkan Data Anak agar saling terhubung dengan akurat.</p>
                </div>
            </div>
            
        </div>
    </div>
</main>

<!-- MODAL FORM -->
<div id="formModal" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-slate-100">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg font-semibold leading-6 text-slate-900 mb-4 flex items-center gap-2" id="modalTitle">
                                <i class="fa-solid fa-person-dress text-indigo-600"></i> Tambah Profil Ibu
                            </h3>
                            <form id="ibuForm" class="space-y-4">
                                <input type="hidden" id="profilId" name="id">
                                
                                <div>
                                    <label for="nama_ibu" class="block text-sm font-medium text-slate-700">Nama Lengkap Ibu <span class="text-rose-500">*</span></label>
                                    <input type="text" id="nama_ibu" name="nama_ibu" required class="mt-1 block w-full rounded-lg border-slate-300 border px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none sm:text-sm">
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="usia_ibu" class="block text-sm font-medium text-slate-700">Usia Ibu (Tahun) <span class="text-rose-500">*</span></label>
                                        <input type="number" id="usia_ibu" name="usia_ibu" min="15" required class="mt-1 block w-full rounded-lg border-slate-300 border px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="tinggi_ibu" class="block text-sm font-medium text-slate-700">Tinggi (cm) <span class="text-rose-500">*</span></label>
                                        <input type="number" step="0.1" id="tinggi_ibu" name="tinggi_ibu" min="100" required class="mt-1 block w-full rounded-lg border-slate-300 border px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none sm:text-sm">
                                    </div>
                                </div>

                                <div>
                                    <label for="pendidikan_ibu" class="block text-sm font-medium text-slate-700">Pendidikan Terakhir <span class="text-rose-500">*</span></label>
                                    <select id="pendidikan_ibu" name="pendidikan_ibu" required class="mt-1 block w-full rounded-lg border-slate-300 border px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none bg-white sm:text-sm text-slate-600">
                                        <option value="" disabled selected>Pilih Pendidikan...</option>
                                        <option value="Tidak Sekolah/Belum Lulus SD">Tidak Sekolah/Belum Lulus SD</option>
                                        <option value="SD/Sederajat">SD/Sederajat</option>
                                        <option value="SMP/Sederajat">SMP/Sederajat</option>
                                        <option value="SMA/SMK/Sederajat">SMA/SMK/Sederajat</option>
                                        <option value="Diploma/Sarjana">Diploma/Sarjana/Pascasarjana</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="pekerjaan_ibu" class="block text-sm font-medium text-slate-700">Pekerjaan <span class="text-rose-500">*</span></label>
                                    <select id="pekerjaan_ibu" name="pekerjaan_ibu" required class="mt-1 block w-full rounded-lg border-slate-300 border px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none bg-white sm:text-sm text-slate-600">
                                        <option value="" disabled selected>Pilih Pekerjaan...</option>
                                        <option value="Ibu Rumah Tangga">Ibu Rumah Tangga (Tidak bekerja)</option>
                                        <option value="Wiraswasta/Pekerja Lepas">Wiraswasta/Pekerja Lepas</option>
                                        <option value="Karyawan Swasta">Karyawan Swasta</option>
                                        <option value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                
                                <p id="formError" class="hidden text-sm text-red-500 mt-2 bg-red-50 p-2 rounded"></p>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" onclick="submitForm()" id="btnSubmit" class="inline-flex w-full justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto transition-colors">Simpan Data</button>
                    <button type="button" onclick="closeModal()" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto transition-colors">Batal</button>
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
    
    // Notification Elements
    const notifWrapper = document.getElementById('notificationWrapper');
    const notifMsg = document.getElementById('notificationMessage');
    const notifIcon = document.getElementById('notificationIcon');
    
    // State
    let isEditMode = false;

    // --- INIT ---
    document.addEventListener("DOMContentLoaded", () => {
        fetchDataIbu();
    });

    // --- FETCH DATA IBU ---
    async function fetchDataIbu() {
        tableLoading.classList.remove('hidden');
        emptyState.classList.add('hidden');
        
        try {
            const res = await fetch(API_IBU, { headers: { 'Accept': 'application/json' }});
            const responseData = await res.json();
            
            if (Array.isArray(responseData) && responseData.length > 0) {
                renderTable(responseData);
            } else {
                tableBody.innerHTML = '';
                emptyState.classList.remove('hidden');
            }
        } catch (error) {
            showNotification("Gagal mengambil data profil ibu dari server", true);
        } finally {
            tableLoading.classList.add('hidden');
        }
    }

    // --- RENDER TABLE ---
    function renderTable(dataArray) {
        let html = '';
        dataArray.forEach(ibu => {
            html += `
                <tr class="group transition-colors hover:bg-slate-50/70">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 flex items-center justify-center rounded-lg bg-pink-50 text-pink-500">
                                <i class="fa-solid fa-person-breastfeeding"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-bold text-slate-800">${ibu.nama_ibu}</span>
                                <span class="text-[11px] text-slate-500 text-indigo-400 font-semibold">${ibu.anak ? (ibu.anak.length + ' Anak terdaftar') : 'Belum ada anak terdaftar'}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-medium text-slate-800">${ibu.usia_ibu}</span> <span class="text-xs text-slate-500">Thn</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-medium text-slate-800">${ibu.tinggi_ibu}</span> <span class="text-xs text-slate-500">cm</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-slate-600">${ibu.pendidikan_ibu}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-slate-600">${ibu.pekerjaan_ibu}</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick='openModal("edit", ${JSON.stringify(ibu).replace(/'/g, "&#39;")})' class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white" title="Edit Data">
                                <i class="fa-solid fa-pen-to-square text-sm"></i>
                            </button>
                            <button onclick='deleteData("${ibu._id || ibu.id}")' class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white" title="Hapus Data">
                                <i class="fa-solid fa-trash-can text-sm"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });
        tableBody.innerHTML = html;
        emptyState.classList.add('hidden');
    }

    // --- MODAL HANDLING ---
    function openModal(mode, data = null) {
        document.getElementById('formError').classList.add('hidden');
        if (mode === 'tambah') {
            isEditMode = false;
            document.getElementById('modalTitle').innerHTML = '<i class="fa-solid fa-person-dress text-indigo-600"></i> Tambah Profil Ibu';
            ibuForm.reset();
            document.getElementById('profilId').value = '';
        } else if (mode === 'edit' && data) {
            isEditMode = true;
            document.getElementById('modalTitle').innerHTML = '<i class="fa-solid fa-pen text-indigo-600"></i> Edit Profil Ibu';
            
            document.getElementById('profilId').value = data._id || data.id; 
            document.getElementById('nama_ibu').value = data.nama_ibu || '';
            document.getElementById('usia_ibu').value = data.usia_ibu || '';
            document.getElementById('tinggi_ibu').value = data.tinggi_ibu || '';
            document.getElementById('pendidikan_ibu').value = data.pendidikan_ibu || '';
            document.getElementById('pekerjaan_ibu').value = data.pekerjaan_ibu || '';
        }
        formModal.classList.remove('hidden');
    }

    function closeModal() {
        formModal.classList.add('hidden');
    }

    // --- SUBMIT DATA (CREATE/UPDATE) ---
    async function submitForm() {
        if(!ibuForm.checkValidity()) {
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
        btnSubmit.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin mr-2"></i>Menyimpan...';
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
                let errorMsg = result.message || "Gagal menyimpan data.";
                if (result.errors || (typeof result === 'object' && !result.message)) {
                    const errs = result.errors || result;
                    errorMsg = Object.values(errs).flat().join(', ');
                }
                throw new Error(errorMsg);
            }
        } catch (error) {
            const errEl = document.getElementById('formError');
            errEl.innerText = error.message;
            errEl.classList.remove('hidden');
        } finally {
            btnSubmit.innerHTML = originalText;
            btnSubmit.disabled = false;
        }
    }

    // --- DELETE DATA ---
    async function deleteData(id) {
        if (!confirm('Apakah Anda yakin ingin menghapus profil ibu ini? Menu ini mungkin terkait dengan Data Anak yang sudah mendaftar.')) return;

        try {
            const res = await fetch(`${API_IBU}/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            });

            if (res.ok || res.status === 204) {
                showNotification("Data profil ibu berhasil dihapus!");
                fetchDataIbu();
            } else {
                const result = await res.json();
                showNotification(result.message || "Gagal menghapus data", true);
            }
        } catch (error) {
            showNotification("Terjadi kesalahan sistem", true);
        }
    }

    function showNotification(message, isError = false) {
        notifMsg.innerText = message;
        
        if (isError) {
            notifWrapper.className = "mb-6 rounded-lg bg-red-50 p-4 border border-red-200 transition-all";
            notifMsg.className = "text-sm font-medium text-red-800";
            notifIcon.className = "fa-solid fa-circle-exclamation text-red-400";
        } else {
            notifWrapper.className = "mb-6 rounded-lg bg-green-50 p-4 border border-green-200 transition-all";
            notifMsg.className = "text-sm font-medium text-green-800";
            notifIcon.className = "fa-solid fa-check-circle text-green-400";
        }
        
        notifWrapper.classList.remove('hidden');
        setTimeout(() => closeNotification(), 4000);
    }

    function closeNotification() {
        notifWrapper.classList.add('hidden');
    }
</script>
@endsection
