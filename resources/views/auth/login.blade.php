<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - StuntCheck</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'blob': 'blob 7s infinite',
                    },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        }
        .dark .glass-panel {
            background: rgba(17, 24, 39, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }
        .bg-animated {
            background: linear-gradient(-45deg, #f8fafc, #f1f5f9, #e0f2fe, #ecfdf5);
            background-size: 400% 400%;
            animation: gradient-shift 15s ease infinite;
        }
        .dark .bg-animated {
            background: linear-gradient(-45deg, #030712, #0f172a, #1e1b4b, #064e3b);
            background-size: 400% 400%;
            animation: gradient-shift 15s ease infinite;
        }
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body class="bg-animated min-h-screen flex items-center justify-center p-6 relative overflow-hidden transition-colors duration-500">
    
    <!-- Top Controls -->
    <div class="absolute top-6 right-6 flex items-center gap-3 z-50">
        <!-- Language Switcher -->
        <div class="relative group/lang">
            <button class="p-3 rounded-full glass-panel text-gray-800 dark:text-gray-200 hover:scale-105 transition-all flex items-center gap-2">
                <i class="fa-solid fa-language text-lg"></i>
                <span class="text-xs font-bold uppercase">{{ App::getLocale() }}</span>
            </button>
            <div class="absolute top-full right-0 mt-2 w-32 glass-panel rounded-2xl overflow-hidden opacity-0 invisible group-hover/lang:opacity-100 group-hover/lang:visible transition-all">
                <a href="{{ route('set-language', 'id') }}" class="block px-4 py-3 text-xs font-bold text-gray-700 dark:text-gray-300 hover:bg-white/50 dark:hover:bg-gray-800 transition-colors">🇮🇩 Indonesia</a>
                <a href="{{ route('set-language', 'en') }}" class="block px-4 py-3 text-xs font-bold text-gray-700 dark:text-gray-300 hover:bg-white/50 dark:hover:bg-gray-800 transition-colors">🇺🇸 English</a>
            </div>
        </div>

        <!-- Theme Toggle -->
        <button onclick="toggleTheme()" class="p-3 rounded-full glass-panel text-gray-800 dark:text-gray-200 hover:scale-105 transition-all">
            <svg id="theme-icon-dark" class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            <svg id="theme-icon-light" class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </button>
    </div>

    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Background Orbs (Optional for extra flair) -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-400/20 dark:bg-blue-600/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-70 animate-blob"></div>
        <div class="absolute top-[20%] right-[-10%] w-96 h-96 bg-emerald-400/20 dark:bg-emerald-600/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-[-20%] left-[20%] w-96 h-96 bg-blue-300/20 dark:bg-blue-800/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-70 animate-blob animation-delay-4000"></div>
    </div>

    <div class="w-full max-w-md relative z-10">
        <div class="glass-panel rounded-3xl p-8 sm:p-10 relative overflow-hidden group">
            
            <!-- Inner Glow effect on hover -->
            <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 via-indigo-500 to-emerald-500 rounded-3xl blur-xl opacity-0 group-hover:opacity-20 dark:group-hover:opacity-30 transition duration-1000 group-hover:duration-300 z-[-1]"></div>

            <div class="flex flex-col items-center mb-10 relative z-10">
                <!-- Logo -->
                <div class="flex items-center mb-6">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo StuntCheck" class="h-14 w-auto transform hover:scale-110 transition-transform duration-300 drop-shadow-md">
                    <span class="ml-3 text-3xl font-black tracking-tighter text-gray-900 dark:text-white">Stunt<span class="text-blue-600">Check</span></span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">{{ __('Welcome Back') }}</h1>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-2 text-center">{{ __('Sign in to your StuntCheck account to continue.') }}</p>
            </div>

            @if (session('logout_success'))
                <div id="logoutNotif" class="mb-6 p-4 rounded-xl bg-emerald-50/80 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 text-sm font-medium backdrop-blur-sm flex items-center gap-3 animate-slide-down">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{ __('Anda berhasil keluar dari sistem.') }}</span>
                </div>
                <style>
                    @keyframes slide-down { from { opacity: 0; transform: translateY(-12px); } to { opacity: 1; transform: translateY(0); } }
                    .animate-slide-down { animation: slide-down 0.5s ease-out forwards; }
                </style>
                <script>setTimeout(() => { const el = document.getElementById('logoutNotif'); if(el) { el.style.transition = 'opacity 0.5s, transform 0.5s'; el.style.opacity = '0'; el.style.transform = 'translateY(-12px)'; setTimeout(() => el.remove(), 500); } }, 4000);</script>
            @endif

            @if (session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-50/80 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 text-sm font-medium backdrop-blur-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5 relative z-10">
                @csrf
                
                <div class="space-y-1.5">
                    <label for="email" class="text-sm font-medium text-gray-700 dark:text-gray-300 ml-1">{{ __('Email Address') }}</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 pl-11"
                            placeholder="you@example.com">
                    </div>
                    @error('email')
                        <p class="mt-1 text-xs text-red-500 font-medium ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label for="password" class="text-sm font-medium text-gray-700 dark:text-gray-300 ml-1">{{ __('Password') }}</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" name="password" type="password" required
                            class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 pl-11 pr-11"
                            placeholder="••••••••">
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-blue-500 transition-colors">
                            <svg class="h-5 w-5" fill="none" id="eye-icon" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded bg-white dark:bg-gray-900 dark:border-gray-700">
                        <label for="remember" class="ml-2 block text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 transition-colors">{{ __('Forgot password?') }}</a>
                    @endif
                </div>

                <div class="pt-5">
                    <button type="submit"
                        class="w-full flex justify-center items-center gap-2 py-3.5 px-4 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 dark:focus:ring-offset-gray-900 transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg shadow-blue-500/30">
                        {{ __('Sign In') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Footer text -->
        <div class="mt-8 text-center relative z-10">
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __("Don't have an account?") }} <a href="#" class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 transition-colors hover:underline">{{ __('Contact Administrator') }}</a></p>
        </div>
    </div>

    <script>
        // Check for saved theme preference or use system preference
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        function toggleTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        }

        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.04m4.066-1.56a10.048 10.048 0 014.113-1.045c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 01-1.563 3.04m-4.066 1.56A10.048 10.048 0 0112 13c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.04M9 9l6 6M9 15l6-6" />';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }
    </script>
</body>
</html>
