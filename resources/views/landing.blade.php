<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Prediksi Stunting - Deteksi Dini Status Gizi Balita</title>
    
    <!-- Google Fonts: Nunito for kids/friendly theme -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Nunito', sans-serif; }
        
        /* Custom Keyframe Animations */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        @keyframes float-delay {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        @keyframes wave-animation {
            0% { transform: translateX(0) scaleY(1); }
            50% { transform: translateX(-25%) scaleY(0.95); }
            100% { transform: translateX(-50%) scaleY(1); }
        }
        
        .animate-float {
            animation: float 5s ease-in-out infinite;
        }
        .animate-float-delay {
            animation: float-delay 6s ease-in-out infinite 2s;
        }
        
        /* Wavy bottom background */
        .wavy-bg {
            position: relative;
            background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 50%, #06b6d4 100%);
            overflow: hidden;
            z-index: 1;
        }
        .wavy-bg::before, .wavy-bg::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            right: 0;
            background-repeat: repeat-x;
            z-index: -1;
        }
        /* We can use layered SVG for the cute wave effect later */
        
        /* Shadow styles for modern friendly look */
        .card-shadow {
            box-shadow: 0 10px 40px -10px rgba(59,130,246,0.15);
        }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-800 overflow-x-hidden">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md transition-all duration-300 py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <div class="flex items-center">
                        <!-- Playful Logo Mark -->
                        <div class="relative w-10 h-10 mr-3">
                            <div class="absolute inset-0 bg-blue-500 rounded-full opacity-20 animate-ping"></div>
                            <div class="relative w-10 h-10 bg-gradient-to-tr from-blue-600 to-cyan-400 rounded-full flex items-center justify-center shadow-lg shadow-blue-500/30">
                                <span class="text-white font-black text-xl">S</span>
                            </div>
                        </div>
                        <span class="font-extrabold text-2xl tracking-tight text-blue-900">Stunt<span class="text-cyan-500">Check</span></span>
                    </div>
                </div>
                
                <!-- Nav Links -->
                <div class="hidden md:flex space-x-10 items-center">
                    <a href="#beranda" class="text-slate-600 hover:text-blue-600 font-bold transition-colors">Home</a>
                    <a href="#apa-itu-stunting" class="text-slate-600 hover:text-blue-600 font-bold transition-colors">Tentang Stunting</a>
                    <a href="#apa-itu-stuntcheck" class="text-slate-600 hover:text-blue-600 font-bold transition-colors">Fitur Aplikasi</a>
                    
                    <!-- Login CTA -->
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-bold rounded-full text-white bg-blue-500 hover:bg-blue-600 shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-0.5 transition-all duration-300">
                        Masuk
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="relative pt-32 pb-40 lg:pt-40 lg:pb-56 overflow-visible">
        <!-- Abstract shape backgrounds to mimic the soft wave background -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[600px] h-[600px] bg-sky-100 rounded-full blur-[80px] opacity-60 z-0"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-[500px] h-[500px] bg-blue-100 rounded-full blur-[80px] opacity-60 z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-center">
                <!-- Text Content -->
                <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-50 text-blue-600 font-bold text-sm mb-6 border border-blue-100 shadow-sm animate-float-delay">
                        <span class="relative flex h-2.5 w-2.5 mr-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-500"></span>
                        </span>
                        Aplikasi Pemantauan Kesehatan Anak
                    </div>
                    
                    <h1 class="text-5xl tracking-tight font-extrabold text-slate-800 sm:text-6xl md:text-7xl lg:text-5xl xl:text-6xl mb-4 leading-tight">
                        Cegah <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-500">Stunting</span><br>
                        pada <span class="text-blue-900 font-black">Anak</span>
                    </h1>
                    
                    <p class="mt-3 text-base text-slate-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0 mb-10">
                        Pantau tumbuh kembang anak Anda secara teratur. Cegah stunting sejak dini untuk masa depan yang lebih cerdas dan membanggakan.
                    </p>
                    
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start gap-4">
                        <div class="rounded-full shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-1 transition-all duration-300">
                            <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-8 py-3.5 border border-transparent text-base font-bold rounded-full text-white bg-emerald-500 hover:bg-emerald-600 md:py-4 md:text-lg px-10">
                                Cek Status Anakmu
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                        <div class="mt-3 sm:mt-0">
                            <a href="#apa-itu-stunting" class="w-full flex items-center justify-center px-8 py-3.5 border-2 border-blue-100 text-base font-bold rounded-full text-blue-600 bg-transparent hover:bg-blue-50 md:py-4 md:text-lg transition-all duration-300">
                                Pelajari Lebih Lanjut
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Hero Illustration -->
                <div class="mt-16 lg:mt-0 lg:col-span-6 relative">
                    <div class="relative mx-auto w-full max-w-lg lg:max-w-none animate-float">
                        <!-- We use our generated image here -->
                        <img class="w-full h-auto drop-shadow-2xl relative z-10" src="{{ asset('img/stunting_hero.png') }}" alt="Ilustrasi Dokter dan Anak">
                        
                        <!-- Decorative animated elements floating around -->
                        <div class="absolute top-10 right-10 bg-white p-3 rounded-2xl shadow-xl z-20 animate-float-delay transform rotate-12">
                            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center text-2xl">🍎</div>
                        </div>
                        <div class="absolute bottom-20 left-10 bg-white p-3 rounded-2xl shadow-xl z-20 animate-float transform -rotate-12" style="animation-delay: 1s;">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-2xl">🍼</div>
                        </div>
                        <div class="absolute top-1/2 -right-5 bg-white p-3 rounded-2xl shadow-xl z-20 animate-float transform rotate-6" style="animation-delay: 2s;">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-2xl">🥦</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Floating Feature Cards overlapping Hero -->
    <section class="relative z-20 -mt-32 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white rounded-[2rem] p-8 card-shadow hover:-translate-y-2 transition-all duration-300 border border-slate-100">
                    <div class="h-16 w-16 bg-red-50 rounded-2xl flex items-center justify-center mb-6">
                        <!-- Icon -->
                        <svg class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Monitoring Pertumbuhan</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">
                        Lacak berat & tinggi anak dengan mudah. Dapatkan grafik pertumbuhan sesuai standar WHO.
                    </p>
                </div>
                
                <!-- Card 2 -->
                <div class="bg-white rounded-[2rem] p-8 card-shadow hover:-translate-y-2 transition-all duration-300 border border-slate-100">
                    <div class="h-16 w-16 bg-emerald-50 rounded-2xl flex items-center justify-center mb-6">
                        <!-- Icon -->
                        <svg class="h-8 w-8 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Tips & Edukasi</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">
                        Informasi sehat untuk cegah stunting. Asupan gizi yang tepat pada usia emas pertumbuhan.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-[2rem] p-8 card-shadow hover:-translate-y-2 transition-all duration-300 border border-slate-100">
                    <div class="h-16 w-16 bg-blue-50 rounded-2xl flex items-center justify-center mb-6">
                        <!-- Icon -->
                        <svg class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Analisis Kesehatan</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">
                        Laporan detail perkembangan anak Anda berdasarkan sistem pakar dan perhitungan Z-score.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mengapa Stunting Berbahaya -->
    <section id="apa-itu-stunting" class="py-20 relative bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center md:max-w-3xl md:mx-auto mb-16">
                <h2 class="text-4xl font-extrabold text-blue-900 sm:text-5xl mb-6">
                    Mengapa <span class="text-slate-800">Stunting</span> <span class="text-blue-500">Berbahaya?</span>
                </h2>
                <p class="text-lg text-slate-500 font-medium">
                    Bantu si kecil tumbuh sehat dan cerdas dengan memahami risiko stunting sejak dini.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4 sm:px-0">
                <!-- Hazard 1 -->
                <div class="bg-white rounded-[2.5rem] p-8 text-center shadow-lg shadow-slate-200/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 relative group overflow-hidden">
                    <div class="absolute inset-0 bg-blue-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-32 h-32 mb-6">
                            <!-- Custom illustration placeholder (Using emojis for kid-friendly style or svg) -->
                            <div class="w-full h-full bg-blue-100 rounded-full flex items-center justify-center text-6xl shadow-inner animate-float">
                                🧠
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-blue-900 mb-4">Gangguan Kognitif</h3>
                        <p class="text-slate-500 font-medium">Menghambat perkembangan otak anak, menurunkan kecerdasan dan prestasi belajar saat dewasa kelak.</p>
                    </div>
                </div>

                <!-- Hazard 2 -->
                <div class="bg-white rounded-[2.5rem] p-8 text-center shadow-lg shadow-slate-200/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 relative group overflow-hidden">
                    <div class="absolute inset-0 bg-emerald-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-32 h-32 mb-6">
                            <div class="w-full h-full bg-emerald-100 rounded-full flex items-center justify-center text-6xl shadow-inner animate-float-delay">
                                📏
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-blue-900 mb-4">Pertumbuhan Terhambat</h3>
                        <p class="text-slate-500 font-medium">Anak tampak lebih pendek dari anak seusianya dan rentan memiliki postur tubuh tidak maksimal.</p>
                    </div>
                </div>

                <!-- Hazard 3 -->
                <div class="bg-white rounded-[2.5rem] p-8 text-center shadow-lg shadow-slate-200/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 relative group overflow-hidden">
                    <div class="absolute inset-0 bg-cyan-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-32 h-32 mb-6">
                            <div class="w-full h-full bg-cyan-100 rounded-full flex items-center justify-center text-6xl shadow-inner animate-float">
                                🛡️
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-blue-900 mb-4">Risiko Penyakit</h3>
                        <p class="text-slate-500 font-medium">Sistem imun tubuh lebih rendah, menjadikan anak lebih rentan terhadap berbagai penyakit kronis pada usia dewasa.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Wave Bottom Section -->
    <section class="wavy-bg pt-32 pb-20 lg:pt-48 lg:pb-32 mt-10 relative">
        <!-- SVG wave top border -->
        <svg class="absolute top-0 w-full text-slate-50 fill-current -mt-1" viewBox="0 0 1440 120" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,64L80,74.7C160,85,320,107,480,101.3C640,96,800,64,960,48C1120,32,1280,32,1360,32L1440,32L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path>
        </svg>
        
        <!-- Animated Background bubbles -->
        <div class="absolute top-20 left-10 w-24 h-24 bg-white rounded-full opacity-10 animate-float"></div>
        <div class="absolute bottom-20 right-20 w-40 h-40 bg-white rounded-full opacity-10 animate-float-delay"></div>
        <div class="absolute top-1/2 left-1/4 w-12 h-12 bg-white rounded-full opacity-20 animate-ping"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h2 class="text-4xl sm:text-5xl font-extrabold text-white mb-6 tracking-tight drop-shadow-md">
                Mulai Pantau Kesehatan Anakmu!
            </h2>
            <p class="text-xl text-blue-50 font-medium mb-12 max-w-2xl mx-auto">
                Bergabung sekarang dan pantau grafik pertumbuhan si kecil setiap detiknya secara gratis dan mudah digunakan.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-10 py-4 border border-transparent text-lg font-bold rounded-full text-white bg-emerald-500 hover:bg-emerald-400 shadow-xl shadow-emerald-600/30 hover:-translate-y-1 transition-all duration-300">
                    Cek Sekarang
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>

            </div>
        </div>
        
        <!-- SVG wave bottom border -->
        <svg class="absolute bottom-0 w-full text-white fill-current -mb-1 opacity-20 transform rotate-180" viewBox="0 0 1440 120" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,64L80,74.7C160,85,320,107,480,101.3C640,96,800,64,960,48C1120,32,1280,32,1360,32L1440,32L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path>
        </svg>
    </section>

    <!-- Footer -->
    <footer class="bg-white pt-10 pb-8 text-center text-slate-500 text-sm font-medium">
        <p>&copy; {{ date('Y') }} Sistem Prediksi Stunting - StuntCheck. All rights reserved.</p>
    </footer>

</body>
</html>