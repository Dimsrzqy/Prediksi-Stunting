<header class="flex items-center justify-between bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl border-b border-white dark:border-slate-800 shadow-[0_4px_24px_rgba(0,0,0,0.02)] px-6 py-4 z-30 sticky top-0 transition-colors duration-300">
    
    <!-- Left Section (Mobile Menu & Breadcrumbs) -->
    <div class="flex items-center gap-4">
        <!-- Hamburger (Visible on Mobile) -->
        <button class="text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 focus:outline-none md:hidden transition-colors rounded-xl p-2 hover:bg-slate-100/80 dark:hover:bg-slate-800 active:scale-95">
            <i class="fa-solid fa-bars text-xl"></i>
        </button>

        <!-- Breadcrumbs -->
        <nav class="hidden md:flex items-center text-[13px] font-bold text-slate-400 dark:text-slate-500 tracking-wide">
            @if(request()->routeIs('dashboard'))
                <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">UTAMA</a>
                <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300 dark:text-slate-700"></i>
                <span class="text-slate-800 dark:text-slate-200">DASHBOARD</span>
            @elseif(request()->routeIs('anak.index'))
                <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">MASTER DATA</a>
                <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300 dark:text-slate-700"></i>
                <span class="text-slate-800 dark:text-slate-200">DATA ANAK</span>
            @elseif(request()->routeIs('ibu.index'))
                <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">MASTER DATA</a>
                <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300 dark:text-slate-700"></i>
                <span class="text-slate-800 dark:text-slate-200">DATA IBU</span>
            @elseif(request()->routeIs('user.index'))
                <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">SISTEM</a>
                <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300 dark:text-slate-700"></i>
                <span class="text-slate-800 dark:text-slate-200">MANAJEMEN USER</span>
            @elseif(request()->routeIs('profil.index'))
                <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">SISTEM</a>
                <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300 dark:text-slate-700"></i>
                <span class="text-slate-800 dark:text-slate-200">PROFIL SAYA</span>
            @elseif(request()->routeIs('pengaturan.index'))
                <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">SISTEM</a>
                <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300 dark:text-slate-700"></i>
                <span class="text-slate-800 dark:text-slate-200">PENGATURAN</span>
            @else
                <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">SISTEM</a>
                <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300 dark:text-slate-700"></i>
                <span class="text-slate-800 dark:text-slate-200">LAINNYA</span>
            @endif
        </nav>
    </div>

    <!-- Right Section (Search, Notifications, Profile) -->
    <div class="flex items-center gap-4 md:gap-6 relative">
        <!-- Search Bar -->
        <div class="relative hidden sm:block">
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                <i class="fa-solid fa-magnifying-glass text-slate-400 dark:text-slate-500"></i>
            </div>
            <input type="text" id="searchInput" class="w-48 lg:w-64 rounded-2xl border-0 bg-slate-100/80 dark:bg-slate-800/80 py-2.5 pl-11 pr-4 text-sm text-slate-700 dark:text-slate-200 transition-all focus:bg-white dark:focus:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/50 shadow-inner placeholder-slate-400 dark:placeholder-slate-500" placeholder="Cari menu...">
        </div>



        <!-- Notification -->
        <div class="relative">
            <button id="notifBtn" class="relative flex items-center justify-center w-10 h-10 rounded-full bg-slate-100/80 dark:bg-slate-800/80 text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-700 transition-all active:scale-95">
                <i class="fa-regular fa-bell text-lg"></i>
                <span class="absolute top-2 right-2 h-2.5 w-2.5 rounded-full bg-rose-500 ring-2 ring-white dark:ring-slate-900 shadow-sm"></span>
            </button>
            
            <!-- Dropdown Notifikasi -->
            <div id="notifDropdown" class="absolute right-0 mt-3 w-80 bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl rounded-3xl shadow-[0_20px_40px_-15px_rgba(0,0,0,0.15)] ring-1 ring-slate-200/50 dark:ring-slate-800 overflow-hidden origin-top-right transition-all duration-300 ease-out opacity-0 invisible scale-95 translate-y-2 z-50">
                <div class="px-5 py-4 border-b border-slate-100 dark:border-slate-800 bg-white/50 dark:bg-slate-900/50 flex justify-between items-center">
                    <h3 class="text-[15px] font-bold text-slate-800 dark:text-slate-200">Notifikasi</h3>
                    <span class="text-[10px] font-bold bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 px-2 py-1 rounded-full shadow-sm">2 Baru</span>
                </div>
                <div class="max-h-64 overflow-y-auto no-scrollbar bg-white/50 dark:bg-slate-900/50">
                    <a href="#" class="block px-5 py-3 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors border-b border-slate-50 dark:border-slate-800">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-full bg-rose-100 dark:bg-rose-900/30 text-rose-500 dark:text-rose-400 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fa-solid fa-triangle-exclamation text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[13px] font-bold text-slate-700 dark:text-slate-300">Risiko Stunting Tinggi</p>
                                <p class="text-[12px] text-slate-500 dark:text-slate-500 mt-0.5 leading-snug">Sistem mendeteksi 3 anak dengan potensi stunting minggu ini.</p>
                                <p class="text-[10px] text-slate-400 dark:text-slate-600 mt-1.5 font-semibold">10 menit yang lalu</p>
                            </div>
                        </div>
                    </a>
                </div>
                <a href="#" class="block px-4 py-3 text-center text-xs font-bold text-blue-600 dark:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-800 border-t border-slate-100 dark:border-slate-800 transition-colors bg-white/50 dark:bg-slate-900/50">Lihat Semua Notifikasi</a>
            </div>
        </div>

        <!-- Profile Dropdown Trigger -->
        <div class="relative">
            <div id="profileBtn" class="flex cursor-pointer items-center gap-3 pl-2 md:pl-5 border-l border-slate-200/50 dark:border-slate-800 group active:scale-95 transition-transform">
                <div class="relative">
                    @php
                        $navAvatarUrl = auth()->user()->avatar 
                            ? asset('storage/' . auth()->user()->avatar) 
                            : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=3b82f6&color=fff&bold=true';
                    @endphp
                    <img src="{{ $navAvatarUrl }}" alt="Profile" class="h-10 w-10 rounded-[14px] object-cover ring-2 ring-white dark:ring-slate-900 shadow-sm transition-transform group-hover:scale-105">
                    <div class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-emerald-500 rounded-full ring-2 ring-white dark:ring-slate-900"></div>
                </div>
                <div class="hidden md:block">
                    <p class="text-[13px] font-extrabold text-slate-800 dark:text-slate-200 leading-tight">{{ auth()->user()->name }}</p>
                    <p class="text-[11px] font-bold text-blue-500 dark:text-blue-400 uppercase tracking-wide">{{ ucfirst(auth()->user()->role) }}</p>
                </div>
                <i class="fa-solid fa-angle-down text-[10px] text-slate-400 dark:text-slate-600 ml-1 transition-transform group-hover:rotate-180"></i>
            </div>
            
            <!-- Dropdown Profil -->
            <div id="profileDropdown" class="absolute right-0 mt-4 w-64 bg-white/80 dark:bg-slate-900/80 backdrop-blur-2xl rounded-[28px] shadow-[0_12px_40px_-10px_rgba(0,0,0,0.15)] ring-1 ring-white/60 dark:ring-slate-800 overflow-hidden origin-top-right transition-all duration-300 ease-out opacity-0 invisible scale-95 translate-y-2 z-50">
                <div class="px-5 py-4 border-b border-slate-200/60 dark:border-slate-800 bg-white/40 dark:bg-slate-900/40 backdrop-blur-sm">
                    <p class="text-[15px] font-bold text-slate-800 dark:text-slate-200 leading-tight tracking-tight">{{ auth()->user()->name }}</p>
                    <p class="text-[12px] font-medium text-slate-500 dark:text-slate-500 mt-0.5">{{ ucfirst(auth()->user()->role) }}</p>
                </div>

                <div class="p-2 space-y-1">
                    <a href="{{ route('profil.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-2xl text-[14px] text-slate-700 dark:text-slate-300 hover:bg-white dark:hover:bg-slate-800 hover:shadow-[0_2px_10px_-4px_rgba(0,0,0,0.1)] active:bg-slate-100 active:scale-[0.98] transition-all duration-200 font-semibold group">
                        <div class="flex items-center gap-3.5">
                            <div class="w-9 h-9 rounded-[14px] bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 flex items-center justify-center group-hover:bg-blue-500 group-hover:text-white transition-all duration-300 shadow-sm group-hover:shadow-blue-500/30">
                                <i class="fa-regular fa-user text-[15px]"></i>
                            </div>
                            <span class="tracking-wide">Profil Saya</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-300 dark:text-slate-700 group-hover:text-blue-500 group-hover:translate-x-1 transition-all duration-300"></i>
                    </a>
                </div>
                
                <div class="p-2 pt-0">
                    <div class="h-px w-[calc(100%-16px)] mx-auto bg-slate-200/60 dark:bg-slate-800/60 mb-2"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-between px-3 py-2.5 rounded-2xl text-[14px] text-rose-600 dark:text-rose-400 hover:bg-rose-50/80 dark:hover:bg-rose-900/20 hover:shadow-[0_2px_10px_-4px_rgba(225,29,72,0.1)] active:bg-rose-100 active:scale-[0.98] transition-all duration-200 font-semibold group">
                            <div class="flex items-center gap-3.5">
                                <div class="w-9 h-9 rounded-[14px] bg-rose-50 dark:bg-rose-900/30 text-rose-600 dark:text-rose-400 flex items-center justify-center group-hover:bg-rose-500 group-hover:text-white transition-all duration-300 shadow-sm group-hover:shadow-rose-500/30">
                                    <i class="fa-solid fa-right-from-bracket text-[15px] translate-x-[1px]"></i>
                                </div>
                                <span class="tracking-wide">Keluar</span>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener("DOMContentLoaded", () => {


        // Dropdown Logic
        const notifBtn = document.getElementById('notifBtn');
        const notifDropdown = document.getElementById('notifDropdown');
        const profileBtn = document.getElementById('profileBtn');
        const profileDropdown = document.getElementById('profileDropdown');
        const searchInput = document.getElementById('searchInput');

        const showClasses = ['opacity-100', 'scale-100', 'translate-y-0'];
        const hideClasses = ['opacity-0', 'invisible', 'scale-95', 'translate-y-2'];

        function openDropdown(dropdown) {
            dropdown.classList.remove(...hideClasses);
            dropdown.classList.add('visible', ...showClasses);
        }

        function closeDropdown(dropdown) {
            dropdown.classList.remove('visible', ...showClasses);
            dropdown.classList.add(...hideClasses);
        }

        if(notifBtn) {
            notifBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                if (notifDropdown.classList.contains('invisible')) {
                    openDropdown(notifDropdown);
                    closeDropdown(profileDropdown);
                } else {
                    closeDropdown(notifDropdown);
                }
            });
        }

        if(profileBtn) {
            profileBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                if (profileDropdown.classList.contains('invisible')) {
                    openDropdown(profileDropdown);
                    closeDropdown(notifDropdown);
                } else {
                    closeDropdown(profileDropdown);
                }
            });
        }

        document.addEventListener('click', (e) => {
            if (notifBtn && !notifBtn.contains(e.target) && notifDropdown && !notifDropdown.contains(e.target)) {
                closeDropdown(notifDropdown);
            }
            if (profileBtn && !profileBtn.contains(e.target) && profileDropdown && !profileDropdown.contains(e.target)) {
                closeDropdown(profileDropdown);
            }
        });
    });
</script>
