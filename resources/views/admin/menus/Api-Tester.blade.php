@extends('layouts.admin')

@section('title', 'API Tester - Prediksi Stunting')

@section('content')
<main class="flex-1 bg-slate-50/50 dark:bg-slate-950/50 p-6 md:p-8 overflow-y-auto overflow-x-hidden transition-colors duration-300">
    <div class="mx-auto max-w-7xl">

        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-1">
                <div class="flex items-center justify-center w-10 h-10 rounded-2xl bg-gradient-to-br from-violet-500 to-purple-600 shadow-lg shadow-violet-500/30">
                    <i class="fa-solid fa-satellite-dish text-white text-lg"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">API Tester</h1>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Uji coba endpoint API secara langsung dari browser.</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Panel Kiri: Request Builder --}}
            <div class="flex flex-col gap-5">

                {{-- URL & Method --}}
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm p-5 transition-colors">
                    <h2 class="text-sm font-bold text-slate-700 dark:text-slate-300 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-link text-violet-500"></i> Request
                    </h2>
                    <div class="flex gap-2">
                        <select id="httpMethod" class="rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-sm font-bold px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-violet-500 transition-all">
                            <option value="GET">GET</option>
                            <option value="POST">POST</option>
                            <option value="PUT">PUT</option>
                            <option value="PATCH">PATCH</option>
                            <option value="DELETE">DELETE</option>
                        </select>
                        <input id="requestUrl" type="url" placeholder="https://example.com/api/endpoint"
                            class="flex-1 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-sm px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-violet-500 transition-all placeholder:text-slate-400">
                    </div>
                    <button id="btnSend" onclick="sendRequest()"
                        class="mt-3 w-full inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-violet-600 to-purple-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-violet-500/30 hover:from-violet-700 hover:to-purple-700 active:scale-[0.98] transition-all">
                        <i class="fa-solid fa-paper-plane"></i> Kirim Request
                    </button>
                </div>

                {{-- Headers --}}
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm p-5 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-sm font-bold text-slate-700 dark:text-slate-300 flex items-center gap-2">
                            <i class="fa-solid fa-sliders text-violet-500"></i> Headers
                        </h2>
                        <button onclick="addHeader()" class="text-xs font-semibold text-violet-600 dark:text-violet-400 hover:text-violet-700 flex items-center gap-1 transition-colors">
                            <i class="fa-solid fa-plus"></i> Tambah
                        </button>
                    </div>
                    <div id="headersContainer" class="space-y-2">
                        <div class="flex gap-2 header-row">
                            <input type="text" placeholder="Key" class="header-key flex-1 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs px-3 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400 transition-all">
                            <input type="text" placeholder="Value" class="header-val flex-1 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs px-3 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400 transition-all">
                            <button onclick="this.closest('.header-row').remove()" class="w-8 h-8 flex items-center justify-center rounded-xl text-slate-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-colors flex-shrink-0">
                                <i class="fa-solid fa-xmark text-xs"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <button onclick="addPresetHeader('Content-Type','application/json')" class="text-xs rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 px-2.5 py-1 hover:bg-violet-100 dark:hover:bg-violet-900/30 hover:text-violet-600 dark:hover:text-violet-400 transition-colors">+ Content-Type: JSON</button>
                        <button onclick="addPresetHeader('Accept','application/json')" class="text-xs rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 px-2.5 py-1 hover:bg-violet-100 dark:hover:bg-violet-900/30 hover:text-violet-600 dark:hover:text-violet-400 transition-colors">+ Accept: JSON</button>
                        <button onclick="addPresetHeader('Authorization','Bearer ')" class="text-xs rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 px-2.5 py-1 hover:bg-violet-100 dark:hover:bg-violet-900/30 hover:text-violet-600 dark:hover:text-violet-400 transition-colors">+ Authorization</button>
                    </div>
                </div>

                {{-- Body --}}
                <div id="bodyPanel" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm p-5 transition-colors">
                    <h2 class="text-sm font-bold text-slate-700 dark:text-slate-300 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-code text-violet-500"></i> Body (JSON)
                    </h2>
                    <textarea id="requestBody" rows="6" placeholder='{\n  "key": "value"\n}'
                        class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs font-mono px-4 py-3 focus:outline-none focus:ring-2 focus:ring-violet-400 transition-all resize-none"></textarea>
                    <button onclick="formatJson()" class="mt-2 text-xs font-semibold text-violet-600 dark:text-violet-400 hover:text-violet-700 flex items-center gap-1 transition-colors">
                        <i class="fa-solid fa-wand-magic-sparkles"></i> Format JSON
                    </button>
                </div>

            </div>

            {{-- Panel Kanan: Response --}}
            <div class="flex flex-col gap-5">

                {{-- Status Bar --}}
                <div id="statusBar" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm p-5 transition-colors hidden">
                    <div class="flex items-center justify-between flex-wrap gap-3">
                        <div class="flex items-center gap-3">
                            <span id="statusBadge" class="inline-flex items-center gap-1.5 rounded-xl px-3 py-1.5 text-sm font-bold"></span>
                            <span id="statusText" class="text-sm text-slate-500 dark:text-slate-400 font-medium"></span>
                        </div>
                        <div class="flex items-center gap-4 text-xs text-slate-400 dark:text-slate-500">
                            <span id="respTime" class="flex items-center gap-1.5"><i class="fa-regular fa-clock"></i> <span></span></span>
                            <span id="respSize" class="flex items-center gap-1.5"><i class="fa-solid fa-weight-scale"></i> <span></span></span>
                        </div>
                    </div>
                </div>

                {{-- Tabs --}}
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden transition-colors flex-1">
                    <div class="flex border-b border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
                        <button onclick="switchTab('body')" id="tab-body"
                            class="tab-btn px-5 py-3.5 text-sm font-semibold border-b-2 border-violet-500 text-violet-600 dark:text-violet-400 transition-all">
                            Body
                        </button>
                        <button onclick="switchTab('headers')" id="tab-headers"
                            class="tab-btn px-5 py-3.5 text-sm font-semibold border-b-2 border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 transition-all">
                            Headers
                        </button>
                    </div>

                    {{-- Loading State --}}
                    <div id="loadingState" class="hidden flex-col items-center justify-center py-16 gap-4">
                        <div class="w-12 h-12 rounded-full border-4 border-violet-200 dark:border-violet-900 border-t-violet-600 animate-spin"></div>
                        <p class="text-sm text-slate-400 dark:text-slate-500 font-medium">Mengirim request...</p>
                    </div>

                    {{-- Empty State --}}
                    <div id="emptyState" class="flex flex-col items-center justify-center py-16 gap-3">
                        <div class="w-14 h-14 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center">
                            <i class="fa-solid fa-satellite-dish text-2xl text-slate-300 dark:text-slate-600"></i>
                        </div>
                        <p class="text-sm font-semibold text-slate-400 dark:text-slate-500">Belum ada response</p>
                        <p class="text-xs text-slate-300 dark:text-slate-600">Kirim request untuk melihat hasilnya</p>
                    </div>

                    {{-- Error State --}}
                    <div id="errorState" class="hidden p-6">
                        <div class="rounded-2xl bg-rose-50 dark:bg-rose-900/20 border border-rose-200 dark:border-rose-900/40 p-5">
                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-circle-exclamation text-rose-500 mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-bold text-rose-700 dark:text-rose-400">Request Gagal</p>
                                    <p id="errorMsg" class="text-xs text-rose-600 dark:text-rose-500 mt-1"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Response Body Tab --}}
                    <div id="tab-content-body" class="hidden p-4">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-2">
                                <button onclick="setView('pretty')" id="viewPretty" class="text-xs font-semibold px-3 py-1.5 rounded-lg bg-violet-100 dark:bg-violet-900/40 text-violet-700 dark:text-violet-400 transition-all">Pretty</button>
                                <button onclick="setView('raw')" id="viewRaw" class="text-xs font-semibold px-3 py-1.5 rounded-lg text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all">Raw</button>
                            </div>
                            <button onclick="copyResponse()" class="text-xs text-slate-400 hover:text-violet-600 flex items-center gap-1 transition-colors">
                                <i class="fa-regular fa-copy"></i> Salin
                            </button>
                        </div>
                        <pre id="responseBody" class="text-xs font-mono bg-slate-50 dark:bg-slate-950 rounded-xl p-4 overflow-auto max-h-[420px] text-slate-600 dark:text-slate-300 whitespace-pre-wrap break-all border border-slate-100 dark:border-slate-800"></pre>
                    </div>

                    {{-- Response Headers Tab --}}
                    <div id="tab-content-headers" class="hidden p-4">
                        <div id="responseHeaders" class="space-y-1.5 max-h-[460px] overflow-y-auto"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let currentView = 'pretty';
    let rawResponseData = null;

    // Toggle body panel berdasarkan method
    document.getElementById('httpMethod').addEventListener('change', function () {
        const bodyPanel = document.getElementById('bodyPanel');
        bodyPanel.style.opacity = ['GET', 'DELETE'].includes(this.value) ? '0.5' : '1';
    });

    function addHeader(key = '', val = '') {
        const container = document.getElementById('headersContainer');
        const row = document.createElement('div');
        row.className = 'flex gap-2 header-row';
        row.innerHTML = `
            <input type="text" placeholder="Key" value="${key}" class="header-key flex-1 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs px-3 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400 transition-all">
            <input type="text" placeholder="Value" value="${val}" class="header-val flex-1 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs px-3 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400 transition-all">
            <button onclick="this.closest('.header-row').remove()" class="w-8 h-8 flex items-center justify-center rounded-xl text-slate-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-colors flex-shrink-0">
                <i class="fa-solid fa-xmark text-xs"></i>
            </button>`;
        container.appendChild(row);
    }

    function addPresetHeader(key, val) {
        addHeader(key, val);
    }

    function getHeaders() {
        const headers = {};
        document.querySelectorAll('.header-row').forEach(row => {
            const k = row.querySelector('.header-key').value.trim();
            const v = row.querySelector('.header-val').value.trim();
            if (k) headers[k] = v;
        });
        return headers;
    }

    function switchTab(tab) {
        document.getElementById('tab-body').className = `tab-btn px-5 py-3.5 text-sm font-semibold border-b-2 transition-all ${tab === 'body' ? 'border-violet-500 text-violet-600 dark:text-violet-400' : 'border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-700'}`;
        document.getElementById('tab-headers').className = `tab-btn px-5 py-3.5 text-sm font-semibold border-b-2 transition-all ${tab === 'headers' ? 'border-violet-500 text-violet-600 dark:text-violet-400' : 'border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-700'}`;
        document.getElementById('tab-content-body').classList.toggle('hidden', tab !== 'body');
        document.getElementById('tab-content-headers').classList.toggle('hidden', tab !== 'headers');
    }

    function setView(view) {
        currentView = view;
        document.getElementById('viewPretty').className = `text-xs font-semibold px-3 py-1.5 rounded-lg transition-all ${view === 'pretty' ? 'bg-violet-100 dark:bg-violet-900/40 text-violet-700 dark:text-violet-400' : 'text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800'}`;
        document.getElementById('viewRaw').className = `text-xs font-semibold px-3 py-1.5 rounded-lg transition-all ${view === 'raw' ? 'bg-violet-100 dark:bg-violet-900/40 text-violet-700 dark:text-violet-400' : 'text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800'}`;
        if (rawResponseData !== null) renderBody(rawResponseData, view);
    }

    function renderBody(data, view) {
        const el = document.getElementById('responseBody');
        if (view === 'pretty' && typeof data === 'object') {
            el.textContent = JSON.stringify(data, null, 2);
        } else {
            el.textContent = typeof data === 'object' ? JSON.stringify(data) : String(data);
        }
    }

    function copyResponse() {
        const text = document.getElementById('responseBody').textContent;
        navigator.clipboard.writeText(text).then(() => {
            Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Response disalin!', showConfirmButton: false, timer: 1500 });
        });
    }

    function formatJson() {
        const el = document.getElementById('requestBody');
        try {
            el.value = JSON.stringify(JSON.parse(el.value), null, 2);
        } catch {
            Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: 'JSON tidak valid!', showConfirmButton: false, timer: 1500 });
        }
    }

    function showLoading(show) {
        document.getElementById('loadingState').classList.toggle('hidden', !show);
        document.getElementById('loadingState').classList.toggle('flex', show);
        document.getElementById('emptyState').classList.toggle('hidden', show);
        document.getElementById('errorState').classList.add('hidden');
        document.getElementById('tab-content-body').classList.add('hidden');
        document.getElementById('tab-content-headers').classList.add('hidden');
        const btn = document.getElementById('btnSend');
        btn.disabled = show;
        btn.innerHTML = show ? '<i class="fa-solid fa-circle-notch fa-spin"></i> Mengirim...' : '<i class="fa-solid fa-paper-plane"></i> Kirim Request';
    }

    async function sendRequest() {
        const url = document.getElementById('requestUrl').value.trim();
        const method = document.getElementById('httpMethod').value;
        const body = document.getElementById('requestBody').value.trim();

        if (!url) {
            Swal.fire({ toast: true, position: 'top-end', icon: 'warning', title: 'URL tidak boleh kosong!', showConfirmButton: false, timer: 1800 });
            return;
        }

        showLoading(true);
        document.getElementById('statusBar').classList.add('hidden');

        try {
            const payload = { url, method, headers: getHeaders() };
            if (!['GET', 'DELETE'].includes(method) && body) payload.body = body;

            const res = await fetch('/api-tester/execute', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify(payload)
            });

            const result = await res.json();
            showLoading(false);

            if (!result.success) {
                document.getElementById('errorState').classList.remove('hidden');
                document.getElementById('errorMsg').textContent = result.message;
                return;
            }

            const d = result.data;
            rawResponseData = d.body;

            // Status Bar
            const bar = document.getElementById('statusBar');
            bar.classList.remove('hidden');
            const badge = document.getElementById('statusBadge');
            const isOk = d.status >= 200 && d.status < 300;
            const isWarn = d.status >= 300 && d.status < 500;
            badge.className = `inline-flex items-center gap-1.5 rounded-xl px-3 py-1.5 text-sm font-bold ${isOk ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400' : isWarn ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400' : 'bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-400'}`;
            badge.innerHTML = `<span class="w-2 h-2 rounded-full ${isOk ? 'bg-emerald-500' : isWarn ? 'bg-amber-500' : 'bg-rose-500'}"></span> ${d.status}`;
            document.getElementById('statusText').textContent = d.statusText;
            document.getElementById('respTime').querySelector('span').textContent = d.time;
            document.getElementById('respSize').querySelector('span').textContent = d.size;

            // Body tab
            document.getElementById('tab-content-body').classList.remove('hidden');
            renderBody(d.body, currentView);

            // Headers tab
            const headersDiv = document.getElementById('responseHeaders');
            headersDiv.innerHTML = '';
            Object.entries(d.headers || {}).forEach(([k, v]) => {
                headersDiv.innerHTML += `
                    <div class="flex items-start gap-2 rounded-xl bg-slate-50 dark:bg-slate-800/60 px-3 py-2 border border-slate-100 dark:border-slate-800">
                        <span class="text-xs font-bold text-violet-600 dark:text-violet-400 min-w-max">${k}</span>
                        <span class="text-xs text-slate-500 dark:text-slate-400 break-all">${Array.isArray(v) ? v.join(', ') : v}</span>
                    </div>`;
            });

            switchTab('body');

        } catch (e) {
            showLoading(false);
            document.getElementById('errorState').classList.remove('hidden');
            document.getElementById('errorMsg').textContent = e.message;
        }
    }
</script>
@endsection
