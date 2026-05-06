<aside class="hidden w-64 flex-shrink-0 flex-col bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl border-r border-white dark:border-slate-800 shadow-[4px_0_24px_rgba(0,0,0,0.02)] transition-all duration-300 md:flex z-40 relative">
    <!-- Logo Section -->
    <div class="flex items-center justify-center py-8 border-b border-white/50 dark:border-slate-800/50">
        <div class="flex items-center gap-3">
            <div class="relative w-11 h-11 flex items-center justify-center bg-gradient-to-br from-blue-500 to-indigo-600 rounded-[14px] shadow-lg shadow-blue-500/30 ring-1 ring-white/50 dark:ring-slate-700/50">
                <span class="text-white font-black text-2xl tracking-tighter">S</span>
            </div>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-800 dark:text-slate-100 transition-colors">
                Stunt<span class="bg-gradient-to-r from-blue-500 to-cyan-500 bg-clip-text text-transparent">Check</span>
            </h2>
        </div>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 overflow-y-auto mt-6 px-4 pb-4 no-scrollbar">
        <ul class="space-y-1.5">
            <li class="pt-2 pb-1">
                <span class="px-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 dark:text-slate-600">{{ __('Utama') }}</span>
            </li>
            <li>
                <a href="{{ route('dashboard') }}" class="group flex items-center rounded-2xl px-4 py-3.5 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-600 to-blue-500 shadow-md shadow-blue-500/30 text-white translate-x-1' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100/80 dark:hover:bg-slate-800 hover:text-slate-800 dark:hover:text-slate-200' }} transition-all duration-300 active:scale-95">
                    <div class="flex items-center justify-center w-8 h-8 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-white/25 text-white' : 'bg-white dark:bg-slate-800 shadow-sm text-slate-400 dark:text-slate-500 group-hover:text-blue-600 dark:group-hover:text-blue-400' }} transition-colors duration-300">
                        <i class="fa-solid fa-chart-pie text-sm"></i>
                    </div>
                    <span class="ml-3 font-semibold text-[15px]">{{ __('Dashboard') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('histori.index') }}" class="group flex items-center rounded-2xl px-4 py-3.5 {{ request()->routeIs('histori.index') ? 'bg-gradient-to-r from-blue-600 to-blue-500 shadow-md shadow-blue-500/30 text-white translate-x-1' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100/80 dark:hover:bg-slate-800 hover:text-slate-800 dark:hover:text-slate-200' }} transition-all duration-300 active:scale-95">
                    <div class="flex items-center justify-center w-8 h-8 rounded-xl {{ request()->routeIs('histori.index') ? 'bg-white/25 text-white' : 'bg-white dark:bg-slate-800 shadow-sm text-slate-400 dark:text-slate-500 group-hover:text-blue-600 dark:group-hover:text-blue-400' }} transition-colors duration-300">
                        <i class="fa-solid fa-clock-rotate-left text-sm"></i>
                    </div>
                    <span class="ml-3 font-semibold text-[15px]">{{ __('Histori Prediksi') }}</span>
                </a>
            </li>

            <li class="pt-6 pb-1">
                <span class="px-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 dark:text-slate-600">{{ __('Master Data') }}</span>
            </li>
            <li>
                <a href="{{ route('ibu.index') }}" class="group flex items-center rounded-2xl px-4 py-3.5 {{ request()->routeIs('ibu.index') ? 'bg-gradient-to-r from-pink-600 to-pink-500 shadow-md shadow-pink-500/30 text-white translate-x-1' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100/80 dark:hover:bg-slate-800 hover:text-slate-800 dark:hover:text-slate-200' }} transition-all duration-300 active:scale-95">
                    <div class="flex items-center justify-center w-8 h-8 rounded-xl {{ request()->routeIs('ibu.index') ? 'bg-white/25 text-white' : 'bg-white dark:bg-slate-800 shadow-sm text-slate-400 dark:text-slate-500 group-hover:text-pink-600 dark:group-hover:text-pink-400' }} transition-colors duration-300">
                        <i class="fa-solid fa-person-dress text-sm"></i>
                    </div>
                    <span class="ml-3 font-semibold text-[15px]">{{ __('Data Ibu') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('anak.index') }}" class="group flex items-center rounded-2xl px-4 py-3.5 {{ request()->routeIs('anak.index') ? 'bg-gradient-to-r from-blue-600 to-blue-500 shadow-md shadow-blue-500/30 text-white translate-x-1' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100/80 dark:hover:bg-slate-800 hover:text-slate-800 dark:hover:text-slate-200' }} transition-all duration-300 active:scale-95">
                    <div class="flex items-center justify-center w-8 h-8 rounded-xl {{ request()->routeIs('anak.index') ? 'bg-white/25 text-white' : 'bg-white dark:bg-slate-800 shadow-sm text-slate-400 dark:text-slate-500 group-hover:text-blue-600 dark:group-hover:text-blue-400' }} transition-colors duration-300">
                        <i class="fa-solid fa-child-reaching text-sm"></i>
                    </div>
                    <span class="ml-3 font-semibold text-[15px]">{{ __('Data Anak') }}</span>
                </a>
            </li>

            <li class="pt-6 pb-1">
                <span class="px-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 dark:text-slate-600">{{ __('Data & Gizi') }}</span>
            </li>
            <!-- Menu Data Gizi & Menu (Baru) -->
            <li>
                <a href="{{ route('makanan.index') }}" class="group flex items-center rounded-2xl px-4 py-3.5 {{ request()->routeIs('makanan.*') ? 'bg-gradient-to-r from-emerald-600 to-emerald-500 shadow-md shadow-emerald-500/30 text-white translate-x-1' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100/80 dark:hover:bg-slate-800 hover:text-slate-800 dark:hover:text-slate-200' }} transition-all duration-300 active:scale-95">
                    <div class="flex items-center justify-center w-8 h-8 rounded-xl {{ request()->routeIs('makanan.*') ? 'bg-white/25 text-white' : 'bg-white dark:bg-slate-800 shadow-sm text-slate-400 dark:text-slate-500 group-hover:text-emerald-600 dark:group-hover:text-emerald-400' }} transition-colors duration-300">
                        <i class="fa-solid fa-utensils text-sm"></i>
                    </div>
                    <span class="ml-3 font-semibold text-[15px]">{{ __('Data Gizi & Menu') }}</span>
                </a>
            </li>

            <li class="pt-6 pb-1">
                <span class="px-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 dark:text-slate-600">{{ __('Sistem') }}</span>
            </li>
            <li>
                <a href="{{ route('user.index') }}" class="group flex items-center rounded-2xl px-4 py-3.5 {{ request()->routeIs('user.index') ? 'bg-gradient-to-r from-indigo-600 to-indigo-500 shadow-md shadow-indigo-500/30 text-white translate-x-1' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100/80 dark:hover:bg-slate-800 hover:text-slate-800 dark:hover:text-slate-200' }} transition-all duration-300 active:scale-95">
                    <div class="flex items-center justify-center w-8 h-8 rounded-xl {{ request()->routeIs('user.index') ? 'bg-white/25 text-white' : 'bg-white dark:bg-slate-800 shadow-sm text-slate-400 dark:text-slate-500 group-hover:text-indigo-600 dark:group-hover:text-indigo-400' }} transition-colors duration-300">
                        <i class="fa-solid fa-users text-sm"></i>
                    </div>
                    <span class="ml-3 font-semibold text-[15px]">{{ __('Manajemen User') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('api-tester.index') }}" class="group flex items-center rounded-2xl px-4 py-3.5 {{ request()->routeIs('api-tester.*') ? 'bg-gradient-to-r from-violet-600 to-purple-500 shadow-md shadow-violet-500/30 text-white translate-x-1' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100/80 dark:hover:bg-slate-800 hover:text-slate-800 dark:hover:text-slate-200' }} transition-all duration-300 active:scale-95">
                    <div class="flex items-center justify-center w-8 h-8 rounded-xl {{ request()->routeIs('api-tester.*') ? 'bg-white/25 text-white' : 'bg-white dark:bg-slate-800 shadow-sm text-slate-400 dark:text-slate-500 group-hover:text-violet-600 dark:group-hover:text-violet-400' }} transition-colors duration-300">
                        <i class="fa-solid fa-satellite-dish text-sm"></i>
                    </div>
                    <span class="ml-3 font-semibold text-[15px]">{{ __('API Tester') }}</span>
                </a>
            </li>

        </ul>
    </nav>
</aside>