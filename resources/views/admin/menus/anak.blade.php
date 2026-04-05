@extends('layouts.admin')

@section('title', 'Data Anak - Prediksi Stunting')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50/50 p-6 md:p-8">
    <div class="mx-auto max-w-7xl">
        <!-- HEADER HALAMAN -->
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Manajemen Data Anak</h1>
                <p class="mt-1 text-sm text-slate-500">Kelola daftar anak untuk pencatatan prediksi stunting dan pemantauan.</p>
            </div>
            <button onclick="openModal('tambah')" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition-all hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:scale-95">
                <i class="fa-solid fa-plus"></i>
                Tambah Data Anak
            </button>
        </div>

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
                        <button onclick="closeNotification()" type="button" class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABEL DATA -->
        <div class="flex flex-col bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="flex items-center justify-between p-5 border-b border-slate-200 bg-slate-50/50">
                <h2 class="text-lg font-bold text-slate-800">Daftar Anak</h2>
                <button onclick="fetchDataAnak()" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-600 shadow-sm transition-colors hover:bg-slate-50">
                    <i class="fa-solid fa-rotate-right text-slate-400"></i> Refresh
                </button>
            </div>

            <div class="overflow-x-auto relative">
                <div id="tableLoading" class="absolute inset-0 bg-white/80 z-10 flex items-center justify-center backdrop-blur-sm hidden">
                    <div class="flex flex-col items-center">
                        <i class="fa-solid fa-circle-notch fa-spin text-3xl text-indigo-600 mb-2"></i>
                        <span class="text-sm font-medium text-slate-600">Memuat data...</span>
                    </div>
                </div>

                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500 border-b border-slate-200">
                        <tr>
                            <th scope="col" class="px-4 py-4 font-semibold">NIK</th>
                            <th scope="col" class="px-4 py-4 font-semibold">Nama Anak</th>
                            <th scope="col" class="px-4 py-4 font-semibold">Tgl Lahir / Usia</th>
                            <th scope="col" class="px-4 py-4 font-semibold">Jenis Kelamin</th>
                            <th scope="col" class="px-4 py-4 font-semibold">Nama Ibu (Ortu)</th>
                            <th scope="col" class="px-4 py-4 font-semibold">Data Lahir</th>
                            <th scope="col" class="px-4 py-4 font-semibold">Pemeriksaan Tkh</th>
                            <th scope="col" class="px-4 py-4 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="divide-y divide-slate-100 bg-white">
                        <!-- Data injected by JS -->
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="hidden py-12 px-6 text-center text-slate-500">
                <div class="flex flex-col items-center justify-center">
                    <div class="bg-slate-100 h-16 w-16 rounded-full flex items-center justify-center mb-3">
                        <i class="fa-solid fa-child-reaching text-2xl text-slate-400"></i>
                    </div>
                    <p class="font-semibold text-slate-700 mb-1">Belum ada data anak</p>
                    <p class="text-sm">Silakan tambahkan data anak untuk mulai memantau.</p>
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
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-slate-100">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i id="modalIcon" class="fa-solid fa-child-reaching text-indigo-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                            <h3 id="modalTitle" class="text-lg font-semibold leading-6 text-slate-900" id="modal-title">Tambah Data Anak</h3>
                            <div class="mt-4">
                                <form id="anakForm" class="space-y-4">
                                    <input type="hidden" id="anakId" name="id">

                                    <div>
                                        <label for="id_ibu" class="flex justify-between items-center text-sm font-medium text-slate-700">
                                            <span>Pilih Ortu/Ibu Kandung <span class="text-rose-500">*</span></span>
                                            <a href="/ibu" class="text-xs text-indigo-600 hover:underline">Kelola Data Ibu</a>
                                        </label>
                                        <select id="id_ibu" name="id_ibu" required class="mt-1 block w-full rounded-lg border-slate-300 border px-3 py-2.5 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 bg-white sm:text-sm">
                                            <option value="" disabled selected>Memuat data orang tua...</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="nik" class="block text-sm font-medium text-slate-700">NIK (Nomor Induk Kependudukan) <span class="text-rose-500">*</span></label>
                                        <input type="text" id="nik" name="nik" required class="mt-1 block w-full rounded-lg border-slate-300 border px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <div>
                                        <label for="nama_anak" class="block text-sm font-medium text-slate-700">Nama Lengkap Anak <span class="text-rose-500">*</span></label>
                                        <input type="text" id="nama_anak" name="nama_anak" required class="mt-1 block w-full rounded-lg border-slate-300 border px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="tgl_lahir" class="block text-sm font-medium text-slate-700">Tanggal Lahir <span class="text-rose-500">*</span></label>
                                            <input type="date" id="tgl_lahir" name="tgl_lahir" required class="mt-1 block w-full rounded-lg border-slate-300 border px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                        <div>
                                            <label for="jenis_kelamin" class="block text-sm font-medium text-slate-700">Jenis Kelamin <span class="text-rose-500">*</span></label>
                                            <select id="jenis_kelamin" name="jenis_kelamin" required class="mt-1 block w-full rounded-lg border-slate-300 border px-3 py-2.5 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm bg-white">
                                                <option value="" disabled selected>Pilih...</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="bb_lahir" class="block text-sm font-medium text-slate-700">BB Lahir (kg)</label>
                                            <input type="number" step="0.01" id="bb_lahir" name="bb_lahir" placeholder="Contoh: 3.2" class="mt-1 block w-full rounded-lg border-slate-300 border px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                        <div>
                                            <label for="tb_lahir" class="block text-sm font-medium text-slate-700">TB Lahir (cm)</label>
                                            <input type="number" step="0.1" id="tb_lahir" name="tb_lahir" placeholder="Contoh: 50.5" class="mt-1 block w-full rounded-lg border-slate-300 border px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                    </div>

                                    <div class="border-t border-slate-200 pt-4 mt-2">
                                        <h4 class="text-sm font-semibold text-slate-800 mb-3">Data Pemeriksaan Terakhir</h4>
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                            <div>
                                                <label for="berat_badan" class="block text-sm font-medium text-slate-700">Berat Badan (kg)</label>
                                                <input type="number" step="0.01" id="berat_badan" name="berat_badan" class="mt-1 block w-full rounded-lg border-slate-300 border px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <label for="tinggi_badan" class="block text-sm font-medium text-slate-700">Tinggi Badan (cm)</label>
                                                <input type="number" step="0.1" id="tinggi_badan" name="tinggi_badan" class="mt-1 block w-full rounded-lg border-slate-300 border px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <label for="tgl_pemeriksaan" class="block text-sm font-medium text-slate-700">Tgl Pemeriksaan</label>
                                                <input type="date" id="tgl_pemeriksaan" name="tgl_pemeriksaan" class="mt-1 block w-full rounded-lg border-slate-300 border px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hidden">
                                        <p id="formError" class="text-sm text-red-500 mt-2 bg-red-50 p-2 rounded"></p>
                                    </div>
                                </form>
                            </div>
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
    const ENDPOINT = '/api-anak';
    const ENDPOINT_IBU = '/api-ibu';

    const formModal = document.getElementById('formModal');
    const anakForm = document.getElementById('anakForm');
    const tableBody = document.getElementById('tableBody');
    const tableLoading = document.getElementById('tableLoading');
    const emptyState = document.getElementById('emptyState');
    const notificationWrapper = document.getElementById('notificationWrapper');
    const notificationMessage = document.getElementById('notificationMessage');

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
            dataIbuArr = result || [];

            const dropdown = document.getElementById('id_ibu');
            if (dataIbuArr.length === 0) {
                dropdown.innerHTML = '<option value="" disabled selected>Belum ada data Profil Ibu. Tambahkan di menu Data Ibu.</option>';
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
        try {
            const res = await fetch(ENDPOINT, {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            });
            const response = await res.json();

            if (response.data && response.data.length > 0) {
                renderTable(response.data);
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
                `<span class="inline-flex items-center gap-1.5 rounded-full bg-blue-100 px-2.5 py-1 text-[11px] font-semibold text-blue-700"><i class="fa-solid fa-mars"></i> Laki-laki</span>` :
                `<span class="inline-flex items-center gap-1.5 rounded-full bg-pink-100 px-2.5 py-1 text-[11px] font-semibold text-pink-700"><i class="fa-solid fa-venus"></i> Perempuan</span>`;

            const namaIbu = anak.ibu ? anak.ibu.nama_ibu : (anak.nama_ortu ? `${anak.nama_ortu} <span class="text-xs text-amber-500/80 italic">(Belum Tertaut)</span>` : '<span class="text-rose-400">Belum Tertaut</span>');

            // Menyiapkan format teks untuk data baru
            const bbLahir = anak.bb_lahir ? `${anak.bb_lahir} kg` : '-';
            const tbLahir = anak.tb_lahir ? `${anak.tb_lahir} cm` : '-';
            const beratBadan = anak.berat_badan ? `${anak.berat_badan} kg` : '-';
            const tinggiBadan = anak.tinggi_badan ? `${anak.tinggi_badan} cm` : '-';
            const tglPeriksa = anak.tgl_pemeriksaan ? anak.tgl_pemeriksaan.split('T')[0] : '-';

            html += `
            <tr class="group transition-colors hover:bg-slate-50/70">
                <td class="px-4 py-4">
                    <span class="font-medium text-slate-800">${anak.nik || '-'}</span>
                </td>
                <td class="px-4 py-4">
                    <span class="font-bold text-slate-800">${anak.nama_anak}</span>
                </td>
                <td class="px-4 py-4">
                    <div class="flex flex-col">
                        <span class="font-medium text-slate-800">${anak.tgl_lahir || '-'}</span>
                        <span class="text-xs text-slate-500 mt-0.5">Umur: ${umurText}</span>
                    </div>
                </td>
                <td class="px-4 py-4">
                    ${genderBadge}
                </td>
                <td class="px-4 py-4">
                    <span class="text-sm text-slate-600">${namaIbu}</span>
                </td>
                
                <td class="px-4 py-4">
                    <div class="flex flex-col text-xs">
                        <span class="text-slate-700"><span class="text-slate-500">BB:</span> ${bbLahir}</span>
                        <span class="text-slate-700 mt-0.5"><span class="text-slate-500">TB:</span> ${tbLahir}</span>
                    </div>
                </td>

                <td class="px-4 py-4">
                    <div class="flex flex-col text-xs">
                        <span class="text-slate-700 font-medium whitespace-nowrap"><i class="fa-regular fa-calendar text-slate-400 mr-1"></i> ${tglPeriksa}</span>
                        <span class="text-slate-700 mt-0.5">BB: ${beratBadan} | TB: ${tinggiBadan}</span>
                    </div>
                </td>

                <td class="px-4 py-4 text-center">
                    <div class="flex items-center justify-center gap-2">
                        <button onclick='openModal("edit", ${JSON.stringify(anak).replace(/'/g, "&#39;")})' class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600 transition-colors hover:bg-blue-600 hover:text-white" title="Edit Data">
                            <i class="fa-solid fa-pen-to-square text-sm"></i>
                        </button>
                        <button onclick='deleteData("${anak._id || anak.id}")' class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-50 text-rose-600 transition-colors hover:bg-rose-600 hover:text-white" title="Hapus Data">
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

    function openModal(mode, data = null) {
        document.getElementById('formError').parentElement.classList.add('hidden');
        if (mode === 'tambah') {
            isEditMode = false;
            document.getElementById('modalTitle').innerText = 'Tambah Data Anak';
            document.getElementById('modalIcon').className = 'fa-solid fa-child-reaching text-indigo-600';
            anakForm.reset();
            document.getElementById('anakId').value = '';
        } else if (mode === 'edit' && data) {
            isEditMode = true;
            document.getElementById('modalTitle').innerText = 'Edit Data Anak';
            document.getElementById('modalIcon').className = 'fa-solid fa-pen text-indigo-600';

            // Populate Data Utama
            document.getElementById('anakId').value = data._id || data.id;
            document.getElementById('id_ibu').value = data.id_ibu || '';
            document.getElementById('nik').value = data.nik || '';
            document.getElementById('nama_anak').value = data.nama_anak || '';
            document.getElementById('tgl_lahir').value = data.tgl_lahir || '';
            document.getElementById('jenis_kelamin').value = (data.jenis_kelamin === 'Laki-laki' ? 'L' : (data.jenis_kelamin === 'Perempuan' ? 'P' : data.jenis_kelamin)) || '';

            // Populate Data Tambahan (Pemeriksaan & Lahir)
            document.getElementById('bb_lahir').value = data.bb_lahir || '';
            document.getElementById('tb_lahir').value = data.tb_lahir || '';
            document.getElementById('berat_badan').value = data.berat_badan || '';
            document.getElementById('tinggi_badan').value = data.tinggi_badan || '';

            // Memastikan format tanggal benar untuk input type="date" jika ada timestamp waktu
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
                showNotification(result.pesan || "Data berhasil disimpan!");
                fetchDataAnak();
            } else {
                throw new Error(result.message || result.pesan || "Terjadi kesalahan!");
            }
        } catch (error) {
            document.getElementById('formError').innerText = error.message;
            document.getElementById('formError').parentElement.classList.remove('hidden');
        } finally {
            btnSubmit.innerHTML = 'Simpan Data';
            btnSubmit.disabled = false;
        }
    }

    async function deleteData(id) {
        if (!confirm('Apakah Anda yakin ingin menghapus data anak ini? Data tidak dapat dikembalikan.')) return;

        try {
            const res = await fetch(`${ENDPOINT}/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            });

            const result = await res.json();

            if (res.ok) {
                showNotification(result.pesan || "Data berhasil dihapus!");
                fetchDataAnak();
            } else {
                showNotification(result.pesan || "Gagal menghapus data", true);
            }
        } catch (error) {
            showNotification("Terjadi kesalahan sistem", true);
        }
    }

    function showNotification(message, isError = false) {
        notificationMessage.innerText = message;

        const wrapper = notificationWrapper;
        if (isError) {
            wrapper.className = "mb-6 rounded-lg bg-red-50 p-4 border border-red-200";
            notificationMessage.className = "text-sm font-medium text-red-800";
            wrapper.querySelector('i').className = "fa-solid fa-circle-exclamation text-red-400";
        } else {
            wrapper.className = "mb-6 rounded-lg bg-green-50 p-4 border border-green-200";
            notificationMessage.className = "text-sm font-medium text-green-800";
            wrapper.querySelector('i').className = "fa-solid fa-check-circle text-green-400";
        }

        wrapper.classList.remove('hidden');
        setTimeout(() => closeNotification(), 4000);
    }

    function closeNotification() {
        notificationWrapper.classList.add('hidden');
    }
</script>
@endsection