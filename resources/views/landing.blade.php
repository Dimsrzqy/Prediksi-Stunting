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
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
        
        /* Antigravity CTA Section (Light Theme) */
        .bg-antigravity-light {
            background-color: #f8fafc;
            background-image: radial-gradient(circle at 50% 50%, #ffffff 0%, #e0f2fe 100%);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        /* Futuristic Grid (Light) */
        .bg-antigravity-light::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(to right, rgba(14, 165, 233, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(14, 165, 233, 0.05) 1px, transparent 1px);
            background-size: 40px 40px;
            mask-image: radial-gradient(circle at center, black 20%, transparent 80%);
            -webkit-mask-image: radial-gradient(circle at center, black 20%, transparent 80%);
            pointer-events: none;
            z-index: -1;
        }

        /* Ambient Glow Spheres (Light) */
        .ambient-glow {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.3;
            pointer-events: none;
            z-index: -1;
        }
        .glow-blue-light { background: #3b82f6; width: 40vw; height: 40vw; top: -10%; left: -10%; }
        .glow-emerald-light { background: #10b981; width: 50vw; height: 50vw; bottom: -20%; right: -10%; }

        /* Orbit Rings (Light) */
        .orbit-ring {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid rgba(14, 165, 233, 0.15);
            border-radius: 50%;
            pointer-events: none;
            z-index: -1;
        }
        .orbit-1 { width: 50vw; height: 50vw; animation: spin-orbit 40s linear infinite; border-style: dashed; }
        .orbit-2 { width: 70vw; height: 70vw; animation: spin-orbit-reverse 60s linear infinite; border: 1px solid rgba(16, 185, 129, 0.15); }
        
        @keyframes spin-orbit { 100% { transform: translate(-50%, -50%) rotate(360deg); } }
        @keyframes spin-orbit-reverse { 100% { transform: translate(-50%, -50%) rotate(-360deg); } }

        /* Glass Cards (Light) */
        .glass-antigravity-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.9);
            box-shadow: 0 20px 40px -10px rgba(14, 165, 233, 0.15), inset 0 0 20px rgba(255, 255, 255, 0.5);
            border-radius: 1.5rem;
            transition: all 0.5s cubic-bezier(0.2, 0.8, 0.2, 1);
        }
        .glass-antigravity-card:hover {
            background: rgba(255, 255, 255, 0.9);
            border-color: #bae6fd;
            box-shadow: 0 30px 60px -10px rgba(14, 165, 233, 0.25), inset 0 0 30px rgba(255, 255, 255, 1);
            transform: translateY(-8px) scale(1.02);
        }

        /* Pill Button (Light) */
        .btn-antigravity {
            background: linear-gradient(135deg, #0ea5e9, #3b82f6);
            color: #fff;
            box-shadow: 0 10px 25px rgba(14, 165, 233, 0.4);
            transition: all 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: none;
        }
        .btn-antigravity::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: 0.5s;
        }
        .btn-antigravity:hover {
            box-shadow: 0 15px 35px rgba(14, 165, 233, 0.6);
            transform: translateY(-3px) scale(1.02);
        }
        .btn-antigravity:hover::before {
            left: 100%;
        }

        /* Text Effects (Light) */
        .text-glow-primary {
            text-shadow: 0 0 30px rgba(14, 165, 233, 0.2);
        }

        /* Particles (Light) */
        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.6;
        }
        .particle-blue { background: #0ea5e9; box-shadow: 0 0 10px #0ea5e9; }
        .particle-emerald { background: #10b981; box-shadow: 0 0 10px #10b981; }

        @keyframes float-anti-1 {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }
        @keyframes float-anti-2 {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-12px) rotate(-2deg); }
        }
        .animate-float-anti-1 { animation: float-anti-1 8s ease-in-out infinite; }
        .animate-float-anti-2 { animation: float-anti-2 10s ease-in-out infinite 1s; }

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
                    <img src="{{ asset('img/logo.png') }}" alt="Logo StuntCheck" class="w-8 h-8 mr-3 object-contain drop-shadow-sm">
                    <span class="font-extrabold text-xl tracking-tight text-slate-800">Stunt<span class="text-blue-500">Check</span></span>
                </div>
                
                <!-- Nav Links -->
                <div class="hidden md:flex space-x-8 items-center" data-aos="fade-down" data-aos-duration="800" data-aos-delay="100">
                    <a href="#hero" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">Beranda</a>
                    <a href="{{ route('prediksi') }}" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">Prediksi</a>
                    <a href="#about" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">Tentang Kami</a>
                    <a href="#features" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">Fitur</a>
                    <a href="#impact" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">Dampak</a>
                </div>


            </div>
        </div>
    </nav>

    <!-- 1. HERO SECTION -->
    <section id="hero" class="relative pt-28 pb-16 lg:pt-40 lg:pb-24 overflow-hidden">
        <!-- Decorative blobs -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[300px] md:w-[500px] h-[300px] md:h-[500px] rounded-full bg-blue-400/20 blur-[80px] z-0 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-[250px] md:w-[400px] h-[250px] md:h-[400px] rounded-full bg-emerald-400/20 blur-[80px] z-0 pointer-events-none"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
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
                    
                    <h1 class="text-4xl lg:text-5xl xl:text-6xl font-extrabold text-slate-800 leading-[1.1] mb-5">
                        Cegah <span class="text-gradient">Stunting</span><br>
                        Pada Anak
                    </h1>
                    
                    <p class="text-base text-slate-500 mb-8 max-w-xl mx-auto lg:mx-0 leading-relaxed font-medium">
                        Pantau tumbuh kembang si kecil dengan teknologi cerdas. Deteksi dini potensi stunting dengan analisis berbasis sistem pakar dan standar WHO.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start mt-4">
                        <a href="{{ route('prediksi') }}" class="btn-glow flex items-center justify-center px-7 py-3.5 rounded-full bg-[#10B981] text-white font-bold text-base hover:bg-emerald-600 transition-all transform hover:scale-105">
                            Cek Sekarang
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </a>
                        <a href="#about" class="flex items-center justify-center px-7 py-3.5 rounded-full border-2 border-slate-200 text-slate-600 font-bold text-base hover:border-blue-500 hover:text-blue-600 transition-all bg-white/50 backdrop-blur-sm">
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
    <section id="about" class="py-20 relative z-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass rounded-[2rem] p-8 md:p-12 text-center shadow-2xl relative overflow-hidden border border-white/40" data-aos="zoom-in" data-aos-duration="800">
                <!-- Decorative background pattern inside card -->
                <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-blue-100 rounded-full opacity-30 blur-2xl pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-40 h-40 bg-emerald-100 rounded-full opacity-30 blur-2xl pointer-events-none"></div>
                
                <div class="relative z-10">
                    <div class="w-14 h-14 md:w-16 md:h-16 mx-auto bg-gradient-to-br from-blue-500 to-emerald-400 rounded-2xl flex items-center justify-center mb-5 md:mb-6 shadow-lg shadow-blue-500/30 transform -rotate-6">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h2 class="text-3xl md:text-3xl font-extrabold text-slate-800 mb-5">Apa itu <span class="text-gradient">StuntCheck?</span></h2>
                    <p class="text-base md:text-lg text-slate-500 leading-relaxed font-medium max-w-3xl mx-auto">
                        StuntCheck adalah platform cerdas inovatif yang dirancang khusus untuk memantau status gizi dan tumbuh kembang anak. Kami membantu Anda mendeteksi potensi stunting sejak dini melalui analisis yang akurat, sehingga langkah pencegahan dapat dilakukan secara optimal demi masa depan yang gemilang.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. FITUR -->
    <section id="features" class="py-20 relative">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-xs font-bold text-blue-600 tracking-wider uppercase mb-2">Layanan Kami</h2>
                <h3 class="text-3xl font-extrabold text-slate-800">Fitur Unggulan StuntCheck</h3>
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
    <section id="impact" class="py-20 bg-white relative">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-extrabold text-slate-800 mb-3">Mengapa Stunting <span class="text-red-500">Berbahaya?</span></h2>
                <p class="text-base text-slate-500 font-medium max-w-2xl mx-auto">Kenali ancaman tersembunyi dari stunting yang dapat memengaruhi masa depan anak secara permanen jika tidak ditangani sedini mungkin.</p>
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

    <!-- 5. CALL TO ACTION (CTA) ANTIGRAVITY LIGHT -->
    <section class="bg-antigravity-light py-16 md:py-20 relative flex items-center">
        <!-- Ambient Glows -->
        <div class="ambient-glow glow-blue-light"></div>
        <div class="ambient-glow glow-emerald-light"></div>

        <!-- Orbit Rings -->
        <div class="orbit-ring orbit-1"></div>
        <div class="orbit-ring orbit-2"></div>

        <!-- Glowing Particles -->
        <div class="particle particle-blue w-2 h-2 top-1/4 left-[15%] animate-float-anti-1"></div>
        <div class="particle particle-emerald w-3 h-3 bottom-1/3 right-[20%] animate-float-anti-2"></div>
        <div class="particle particle-blue w-1.5 h-1.5 top-[20%] right-[30%] animate-float-anti-1" style="animation-delay: 2s;"></div>
        <div class="particle particle-emerald w-2 h-2 bottom-[15%] left-[25%] animate-float-anti-2" style="animation-delay: 1.5s;"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-10">
                
                <!-- Left Column: Mini Cards -->
                <div class="hidden lg:flex flex-col gap-10 w-1/4 relative">
                    <!-- Holographic Reflection (Decorative) -->
                    <div class="absolute -top-10 -left-10 w-32 h-32 bg-blue-300/20 rounded-full blur-2xl"></div>

                    <!-- Card 1 -->
                    <div class="glass-antigravity-card p-4 animate-float-anti-1 parallax-cta-layer self-start relative" data-speed="0.03">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-blue-600 text-lg bg-blue-50 border border-blue-100 shadow-sm">
                                <i class="fa-solid fa-microchip"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-0.5">AI Monitoring</p>
                                <p class="text-lg font-black text-slate-800 leading-none">99.9% <span class="text-[10px] font-semibold text-blue-600 block mt-1">Real-time Akurasi</span></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card 2 -->
                    <div class="glass-antigravity-card p-4 animate-float-anti-2 parallax-cta-layer self-end -mr-12 relative" data-speed="0.05" style="animation-delay: -3s;">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-emerald-600 text-lg bg-emerald-50 border border-emerald-100 shadow-sm">
                                <i class="fa-solid fa-shield-virus"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-0.5">Data Security</p>
                                <p class="text-xs font-bold text-slate-800 leading-tight">Enkripsi End-to-End<br><span class="text-[10px] font-medium text-emerald-600">Standar Medis Global</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area (Center) -->
                <div class="max-w-2xl mx-auto text-center shrink-0 w-full lg:w-1/2 relative" data-aos="zoom-in" data-aos-duration="1000">
                    <!-- Center Glow for Text Depth -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-white/50 blur-3xl rounded-full z-[-1]"></div>

                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-slate-800 mb-4 leading-[1.1] tracking-tight text-glow-primary">
                        Mulai Pantau<br>Kesehatan<br>Anak Anda Sekarang!
                    </h2>
                    <p class="text-base text-slate-600 font-medium mb-8 leading-relaxed max-w-xl mx-auto">
                        Dampingi setiap tahap pertumbuhan si kecil. Kami bantu deteksi potensi stunting lebih awal melalui sistem pintar yang akurat dan terpercaya.
                    </p>
                    
                    <a href="{{ route('prediksi') }}" class="btn-antigravity inline-flex items-center justify-center px-8 py-3.5 rounded-full font-bold text-base group">
                        Daftar & Cek Sekarang
                        <i class="fa-solid fa-arrow-right-long ml-3 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </a>
                </div>

                <!-- Right Column: Mini Cards -->
                <div class="hidden lg:flex flex-col gap-10 w-1/4 relative">
                    <!-- Holographic Reflection (Decorative) -->
                    <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-emerald-300/20 rounded-full blur-2xl"></div>

                    <!-- Card 3 -->
                    <div class="glass-antigravity-card p-4 animate-float-anti-2 parallax-cta-layer self-end relative" data-speed="0.04" style="animation-delay: -2s;">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-cyan-600 text-lg bg-cyan-50 border border-cyan-100 shadow-sm">
                                <i class="fa-solid fa-heart-pulse"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-0.5">Pulse Line</p>
                                <p class="text-xs font-bold text-slate-800 leading-tight">Sinkronisasi Data<br><span class="text-[10px] font-medium text-cyan-600">Respons Instan</span></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card 4 -->
                    <div class="glass-antigravity-card p-4 animate-float-anti-1 parallax-cta-layer self-start -ml-12 relative" data-speed="0.06" style="animation-delay: -4s;">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-indigo-600 text-lg bg-indigo-50 border border-indigo-100 shadow-sm">
                                <i class="fa-solid fa-chart-pie"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-0.5">Data Analytics</p>
                                <p class="text-xs font-bold text-slate-800 leading-tight">Insight Komprehensif<br><span class="text-[10px] font-medium text-indigo-600">Visualisasi Prediktif</span></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-slate-100 py-12 relative overflow-hidden">
        <!-- Subtle decorative blobs -->
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-blue-50 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-emerald-50 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col items-center justify-center text-center">
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
        // Parallax Effect for CTA
        document.addEventListener('mousemove', (e) => {
            const layers = document.querySelectorAll('.parallax-cta-layer');
            const x = (window.innerWidth - e.pageX * 2) / 100;
            const y = (window.innerHeight - e.pageY * 2) / 100;

            layers.forEach(layer => {
                const speed = layer.getAttribute('data-speed');
                layer.style.transform = `translateX(${x * speed * 20}px) translateY(${y * speed * 20}px)`;
            });
        });
    </script>
</body>
</html>