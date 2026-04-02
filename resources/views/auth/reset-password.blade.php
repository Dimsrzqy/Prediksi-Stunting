<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password - StuntCheck</title>
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
                <h1 class="text-3xl font-extrabold text-primary-blue mt-4 text-center">Reset Password</h1>
                <p class="text-gray-600 font-medium text-sm text-center mt-4 leading-relaxed">
                    Set your new password below.
                </p>
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-2xl border border-green-200">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ old('email', $email) }}">
                
                @error('email')
                    <p class="mt-2 text-xs text-red-500 font-medium ml-2">{{ $message }}</p>
                @enderror
                @error('token')
                    <p class="mt-2 text-xs text-red-500 font-medium ml-2 text-center">{{ $message }}</p>
                @enderror

                <div class="relative group">
                    <input id="password" name="password" type="password" required autofocus
                        class="block w-full px-5 py-3.5 rounded-2xl bg-custom-blue text-gray-900 border-2 border-gray-300 focus:border-primary-blue focus:bg-white outline-none transition-all duration-300 placeholder:text-black"
                        placeholder="New Password">
                    <button type="button" onclick="togglePassword('password', 'eye-icon-1')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-blue-300 hover:text-primary-blue transition-colors">
                        <svg class="h-5 w-5" fill="none" id="eye-icon-1" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                    @error('password')
                        <p class="mt-2 text-xs text-red-500 font-medium ml-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="relative group">
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="block w-full px-5 py-3.5 rounded-2xl bg-custom-blue text-gray-900 border-2 border-gray-300 focus:border-primary-blue focus:bg-white outline-none transition-all duration-300 placeholder:text-black"
                        placeholder="Confirm New Password">
                    <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-2')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-blue-300 hover:text-primary-blue transition-colors">
                        <svg class="h-5 w-5" fill="none" id="eye-icon-2" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full flex justify-center py-4 px-4 rounded-2xl shadow-xl text-lg font-bold text-white bg-primary-blue hover:bg-blue-800 transition-all duration-300 transform hover:scale-[1.02] active:scale-95 shadow-blue-200">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.04m4.066-1.56a10.048 10.048 0 014.113-1.045c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 01-1.563 3.04m-4.066 1.56A10.048 10.048 0 0112 13c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.04M9 9l6 6M9 15l6-6" />';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }
    </script>
</body>

</html>
