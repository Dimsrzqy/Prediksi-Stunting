<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify Email - StuntCheck</title>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-gray-900 tracking-tight">StuntCheck</span>
                </div>
                <h1 class="text-3xl font-extrabold text-primary-blue mt-4 text-center">Verifikasi Email</h1>
                <p class="text-gray-600 font-medium text-sm text-center mt-4 leading-relaxed">
                    Terima kasih telah mendaftar! Sebelum mulai, silakan verifikasi email Anda dengan mengklik link yang baru saja kami kirimkan.
                </p>
            </div>

            @if (session('message'))
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-2xl border border-green-200">
                    {{ session('message') }}
                </div>
            @endif

            <div class="space-y-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex justify-center py-4 px-4 rounded-2xl shadow-xl text-lg font-bold text-white bg-primary-blue hover:bg-blue-800 transition-all duration-300 transform hover:scale-[1.02] active:scale-95 shadow-blue-200">
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 rounded-2xl text-sm font-bold text-gray-600 hover:text-red-500 transition-all duration-300">
                        Keluar (Logout)
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
