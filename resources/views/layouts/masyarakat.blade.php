<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>.font-poppins { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-purple-200 via-pink-200 to-blue-100 font-poppins flex flex-col">

    <!-- NAVBAR -->
    <nav class="bg-white bg-opacity-70 shadow px-8 py-4 flex items-center justify-between">
        <!-- Brand -->
        <div class="flex items-center space-x-3">
            <!-- Logo -->
            <div class="bg-purple-600 text-white p-2 rounded-full shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" 
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M13 5v14m-6 0h12" />
                </svg>
            </div>
            <span class="font-bold text-purple-700 text-xl tracking-wide">PENGADUAN MASYARAKAT</span>
        </div>

        <!-- Menu -->
        <div class="hidden md:flex items-center space-x-6 font-medium">
            <form action="/logout" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 transition">
                    Logout
                </button>
            </form>
        </div>
    </nav>
    <!-- END NAVBAR -->

    <!-- CONTENT -->
    <main class="flex-1 container mx-auto px-8 py-6">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-white bg-opacity-70 shadow px-8 py-4 text-center">
    <span class="text-gray-500">&copy; {{ date('Y') }} Pengaduan Masyarakat by Frinzka Desfrilia</span>
    </footer>

</body>
</html>
