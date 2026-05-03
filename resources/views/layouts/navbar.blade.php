<header class="flex items-center justify-between bg-white/70 backdrop-blur-xl border-b border-white shadow-[0_4px_24px_rgba(0,0,0,0.02)] px-6 py-4 z-30 sticky top-0">
    
    <!-- Left Section (Mobile Menu & Breadcrumbs) -->
    <div class="flex items-center gap-4">
        <!-- Hamburger (Visible on Mobile) -->
        <button class="text-slate-500 hover:text-blue-600 focus:outline-none md:hidden transition-colors rounded-xl p-2 hover:bg-slate-100/80 active:scale-95">
            <i class="fa-solid fa-bars text-xl"></i>
        </button>

        <!-- Breadcrumbs -->
        <nav class="hidden md:flex items-center text-[13px] font-bold text-slate-400 tracking-wide">
            @if(request()->routeIs('dashboard'))
                <a href="#" class="hover:text-blue-600 transition-colors">UTAMA</a>
                <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300"></i>
                <span class="text-slate-800">DASHBOARD</span>
            @elseif(request()->routeIs('anak.index'))
                <a href="#" class="hover:text-blue-600 transition-colors">MASTER DATA</a>
                <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300"></i>
                <span class="text-slate-800">DATA ANAK</span>
            @elseif(request()->routeIs('ibu.index'))
                <a href="#" class="hover:text-blue-600 transition-colors">MASTER DATA</a>
                <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300"></i>
                <span class="text-slate-800">DATA IBU</span>
            @elseif(request()->routeIs('makanan.index'))
                <a href="#" class="hover:text-blue-600 transition-colors">MANAJEMEN GIZI</a>
                <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300"></i>
                <span class="text-slate-800">MENU MAKANAN</span>
            @elseif(request()->routeIs('profil.index'))
                <a href="#" class="hover:text-blue-600 transition-colors">SISTEM</a>
                <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300"></i>
                <span class="text-slate-800">PROFIL SAYA</span>
            @elseif(request()->routeIs('pengaturan.index'))
                <a href="#" class="hover:text-blue-600 transition-colors">SISTEM</a>
                <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300"></i>
                <span class="text-slate-800">PENGATURAN</span>
            @elseif(request()->routeIs('user.index'))
                <a href="#" class="hover:text-blue-600 transition-colors">SISTEM</a>
                <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300"></i>
                <span class="text-slate-800">PENGGUNA</span>
            @else
                <a href="#" class="hover:text-blue-600 transition-colors">SISTEM</a>
                <i class="fa-solid fa-chevron-right text-[9px] mx-3 text-slate-300"></i>
                <span class="text-slate-800">LAINNYA</span>
            @endif
        </nav>
    </div>

    <!-- Right Section (Search, Notifications, Profile) -->
    <div class="flex items-center gap-4 md:gap-6 relative">
        <!-- Search Bar -->
        <div class="relative hidden sm:block">
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                <i class="fa-solid fa-magnifying-glass text-slate-400"></i>
            </div>
            <input type="text" id="searchInput" class="w-48 lg:w-64 rounded-2xl border-0 bg-slate-100/80 py-2.5 pl-11 pr-4 text-sm text-slate-700 transition-all focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 shadow-inner" placeholder="Cari menu...">
        </div>

        <!-- Notification -->
        <div class="relative">
            <button id="notifBtn" class="relative flex items-center justify-center w-10 h-10 rounded-full bg-slate-100/80 text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition-all active:scale-95">
                <i class="fa-regular fa-bell text-lg"></i>
                <span class="absolute top-2 right-2 h-2.5 w-2.5 rounded-full bg-rose-500 ring-2 ring-white shadow-sm"></span>
            </button>
            
            <!-- Dropdown Notifikasi -->
            <div id="notifDropdown" class="absolute right-0 mt-3 w-80 bg-white/90 backdrop-blur-xl rounded-3xl shadow-[0_20px_40px_-15px_rgba(0,0,0,0.15)] ring-1 ring-slate-200/50 overflow-hidden origin-top-right transition-all duration-300 ease-out opacity-0 invisible scale-95 translate-y-2 z-50">
                <div class="px-5 py-4 border-b border-slate-100 bg-white/50 flex justify-between items-center">
                    <h3 class="text-[15px] font-bold text-slate-800">Notifikasi</h3>
                    <span class="text-[10px] font-bold bg-blue-100 text-blue-600 px-2 py-1 rounded-full shadow-sm">2 Baru</span>
                </div>
                <div class="max-h-64 overflow-y-auto no-scrollbar bg-white/50">
                    <a href="#" class="block px-5 py-3 hover:bg-slate-50 transition-colors border-b border-slate-50">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-full bg-rose-100 text-rose-500 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fa-solid fa-triangle-exclamation text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[13px] font-bold text-slate-700">Risiko Stunting Tinggi</p>
                                <p class="text-[12px] text-slate-500 mt-0.5 leading-snug">Sistem mendeteksi 3 anak dengan potensi stunting minggu ini.</p>
                                <p class="text-[10px] text-slate-400 mt-1.5 font-semibold">10 menit yang lalu</p>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="block px-5 py-3 hover:bg-slate-50 transition-colors">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fa-solid fa-cloud-arrow-up text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[13px] font-bold text-slate-700">Update Data Otomatis</p>
                                <p class="text-[12px] text-slate-500 mt-0.5 leading-snug">Data posyandu kecamatan telah berhasil disinkronisasi.</p>
                                <p class="text-[10px] text-slate-400 mt-1.5 font-semibold">2 jam yang lalu</p>
                            </div>
                        </div>
                    </a>
                </div>
                <a href="#" class="block px-4 py-3 text-center text-xs font-bold text-blue-600 hover:bg-slate-50 border-t border-slate-100 transition-colors bg-white/50">Lihat Semua Notifikasi</a>
            </div>
        </div>

        <!-- Profile Dropdown Trigger -->
        <div class="relative">
            <div id="profileBtn" class="flex cursor-pointer items-center gap-3 pl-2 md:pl-5 border-l border-slate-200/50 group active:scale-95 transition-transform">
                <div class="relative">
                    <img src="https://ui-avatars.com/api/?name=Admin+Puskesmas&background=3b82f6&color=fff&bold=true" alt="Admin Profile" class="h-10 w-10 rounded-[14px] object-cover ring-2 ring-white shadow-sm transition-transform group-hover:scale-105">
                    <div class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-emerald-500 rounded-full ring-2 ring-white"></div>
                </div>
                <div class="hidden md:block">
                    <p class="text-[13px] font-extrabold text-slate-800 leading-tight">Admin Puskesmas</p>
                    <p class="text-[11px] font-bold text-blue-500 uppercase tracking-wide">Ahli Gizi</p>
                </div>
                <i class="fa-solid fa-angle-down text-[10px] text-slate-400 ml-1 transition-transform group-hover:rotate-180"></i>
            </div>
            
            <!-- Dropdown Profil -->
            <div id="profileDropdown" class="absolute right-0 mt-4 w-64 bg-white/80 backdrop-blur-2xl rounded-[28px] shadow-[0_12px_40px_-10px_rgba(0,0,0,0.15)] ring-1 ring-white/60 overflow-hidden origin-top-right transition-all duration-300 ease-out opacity-0 invisible scale-95 translate-y-2 z-50">
                
                <!-- Profil Info Minimalis -->
                <div class="px-5 py-4 border-b border-slate-200/60 bg-white/40 backdrop-blur-sm">
                    <p class="text-[15px] font-bold text-slate-800 leading-tight tracking-tight">Admin Puskesmas</p>
                    <p class="text-[12px] font-medium text-slate-500 mt-0.5">Ahli Gizi</p>
                </div>

                <div class="p-2 space-y-1">
                    <a href="{{ route('profil.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-2xl text-[14px] text-slate-700 hover:bg-white hover:shadow-[0_2px_10px_-4px_rgba(0,0,0,0.1)] active:bg-slate-100 active:scale-[0.98] transition-all duration-200 font-semibold group">
                        <div class="flex items-center gap-3.5">
                            <div class="w-9 h-9 rounded-[14px] bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-500 group-hover:text-white transition-all duration-300 shadow-sm group-hover:shadow-blue-500/30">
                                <i class="fa-regular fa-user text-[15px]"></i>
                            </div>
                            <span class="tracking-wide">Profil Saya</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-300 group-hover:text-blue-500 group-hover:translate-x-1 transition-all duration-300"></i>
                    </a>
                    
                    <a href="{{ route('pengaturan.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-2xl text-[14px] text-slate-700 hover:bg-white hover:shadow-[0_2px_10px_-4px_rgba(0,0,0,0.1)] active:bg-slate-100 active:scale-[0.98] transition-all duration-200 font-semibold group">
                        <div class="flex items-center gap-3.5">
                            <div class="w-9 h-9 rounded-[14px] bg-slate-100 text-slate-600 flex items-center justify-center group-hover:bg-slate-800 group-hover:text-white transition-all duration-300 shadow-sm group-hover:shadow-slate-800/30">
                                <i class="fa-solid fa-gear text-[15px]"></i>
                            </div>
                            <span class="tracking-wide">Pengaturan</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-300 group-hover:text-slate-800 group-hover:translate-x-1 transition-all duration-300"></i>
                    </a>
                </div>
                
                <div class="p-2 pt-0">
                    <div class="h-px w-[calc(100%-16px)] mx-auto bg-slate-200/60 mb-2"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-between px-3 py-2.5 rounded-2xl text-[14px] text-rose-600 hover:bg-rose-50/80 hover:shadow-[0_2px_10px_-4px_rgba(225,29,72,0.1)] active:bg-rose-100 active:scale-[0.98] transition-all duration-200 font-semibold group">
                            <div class="flex items-center gap-3.5">
                                <div class="w-9 h-9 rounded-[14px] bg-rose-50 text-rose-600 flex items-center justify-center group-hover:bg-rose-500 group-hover:text-white transition-all duration-300 shadow-sm group-hover:shadow-rose-500/30">
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
        // Elements
        const notifBtn = document.getElementById('notifBtn');
        const notifDropdown = document.getElementById('notifDropdown');
        const profileBtn = document.getElementById('profileBtn');
        const profileDropdown = document.getElementById('profileDropdown');
        const searchInput = document.getElementById('searchInput');

        // Classes for Animation (Show/Hide)
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

        // Toggle Notifikasi
        if(notifBtn && notifDropdown) {
            notifBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                if (notifDropdown.classList.contains('invisible')) {
                    openDropdown(notifDropdown);
                    closeDropdown(profileDropdown); // Tutup profil jika terbuka
                } else {
                    closeDropdown(notifDropdown);
                }
            });
        }

        // Toggle Profil
        if(profileBtn && profileDropdown) {
            profileBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                if (profileDropdown.classList.contains('invisible')) {
                    openDropdown(profileDropdown);
                    closeDropdown(notifDropdown); // Tutup notif jika terbuka
                } else {
                    closeDropdown(profileDropdown);
                }
            });
        }

        // Click diluar area untuk menutup dropdown
        document.addEventListener('click', (e) => {
            if (notifBtn && !notifBtn.contains(e.target) && notifDropdown && !notifDropdown.contains(e.target)) {
                closeDropdown(notifDropdown);
            }
            if (profileBtn && !profileBtn.contains(e.target) && profileDropdown && !profileDropdown.contains(e.target)) {
                closeDropdown(profileDropdown);
            }
        });

        // Search Bar Logic (Live Filter Sidebar Menu)
        if(searchInput) {
            searchInput.addEventListener('input', (e) => {
                const query = e.target.value.toLowerCase();
                const menuItems = document.querySelectorAll('aside nav ul li a');
                
                menuItems.forEach(item => {
                    const text = item.innerText.toLowerCase();
                    const parentLi = item.parentElement;
                    
                    if (text.includes(query)) {
                        parentLi.style.display = 'block';
                    } else {
                        parentLi.style.display = 'none';
                    }
                });

                // Tampilkan/Sembunyikan label kategori
                const categoryTitles = document.querySelectorAll('aside nav ul li span.text-\\[11px\\]');
                categoryTitles.forEach(title => {
                    const parentLi = title.parentElement;
                    if(query === '') {
                        parentLi.style.display = 'block';
                    } else {
                        parentLi.style.display = 'none'; // Sembunyikan kategori saat pencarian aktif
                    }
                });
            });
        }
    });
</script>
