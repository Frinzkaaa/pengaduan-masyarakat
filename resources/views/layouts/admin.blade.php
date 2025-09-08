<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Layout</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gradient-to-br from-purple-200 via-pink-200 to-blue-100 font-poppins flex flex-col">

    <!-- NAVBAR -->
    <nav class="bg-white bg-opacity-70 shadow px-8 py-4 flex items-center justify-between">
        <!-- Kiri: Brand -->
        <div class="flex items-center space-x-3">
             <!-- Logo bundar -->
                 <div class="bg-purple-600 text-white p-2 rounded-full shadow">
                 <!-- Ikon Dashboard (SVG) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
        </svg>
    </div>

    <!-- Teks Brand -->
    <span class="font-bold text-purple-700 text-xl tracking-wide">ADMIN PANEL</span>
</div>
        
        <!-- Kanan: Menu -->
        <div class="hidden md:flex items-center space-x-6 font-medium">
            <a href="/admin/dashboard" class="bg-gradient-to-r from-purple-200 via-blue-200 to-green-200 text-gray-800 font-semibold rounded-full px-6 py-2 shadow hover:from-blue-300 hover:to-purple-300 hover:text-white transition">Dashboard</a>
            <a href="{{ route('admin.petugas.create') }}" class="bg-gradient-to-r from-green-300 via-blue-200 to-purple-200 text-gray-800 font-semibold rounded-full px-6 py-2 shadow hover:from-blue-300 hover:to-green-300 hover:text-white transition">Daftarkan Petugas</a>
            <a href="{{ route('admin.laporan') }}" class="bg-gradient-to-r from-purple-300 via-pink-300 to-blue-200 text-gray-800 font-semibold rounded-full px-6 py-2 shadow hover:from-pink-300 hover:to-purple-300 hover:text-white transition">Generate Laporan</a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-red-500 text-white font-semibold px-6 py-2 rounded-full shadow hover:bg-red-600 transition ml-2">Logout</button>
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
