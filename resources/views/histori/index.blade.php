@extends('layouts.admin')

@section('title', 'Histori Prediksi - StuntCheck')

@section('content')
<div class="flex-1 overflow-y-auto bg-slate-50/50 p-4 md:p-8">
    <!-- Header Section -->
    <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 md:text-3xl">Histori Prediksi</h1>
            <p class="mt-1 text-slate-500">Daftar riwayat deteksi dini status gizi balita</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('histori.export') }}" class="flex items-center gap-2 rounded-xl bg-white border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-700 shadow-sm transition-all hover:bg-slate-50 hover:border-indigo-200 hover:text-indigo-600">
                <i class="fa-solid fa-file-excel text-emerald-600"></i>
                Ekspor Excel
            </a>
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600 shadow-sm">
                <i class="fa-solid fa-clock-rotate-left text-xl"></i>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-100 bg-emerald-50 p-4 text-emerald-700 shadow-sm animate-fade-in">
        <i class="fa-solid fa-circle-check text-lg"></i>
        <p class="font-medium">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 flex items-center gap-3 rounded-2xl border border-rose-100 bg-rose-50 p-4 text-rose-700 shadow-sm animate-fade-in">
        <i class="fa-solid fa-circle-xmark text-lg"></i>
        <p class="font-medium">{{ session('error') }}</p>
    </div>
    @endif

    <!-- Table Card -->
    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition-all hover:shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50/50">
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Nama Anak</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Hasil Prediksi</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 text-center">Probabilitas</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Tanggal Prediksi</th>
                        @if(Auth::user()->role === 'admin')
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 text-right">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($histori as $item)
                    <tr class="group transition-colors hover:bg-slate-50/80">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-slate-600 group-hover:bg-indigo-100 group-hover:text-indigo-600 transition-colors">
                                    <i class="fa-solid fa-child text-sm"></i>
                                </div>
                                <span class="font-semibold text-slate-700">{{ $item->anak->nama_anak ?? 'Data Terhapus' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusClass = match(strtolower($item->hasil_prediksi)) {
                                    'normal' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                    'berisiko' => 'bg-amber-100 text-amber-700 border-amber-200',
                                    'stunting' => 'bg-rose-100 text-rose-700 border-rose-200',
                                    default => 'bg-slate-100 text-slate-700 border-slate-200'
                                };
                            @endphp
                            <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-bold uppercase tracking-wide {{ $statusClass }}">
                                {{ $item->hasil_prediksi }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex flex-col items-center gap-1">
                                <span class="text-sm font-bold text-slate-700">{{ number_format($item->probabilitas * 100, 1) }}%</span>
                                <div class="h-1.5 w-16 overflow-hidden rounded-full bg-slate-100">
                                    <div class="h-full bg-indigo-500" style="width: {{ $item->probabilitas * 100 }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-slate-700">
                                    {{ \Carbon\Carbon::parse($item->tanggal_prediksi ?? $item->created_at)->translatedFormat('d F Y') }}
                                </span>
                                <span class="text-xs text-slate-400">
                                    {{ \Carbon\Carbon::parse($item->tanggal_prediksi ?? $item->created_at)->format('H:i') }} WIB
                                </span>
                            </div>
                        </td>
                        @if(Auth::user()->role === 'admin')
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('histori.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-lg p-2 text-slate-400 hover:bg-rose-50 hover:text-rose-600 transition-all">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ Auth::user()->role === 'admin' ? 5 : 4 }}" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-50 text-slate-300">
                                    <i class="fa-solid fa-folder-open text-3xl"></i>
                                </div>
                                <h3 class="text-lg font-bold text-slate-800">Belum Ada Data</h3>
                                <p class="text-slate-500">Belum ada riwayat prediksi yang tersedia.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($histori instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="border-t border-slate-100 bg-slate-50/30 px-6 py-4">
            {{ $histori->links() }}
        </div>
        @endif
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.4s ease-out forwards;
    }
</style>
@endsection
