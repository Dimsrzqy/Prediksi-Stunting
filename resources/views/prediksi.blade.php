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
            --primary-blue: #3b82f6;
            --primary-cyan: #06b6d4;
            --primary-purple: #8b5cf6;
            --bg-soft: #f8fbff;
        }

        body { 
            font-family: 'Outfit', 'Inter', sans-serif; 
            background-color: var(--bg-soft); 
            color: #1e293b;
            overflow-x: hidden;
        }
        
        /* Premium Background Components */
        .bg-premium {
            position: fixed; inset: 0; z-index: -1; overflow: hidden;
        }
        .mesh-gradient {
            position: absolute; inset: 0;
            background: 
                radial-gradient(at 0% 0%, rgba(59, 130, 246, 0.12) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(139, 92, 246, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(6, 182, 212, 0.08) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(16, 185, 129, 0.05) 0px, transparent 50%);
            filter: blur(80px);
        }
        .grid-futuristic {
            position: absolute; inset: 0;
            background-image: linear-gradient(rgba(59, 130, 246, 0.03) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(59, 130, 246, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            mask-image: radial-gradient(circle at center, black, transparent 80%);
        }
        .blob {
            position: absolute; border-radius: 50%; filter: blur(60px); opacity: 0.3; z-index: -1;
            animation: pulse-blob 10s infinite alternate;
        }
        .blob-1 { width: 400px; height: 400px; background: var(--primary-blue); top: -100px; left: -100px; }
        .blob-2 { width: 300px; height: 300px; background: var(--primary-purple); bottom: 10%; right: -50px; }
        
        @keyframes pulse-blob {
            0% { transform: scale(1) translate(0, 0); }
            100% { transform: scale(1.1) translate(30px, 20px); }
        }

        .particles { position: fixed; inset: 0; pointer-events: none; z-index: -1; }
        .particle {
            position: absolute; width: 3px; height: 3px; background: var(--primary-blue);
            border-radius: 50%; opacity: 0.2; animation: float-p var(--d) linear infinite;
        }
        @keyframes float-p {
            0% { transform: translateY(100vh); opacity: 0; }
            50% { opacity: 0.5; }
            100% { transform: translateY(-10vh); opacity: 0; }
        }

        /* Glassmorphism Navbar */
        .nav-glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
        }
        .nav-cta {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-purple));
            color: #fff; padding: 0.7rem 1.5rem; border-radius: 9999px;
            font-weight: 700; box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }
        .nav-cta:hover { transform: translateY(-2px); box-shadow: 0 12px 25px rgba(59, 130, 246, 0.4); }

        /* Typography & Headings */
        .text-gradient {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-cyan));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }

        /* Glassmorphism Cards */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
        }

        /* Form Controls */
        .input-premium {
            background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 16px;
            padding: 0.85rem 1rem; transition: all 0.3s ease; font-weight: 500;
        }
        .input-premium:focus {
            outline: none; border-color: var(--primary-blue); background: #fff;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .btn-predict {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-purple));
            color: #fff; padding: 1.25rem; border-radius: 18px; font-weight: 800; font-size: 1.1rem;
            display: flex; align-items: center; justify-content: center; gap: 0.8rem;
            box-shadow: 0 12px 30px rgba(59, 130, 246, 0.3); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .btn-predict:hover { transform: translateY(-4px) scale(1.02); box-shadow: 0 20px 40px rgba(59, 130, 246, 0.4); }

        /* Results Display */
        .gauge-wrap { position: relative; width: 160px; height: 160px; margin: 0 auto; }
        .gauge-svg { transform: rotate(-90deg); }
        .gauge-bar { fill: none; stroke: #f1f5f9; stroke-width: 14; }
        .gauge-progress {
            fill: none; stroke: #10b981; stroke-width: 14; stroke-linecap: round;
            stroke-dasharray: 440; stroke-dashoffset: 440; transition: stroke-dashoffset 1.5s ease-in-out;
        }

        /* Step Section */
        .step-card {
            background: #fff; padding: 2rem; border-radius: 24px; text-align: center;
            border: 1px solid #f1f5f9; transition: transform 0.3s ease;
        }
        .step-card:hover { transform: translateY(-8px); }
        .step-num {
            width: 50px; height: 50px; background: rgba(59, 130, 246, 0.1); color: var(--primary-blue);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-weight: 900; margin: 0 auto 1.5rem;
        }

        /* Loader */
        .loader { width: 24px; height: 24px; border: 3px solid rgba(255,255,255,0.3); border-top: 3.5px solid #fff; border-radius: 50%; animation: spin 1s linear infinite; }
        @keyframes spin { 100% { transform: rotate(360deg); } }

        .gender-select {
            display: flex; background: #f1f5f9; padding: 0.3rem; border-radius: 12px; gap: 0.3rem;
        }
        .gender-btn { flex: 1; text-align: center; }
        .gender-btn input { display: none; }
        .gender-btn label {
            display: block; padding: 0.6rem; border-radius: 10px; cursor: pointer;
            font-weight: 700; font-size: 0.8rem; color: #64748b; transition: 0.3s;
        }
        .gender-btn input:checked + label { background: #fff; color: var(--primary-blue); shadow: 0 4px 10px rgba(0,0,0,0.05); }

        .floating-badge {
            position: absolute; background: #fff; padding: 0.8rem 1.2rem; border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05); display: flex; align-items: center; gap: 0.8rem;
            animation: float 4s ease-in-out infinite; z-index: 5;
        }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }
    </style>
</head>
<body>

    <div class="bg-premium">
        <div class="mesh-gradient"></div>
        <div class="grid-futuristic"></div>
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>
    
    <div class="particles" id="particles"></div>

    <!-- Navigation -->
    <nav class="fixed w-full z-50 nav-glass transition-all duration-300 py-3" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-14">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center cursor-pointer" data-aos="fade-right" data-aos-duration="800">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo StuntCheck" class="w-8 h-8 mr-3 object-contain drop-shadow-sm">
                    <span class="font-extrabold text-xl tracking-tight text-slate-800">Stunt<span class="text-blue-500">Check</span></span>
                </a>
                
                <!-- Nav Links -->
                <div class="hidden md:flex space-x-8 items-center" data-aos="fade-down" data-aos-duration="800" data-aos-delay="100">
                    <a href="{{ url('/') }}#hero" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">Beranda</a>
                    <a href="{{ route('prediksi') }}" class="text-blue-600 font-semibold transition-colors">Prediksi</a>
                    <a href="{{ url('/') }}#about" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">Tentang Kami</a>
                    <a href="{{ url('/') }}#features" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">Fitur</a>
                    <a href="{{ url('/') }}#impact" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">Dampak</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-52 pb-24 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                
                <!-- Left: Content & Illustration -->
                <div class="lg:col-span-5" data-aos="fade-right">
                    <h1 class="text-5xl xl:text-6xl font-black text-slate-800 leading-[1.05] mb-6">
                        Cek Risiko <span class="text-gradient">Stunting</span> Anak Sejak Dini
                    </h1>
                    <p class="text-slate-500 font-medium text-lg leading-relaxed mb-8">
                        Deteksi dini potensi stunting dengan bantuan <span class="text-slate-800 font-bold">AI Cerdas</span> yang disesuaikan dengan standar medis <span class="text-blue-600 font-bold">WHO</span>.
                    </p>

                    <div class="flex flex-wrap gap-4 mb-12">
                        <div class="flex items-center gap-3 px-5 py-3 bg-white rounded-2xl shadow-sm border border-slate-50">
                            <i class="fa-solid fa-shield-check text-blue-500"></i>
                            <span class="text-sm font-bold text-slate-700">Akurat</span>
                        </div>
                        <div class="flex items-center gap-3 px-5 py-3 bg-white rounded-2xl shadow-sm border border-slate-50">
                            <i class="fa-solid fa-bolt text-purple-500"></i>
                            <span class="text-sm font-bold text-slate-700">Cepat</span>
                        </div>
                        <div class="flex items-center gap-3 px-5 py-3 bg-white rounded-2xl shadow-sm border border-slate-50">
                            <i class="fa-solid fa-lock text-emerald-500"></i>
                            <span class="text-sm font-bold text-slate-700">Data Aman</span>
                        </div>
                    </div>

                    <div class="relative mt-16 hidden lg:block">
                        <img src="https://img.freepik.com/free-vector/mother-hugging-her-baby_23-2148419616.jpg?t=st=1715402435~exp=1715406035~hmac=a403d158782f6e911a3d937a0d49472390f117a268a735626359595959595959" alt="Illustration" class="w-full max-w-sm rounded-3xl mix-blend-multiply opacity-90">
                        <div class="floating-badge top-0 -left-10">
                            <div class="w-9 h-9 bg-blue-50 text-blue-500 rounded-lg flex items-center justify-center"><i class="fa-solid fa-chart-line"></i></div>
                            <div><p class="text-[9px] font-black text-slate-400 uppercase">Growth Rate</p><p class="text-sm font-black text-slate-800">+15% Normal</p></div>
                        </div>
                        <div class="floating-badge bottom-10 -right-5" style="animation-delay: 2s;">
                            <div class="w-9 h-9 bg-emerald-50 text-emerald-500 rounded-lg flex items-center justify-center"><i class="fa-solid fa-shield-halved"></i></div>
                            <div><p class="text-[9px] font-black text-slate-400 uppercase">Health Shield</p><p class="text-sm font-black text-slate-800">Protected</p></div>
                        </div>
                    </div>
                </div>

                <!-- Right: Prediction Form -->
                <div class="lg:col-span-7" data-aos="fade-left">
                    <div class="glass-card p-8 md:p-12 relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-8 opacity-5"><i class="fa-solid fa-stethoscope text-8xl text-blue-600"></i></div>
                        <h2 class="text-3xl font-black text-slate-800 mb-2">Data Anak</h2>
                        <p class="text-slate-400 font-bold text-sm mb-10">Lengkapi informasi si kecil untuk analisis AI</p>

                        <form id="prediksiForm">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5">
                                <div><label class="block text-sm font-black text-slate-700 mb-2">Nama Lengkap</label><input type="text" name="nama_anak" required class="w-full input-premium" placeholder="Budi Santoso"></div>
                                <div><label class="block text-sm font-black text-slate-700 mb-2">Tanggal Lahir</label><input type="date" name="tgl_lahir" required class="w-full input-premium"></div>
                                <div><label class="block text-sm font-black text-slate-700 mb-2">Jenis Kelamin</label>
                                    <div class="gender-select">
                                        <div class="gender-btn"><input type="radio" name="jenis_kelamin" id="jk_l" value="Laki-laki" checked><label for="jk_l"><i class="fa-solid fa-mars"></i> Laki-laki</label></div>
                                        <div class="gender-btn"><input type="radio" name="jenis_kelamin" id="jk_p" value="Perempuan"><label for="jk_p"><i class="fa-solid fa-venus"></i> Perempuan</label></div>
                                    </div>
                                </div>
                                <div><label class="block text-sm font-black text-slate-700 mb-2">Usia (bulan)</label><input type="number" name="umur_bulan" required class="w-full input-premium" placeholder="24"></div>
                                <div><label class="block text-sm font-black text-slate-700 mb-2">Berat Badan (kg)</label><input type="number" step="0.1" name="berat_badan" required class="w-full input-premium" placeholder="12.5"></div>
                                <!-- TB -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-black text-slate-700 mb-2">Tinggi Badan (cm)</label>
                                    <div class="relative">
                                        <input type="number" step="0.1" name="tinggi_badan" required class="w-full input-premium pl-12" placeholder="85">
                                        <i class="fa-solid fa-ruler-vertical absolute left-4 top-1/2 -translate-y-1/2 text-blue-400"></i>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" id="btnSubmit" class="w-full btn-predict mt-10"><span>Mulai Prediksi Sekarang</span><i class="fa-solid fa-arrow-right-long"></i></button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Results Section -->
            <div id="resultsArea" class="mt-20 grid grid-cols-1 lg:grid-cols-12 gap-8 opacity-0 translate-y-10 transition-all duration-700">
                <div class="lg:col-span-4">
                    <div class="glass-card p-10 text-center">
                        <h3 class="font-black text-xl text-slate-800 mb-8">Hasil Prediksi AI</h3>
                        <div class="gauge-wrap mb-8">
                            <svg class="gauge-svg" width="160" height="160" viewBox="0 0 160 160">
                                <circle class="gauge-bar" cx="80" cy="80" r="70"></circle>
                                <circle id="gaugeFill" class="gauge-progress" cx="80" cy="80" r="70"></circle>
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center leading-none">
                                <span id="probText" class="text-3xl font-black text-slate-800">0%</span>
                                <span class="text-[9px] font-bold text-slate-400 uppercase mt-2">Risiko</span>
                            </div>
                        </div>
                        <div id="statusBadge" class="inline-block px-5 py-2 rounded-full bg-emerald-50 text-emerald-600 font-black text-xs uppercase mb-6 border border-emerald-100">Risiko Rendah</div>
                        <div class="p-5 bg-slate-50 rounded-2xl text-left border border-slate-100">
                            <p id="recommendationText" class="text-[11px] font-bold text-slate-600 leading-relaxed">Analisis menunjukkan kondisi si kecil berada dalam kategori normal. Teruskan pola hidup sehat.</p>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-8">
                    <div class="glass-card p-10 h-full">
                        <h4 class="font-black text-lg text-slate-800 mb-8">Indikator Status Gizi (WHO Standard)</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                                <p class="text-[10px] font-black text-slate-400 uppercase mb-2">Tinggi Badan/Umur (TB/U)</p>
                                <p id="z_ha" class="text-2xl font-black text-slate-800 mb-4">-</p>
                                <span class="px-3 py-1 rounded-lg bg-emerald-100 text-emerald-600 text-[9px] font-black uppercase">Normal</span>
                            </div>
                            <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                                <p class="text-[10px] font-black text-slate-400 uppercase mb-2">Berat Badan/Umur (BB/U)</p>
                                <p id="z_wa" class="text-2xl font-black text-slate-800 mb-4">-</p>
                                <span class="px-3 py-1 rounded-lg bg-emerald-100 text-emerald-600 text-[9px] font-black uppercase">Normal</span>
                            </div>
                            <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                                <p class="text-[10px] font-black text-slate-400 uppercase mb-2">Berat Badan/Tinggi (BB/TB)</p>
                                <p id="z_wh" class="text-2xl font-black text-slate-800 mb-4">-</p>
                                <span class="px-3 py-1 rounded-lg bg-emerald-100 text-emerald-600 text-[9px] font-black uppercase">Normal</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Steps Section -->
            <div class="mt-32">
                <h3 class="text-3xl font-black text-center text-slate-800 mb-16">Cara Kerja Analisis AI Kami</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="step-card" data-aos="fade-up">
                        <div class="step-num">01</div>
                        <h5 class="text-lg font-black text-slate-800 mb-3">Isi Data Anak</h5>
                        <p class="text-sm text-slate-400 font-medium leading-relaxed">Masukkan informasi akurat mengenai usia, berat, dan tinggi badan si kecil.</p>
                    </div>
                    <div class="step-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="step-num">02</div>
                        <h5 class="text-lg font-black text-slate-800 mb-3">AI Menganalisis Data</h5>
                        <p class="text-sm text-slate-400 font-medium leading-relaxed">Algoritma AI cerdas kami memproses data berdasarkan database medis WHO.</p>
                    </div>
                    <div class="step-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="step-num">03</div>
                        <h5 class="text-lg font-black text-slate-800 mb-3">Hasil Prediksi</h5>
                        <p class="text-sm text-slate-400 font-medium leading-relaxed">Dapatkan laporan kesehatan komprehensif dan rekomendasi tindakan secara instan.</p>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <footer class="py-12 border-t border-slate-100 mt-20 text-center">
        <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">&copy; {{ date('Y') }} StuntCheck Premium AI Healthcare Platform</p>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        AOS.init({ duration: 1000, once: true });

        // Particles
        const partWrap = document.getElementById('particles');
        for(let i=0; i<20; i++) {
            const p = document.createElement('div');
            p.className = 'particle';
            p.style.left = Math.random() * 100 + 'vw';
            p.style.setProperty('--d', (Math.random() * 10 + 10) + 's');
            p.style.animationDelay = (Math.random() * 5) + 's';
            partWrap.appendChild(p);
        }

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 20) {
                nav.classList.add('shadow-xl', 'bg-white/90');
            } else {
                nav.classList.remove('shadow-xl', 'bg-white/90');
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
                    const prob = (data.probabilitas * 100).toFixed(0);
                    const ha = data.status.ha.toLowerCase();
                    
                    resultsArea.classList.remove('opacity-0', 'translate-y-10');
                    gaugeFill.style.strokeDashoffset = 440 - (440 * prob / 100);
                    probText.innerText = prob + '%';

                    // Dynamic UI Updates
                    if (ha.includes('normal')) {
                        gaugeFill.style.stroke = '#10b981';
                        statusBadge.innerText = 'Risiko Rendah';
                        statusBadge.className = 'inline-block px-5 py-2 rounded-full bg-emerald-50 text-emerald-600 font-black text-xs uppercase mb-6 border border-emerald-100';
                        recommendationText.innerText = 'Analisis menunjukkan kondisi si kecil berada dalam kategori normal. Teruskan pemberian nutrisi seimbang dan pantau tumbuh kembang secara rutin.';
                    } else if (ha.includes('risiko') || ha.includes('berisiko')) {
                        gaugeFill.style.stroke = '#f59e0b';
                        statusBadge.innerText = 'Risiko Sedang';
                        statusBadge.className = 'inline-block px-5 py-2 rounded-full bg-yellow-50 text-yellow-600 font-black text-xs uppercase mb-6 border border-yellow-100';
                        recommendationText.innerText = 'Si kecil menunjukkan tanda risiko stunting. Segera konsultasikan dengan tenaga kesehatan atau posyandu terdekat untuk penanganan dini.';
                    } else {
                        gaugeFill.style.stroke = '#ef4444';
                        statusBadge.innerText = 'Risiko Tinggi';
                        statusBadge.className = 'inline-block px-5 py-2 rounded-full bg-red-50 text-red-600 font-black text-xs uppercase mb-6 border border-red-100';
                        recommendationText.innerText = 'Ditemukan indikasi stunting yang signifikan. Sangat disarankan untuk segera melakukan pemeriksaan medis intensif ke dokter spesialis anak.';
                    }

                    document.getElementById('z_ha').innerText = (data.z_score.z_ha || 0).toFixed(2);
                    document.getElementById('z_wa').innerText = (data.z_score.z_wa || 0).toFixed(2);
                    document.getElementById('z_wh').innerText = (data.z_score.z_wh || 0).toFixed(2);

                    resultsArea.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    Swal.fire({ icon: 'success', title: 'Analisis Berhasil', text: 'Hasil telah diperbarui di bawah.', timer: 2500, showConfirmButton: false });
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
