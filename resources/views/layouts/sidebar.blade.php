<aside class="hidden w-64 flex-shrink-0 flex-col bg-white/70 backdrop-blur-xl border-r border-white shadow-[4px_0_24px_rgba(0,0,0,0.02)] transition-all duration-300 md:flex z-40 relative">
    <!-- Logo Section -->
    <div class="flex items-center justify-center py-8 border-b border-white/50">
        <div class="flex items-center gap-3">
            <div class="relative w-11 h-11 flex items-center justify-center bg-gradient-to-br from-blue-500 to-indigo-600 rounded-[14px] shadow-lg shadow-blue-500/30 ring-1 ring-white/50">
                <span class="text-white font-black text-2xl tracking-tighter">S</span>
            </div>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-800">
                Stunt<span class="bg-gradient-to-r from-blue-500 to-cyan-500 bg-clip-text text-transparent">Check</span>
            </h2>
        </div>
    </div>
    
    <!-- Navigation Links -->
    <nav class="flex-1 overflow-y-auto mt-6 px-4 pb-4 no-scrollbar">
        <ul class="space-y-1.5">
            <li class="pt-2 pb-1">
                <span class="px-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Utama</span>
            </li>
            <li>
                <a href="{{ route('dashboard') }}" class="group flex items-center rounded-2xl px-4 py-3.5 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-600 to-blue-500 shadow-md shadow-blue-500/30 text-white translate-x-1' : 'text-slate-500 hover:bg-slate-100/80 hover:text-slate-800' }} transition-all duration-300 active:scale-95">
                    <div class="flex items-center justify-center w-8 h-8 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-white/25 text-white' : 'bg-white shadow-sm text-slate-400 group-hover:text-blue-600' }} transition-colors duration-300">
                        <i class="fa-solid fa-chart-pie text-sm"></i>
                    </div>
                    <span class="ml-3 font-semibold text-[15px]">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('histori.index') }}" class="group flex items-center rounded-2xl px-4 py-3.5 {{ request()->routeIs('histori.index') ? 'bg-gradient-to-r from-blue-600 to-blue-500 shadow-md shadow-blue-500/30 text-white translate-x-1' : 'text-slate-500 hover:bg-slate-100/80 hover:text-slate-800' }} transition-all duration-300 active:scale-95">
                    <div class="flex items-center justify-center w-8 h-8 rounded-xl {{ request()->routeIs('histori.index') ? 'bg-white/25 text-white' : 'bg-white shadow-sm text-slate-400 group-hover:text-blue-600' }} transition-colors duration-300">
                        <i class="fa-solid fa-clock-rotate-left text-sm"></i>
                    </div>
                    <span class="ml-3 font-semibold text-[15px]">Histori Prediksi</span>
                </a>
            </li>

            <li class="pt-6 pb-1">
                <span class="px-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Master Data</span>
            </li>
            <li>
                <a href="{{ route('ibu.index') }}" class="group flex items-center rounded-2xl px-4 py-3.5 {{ request()->routeIs('ibu.index') ? 'bg-gradient-to-r from-pink-600 to-pink-500 shadow-md shadow-pink-500/30 text-white translate-x-1' : 'text-slate-500 hover:bg-slate-100/80 hover:text-slate-800' }} transition-all duration-300 active:scale-95">
                    <div class="flex items-center justify-center w-8 h-8 rounded-xl {{ request()->routeIs('ibu.index') ? 'bg-white/25 text-white' : 'bg-white shadow-sm text-slate-400 group-hover:text-pink-600' }} transition-colors duration-300">
                        <i class="fa-solid fa-person-dress text-sm"></i>
                    </div>
                    <span class="ml-3 font-semibold text-[15px]">Data Ibu</span>
                </a>
            </li>
            <li>
                <a href="{{ route('anak.index') }}" class="group flex items-center rounded-2xl px-4 py-3.5 {{ request()->routeIs('anak.index') ? 'bg-gradient-to-r from-blue-600 to-blue-500 shadow-md shadow-blue-500/30 text-white translate-x-1' : 'text-slate-500 hover:bg-slate-100/80 hover:text-slate-800' }} transition-all duration-300 active:scale-95">
                    <div class="flex items-center justify-center w-8 h-8 rounded-xl {{ request()->routeIs('anak.index') ? 'bg-white/25 text-white' : 'bg-white shadow-sm text-slate-400 group-hover:text-blue-600' }} transition-colors duration-300">
                        <i class="fa-solid fa-child-reaching text-sm"></i>
                    </div>
                    <span class="ml-3 font-semibold text-[15px]">Data Anak</span>
                </a>
            </li>
            
            <li class="pt-6 pb-1">
                <span class="px-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Sistem</span>
            </li>
            <li>
                <a href="{{ route('user.index') }}" class="group flex items-center rounded-2xl px-4 py-3.5 {{ request()->routeIs('user.index') ? 'bg-gradient-to-r from-indigo-600 to-indigo-500 shadow-md shadow-indigo-500/30 text-white translate-x-1' : 'text-slate-500 hover:bg-slate-100/80 hover:text-slate-800' }} transition-all duration-300 active:scale-95">
                    <div class="flex items-center justify-center w-8 h-8 rounded-xl {{ request()->routeIs('user.index') ? 'bg-white/25 text-white' : 'bg-white shadow-sm text-slate-400 group-hover:text-indigo-600' }} transition-colors duration-300">
                        <i class="fa-solid fa-users text-sm"></i>
                    </div>
                    <span class="ml-3 font-semibold text-[15px]">Manajemen User</span>
                </a>
            </li>
            <li>
                <a href="#" class="group flex items-center rounded-2xl px-4 py-3.5 text-slate-500 hover:bg-slate-100/80 hover:text-slate-800 transition-all duration-300 active:scale-95">
                    <div class="flex items-center justify-center w-8 h-8 rounded-xl bg-white shadow-sm text-slate-400 group-hover:text-slate-600 transition-colors duration-300">
                        <i class="fa-solid fa-gear text-sm"></i>
                    </div>
                    <span class="ml-3 font-semibold text-[15px]">Pengaturan</span>
                </a>
            </li>
        </ul>
    </nav>
    
    <!-- Logout Button -->
    <div class="px-5 py-6 border-t border-white/50">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-3 rounded-[14px] bg-slate-100/80 px-4 py-3.5 text-slate-600 font-bold transition-all hover:bg-rose-100 hover:text-rose-600 active:scale-95 shadow-sm ring-1 ring-white">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>
