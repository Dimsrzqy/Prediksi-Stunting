<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StuntCheck - Premium AI Prediction</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --primary: #3b82f6;
            --primary-rgb: 59, 130, 246;
            --indigo: #6366f1;
            --indigo-rgb: 99, 102, 241;
            --purple: #8b5cf6;
            --purple-rgb: 139, 92, 246;
            --cyan: #06b6d4;
            --cyan-rgb: 6, 182, 212;
            --bg-soft: #fcfdfe;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(99, 102, 241, 0.15);
            border-radius: 9999px;
            border: 2px solid transparent;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(99, 102, 241, 0.35);
        }

        body { 
            font-family: 'Outfit', 'Inter', sans-serif; 
            background-color: var(--bg-soft); 
            color: #0f172a;
            overflow-x: hidden;
        }
        
        /* Premium Background Components */
        .bg-premium {
            position: fixed; inset: 0; z-index: -1; overflow: hidden;
            background: #f8fafc;
        }
        .mesh-gradient {
            position: absolute; inset: 0;
            background: 
                radial-gradient(circle at 10% 15%, rgba(59, 130, 246, 0.08) 0px, transparent 40%),
                radial-gradient(circle at 95% 10%, rgba(139, 92, 246, 0.07) 0px, transparent 35%),
                radial-gradient(circle at 90% 85%, rgba(6, 182, 212, 0.07) 0px, transparent 40%),
                radial-gradient(circle at 15% 90%, rgba(99, 102, 241, 0.05) 0px, transparent 45%);
            filter: blur(80px);
        }
        .grid-futuristic {
            position: absolute; inset: 0;
            background-image: linear-gradient(rgba(99, 102, 241, 0.025) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(99, 102, 241, 0.025) 1px, transparent 1px);
            background-size: 50px 50px;
            mask-image: radial-gradient(circle at center, black, transparent 80%);
            animation: grid-move 60s linear infinite;
        }
        @keyframes grid-move {
            0% { background-position: 0 0; }
            100% { background-position: 50px 50px; }
        }
        .blob {
            position: absolute; border-radius: 50%; filter: blur(100px); opacity: 0.25; z-index: -1;
            animation: pulse-blob 20s infinite ease-in-out;
        }
        .blob-1 { width: 550px; height: 550px; background: radial-gradient(circle, var(--indigo) 0%, var(--cyan) 100%); top: -150px; left: -150px; animation-duration: 25s; }
        .blob-2 { width: 450px; height: 450px; background: radial-gradient(circle, var(--purple) 0%, var(--primary) 100%); bottom: 5%; right: -150px; animation-duration: 22s; }
        .blob-3 { width: 350px; height: 350px; background: radial-gradient(circle, var(--cyan) 0%, var(--indigo) 100%); top: 35%; left: 35%; animation-duration: 28s; opacity: 0.15; }
        
        @keyframes pulse-blob {
            0%, 100% { transform: scale(1) translate(0, 0) rotate(0deg); }
            33% { transform: scale(1.1) translate(30px, -20px) rotate(120deg); }
            66% { transform: scale(0.95) translate(-15px, 30px) rotate(240deg); }
        }

        .particles { position: fixed; inset: 0; pointer-events: none; z-index: -1; }
        .particle {
            position: absolute; width: 4px; height: 4px; background: linear-gradient(135deg, var(--indigo), var(--cyan));
            border-radius: 50%; opacity: 0.15; animation: float-p var(--d) linear infinite;
            box-shadow: 0 0 8px rgba(99, 102, 241, 0.4);
        }
        @keyframes float-p {
            0% { transform: translateY(105vh) scale(0.8); opacity: 0; }
            50% { opacity: 0.6; }
            100% { transform: translateY(-10vh) scale(1.2); opacity: 0; }
        }

        /* Glassmorphism Navbar */
        .nav-glass {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.4);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .nav-glass.scrolled {
            background: rgba(255, 255, 255, 0.7);
            border-bottom: 1px solid rgba(99, 102, 241, 0.08);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.04), 0 1px 0 rgba(255, 255, 255, 0.5);
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        .nav-link {
            position: relative;
            color: #64748b;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px; left: 0; width: 0; height: 2px;
            background: linear-gradient(90deg, var(--primary), var(--purple));
            border-radius: 2px;
            transition: width 0.3s ease;
        }
        .nav-link:hover { color: #0f172a; }
        .nav-link:hover::after { width: 100%; }

        .nav-cta {
            background: linear-gradient(135deg, var(--primary), var(--purple));
            color: #fff; padding: 0.6rem 1.5rem; border-radius: 9999px;
            font-weight: 700; box-shadow: 0 4px 15px rgba(99, 102, 241, 0.2);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .nav-cta:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.35);
        }

        /* Typography & Headings */
        .text-gradient {
            background: linear-gradient(135deg, var(--primary) 0%, var(--indigo) 35%, var(--purple) 70%, var(--cyan) 100%);
            background-size: 200% auto;
            -webkit-background-clip: text; 
            -webkit-text-fill-color: transparent;
            animation: gradient-shift 8s ease infinite;
        }
        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        /* Premium Badge Cards */
        .premium-badge-card {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.7);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03), inset 0 1px 0 rgba(255, 255, 255, 0.8);
            border-radius: 18px;
            padding: 0.75rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .premium-badge-card:hover {
            transform: translateY(-4px) scale(1.02);
            border-color: rgba(99, 102, 241, 0.25);
            box-shadow: 0 20px 35px -10px rgba(99, 102, 241, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }
        .badge-icon-wrapper {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            background: linear-gradient(135deg, rgba(var(--indigo-rgb), 0.1), rgba(var(--cyan-rgb), 0.1));
            border: 1px solid rgba(99, 102, 241, 0.15);
            color: var(--indigo);
            transition: all 0.3s ease;
        }
        .premium-badge-card:hover .badge-icon-wrapper {
            background: linear-gradient(135deg, var(--indigo), var(--cyan));
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
            border-color: transparent;
        }

        /* Glassmorphism Cards */
        .glass-card {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.75);
            border-radius: 32px;
            box-shadow: 
                0 30px 70px -15px rgba(99, 102, 241, 0.05),
                0 10px 30px -10px rgba(0, 0, 0, 0.02),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            position: relative;
            overflow: hidden;
        }
        .glass-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--indigo), var(--purple), var(--cyan));
            opacity: 0.8;
        }

        /* Form Controls */
        .input-premium {
            background: rgba(255, 255, 255, 0.6);
            border: 1.5px solid rgba(226, 232, 240, 0.8);
            border-radius: 16px;
            padding: 0.85rem 1rem 0.85rem 2.75rem;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            font-weight: 500;
            color: #1e293b;
        }
        .input-premium::placeholder {
            color: #94a3b8;
        }
        .input-premium:focus {
            outline: none;
            border-color: var(--indigo);
            background: #ffffff;
            box-shadow: 
                0 0 0 4px rgba(99, 102, 241, 0.1),
                0 10px 25px -10px rgba(99, 102, 241, 0.08);
            transform: translateY(-1px);
        }

        .input-icon-wrapper {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1rem;
            transition: color 0.3s ease;
            pointer-events: none;
        }
        .input-premium:focus ~ .input-icon-wrapper {
            color: var(--indigo);
        }

        .btn-predict {
            background: linear-gradient(135deg, var(--primary), var(--indigo), var(--purple));
            background-size: 150% auto;
            color: #fff; padding: 1.15rem; border-radius: 18px; font-weight: 800; font-size: 1.1rem;
            display: flex; align-items: center; justify-content: center; gap: 0.8rem;
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .btn-predict:hover:not(:disabled) {
            transform: translateY(-3px) scale(1.01);
            box-shadow: 0 15px 35px rgba(99, 102, 241, 0.35);
            background-position: right center;
        }
        .btn-predict:active:not(:disabled) {
            transform: translateY(-1px) scale(0.99);
        }
        .btn-predict:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* AI Interactive Dashboard Graphics */
        .dashboard-container {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 40px 80px -20px rgba(0, 0, 0, 0.06), inset 0 1px 0 rgba(255, 255, 255, 0.7);
            border-radius: 28px;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
        }
        .dashboard-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(99, 102, 241, 0.08);
            padding-bottom: 0.85rem;
            margin-bottom: 1.25rem;
        }
        .window-dot {
            width: 8px; height: 8px; border-radius: 50%; display: inline-block; margin-right: 4px;
        }
        .dot-red { background: #ff5f56; }
        .dot-yellow { background: #ffbd2e; }
        .dot-green { background: #27c93f; }
        
        .dashboard-stat-card {
            background: rgba(255, 255, 255, 0.65);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 10px 25px -10px rgba(0, 0, 0, 0.03);
            border-radius: 16px;
            padding: 0.85rem;
            transition: all 0.3s ease;
        }
        .dashboard-stat-card:hover {
            transform: translateY(-2px);
            border-color: rgba(99, 102, 241, 0.15);
            background: rgba(255, 255, 255, 0.8);
        }

        /* SVG Line Chart Animated */
        .neon-stroke {
            stroke: url(#chart-gradient);
            stroke-width: 3;
            fill: none;
            stroke-dasharray: 600;
            stroke-dashoffset: 600;
            animation: draw-line 3.5s cubic-bezier(0.4, 0, 0.2, 1) forwards infinite;
        }
        @keyframes draw-line {
            0% { stroke-dashoffset: 600; }
            45% { stroke-dashoffset: 0; }
            80% { stroke-dashoffset: 0; }
            100% { stroke-dashoffset: 600; }
        }

        .pulse-dot {
            animation: pulse-glow 2s infinite ease-in-out;
        }
        @keyframes pulse-glow {
            0%, 100% { transform: scale(1); opacity: 0.8; filter: drop-shadow(0 0 2px var(--indigo)); }
            50% { transform: scale(1.3); opacity: 1; filter: drop-shadow(0 0 8px var(--indigo)); }
        }

        /* Results Display */
        .gauge-wrap { position: relative; width: 170px; height: 170px; margin: 0 auto; }
        .gauge-svg { transform: rotate(-90deg); filter: drop-shadow(0 4px 15px rgba(99, 102, 241, 0.1)); }
        .gauge-bar { fill: none; stroke: rgba(226, 232, 240, 0.8); stroke-width: 12; }
        .gauge-progress {
            fill: none; stroke: var(--indigo); stroke-width: 12; stroke-linecap: round;
            stroke-dasharray: 440; stroke-dashoffset: 440; transition: stroke-dashoffset 1.5s ease-in-out, stroke 0.5s ease;
        }

        /* Step Section */
        .step-card {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.7);
            padding: 2.25rem 2rem;
            border-radius: 28px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 10px 30px -15px rgba(0, 0, 0, 0.02);
            position: relative;
        }
        .step-card:hover {
            transform: translateY(-8px);
            border-color: rgba(99, 102, 241, 0.2);
            box-shadow: 0 30px 50px -20px rgba(99, 102, 241, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.8);
        }
        .step-num {
            width: 54px; height: 54px;
            background: linear-gradient(135deg, rgba(var(--indigo-rgb), 0.08), rgba(var(--cyan-rgb), 0.08));
            border: 1px solid rgba(99, 102, 241, 0.15);
            color: var(--indigo);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-weight: 900; font-size: 1.1rem; margin: 0 auto 1.5rem;
            transition: all 0.3s ease;
        }
        .step-card:hover .step-num {
            background: linear-gradient(135deg, var(--indigo), var(--cyan));
            color: #ffffff;
            border-color: transparent;
            box-shadow: 0 6px 15px rgba(99, 102, 241, 0.25);
        }

        .step-connector {
            position: absolute;
            top: 50px;
            left: calc(100% - 15px);
            width: calc(100% - 24px);
            height: 2px;
            background: linear-gradient(90deg, var(--indigo), rgba(6, 182, 212, 0.3), transparent);
            z-index: -1;
        }

        /* Loader */
        .loader { width: 24px; height: 24px; border: 3px solid rgba(255,255,255,0.3); border-top: 3.5px solid #fff; border-radius: 50%; animation: spin 1s linear infinite; }
        @keyframes spin { 100% { transform: rotate(360deg); } }

        /* Gender Radio Selector Custom Capsule style */
        .gender-select {
            display: flex;
            background: rgba(241, 245, 249, 0.6);
            border: 1px solid rgba(226, 232, 240, 0.8);
            padding: 0.35rem;
            border-radius: 16px;
            gap: 0.35rem;
            position: relative;
        }
        .gender-btn {
            flex: 1;
            position: relative;
        }
        .gender-btn input {
            display: none;
        }
        .gender-btn label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.7rem;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 700;
            font-size: 0.85rem;
            color: #64748b;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 2;
            position: relative;
        }
        .gender-btn input:checked + label {
            color: #ffffff;
            background: linear-gradient(135deg, var(--primary), var(--indigo));
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.25);
        }

        /* Floating Badge Cards */
        .floating-badge {
            position: absolute;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1.15rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px -10px rgba(0,0,0,0.08), inset 0 1px 0 rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: float 5s ease-in-out infinite;
            z-index: 10;
        }
        @keyframes float { 
            0%, 100% { transform: translateY(0) rotate(0deg); } 
            50% { transform: translateY(-12px) rotate(1deg); } 
        }
    </style>
</head>
<body>

    <div class="bg-premium">
        <div class="mesh-gradient"></div>
        <div class="grid-futuristic"></div>
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>
    
    <div class="particles" id="particles"></div>

    <!-- Navigation -->
    <nav class="fixed w-full z-50 nav-glass transition-all duration-300 py-4" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-14">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center cursor-pointer" data-aos="fade-right" data-aos-duration="800">
                    <div class="relative w-9 h-9 mr-3 flex items-center justify-center bg-gradient-to-tr from-blue-500 via-indigo-500 to-purple-500 rounded-xl shadow-lg shadow-indigo-500/20 group">
                        <i class="fa-solid fa-square-poll-vertical text-white text-base group-hover:scale-110 transition-transform"></i>
                        <span class="absolute inset-0 bg-white/20 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity"></span>
                    </div>
                    <span class="font-extrabold text-2xl tracking-tight text-slate-800">Stunt<span class="text-indigo-600 bg-gradient-to-r from-indigo-600 to-blue-500 bg-clip-text text-transparent">Check</span></span>
                </a>
                
                <!-- Nav Links -->
                <div class="hidden md:flex space-x-8 items-center" data-aos="fade-down" data-aos-duration="800" data-aos-delay="100">
                    <a href="{{ url('/') }}#hero" class="nav-link">Beranda</a>
                    <a href="{{ route('prediksi') }}" class="nav-link text-indigo-600">Prediksi</a>
                    <a href="{{ url('/') }}#about" class="nav-link">Tentang Kami</a>
                    <a href="{{ url('/') }}#features" class="nav-link">Fitur</a>
                    <a href="{{ url('/') }}#impact" class="nav-link">Dampak</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-36 pb-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                
                <!-- Left: Content & Premium AI Mockup Dashboard -->
                <div class="lg:col-span-6 space-y-8" data-aos="fade-right">
                    <div class="space-y-4">
                        <h1 class="text-5xl lg:text-6xl font-black text-slate-900 leading-[1.05] tracking-tight">
                            Cek Risiko <span class="text-gradient">Stunting</span> Anak Sejak Dini
                        </h1>
                        <p class="text-slate-500 font-medium text-lg lg:text-xl leading-relaxed max-w-xl">
                            Deteksi dini potensi stunting dengan bantuan <span class="text-slate-800 font-semibold">AI Cerdas</span> yang disinkronisasi standar medis <span class="text-indigo-600 font-semibold">WHO</span> secara real-time.
                        </p>
                    </div>

                    <!-- Redesigned Premium Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-lg">
                        <div class="premium-badge-card">
                            <div class="badge-icon-wrapper">
                                <i class="fa-solid fa-microchip"></i>
                            </div>
                            <div>
                                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Engine</h4>
                                <p class="text-xs font-bold text-slate-700">AI Powered</p>
                            </div>
                        </div>
                        
                        <div class="premium-badge-card">
                            <div class="badge-icon-wrapper">
                                <i class="fa-solid fa-award"></i>
                            </div>
                            <div>
                                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Medical</h4>
                                <p class="text-xs font-bold text-slate-700">WHO Standard</p>
                            </div>
                        </div>

                        <div class="premium-badge-card">
                            <div class="badge-icon-wrapper">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <div>
                                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Diagnosis</h4>
                                <p class="text-xs font-bold text-slate-700">Fast Analysis</p>
                            </div>
                        </div>
                    </div>

                    <!-- CSS-Based Medical AI Analytics Dashboard Mockup (Replacing Wood/Cartoon Illustration) -->
                    <div class="relative mt-8 hidden lg:block max-w-md mx-auto lg:mx-0">
                        <div class="dashboard-container">
                            <div class="dashboard-header">
                                <div class="flex items-center">
                                    <span class="window-dot dot-red"></span>
                                    <span class="window-dot dot-yellow"></span>
                                    <span class="window-dot dot-green"></span>
                                    <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 ml-3">Diagnostic Monitor</span>
                                </div>
                                <div class="flex items-center gap-1.5 bg-indigo-50 border border-indigo-100 rounded-full px-2.5 py-0.5">
                                    <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full animate-ping"></span>
                                    <span class="text-[9px] font-black text-indigo-600 uppercase tracking-wider">LIVE</span>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-3 gap-3 mb-4">
                                <div class="dashboard-stat-card col-span-2">
                                    <h4 class="text-[9px] font-black text-slate-400 uppercase tracking-wider mb-1">Pertumbuhan Tinggi</h4>
                                    <!-- Animated Waveform using dynamic animated neon lines -->
                                    <div class="h-20 w-full relative">
                                        <svg class="absolute inset-0 w-full h-full" viewBox="0 0 200 80">
                                            <defs>
                                                <linearGradient id="chart-gradient" x1="0" y1="0" x2="1" y2="0">
                                                    <stop offset="0%" stop-color="#3b82f6" />
                                                    <stop offset="50%" stop-color="#6366f1" />
                                                    <stop offset="100%" stop-color="#06b6d4" />
                                                </linearGradient>
                                            </defs>
                                            <!-- Grid lines in SVG -->
                                            <line x1="0" y1="20" x2="200" y2="20" stroke="rgba(99,102,241,0.05)" stroke-width="1" />
                                            <line x1="0" y1="40" x2="200" y2="40" stroke="rgba(99,102,241,0.05)" stroke-width="1" />
                                            <line x1="0" y1="60" x2="200" y2="60" stroke="rgba(99,102,241,0.05)" stroke-width="1" />
                                            <!-- Pulse wave -->
                                            <path class="neon-stroke" d="M 0 50 Q 25 20 50 60 T 100 30 T 150 50 T 200 20" />
                                            <circle class="pulse-dot" cx="150" cy="50" r="4" fill="#6366f1" />
                                        </svg>
                                    </div>
                                </div>
                                
                                <div class="dashboard-stat-card flex flex-col justify-between">
                                    <h4 class="text-[9px] font-black text-slate-400 uppercase tracking-wider">WHO Z-score</h4>
                                    <div>
                                        <p class="text-2xl font-extrabold text-indigo-600 leading-none">99.4%</p>
                                        <span class="text-[9px] font-bold text-slate-400">Match Accuracy</span>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div class="dashboard-stat-card flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-500 flex items-center justify-center text-xs">
                                            <i class="fa-solid fa-heartpulse"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-[8px] font-black text-slate-400 uppercase">Sensors</h4>
                                            <p class="text-xs font-black text-slate-700">Online</p>
                                        </div>
                                    </div>
                                    <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                </div>

                                <div class="dashboard-stat-card flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-cyan-50 text-cyan-500 flex items-center justify-center text-xs">
                                            <i class="fa-solid fa-brain"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-[8px] font-black text-slate-400 uppercase">AI Engine</h4>
                                            <p class="text-xs font-black text-slate-700">Predictive v2.1</p>
                                        </div>
                                    </div>
                                    <span class="w-2.5 h-2.5 bg-cyan-500 rounded-full animate-pulse"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Floating depth cards relative to container -->
                        <div class="floating-badge -top-8 -left-8">
                            <div class="w-8 h-8 bg-blue-50 text-blue-500 rounded-lg flex items-center justify-center text-sm shadow-sm"><i class="fa-solid fa-baby-carriage"></i></div>
                            <div>
                                <p class="text-[8px] font-black text-slate-400 uppercase leading-none">Growth Ratio</p>
                                <p class="text-xs font-black text-slate-800 mt-1">Normal Velocity</p>
                            </div>
                        </div>

                        <div class="floating-badge bottom-8 -right-8" style="animation-delay: 2.5s;">
                            <div class="w-8 h-8 bg-purple-50 text-purple-500 rounded-lg flex items-center justify-center text-sm shadow-sm"><i class="fa-solid fa-shield-halved"></i></div>
                            <div>
                                <p class="text-[8px] font-black text-slate-400 uppercase leading-none">Secure Shield</p>
                                <p class="text-xs font-black text-slate-800 mt-1">HIPAA Compliant</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Prediction Form Card -->
                <div class="lg:col-span-6" data-aos="fade-left">
                    <div class="glass-card p-8 sm:p-10 md:p-12 relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-8 opacity-5 text-indigo-600"><i class="fa-solid fa-stethoscope text-[120px]"></i></div>
                        
                        <div class="mb-8">
                            <h2 class="text-3xl font-black text-slate-900 mb-2 tracking-tight">Data Si Kecil</h2>
                            <p class="text-slate-400 font-bold text-sm">Lengkapi data di bawah untuk memulai diagnosis medis AI</p>
                        </div>

                        <form id="prediksiForm" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="relative">
                                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Nama Lengkap</label>
                                    <div class="relative">
                                        <input type="text" name="nama_anak" required class="w-full input-premium" placeholder="Budi Santoso">
                                        <span class="input-icon-wrapper"><i class="fa-solid fa-user"></i></span>
                                    </div>
                                </div>
                                
                                <div class="relative">
                                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Tanggal Lahir</label>
                                    <div class="relative">
                                        <input type="date" name="tgl_lahir" required class="w-full input-premium">
                                        <span class="input-icon-wrapper"><i class="fa-solid fa-calendar-alt"></i></span>
                                    </div>
                                </div>
                                
                                <div class="relative">
                                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Jenis Kelamin</label>
                                    <div class="gender-select">
                                        <div class="gender-btn">
                                            <input type="radio" name="jenis_kelamin" id="jk_l" value="Laki-laki" checked>
                                            <label for="jk_l"><i class="fa-solid fa-mars"></i> Laki-laki</label>
                                        </div>
                                        <div class="gender-btn">
                                            <input type="radio" name="jenis_kelamin" id="jk_p" value="Perempuan">
                                            <label for="jk_p"><i class="fa-solid fa-venus"></i> Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="relative">
                                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Usia (bulan)</label>
                                    <div class="relative">
                                        <input type="number" name="umur_bulan" required class="w-full input-premium" placeholder="24">
                                        <span class="input-icon-wrapper"><i class="fa-solid fa-baby"></i></span>
                                    </div>
                                </div>
                                
                                <div class="md:col-span-2 relative">
                                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Tinggi Badan (cm)</label>
                                    <div class="relative">
                                        <input type="number" step="0.1" name="tinggi_badan" required class="w-full input-premium" placeholder="85">
                                        <span class="input-icon-wrapper"><i class="fa-solid fa-ruler-vertical"></i></span>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" id="btnSubmit" class="w-full btn-predict mt-6">
                                <span>Mulai Prediksi Sekarang</span>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Results Section -->
            <div id="resultsArea" class="mt-24 grid grid-cols-1 lg:grid-cols-12 gap-8 hidden opacity-0 translate-y-10 transition-all duration-700">
                <div class="lg:col-span-6 lg:col-start-4">
                    <div class="glass-card p-10 text-center relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-b from-indigo-50/10 to-transparent pointer-events-none"></div>
                        <h3 class="font-black text-2xl text-slate-800 mb-8 tracking-tight">Hasil Prediksi AI</h3>
                        
                        <div class="gauge-wrap mb-8">
                            <svg class="gauge-svg" width="170" height="170" viewBox="0 0 160 160">
                                <circle class="gauge-bar" cx="80" cy="80" r="70"></circle>
                                <circle id="gaugeFill" class="gauge-progress" cx="80" cy="80" r="70"></circle>
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center leading-none">
                                <span id="probText" class="text-4xl font-extrabold text-slate-900">0%</span>
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-wider mt-2.5">Tingkat Risiko</span>
                            </div>
                        </div>
                        
                        <div id="statusBadge" class="inline-block px-6 py-2.5 rounded-full bg-emerald-50 text-emerald-600 font-extrabold text-xs uppercase mb-8 border border-emerald-100 tracking-wider">Risiko Rendah</div>
                        
                        <div class="p-6 bg-white/70 backdrop-blur-md rounded-2xl text-left border border-slate-100/50 shadow-sm relative z-10">
                            <h4 class="text-[10px] font-black text-indigo-500 uppercase tracking-wider mb-2">Rekomendasi Medis AI:</h4>
                            <p id="recommendationText" class="text-sm font-semibold text-slate-600 leading-relaxed">...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Steps Section -->
            <div class="mt-32">
                <div class="text-center max-w-xl mx-auto mb-16">
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">Cara Kerja Analisis AI Kami</h3>
                    <p class="text-slate-400 font-bold text-sm mt-3 leading-relaxed">Proses pemindaian klinis cerdas kami mendiagnosis rasio potensi stunting secara komprehensif dalam tiga langkah mudah.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10">
                    <div class="step-card" data-aos="fade-up">
                        <div class="step-num">01</div>
                        <h5 class="text-lg font-black text-slate-800 mb-3 tracking-tight">Isi Data Anak</h5>
                        <p class="text-sm text-slate-400 font-medium leading-relaxed">Masukkan informasi akurat mengenai umur, tanggal lahir, dan tinggi badan si kecil.</p>
                        <div class="hidden md:block step-connector"></div>
                    </div>
                    
                    <div class="step-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="step-num">02</div>
                        <h5 class="text-lg font-black text-slate-800 mb-3 tracking-tight">AI Menganalisis Data</h5>
                        <p class="text-sm text-slate-400 font-medium leading-relaxed">Algoritma AI cerdas kami menyelaraskan parameter dengan standar pertumbuhan internasional WHO.</p>
                        <div class="hidden md:block step-connector" style="background: linear-gradient(90deg, rgba(6, 182, 212, 0.3), rgba(139, 92, 246, 0.3), transparent);"></div>
                    </div>
                    
                    <div class="step-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="step-num">03</div>
                        <h5 class="text-lg font-black text-slate-800 mb-3 tracking-tight">Hasil Prediksi & Laporan</h5>
                        <p class="text-sm text-slate-400 font-medium leading-relaxed">Dapatkan visualisasi persentase tingkat risiko medis beserta anjuran nutrisi yang optimal secara instan.</p>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <footer class="py-12 border-t border-slate-100/50 mt-20 text-center relative z-10">
        <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">&copy; {{ date('Y') }} StuntCheck Premium AI Healthcare Platform</p>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        AOS.init({ duration: 1000, once: true });

        // Particles Background Generation
        const partWrap = document.getElementById('particles');
        for(let i=0; i<25; i++) {
            const p = document.createElement('div');
            p.className = 'particle';
            p.style.left = Math.random() * 100 + 'vw';
            p.style.setProperty('--d', (Math.random() * 10 + 12) + 's');
            p.style.animationDelay = (Math.random() * 6) + 's';
            partWrap.appendChild(p);
        }

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 20) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });

        const form = document.getElementById('prediksiForm');
        const btn = document.getElementById('btnSubmit');
        const resultsArea = document.getElementById('resultsArea');
        const gaugeFill = document.getElementById('gaugeFill');
        const probText = document.getElementById('probText');
        const statusBadge = document.getElementById('statusBadge');
        const recommendationText = document.getElementById('recommendationText');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            btn.disabled = true;
            btn.innerHTML = '<div class="loader mx-auto"></div>';

            const formData = new FormData(form);
            try {
                const response = await fetch('{{ route("guest.predict") }}', {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
                });
                const result = await response.json();
                if (result.success) {
                    const data = result.data;
                    const ha = (data.status?.ha || 'Unknown').toLowerCase();
                    const prob = ((data.probabilitas || 1.0) * 100).toFixed(0);
                    
                    resultsArea.classList.remove('hidden');
                    // Delay slightly to trigger visual transitions smoothly
                    setTimeout(() => {
                        resultsArea.classList.remove('opacity-0', 'translate-y-10');
                    }, 50);

                    gaugeFill.style.strokeDashoffset = 440 - (440 * prob / 100);
                    probText.innerText = prob + '%';

                    // Dynamic UI Updates based on AI analysis
                    if (ha.includes('normal')) {
                        gaugeFill.style.stroke = '#10b981';
                        statusBadge.innerText = 'Normal';
                        statusBadge.className = 'inline-block px-6 py-2.5 rounded-full bg-emerald-50 text-emerald-600 font-extrabold text-xs uppercase mb-8 border border-emerald-100 tracking-wider shadow-sm shadow-emerald-500/5';
                        recommendationText.innerText = 'Analisis menunjukkan kondisi si kecil berada dalam kategori normal. Teruskan pemberian nutrisi seimbang, pantau tumbuh kembang secara rutin, dan konsultasikan secara berkala dengan posyandu terdekat.';
                    } else if (ha.includes('sangat stunting') || ha.includes('severely stunted') || ha.includes('sangat pendek')) {
                        gaugeFill.style.stroke = '#ef4444';
                        statusBadge.innerText = 'Sangat Stunting';
                        statusBadge.className = 'inline-block px-6 py-2.5 rounded-full bg-red-50 text-red-600 font-extrabold text-xs uppercase mb-8 border border-red-100 tracking-wider shadow-sm shadow-red-500/5';
                        recommendationText.innerText = 'Ditemukan indikasi stunting yang signifikan (Sangat Stunting). Sangat disarankan untuk segera melakukan pemeriksaan medis secara intensif ke dokter spesialis anak terdekat demi intervensi gizi segera.';
                    } else if (ha.includes('stunting') || ha.includes('stunted') || ha.includes('pendek')) {
                        gaugeFill.style.stroke = '#f97316'; // orange
                        statusBadge.innerText = 'Stunting';
                        statusBadge.className = 'inline-block px-6 py-2.5 rounded-full bg-orange-50 text-orange-600 font-extrabold text-xs uppercase mb-8 border border-orange-100 tracking-wider shadow-sm shadow-orange-500/5';
                        recommendationText.innerText = 'Si kecil menunjukkan tanda risiko stunting. Segera konsultasikan dengan posyandu atau dokter anak terdekat untuk perbaikan gizi dan penanganan medis dini.';
                    } else if (ha.includes('tinggi')) {
                        gaugeFill.style.stroke = '#3b82f6'; // blue
                        statusBadge.innerText = 'Tinggi';
                        statusBadge.className = 'inline-block px-6 py-2.5 rounded-full bg-blue-50 text-blue-600 font-extrabold text-xs uppercase mb-8 border border-blue-100 tracking-wider shadow-sm shadow-blue-500/5';
                        recommendationText.innerText = 'Tinggi badan si kecil berada di atas rata-rata kelompok usianya. Teruskan menjaga asupan gizi yang kaya nutrisi seimbang untuk mendukung fase perkembangan optimalnya.';
                    } else {
                        gaugeFill.style.stroke = '#6b7280'; // gray
                        statusBadge.innerText = 'Tidak Diketahui';
                        statusBadge.className = 'inline-block px-6 py-2.5 rounded-full bg-gray-50 text-gray-600 font-extrabold text-xs uppercase mb-8 border border-gray-100 tracking-wider';
                        recommendationText.innerText = 'Hasil prediksi tidak dapat diidentifikasi secara terperinci. Pastikan data tinggi badan dan usia diinput secara akurat.';
                    }

                    resultsArea.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    Swal.fire({ 
                        icon: 'success', 
                        title: 'Analisis Berhasil', 
                        text: 'Hasil dari Model AI telah diperbarui di bawah.', 
                        timer: 2500, 
                        showConfirmButton: false,
                        customClass: {
                            popup: 'rounded-2xl border border-slate-100'
                        }
                    });
                } else {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: result.pesan });
                }
            } catch (err) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menghubungi server AI.' });
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<span>Mulai Prediksi Sekarang</span><i class="fa-solid fa-arrow-right-long"></i>';
            }
        });
    </script>
</body>
</html>
