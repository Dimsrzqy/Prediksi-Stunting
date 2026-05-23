<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password - StuntCheck</title>
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

    <!-- Background Orbs -->
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
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight text-center">{{ __('Forgot Password?') }}</h1>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-4 text-center leading-relaxed">
                    {{ __('No problem! Just let us know your email address and we will email you a password reset link.') }}
                </p>
            </div>

            @if (session('status'))
                <div class="mb-6 p-4 rounded-xl bg-green-50/80 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 text-sm font-medium backdrop-blur-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5 relative z-10">
                @csrf
                
                <div class="space-y-1.5">
                    <label for="email" class="text-sm font-medium text-gray-700 dark:text-gray-300 ml-1">{{ __('Email Address') }}</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 pl-11"
                            placeholder="you@example.com">
                    </div>
                    @error('email')
                        <p class="mt-1 text-xs text-red-500 font-medium ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-5">
                    <button type="submit"
                        class="w-full flex justify-center items-center gap-2 py-3.5 px-4 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 dark:focus:ring-offset-gray-900 transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg shadow-blue-500/30">
                        {{ __('Email Password Reset Link') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>
            
            <div class="mt-8 text-center relative z-10 border-t border-gray-100 dark:border-gray-800/80 pt-6">
                <a href="{{ route('login') }}" class="font-bold text-blue-600 dark:text-blue-400 hover:text-blue-500 transition-colors hover:underline text-sm inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    {{ __('Back to Login') }}
                </a>
            </div>
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
    </script>
</body>
</html>
