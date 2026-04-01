<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: true }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Prediksi Stunting</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 font-sans text-slate-900">

    <div class="flex h-screen overflow-hidden">
        
        <aside 
            :class="sidebarOpen ? 'w-64' : 'w-20'" 
            class="relative h-screen bg-indigo-900 text-white transition-all duration-300 ease-in-out flex flex-col shadow-xl">
            
            <div class="h-16 flex items-center px-6 bg-indigo-950 border-b border-indigo-800">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-emerald-400 rounded-lg flex-shrink-0"></div>
                    <span x-show="sidebarOpen" class="font-bold text-lg tracking-wider transition-opacity italic">STUNT-PRED</span>
                </div>
            </div>

            <nav class="flex-1 mt-6 px-3 space-y-2">
                <a href="#" class="flex items-center p-3 rounded-lg bg-indigo-800 text-emerald-400 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span x-show="sidebarOpen" class="ml-4 font-medium transition-opacity">Dashboard</span>
                </a>
                <a href="#" class="flex items-center p-3 rounded-lg hover:bg-indigo-800 hover:text-emerald-300 transition-all text-slate-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    <span x-show="sidebarOpen" class="ml-4 font-medium transition-opacity">Data Input</span>
                </a>
                <a href="#" class="flex items-center p-3 rounded-lg hover:bg-indigo-800 hover:text-emerald-300 transition-all text-slate-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path></svg>
                    <span x-show="sidebarOpen" class="ml-4 font-medium transition-opacity">Analisis GIS</span>
                </a>
            </nav>

            <div class="p-4 border-t border-indigo-800">
                <button class="flex items-center w-full p-2 text-slate-400 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span x-show="sidebarOpen" class="ml-4">Keluar</span>
                </button>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 sticky top-0 z-10">
                <button @click="sidebarOpen = !sidebarOpen" class="text-slate-500 hover:text-indigo-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                </button>
                <div class="flex items-center space-x-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-slate-700 leading-none">Cindy Aulia</p>
                        <p class="text-xs text-slate-400 mt-1">Admin Sistem</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=Cindy+Aulia&background=6366f1&color=fff" class="w-10 h-10 rounded-full border-2 border-slate-100" alt="Avatar">
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>