@extends('layouts.admin')

@section('title', __('Histori Prediksi') . ' - StuntCheck')

@section('content')
<div class="flex-1 overflow-y-auto bg-slate-50/50 dark:bg-slate-950/50 p-4 md:p-8 transition-colors duration-300">
    <!-- Header Section -->
    <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100 md:text-3xl tracking-tight">{{ __('Histori Prediksi') }}</h1>
            <p class="mt-1 text-slate-500 dark:text-slate-400 font-medium">{{ __('Daftar riwayat deteksi dini status gizi balita') }}</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('histori.export') }}" class="flex items-center gap-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2.5 text-sm font-bold text-slate-700 dark:text-slate-300 shadow-sm transition-all hover:bg-slate-50 dark:hover:bg-slate-800 hover:border-indigo-200 dark:hover:border-indigo-900 hover:text-indigo-600 dark:hover:text-indigo-400">
                <i class="fa-solid fa-file-excel text-emerald-600 dark:text-emerald-500"></i>
                {{ __('Ekspor Excel') }}
            </a>
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 shadow-sm transition-colors">
                <i class="fa-solid fa-clock-rotate-left text-xl"></i>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-100 dark:border-emerald-900/30 bg-emerald-50 dark:bg-emerald-900/20 p-4 text-emerald-700 dark:text-emerald-400 shadow-sm animate-fade-in transition-colors">
        <i class="fa-solid fa-circle-check text-lg"></i>
        <p class="font-medium">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Table Card -->
    <div class="overflow-hidden rounded-3xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-sm transition-all hover:shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-500">{{ __('Nama Anak') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-500">{{ __('Hasil Prediksi') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-500 text-center">{{ __('Probabilitas') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-500">{{ __('Tanggal Prediksi') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-500">{{ __('Rekomendasi AI') }}</th>
                        @if(Auth::user()->role === 'admin')
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-500 text-right">{{ __('Aksi') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-slate-800 bg-white dark:bg-slate-900">
                    @forelse($histori as $item)
                    <tr class="group transition-colors hover:bg-slate-50/80 dark:hover:bg-slate-800/50">
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 group-hover:bg-indigo-100 dark:group-hover:bg-indigo-900 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                    <i class="fa-solid fa-child text-sm"></i>
                                </div>
                                <span class="font-bold text-slate-800 dark:text-slate-200 tracking-tight">{{ $item->anak->nama_anak ?? __('Data Terhapus') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            @php
                            $statusClass = match(strtolower($item->hasil_prediksi)) {
                            'normal' => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 border-emerald-200 dark:border-emerald-800',
                            'berisiko' => 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 border-amber-200 dark:border-amber-800',
                            'stunting' => 'bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-400 border-rose-200 dark:border-rose-800',
                            default => 'bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-400 border-slate-200 dark:border-slate-700'
                            };
                            @endphp
                            <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-black uppercase tracking-wider {{ $statusClass }}">
                                {{ $item->hasil_prediksi }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <div class="flex flex-col items-center gap-1.5">
                                <span class="text-sm font-bold text-slate-800 dark:text-slate-200">{{ number_format($item->probabilitas * 100, 1) }}%</span>
                                <div class="h-1.5 w-16 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-800">
                                    <div class="h-full bg-indigo-500 dark:bg-indigo-400" style="width: {{ $item->probabilitas * 100 }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-slate-800 dark:text-slate-200">
                                    {{ \Carbon\Carbon::parse($item->tanggal_prediksi ?? $item->created_at)->translatedFormat('d F Y') }}
                                </span>
                                <span class="text-xs text-slate-400 dark:text-slate-500 font-medium">
                                    {{ \Carbon\Carbon::parse($item->tanggal_prediksi ?? $item->created_at)->format('H:i') }} WIB
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="text-xs text-slate-600 dark:text-slate-400 font-medium line-clamp-3 leading-relaxed" title="{{ $item->rekomendasi_ai ?? 'Tidak ada rekomendasi' }}">
                                {{ $item->rekomendasi_ai ?? '-' }}
                            </div>
                        </td>
                        @if(Auth::user()->role === 'admin')
                        <td class="px-6 py-5 text-right">
                            <form action="{{ route('histori.destroy', $item->id) }}" method="POST" class="inline delete-histori-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-9 h-9 flex items-center justify-center rounded-xl text-slate-400 dark:text-slate-600 hover:bg-rose-50 dark:hover:bg-rose-900/30 hover:text-rose-600 dark:hover:text-rose-400 transition-all">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ Auth::user()->role === 'admin' ? 6 : 5 }}" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="mb-5 flex h-20 w-20 items-center justify-center rounded-3xl bg-slate-50 dark:bg-slate-800 text-slate-300 dark:text-slate-600">
                                    <i class="fa-solid fa-folder-open text-4xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-slate-800 dark:text-slate-200 tracking-tight">{{ __('Data Tidak Ditemukan') }}</h3>
                                <p class="text-slate-500 dark:text-slate-500 font-medium mt-1">{{ __('Belum ada riwayat prediksi yang tersedia saat ini.') }}</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($histori instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="border-t border-slate-100 dark:border-slate-800 bg-slate-50/30 dark:bg-slate-900/30 px-6 py-5">
            {{ $histori->links() }}
        </div>
        @endif
    </div>
</div>

<script>
    document.querySelectorAll('.delete-histori-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const isDark = document.documentElement.classList.contains('dark');
            
            Swal.fire({
                title: '{{ __('Hapus Data?') }}',
                text: '{{ __('Data histori ini akan dihapus secara permanen.') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: isDark ? '#334155' : '#94a3b8',
                confirmButtonText: '{{ __('Ya, Hapus!') }}',
                cancelButtonText: '{{ __('Batal') }}',
                background: isDark ? '#1e293b' : '#ffffff',
                color: isDark ? '#f1f5f9' : '#1e293b',
                customClass: {
                    popup: 'rounded-[32px] border border-slate-200 dark:border-slate-800 shadow-2xl',
                    title: 'text-xl font-bold tracking-tight',
                    confirmButton: 'rounded-2xl px-6 py-3 font-bold transition-all active:scale-95',
                    cancelButton: 'rounded-2xl px-6 py-3 font-bold transition-all active:scale-95'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
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