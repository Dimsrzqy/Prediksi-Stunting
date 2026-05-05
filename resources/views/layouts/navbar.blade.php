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
            <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">{{ strtoupper(__('Utama')) }}</a>
            <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300 dark:text-slate-700"></i>
            <span class="text-slate-800 dark:text-slate-200">{{ strtoupper(__('Dashboard')) }}</span>
            @elseif(request()->routeIs('anak.index'))
            <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">{{ strtoupper(__('Master Data')) }}</a>
            <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300 dark:text-slate-700"></i>
            <span class="text-slate-800 dark:text-slate-200">{{ strtoupper(__('Data Anak')) }}</span>
            @elseif(request()->routeIs('ibu.index'))
            <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">{{ strtoupper(__('Master Data')) }}</a>
            <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300 dark:text-slate-700"></i>
            <span class="text-slate-800 dark:text-slate-200">{{ strtoupper(__('Data Ibu')) }}</span>
            @elseif(request()->routeIs('makanan.index') || request()->routeIs('makanan.*'))
            <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">{{ strtoupper(__('Master Data')) }}</a>
            <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300 dark:text-slate-700"></i>
            <span class="text-slate-800 dark:text-slate-200">{{ strtoupper(__('Data Gizi & Menu')) }}</span>
            @elseif(request()->routeIs('user.index'))
            <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">{{ strtoupper(__('Sistem')) }}</a>
            <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300 dark:text-slate-700"></i>
            <span class="text-slate-800 dark:text-slate-200">{{ strtoupper(__('Manajemen User')) }}</span>
            @elseif(request()->routeIs('profil.index'))
            <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">{{ strtoupper(__('Sistem')) }}</a>
            <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300 dark:text-slate-700"></i>
            <span class="text-slate-800 dark:text-slate-200">{{ strtoupper(__('Profil Saya')) }}</span>
            @else
            <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">{{ strtoupper(__('Sistem')) }}</a>
            <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300 dark:text-slate-700"></i>
            <span class="text-slate-800 dark:text-slate-200">{{ strtoupper(__('Lainnya')) }}</span>
            @endif
        </nav>
    </div>

    <!-- Right Section (Search, Language, Theme, Profile) -->
    <div class="flex items-center gap-3 md:gap-4 relative">
        <!-- Search Bar -->
        <div class="relative hidden sm:block">
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                <i class="fa-solid fa-magnifying-glass text-slate-400 dark:text-slate-500"></i>
            </div>
            <input type="text" id="searchInput" class="w-48 lg:w-64 rounded-2xl border-0 bg-slate-100/80 dark:bg-slate-800/80 py-2.5 pl-11 pr-4 text-sm text-slate-700 dark:text-slate-200 transition-all focus:bg-white dark:focus:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/50 shadow-inner placeholder-slate-400 dark:placeholder-slate-500" placeholder="{{ __('Cari menu...') }}">
            <!-- Search Results Dropdown -->
            <div id="searchResults" class="absolute top-full left-0 right-0 mt-2 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl rounded-2xl shadow-[0_20px_40px_-15px_rgba(0,0,0,0.15)] ring-1 ring-slate-200/50 dark:ring-slate-800 overflow-hidden origin-top transition-all duration-300 opacity-0 invisible scale-95 translate-y-1 z-50">
                <div id="searchResultsList" class="max-h-64 overflow-y-auto no-scrollbar py-2">
                    <!-- Results injected by JS -->
                </div>
            </div>
        </div>

        <!-- Language Toggle -->
        <div class="relative">
            <button id="langToggleBtn" class="relative flex items-center justify-center w-10 h-10 rounded-full bg-slate-100/80 dark:bg-slate-800/80 text-slate-500 dark:text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-slate-700 transition-all active:scale-95" title="{{ __('Bahasa') }}">
                <i class="fa-solid fa-language text-lg"></i>
            </button>
            <!-- Language Dropdown -->
            <div id="langDropdown" class="absolute right-0 mt-3 w-56 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl rounded-2xl shadow-[0_20px_40px_-15px_rgba(0,0,0,0.15)] ring-1 ring-slate-200/50 dark:ring-slate-800 overflow-hidden origin-top-right transition-all duration-300 opacity-0 invisible scale-95 translate-y-2 z-50">
                <div class="p-2 space-y-1">
                    <a href="{{ route('set-language', 'id') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all {{ app()->getLocale() == 'id' ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }}">
                        <span class="text-lg">🇮🇩</span>
                        <span>Bahasa Indonesia</span>
                        @if(app()->getLocale() == 'id')
                        <i class="fa-solid fa-circle-check text-emerald-500 ml-auto"></i>
                        @endif
                    </a>
                    <a href="{{ route('set-language', 'en') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all {{ app()->getLocale() == 'en' ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }}">
                        <span class="text-lg">🇺🇸</span>
                        <span>English (US)</span>
                        @if(app()->getLocale() == 'en')
                        <i class="fa-solid fa-circle-check text-emerald-500 ml-auto"></i>
                        @endif
                    </a>
                </div>
            </div>
        </div>

        <!-- Dark Mode Toggle -->
        <button id="themeToggle" class="relative flex items-center justify-center w-10 h-10 rounded-full bg-slate-100/80 dark:bg-slate-800/80 text-slate-500 dark:text-slate-400 hover:text-amber-500 dark:hover:text-amber-400 hover:bg-amber-50 dark:hover:bg-slate-700 transition-all active:scale-95" title="{{ __('Tampilan') }}">
            <i class="fa-solid fa-sun text-lg dark:hidden"></i>
            <i class="fa-solid fa-moon text-lg hidden dark:block"></i>
        </button>

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
                            <span class="tracking-wide">{{ __('Profil Saya') }}</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-300 dark:text-slate-700 group-hover:text-blue-500 group-hover:translate-x-1 transition-all duration-300"></i>
                    </a>
                </div>

                <div class="p-2 pt-0">
                    <div class="h-px w-[calc(100%-16px)] mx-auto bg-slate-200/60 dark:bg-slate-800/60 mb-2"></div>
                    <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                        @csrf
                        <button type="button" onclick="confirmLogout()" class="w-full flex items-center justify-between px-3 py-2.5 rounded-2xl text-[14px] text-rose-600 dark:text-rose-400 hover:bg-rose-50/80 dark:hover:bg-rose-900/20 hover:shadow-[0_2px_10px_-4px_rgba(225,29,72,0.1)] active:bg-rose-100 active:scale-[0.98] transition-all duration-200 font-semibold group">
                            <div class="flex items-center gap-3.5">
                                <div class="w-9 h-9 rounded-[14px] bg-rose-50 dark:bg-rose-900/30 text-rose-600 dark:text-rose-400 flex items-center justify-center group-hover:bg-rose-500 group-hover:text-white transition-all duration-300 shadow-sm group-hover:shadow-rose-500/30">
                                    <i class="fa-solid fa-right-from-bracket text-[15px] translate-x-[1px]"></i>
                                </div>
                                <span class="tracking-wide">{{ __('Keluar') }}</span>
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
        const profileBtn = document.getElementById('profileBtn');
        const profileDropdown = document.getElementById('profileDropdown');
        const langToggleBtn = document.getElementById('langToggleBtn');
        const langDropdown = document.getElementById('langDropdown');
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');
        const searchResultsList = document.getElementById('searchResultsList');

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

        function closeAllDropdowns() {
            closeDropdown(profileDropdown);
            closeDropdown(langDropdown);
            closeDropdown(searchResults);
        }

        // Language Toggle
        if (langToggleBtn) {
            langToggleBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                if (langDropdown.classList.contains('invisible')) {
                    closeAllDropdowns();
                    openDropdown(langDropdown);
                } else {
                    closeDropdown(langDropdown);
                }
            });
        }

        // Profile Dropdown
        if (profileBtn) {
            profileBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                if (profileDropdown.classList.contains('invisible')) {
                    closeAllDropdowns();
                    openDropdown(profileDropdown);
                } else {
                    closeDropdown(profileDropdown);
                }
            });
        }

        // Theme Toggle
        const themeToggleBtn = document.getElementById('themeToggle');
        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', () => {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            });
        }

        // Search Functionality
        const menuItems = [
            { name: '{{ __("Dashboard") }}', url: '{{ route("dashboard") }}', icon: 'fa-solid fa-chart-pie', color: 'text-blue-600 bg-blue-50 dark:bg-blue-900/30 dark:text-blue-400' },
            { name: '{{ __("Histori Prediksi") }}', url: '{{ route("histori.index") }}', icon: 'fa-solid fa-clock-rotate-left', color: 'text-blue-600 bg-blue-50 dark:bg-blue-900/30 dark:text-blue-400' },
            { name: '{{ __("Data Ibu") }}', url: '{{ route("ibu.index") }}', icon: 'fa-solid fa-person-dress', color: 'text-pink-600 bg-pink-50 dark:bg-pink-900/30 dark:text-pink-400' },
            { name: '{{ __("Data Anak") }}', url: '{{ route("anak.index") }}', icon: 'fa-solid fa-child-reaching', color: 'text-blue-600 bg-blue-50 dark:bg-blue-900/30 dark:text-blue-400' },
            { name: '{{ __("Data Gizi & Menu") }}', url: '{{ route("makanan.index") }}', icon: 'fa-solid fa-utensils', color: 'text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30 dark:text-emerald-400' },
            { name: '{{ __("Manajemen User") }}', url: '{{ route("user.index") }}', icon: 'fa-solid fa-users', color: 'text-indigo-600 bg-indigo-50 dark:bg-indigo-900/30 dark:text-indigo-400' },
            { name: '{{ __("Profil Saya") }}', url: '{{ route("profil.index") }}', icon: 'fa-regular fa-user', color: 'text-blue-600 bg-blue-50 dark:bg-blue-900/30 dark:text-blue-400' },
        ];

        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                const query = e.target.value.toLowerCase().trim();
                if (query.length === 0) {
                    closeDropdown(searchResults);
                    return;
                }

                const filtered = menuItems.filter(item => item.name.toLowerCase().includes(query));

                if (filtered.length === 0) {
                    searchResultsList.innerHTML = `
                        <div class="px-4 py-6 text-center">
                            <i class="fa-solid fa-magnifying-glass text-slate-300 dark:text-slate-600 text-2xl mb-2"></i>
                            <p class="text-sm text-slate-400 dark:text-slate-500 font-medium">{{ __('Tidak ditemukan') }}</p>
                        </div>
                    `;
                } else {
                    searchResultsList.innerHTML = filtered.map(item => `
                        <a href="${item.url}" class="flex items-center gap-3 px-4 py-2.5 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                            <div class="w-8 h-8 rounded-xl ${item.color} flex items-center justify-center flex-shrink-0">
                                <i class="${item.icon} text-xs"></i>
                            </div>
                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">${item.name}</span>
                        </a>
                    `).join('');
                }

                closeDropdown(profileDropdown);
                closeDropdown(langDropdown);
                openDropdown(searchResults);
            });

            searchInput.addEventListener('focus', () => {
                if (searchInput.value.trim().length > 0) {
                    searchInput.dispatchEvent(new Event('input'));
                }
            });
        }

        // Close all dropdowns on outside click
        document.addEventListener('click', (e) => {
            if (profileBtn && !profileBtn.contains(e.target) && profileDropdown && !profileDropdown.contains(e.target)) {
                closeDropdown(profileDropdown);
            }
            if (langToggleBtn && !langToggleBtn.contains(e.target) && langDropdown && !langDropdown.contains(e.target)) {
                closeDropdown(langDropdown);
            }
            if (searchInput && !searchInput.contains(e.target) && searchResults && !searchResults.contains(e.target)) {
                closeDropdown(searchResults);
            }
        });
    });

    function confirmLogout() {
        const isDark = document.documentElement.classList.contains('dark');
        
        Swal.fire({
            title: '{{ __('Konfirmasi Keluar') }}',
            text: '{{ __('Apakah Anda yakin ingin keluar?') }}',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: isDark ? '#334155' : '#94a3b8',
            confirmButtonText: '{{ __('Ya, Keluar!') }}',
            cancelButtonText: '{{ __('Batal') }}',
            background: isDark ? '#1e293b' : '#ffffff',
            color: isDark ? '#f1f5f9' : '#1e293b',
            borderRadius: '24px',
            customClass: {
                popup: 'rounded-[32px] border border-slate-200 dark:border-slate-800 shadow-2xl',
                title: 'text-xl font-bold tracking-tight',
                htmlContainer: 'text-sm font-medium',
                confirmButton: 'rounded-2xl px-6 py-3 font-bold transition-all active:scale-95',
                cancelButton: 'rounded-2xl px-6 py-3 font-bold transition-all active:scale-95'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    }
</script>