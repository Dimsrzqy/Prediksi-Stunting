<header class="flex items-center justify-between border-b border-slate-200 bg-white px-6 py-4 shadow-sm z-30">
    
    <!-- Left Section (Mobile Menu & Breadcrumbs) -->
    <div class="flex items-center gap-4">
        <!-- Hamburger (Visible on Mobile) -->
        <button class="text-slate-500 hover:text-indigo-600 focus:outline-none md:hidden transition-colors rounded-lg p-1 hover:bg-slate-100">
            <i class="fa-solid fa-bars text-xl"></i>
        </button>

        <!-- Breadcrumbs -->
        <nav class="hidden md:flex items-center text-sm font-medium text-slate-500">
            <a href="#" class="hover:text-indigo-600 transition-colors">Manajemen Gizi</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-3 text-slate-300"></i>
            <span class="text-slate-800">Menu Makanan</span>
        </nav>
    </div>

    <!-- Right Section (Search, Notifications, Profile) -->
    <div class="flex items-center gap-5 md:gap-6">
        <!-- Search Bar -->
        <div class="relative hidden sm:block">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fa-solid fa-magnifying-glass text-slate-400"></i>
            </div>
            <input type="text" class="w-48 lg:w-64 rounded-full border border-slate-200 bg-slate-50 py-2 pl-10 pr-4 text-sm text-slate-700 transition-all focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-200" placeholder="Cari menu...">
        </div>

        <!-- Notification -->
        <button class="relative text-slate-400 hover:text-indigo-600 transition-colors">
            <i class="fa-regular fa-bell text-xl"></i>
            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
        </button>

        <!-- Profile Dropdown Trigger -->
        <div class="flex cursor-pointer items-center gap-3 border-l border-slate-200 pl-5 group">
            <img src="https://ui-avatars.com/api/?name=Admin+Puskesmas&background=10b981&color=fff&bold=true" alt="Admin Profile" class="h-9 w-9 rounded-full object-cover ring-2 ring-transparent transition-all group-hover:ring-indigo-500/50">
            <div class="hidden md:block">
                <p class="text-sm font-bold text-slate-700 leading-tight">Admin Puskesmas</p>
                <p class="text-[11px] font-medium text-indigo-600">Ahli Gizi</p>
            </div>
            <i class="fa-solid fa-angle-down text-xs text-slate-400 transition-transform group-hover:rotate-180"></i>
        </div>
    </div>
</header>
