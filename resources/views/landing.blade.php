<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Prediksi Stunting - Deteksi Dini Status Gizi Balita</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-800">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-200 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center text-white font-bold text-xl mr-2">
                        S
                    </div>
                    <span class="font-bold text-xl tracking-tight text-slate-900">Stunt<span class="text-blue-600">Check</span></span>
                </div>
                <!-- Nav Links -->
                <div class="hidden md:flex space-x-8">
                    <a href="#beranda" class="text-slate-600 hover:text-blue-600 font-medium transition-colors">Beranda</a>
                    <a href="#apa-itu-stunting" class="text-slate-600 hover:text-blue-600 font-medium transition-colors">Tentang Stunting</a>
                    <a href="#apa-itu-stuntcheck" class="text-slate-600 hover:text-blue-600 font-medium transition-colors">Tentang Sistem</a>
                </div>
                <!-- Login CTA -->
                <div class="flex items-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-full text-white bg-blue-600 hover:bg-blue-700 shadow-sm hover:shadow-md transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Masuk Sistem
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-sky-300 to-blue-600 opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center justify-center px-4 py-1.5 mb-6 rounded-full bg-blue-50 border border-blue-100 shadow-sm">
                    <span class="flex h-2 w-2 rounded-full bg-blue-600 mr-2 animate-pulse"></span>
                    <span class="text-xs font-semibold text-blue-600 uppercase tracking-widest">Deteksi Dini Status Gizi</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 mb-8 leading-tight">
                    Bersama Cegah Stunting,<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">Wujudkan Generasi Cerdas</span>
                </h1>
                <p class="mt-4 text-lg md:text-xl text-slate-600 leading-relaxed mb-10">
                    Aplikasi cerdas berbasis Machine Learning untuk memprediksi status stunting pada balita menggunakan standar antropometri World Health Organization (WHO).
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('login') }}" class="inline-flex justify-center items-center px-8 py-3.5 border border-transparent text-base font-medium rounded-full text-white bg-blue-600 hover:bg-blue-700 md:text-lg transition-all shadow-lg hover:shadow-blue-500/30">
                        Cek Status Gizi Sekarang
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                    <a href="#apa-itu-stunting" class="inline-flex justify-center items-center px-8 py-3.5 border border-slate-300 text-base font-medium rounded-full text-slate-700 bg-white hover:bg-slate-50 md:text-lg transition-all shadow-sm">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Apa itu Stunting -->
    <section id="apa-itu-stunting" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
                <div class="mb-12 lg:mb-0">
                    <!-- Image mockup / illustration replacement -->
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl bg-blue-100 aspect-w-4 aspect-h-3 sm:aspect-w-16 sm:aspect-h-9 lg:aspect-auto lg:h-[500px] flex items-center justify-center">
                       <div class="absolute inset-0 bg-gradient-to-tr from-blue-500/20 to-cyan-500/20 mix-blend-multiply"></div>
                       <div class="relative p-8 w-full max-w-sm">
                           <div class="grid grid-cols-2 gap-4">
                               <div class="space-y-4">
                                   <div class="h-32 w-full bg-white rounded-xl shadow-md p-4 animate-[bounce_3s_ease-in-out_infinite]">
                                        <div class="h-4 bg-slate-200 rounded w-1/2 mb-4"></div>
                                        <div class="h-16 w-16 rounded-full bg-blue-100 flex items-center justify-center mx-auto">
                                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                        </div>
                                   </div>
                                   <div class="h-40 w-full bg-blue-600 rounded-xl shadow-lg p-5 text-white flex flex-col justify-end">
                                        <span class="text-3xl font-bold block mb-1">-2.0</span>
                                        <span class="text-sm text-blue-100">Ambang Batas Z-Score</span>
                                   </div>
                               </div>
                               <div class="space-y-4 pt-8">
                                   <div class="h-48 w-full bg-slate-800 rounded-xl shadow-lg p-5 text-white flex flex-col justify-end transform hover:-translate-y-1 transition-transform">
                                        <div class="w-full bg-slate-700 rounded-full h-2 mb-2"><div class="bg-cyan-500 h-2 rounded-full" style="width: 70%"></div></div>
                                        <div class="w-full bg-slate-700 rounded-full h-2 mb-2"><div class="bg-blue-500 h-2 rounded-full" style="width: 45%"></div></div>
                                        <div class="w-full bg-slate-700 rounded-full h-2 mb-4"><div class="bg-sky-500 h-2 rounded-full" style="width: 85%"></div></div>
                                        <span class="text-sm text-slate-300">Analisis Gizi</span>
                                   </div>
                                   <div class="h-24 w-full bg-white rounded-xl shadow-md p-4 flex items-center">
                                       <div class="h-12 w-12 rounded-full bg-emerald-100 flex items-center justify-center mr-4">
                                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                       </div>
                                       <div>
                                            <div class="h-3 w-16 bg-slate-200 rounded mb-2"></div>
                                            <div class="h-2 w-24 bg-slate-100 rounded"></div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-blue-600 uppercase tracking-wide">Pahami Bahayanya</h2>
                    <h3 class="mt-2 text-3xl font-extrabold text-slate-900 sm:text-4xl">Apa itu Stunting?</h3>
                    <p class="mt-4 text-lg text-slate-600 leading-relaxed">
                        Stunting adalah gangguan pertumbuhan dan perkembangan anak akibat kekurangan gizi kronis dan infeksi berulang, yang ditandai dengan panjang atau tinggi badannya berada di bawah standar.
                    </p>
                    <div class="mt-8 space-y-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-blue-500 text-white shadow-md">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-xl font-bold text-slate-900">Bukan Sekadar Pendek</h4>
                                <p class="mt-2 text-base text-slate-600">Anak stunting pasti pendek, namun anak pendek belum tentu stunting. Stunting berdampak pada keterlambatan perkembangan otak, menjadikan anak lebih rentan terhadap penyakit.</p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-cyan-500 text-white shadow-md">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-xl font-bold text-slate-900">Standar WHO</h4>
                                <p class="mt-2 text-base text-slate-600">Seorang anak dikategorikan stunting jika tinggi/panjang badannya menurut umur berada pada angka di bawah -2 Standar Deviasi (SD) kurva pertumbuhan WHO.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Apa itu StuntCheck -->
    <section id="apa-itu-stuntcheck" class="py-20 bg-slate-50 relative border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center md:max-w-2xl md:mx-auto mb-16">
                <h2 class="text-sm font-bold text-blue-600 uppercase tracking-wide">Pengenalan Aplikasi</h2>
                <h3 class="mt-2 text-3xl font-extrabold text-slate-900 sm:text-4xl">Mengapa Memilih StuntCheck?</h3>
                <p class="mt-4 text-lg text-slate-600">
                    StuntCheck adalah inovasi teknologi untuk mendigitalisasi proses pemantauan status gizi, memudahkan pakar dan tenaga kesehatan dalam mengidentifikasi risiko stunting.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-6">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Model Cerdas Evaluasi</h4>
                    <p class="text-slate-600">Menganalisis matriks pertumbuhan dan memberikan klasifikasi status gizi secara akurat untuk berbagai kombinasi pengukuran antropometri.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-sky-50 rounded-full z-0 opacity-50"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center mb-6">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold text-slate-900 mb-3">Standar WHO</h4>
                        <p class="text-slate-600">Semua perhitungan Z-score dan metrik pertumbuhan telah disesuaikan dengan standar grafik pertumbuhan balita dari World Health Organization (WHO).</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center mb-6">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Manajemen Terpadu</h4>
                    <p class="text-slate-600">Kelola master data ibu, anak, dan bahan makanan. Riwayat tumbuh kembang anak dicatat secara berkala untuk evaluasi menyeluruh.</p>
                </div>
            </div>
            
            <div class="mt-16 text-center pt-8 border-t border-slate-200">
                <a href="{{ route('login') }}" class="inline-flex justify-center items-center px-8 py-4 border border-transparent text-base font-semibold rounded-full text-white bg-blue-600 hover:bg-blue-700 shadow-md hover:shadow-lg transition-all">
                    Masuk ke Sistem Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex justify-center md:justify-start items-center mb-6 md:mb-0">
                    <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold text-xl mr-2">S</div>
                    <span class="font-bold text-lg tracking-tight text-slate-900">StuntCheck</span>
                </div>
                <div class="mt-4 md:mt-0 flex justify-center space-x-6">
                    <a href="#" class="text-slate-400 hover:text-blue-600 transition-colors">
                        <span class="sr-only">Tentang</span>
                        Tentang
                    </a>
                    <a href="#" class="text-slate-400 hover:text-blue-600 transition-colors">
                        <span class="sr-only">Privasi</span>
                        Privasi
                    </a>
                </div>
                <div class="mt-4 md:mt-0 text-center md:text-right">
                    <p class="text-sm text-slate-500">
                        &copy; {{ date('Y') }} Sistem Prediksi Stunting. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>