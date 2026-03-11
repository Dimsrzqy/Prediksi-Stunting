<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-sm">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex items-center flex-shrink-0">
                        <h1 class="text-xl font-bold">Dashboard</h1>
                    </div>
                </div>
                <div class="flex items-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-3 py-2 text-sm font-medium text-gray-500 rounded-md hover:text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-10">
        <main>
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="px-4 py-8 bg-white rounded-lg shadow-md sm:px-0">
                    <div class="p-8 border-4 border-gray-200 border-dashed rounded-lg">
                        <div class="text-center">
                            <h2 class="text-lg font-medium text-gray-900">Welcome, {{ Auth::user()->name }}!</h2>
                            <p class="mt-1 text-sm text-gray-600">You are logged in.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
