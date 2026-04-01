@extends('layouts.admin')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800">Ringkasan Prediksi Stunting</h1>
        <p class="text-slate-500 text-sm">Update terakhir: {{ now()->format('d M Y, H:i') }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex flex-col space-y-2">
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Sampel</span>
            <div class="flex items-center justify-between">
                <span class="text-3xl font-extrabold text-slate-800">4,281</span>
                <span class="bg-blue-100 text-blue-600 text-xs font-bold px-2 py-1 rounded">+12%</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex flex-col space-y-2">
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Berisiko Stunting</span>
            <div class="flex items-center justify-between">
                <span class="text-3xl font-extrabold text-rose-600">312</span>
                <span class="bg-rose-50 text-rose-500 text-xs font-bold px-2 py-1 rounded">Waspada</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex flex-col space-y-2">
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Akurasi Model ML</span>
            <div class="flex items-center justify-between">
                <span class="text-3xl font-extrabold text-emerald-500">94.8%</span>
                <div class="w-12 h-1 bg-emerald-100 rounded-full overflow-hidden">
                    <div class="bg-emerald-500 h-full" style="width: 94%"></div>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex flex-col space-y-2">
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Desa Pantauan</span>
            <div class="flex items-center justify-between">
                <span class="text-3xl font-extrabold text-slate-800">18</span>
                <span class="text-xs text-slate-400 font-medium italic italic">Kab. Jember</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
            <h3 class="font-bold text-slate-800">Daftar Hasil Prediksi Terbaru</h3>
            <button class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium shadow-md transition">Export PDF</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider">
                    <tr>
                        <th class="px-6 py-4">ID Anak</th>
                        <th class="px-6 py-4">Nama Lengkap</th>
                        <th class="px-6 py-4">Kecamatan</th>
                        <th class="px-6 py-4">Status Prediksi</th>
                        <th class="px-6 py-4">Skor Probabilitas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-6 py-4 text-sm font-mono">#ID-9921</td>
                        <td class="px-6 py-4 text-sm font-semibold text-slate-700">Ahmad Fauzan</td>
                        <td class="px-6 py-4 text-sm text-slate-500">Kec. Sumbersari</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-3 py-1 bg-rose-100 text-rose-700 rounded-full text-xs font-bold italic">Terindikasi</span>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium">88%</td>
                    </tr>
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-6 py-4 text-sm font-mono">#ID-9922</td>
                        <td class="px-6 py-4 text-sm font-semibold text-slate-700">Siti Aminah</td>
                        <td class="px-6 py-4 text-sm text-slate-500">Kec. Patrang</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold italic">Normal</span>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium">12%</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection