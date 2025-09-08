<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-purple-100 to-pink-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
        {{-- Flash error --}}
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <strong class="font-bold">Gagal!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
        <h2 class="text-3xl font-bold text-center text-purple-700 mb-6">Login Admin</h2>
        <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Username</label>
                <div class="relative">
                    <input type="text" name="username" 
                        class="w-full border rounded-lg pl-10 px-3 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none" 
                        placeholder="Masukkan username" required>
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        🔑
                    </span>
                </div>
            </div>
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="admin-password" 
                        class="w-full border rounded-lg pl-10 pr-10 px-3 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none" 
                        placeholder="Masukkan password" required>
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        🔒
                    </span>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePassword('admin-password', this)">
                        <svg id="admin-eye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-9 0a9 9 0 0118 0c0 2.5-2.5 7-9 7s-9-4.5-9-7z" /></svg>
                    </span>
                </div>
            </div>
            <button type="submit" 
                    class="bg-purple-500 text-white font-semibold px-4 py-2 rounded-lg w-full hover:bg-purple-600 active:scale-95 transition transform">
                Login
            </button>
        </form>
        <script>
        function togglePassword(id, el) {
            const input = document.getElementById(id);
            const eye = el.querySelector('svg');
            if (input.type === 'password') {
                input.type = 'text';
                eye.setAttribute('stroke', '#8b5cf6');
            } else {
                input.type = 'password';
                eye.setAttribute('stroke', '#9ca3af');
            }
        }
        </script>
        <p class="text-sm text-center text-gray-500 mt-6">
            &copy; {{ date('Y') }} Sistem Pengaduan Masyarakat
        </p>
    </div>
</body>
</html>
