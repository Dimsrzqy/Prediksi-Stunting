<aside class="hidden w-64 flex-shrink-0 flex-col bg-white border-r border-slate-200 transition-all duration-300 md:flex z-40 relative">
    <!-- Logo Section -->
    <div class="flex items-center justify-center py-6 border-b border-slate-200">
        <div class="flex items-center gap-3">
            <div class="relative w-10 h-10 flex items-center justify-center bg-gradient-to-tr from-blue-600 to-cyan-400 rounded-full shadow-lg shadow-blue-500/20">
                <span class="text-white font-black text-xl">S</span>
            </div>
            <h2 class="text-xl font-extrabold tracking-tight text-slate-800">
                Stunt<span class="text-cyan-500">Check</span>
            </h2>
        </div>
    </div>
    
    <!-- Navigation Links -->
    <nav class="flex-1 overflow-y-auto mt-6 px-4 pb-4 scrollbar-thin scrollbar-thumb-slate-200">
        <ul class="space-y-2">
            <li class="pt-4 pb-2">
                <span class="px-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Utama</span>
            </li>
            <li>
                <a href="{{ route('dashboard') }}" class="group flex items-center rounded-xl px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-600 hover:bg-slate-50 hover:text-indigo-600' }} transition-all">
                    <i class="fa-solid fa-chart-pie w-6 text-center text-lg {{ request()->routeIs('dashboard') ? '' : 'group-hover:text-indigo-600' }} transition-colors"></i>
                    <span class="ml-3 font-medium">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('histori.index') }}" class="group flex items-center rounded-xl px-4 py-3 {{ request()->routeIs('histori.index') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-600 hover:bg-slate-50 hover:text-indigo-600' }} transition-all">
                    <i class="fa-solid fa-clock-rotate-left w-6 text-center text-lg {{ request()->routeIs('histori.index') ? '' : 'group-hover:text-indigo-600' }} transition-colors"></i>
                    <span class="ml-3 font-medium">Histori Prediksi</span>
                </a>
            </li>
            <li class="pt-4 pb-2">
                <span class="px-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Master Data</span>
            </li>
            <li>
                <a href="{{ route('ibu.index') }}" class="group flex items-center rounded-xl px-4 py-3 {{ request()->routeIs('ibu.index') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-600 hover:bg-slate-50 hover:text-indigo-600' }} transition-all">
                    <i class="fa-solid fa-person-dress w-6 text-center text-lg {{ request()->routeIs('ibu.index') ? '' : 'group-hover:text-indigo-600' }} transition-colors"></i>
                    <span class="ml-3 font-medium">Data Ibu</span>
                </a>
            </li>
            <li>
                <a href="{{ route('anak.index') }}" class="group flex items-center rounded-xl px-4 py-3 {{ request()->routeIs('anak.index') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-600 hover:bg-slate-50 hover:text-indigo-600' }} transition-all">
                    <i class="fa-solid fa-child-reaching w-6 text-center text-lg {{ request()->routeIs('anak.index') ? '' : 'group-hover:text-indigo-600' }} transition-colors"></i>
                    <span class="ml-3 font-medium">Data Anak</span>
                </a>
            </li>
            

            
            <li class="pt-4 pb-2">
                <span class="px-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Sistem</span>
            </li>
            
            <li>
                <a href="{{ route('user.index') }}" class="group flex items-center rounded-xl px-4 py-3 {{ request()->routeIs('user.index') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-600 hover:bg-slate-50 hover:text-indigo-600' }} transition-all">
                    <i class="fa-solid fa-users w-6 text-center text-lg {{ request()->routeIs('user.index') ? '' : 'group-hover:text-indigo-600' }} transition-colors"></i>
                    <span class="ml-3 font-medium">Manajemen User</span>
                </a>
            </li>
            <li>
                <a href="#" class="group flex items-center rounded-xl px-4 py-3 text-slate-600 transition-colors hover:bg-slate-50 hover:text-indigo-600">
                    <i class="fa-solid fa-gear w-6 text-center text-lg group-hover:text-indigo-600 transition-colors"></i>
                    <span class="ml-3 font-medium">Pengaturan</span>
                </a>
            </li>
        </ul>
    </nav>
    
    <!-- Logout Button -->
    <div class="px-4 py-4 border-t border-slate-200 bg-slate-50/50">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-3 rounded-xl bg-white border border-slate-200 px-4 py-3 text-slate-600 transition-colors hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200 shadow-sm">
                <i class="fa-solid fa-right-from-bracket text-lg"></i>
                <span class="font-semibold tracking-wide">Logout</span>
            </button>
        </form>
    </div>
</aside>
