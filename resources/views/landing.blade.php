<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StuntCheck - Platform Health-Tech Pencegahan Stunting</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #fafafa; }
        
        /* Glassmorphism Utilities */
        .glass {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
        }
        
        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        
        @keyframes float-delayed {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        .animate-float-delayed { animation: float-delayed 5s ease-in-out infinite 2.5s; }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(16, 185, 129, 0.4); }
            50% { box-shadow: 0 0 40px rgba(16, 185, 129, 0.7); }
        }
        .btn-glow {
            animation: pulse-glow 3s infinite;
        }

        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .bg-animated {
            background: linear-gradient(-45deg, #f8fafc, #f1f5f9, #e0f2fe, #ecfdf5);
            background-size: 400% 400%;
            animation: gradient-shift 15s ease infinite;
        }

        .text-gradient {
            background: linear-gradient(135deg, #3B82F6, #10B981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .bg-primary-gradient {
            background: linear-gradient(135deg, #3B82F6, #0ea5e9, #10B981);
            background-size: 200% 200%;
            animation: gradient-shift 10s ease infinite;
        }

        /* Hero Image Fix */
        .hero-img { mix-blend-mode: multiply; }

        /* Card Hover */
        .hover-card { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .hover-card:hover { 
            transform: translateY(-10px);
            box-shadow: 0 20px 40px -10px rgba(59, 130, 246, 0.15);
        }
    </style>
</head>
<body class="antialiased text-slate-800 overflow-x-hidden bg-animated selection:bg-blue-100">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass transition-all duration-300 py-3" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-14">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center cursor-pointer" data-aos="fade-right" data-aos-duration="800">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo StuntCheck" class="w-10 h-10 mr-3 object-contain drop-shadow-sm">
                    <span class="font-extrabold text-2xl tracking-tight text-slate-800">Stunt<span class="text-blue-500">Check</span></span>
                </div>
                
                <!-- Nav Links -->
                <div class="hidden md:flex space-x-8 items-center" data-aos="fade-down" data-aos-duration="800" data-aos-delay="100">
                    <a href="#hero" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">Beranda</a>
                    <a href="#about" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">Tentang Kami</a>
                    <a href="#features" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">Fitur</a>
                    <a href="#impact" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">Dampak</a>
                </div>


            </div>
        </div>
    </nav>

    <!-- 1. HERO SECTION -->
    <section id="hero" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <!-- Decorative blobs -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[300px] md:w-[500px] h-[300px] md:h-[500px] rounded-full bg-blue-400/20 blur-[80px] z-0 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-[250px] md:w-[400px] h-[250px] md:h-[400px] rounded-full bg-emerald-400/20 blur-[80px] z-0 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="text-center lg:text-left" data-aos="fade-right" data-aos-duration="1000">
                    <div class="inline-flex items-center px-4 py-2 rounded-full glass text-blue-600 font-bold text-sm mb-6 border border-blue-200">
                        <span class="flex h-2.5 w-2.5 relative mr-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                        </span>
                        Platform Health-Tech Masa Depan
                    </div>
                    
                    <h1 class="text-5xl lg:text-6xl xl:text-7xl font-extrabold text-slate-800 leading-[1.1] mb-6">
                        Cegah <span class="text-gradient">Stunting</span><br>
                        Pada Anak
                    </h1>
                    
                    <p class="text-lg text-slate-500 mb-10 max-w-xl mx-auto lg:mx-0 leading-relaxed font-medium">
                        Pantau tumbuh kembang si kecil dengan teknologi cerdas. Deteksi dini potensi stunting dengan analisis berbasis sistem pakar dan standar WHO.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start mt-4">
                        <a href="{{ route('login') }}" class="btn-glow flex items-center justify-center px-8 py-4 rounded-full bg-[#10B981] text-white font-bold text-lg hover:bg-emerald-600 transition-all transform hover:scale-105">
                            Cek Sekarang
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </a>
                        <a href="#about" class="flex items-center justify-center px-8 py-4 rounded-full border-2 border-slate-200 text-slate-600 font-bold text-lg hover:border-blue-500 hover:text-blue-600 transition-all bg-white/50 backdrop-blur-sm">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                
                <!-- Illustration -->
                <div class="relative flex items-center justify-center mt-12 lg:mt-0" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <div class="relative w-full max-w-md lg:max-w-lg animate-float z-10">
                        <img src="{{ asset('img/stunting_hero.png') }}" alt="Ilustrasi Dokter dan Anak" class="w-full h-auto hero-img drop-shadow-2xl">
                    </div>

                    <!-- Floating Elements (Fruits/Veggies) - Hidden on extra small screens -->
                    <div class="absolute top-10 right-4 md:right-10 bg-white/80 backdrop-blur-md p-3 rounded-2xl shadow-xl z-20 animate-float-delayed transform rotate-12 pointer-events-none hidden sm:block">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center text-2xl shadow-inner">🍎</div>
                    </div>
                    <div class="absolute bottom-20 left-4 md:left-10 bg-white/80 backdrop-blur-md p-3 rounded-2xl shadow-xl z-20 animate-float transform -rotate-12 pointer-events-none hidden sm:block" style="animation-delay: 1s;">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-2xl shadow-inner">🍼</div>
                    </div>
                    <div class="absolute top-1/2 -right-2 md:-right-5 bg-white/80 backdrop-blur-md p-3 rounded-2xl shadow-xl z-20 animate-float transform rotate-6 pointer-events-none hidden md:block" style="animation-delay: 2s;">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-2xl shadow-inner">🥦</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. ABOUT SECTION -->
    <section id="about" class="py-24 relative z-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass rounded-[2rem] p-8 md:p-16 text-center shadow-2xl relative overflow-hidden border border-white/40" data-aos="zoom-in" data-aos-duration="800">
                <!-- Decorative background pattern inside card -->
                <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-blue-100 rounded-full opacity-30 blur-2xl pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-40 h-40 bg-emerald-100 rounded-full opacity-30 blur-2xl pointer-events-none"></div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto bg-gradient-to-br from-blue-500 to-emerald-400 rounded-2xl flex items-center justify-center mb-6 md:mb-8 shadow-lg shadow-blue-500/30 transform -rotate-6">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-800 mb-6">Apa itu <span class="text-gradient">StuntCheck?</span></h2>
                    <p class="text-base md:text-lg text-slate-500 leading-relaxed font-medium max-w-3xl mx-auto">
                        StuntCheck adalah platform cerdas inovatif yang dirancang khusus untuk memantau status gizi dan tumbuh kembang anak. Kami membantu Anda mendeteksi potensi stunting sejak dini melalui analisis yang akurat, sehingga langkah pencegahan dapat dilakukan secara optimal demi masa depan yang gemilang.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. FITUR -->
    <section id="features" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-sm font-bold text-blue-600 tracking-wider uppercase mb-3">Layanan Kami</h2>
                <h3 class="text-4xl font-extrabold text-slate-800">Fitur Unggulan StuntCheck</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-[2rem] p-8 hover-card border border-slate-100 shadow-sm relative overflow-hidden group" data-aos="fade-up" data-aos-delay="100">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-10 -mt-10 transition-transform group-hover:scale-110 pointer-events-none"></div>
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30 relative z-10">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800 mb-3 relative z-10">Monitoring Pertumbuhan</h4>
                    <p class="text-slate-500 font-medium leading-relaxed relative z-10">Lacak berat dan tinggi anak dengan sistematis. Dapatkan grafik pertumbuhan visual yang disesuaikan dengan standar kurva WHO secara real-time.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-[2rem] p-8 hover-card border border-slate-100 shadow-sm relative overflow-hidden group" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-full -mr-10 -mt-10 transition-transform group-hover:scale-110 pointer-events-none"></div>
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center mb-6 shadow-lg shadow-emerald-500/30 relative z-10">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800 mb-3 relative z-10">Edukasi Nutrisi</h4>
                    <p class="text-slate-500 font-medium leading-relaxed relative z-10">Akses ribuan informasi sehat untuk mencegah stunting. Panduan asupan gizi yang tepat pada usia emas untuk menunjang tumbuh kembang optimal.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-[2rem] p-8 hover-card border border-slate-100 shadow-sm relative overflow-hidden group md:col-span-2 lg:col-span-1" data-aos="fade-up" data-aos-delay="300">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-bl-full -mr-10 -mt-10 transition-transform group-hover:scale-110 pointer-events-none"></div>
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-400 to-indigo-600 flex items-center justify-center mb-6 shadow-lg shadow-indigo-500/30 relative z-10">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800 mb-3 relative z-10">Analisis Cerdas</h4>
                    <p class="text-slate-500 font-medium leading-relaxed relative z-10">Laporan detail dan prediksi perkembangan anak menggunakan perhitungan Z-score serta rekomendasi langsung dari sistem berbasis kecerdasan buatan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. DAMPAK STUNTING -->
    <section id="impact" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-extrabold text-slate-800 mb-4">Mengapa Stunting <span class="text-red-500">Berbahaya?</span></h2>
                <p class="text-lg text-slate-500 font-medium max-w-2xl mx-auto">Kenali ancaman tersembunyi dari stunting yang dapat memengaruhi masa depan anak secara permanen jika tidak ditangani sedini mungkin.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                <!-- Impact 1: Merah -->
                <div class="glass p-8 rounded-[2rem] hover-card border-t-4 border-red-500 bg-red-50/30" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-white rounded-2xl flex items-center justify-center text-3xl md:text-4xl mb-6 shadow-sm shadow-red-100">🧠</div>
                    <h4 class="text-xl md:text-2xl font-bold text-slate-800 mb-3">Gangguan Kognitif</h4>
                    <p class="text-slate-600 font-medium text-sm md:text-base leading-relaxed">Menghambat perkembangan otak secara drastis, menurunkan tingkat kecerdasan dan fokus belajar saat anak tumbuh dewasa.</p>
                </div>

                <!-- Impact 2: Kuning -->
                <div class="glass p-8 rounded-[2rem] hover-card border-t-4 border-yellow-400 bg-yellow-50/30" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-white rounded-2xl flex items-center justify-center text-3xl md:text-4xl mb-6 shadow-sm shadow-yellow-100">📏</div>
                    <h4 class="text-xl md:text-2xl font-bold text-slate-800 mb-3">Pertumbuhan Terhambat</h4>
                    <p class="text-slate-600 font-medium text-sm md:text-base leading-relaxed">Fisik anak tampak jauh lebih pendek dibanding anak seusianya, serta rentan memiliki postur tubuh yang tidak proporsional.</p>
                </div>

                <!-- Impact 3: Biru -->
                <div class="glass p-8 rounded-[2rem] hover-card border-t-4 border-blue-500 bg-blue-50/30 sm:col-span-2 lg:col-span-1" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-white rounded-2xl flex items-center justify-center text-3xl md:text-4xl mb-6 shadow-sm shadow-blue-100">🛡️</div>
                    <h4 class="text-xl md:text-2xl font-bold text-slate-800 mb-3">Risiko Penyakit</h4>
                    <p class="text-slate-600 font-medium text-sm md:text-base leading-relaxed">Menurunkan sistem kekebalan tubuh, menjadikan anak lebih rentan terhadap berbagai penyakit kronis dan infeksi berkelanjutan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. CALL TO ACTION (CTA) -->
    <section class="relative pt-40 pb-32 md:pt-48 md:pb-48 overflow-hidden bg-primary-gradient">
        <!-- Wave Separator top -->

        <!-- Decorative background elements -->
        <div class="absolute top-20 right-20 w-64 h-64 bg-white rounded-full mix-blend-overlay filter blur-3xl opacity-30 animate-float pointer-events-none"></div>
        <div class="absolute bottom-10 left-20 w-48 h-48 bg-white rounded-full mix-blend-overlay filter blur-2xl opacity-20 animate-float-delayed pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center" data-aos="zoom-in" data-aos-duration="1000">
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 md:mb-8 leading-tight tracking-tight drop-shadow-lg">
                Mulai Pantau Kesehatan<br>Anak Anda Sekarang!
            </h2>
            <p class="text-xl text-blue-50 font-medium mb-12 max-w-2xl mx-auto opacity-90">
                Dampingi setiap tahap pertumbuhan si kecil. Kami bantu deteksi potensi stunting lebih awal melalui sistem pakar yang akurat dan tepercaya dengan standar WHO.
            </p>
            
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-10 py-5 rounded-full bg-white text-blue-600 font-extrabold text-xl hover:bg-slate-50 transition-all hover:-translate-y-1 hover:shadow-2xl hover:shadow-white/20 glow-button">
                Daftar & Cek Gratis
                <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>

        <!-- Wave Separator bottom -->
    </section>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-slate-100 py-12 relative overflow-hidden">
        <!-- Subtle decorative blobs -->
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-blue-50 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-emerald-50 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col items-center justify-center text-center">
            <!-- Brand -->
            <div class="flex items-center justify-center mb-4">
                <img src="{{ asset('img/logo.png') }}" alt="Logo StuntCheck" class="w-8 h-8 mr-2 object-contain grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                <span class="font-extrabold text-xl tracking-tight text-slate-800">Stunt<span class="text-blue-500">Check</span></span>
            </div>
            
            <p class="text-slate-500 text-sm font-medium max-w-md mx-auto mb-6">
                Platform inovatif untuk deteksi dini dan pemantauan stunting pada anak berdasarkan standar WHO.
            </p>

            <div class="w-16 h-1 bg-gradient-to-r from-blue-500 to-emerald-400 rounded-full mb-6 opacity-80"></div>

            <p class="text-slate-400 text-sm font-medium">
                &copy; {{ date('Y') }} StuntCheck. Hak Cipta Dilindungi.
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS animations
        AOS.init({
            once: true,
            offset: 50,
            easing: 'ease-out-cubic',
        });

        // Navbar blur effect on scroll
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 20) {
                nav.classList.add('shadow-md');
                nav.classList.add('bg-white/80');
            } else {
                nav.classList.remove('shadow-md');
                nav.classList.remove('bg-white/80');
            }
        });
    </script>
</body>
</html>