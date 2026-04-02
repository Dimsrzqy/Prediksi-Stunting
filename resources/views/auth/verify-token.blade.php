<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify Token - StuntCheck</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .bg-custom-blue {
            background-color: #f1f4ff;
        }

        .text-primary-blue {
            color: #1f41bb;
        }

        .bg-primary-blue {
            background-color: #1f41bb;
        }

        .shadow-premium {
            box-shadow: 0 20px 50px rgba(31, 65, 187, 0.15);
        }

        /* 3D Shapes */
        .shape-1 {
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(31, 65, 187, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
            z-index: -1;
        }

        .shape-2 {
            position: absolute;
            bottom: -150px;
            left: -150px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(31, 65, 187, 0.05) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
            z-index: -1;
        }
    </style>
</head>

<body class="bg-white min-h-screen flex items-center justify-center p-6 relative overflow-hidden">
    <!-- Background Decorations -->
    <div class="shape-1"></div>
    <div class="shape-2"></div>

    <div class="w-full max-w-md relative">
        <div class="bg-white rounded-[32px] p-8 sm:p-10 shadow-premium border border-blue-50/50">
            <!-- Logo StuntCheck -->
            <div class="flex flex-col items-center mb-8">
                <div class="flex items-center space-x-2 mb-2">
                    <div class="w-10 h-10 bg-primary-blue rounded-xl flex items-center justify-center shadow-lg transform rotate-12">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-gray-900 tracking-tight">StuntCheck</span>
                </div>
                <h1 class="text-3xl font-extrabold text-primary-blue mt-4 text-center">Verify Token</h1>
                <p class="text-gray-600 font-medium text-sm text-center mt-4 leading-relaxed">
                    Masukkan token yang kami kirim ke email Anda.
                </p>
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-2xl border border-green-200">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.token.verify') }}" class="space-y-6">
                @csrf
                
                <div class="relative group">
                    <input id="token" name="token" type="text" value="{{ old('token') }}" required autofocus
                        class="block w-full px-5 py-3.5 rounded-2xl bg-custom-blue text-gray-900 border-2 border-gray-300 focus:border-primary-blue focus:bg-white outline-none transition-all duration-300 placeholder:text-gray-400"
                        placeholder="Masukkan Token (6-8 karakter)">
                    @error('token')
                        <p class="mt-2 text-xs text-red-500 font-medium ml-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full flex justify-center py-4 px-4 rounded-2xl shadow-xl text-lg font-bold text-white bg-primary-blue hover:bg-blue-800 transition-all duration-300 transform hover:scale-[1.02] active:scale-95 shadow-blue-200">
                        Verifikasi
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-8 border-t border-gray-100 flex items-center justify-center">
                <a href="{{ route('password.request') }}" class="text-gray-600 font-bold hover:text-primary-blue transition-colors text-sm">Kembali kirim email</a>
            </div>
        </div>
    </div>
</body>

</html>
