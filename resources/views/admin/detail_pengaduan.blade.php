<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-purple-200 via-pink-200 to-blue-100 min-h-screen font-poppins">
    <div class="container mx-auto py-10 px-6">
        <h1 class="text-3xl font-bold text-purple-700 mb-8">📋 Detail Pengaduan</h1>

        <!-- Card Detail -->
        <div class="bg-white bg-opacity-80 backdrop-blur-sm rounded-xl shadow-lg p-6 space-y-4">
            <div class="grid grid-cols-3 gap-2">
                <span class="font-semibold text-gray-700">Tanggal</span>
                <span class="col-span-2">{{ $pengaduan->tgl_pengaduan }}</span>

                <span class="font-semibold text-gray-700">NIK</span>
                <span class="col-span-2">{{ $pengaduan->nik }}</span>

                <span class="font-semibold text-gray-700">Isi Laporan</span>
                <span class="col-span-2">{{ $pengaduan->isi_laporan }}</span>

                <span class="font-semibold text-gray-700">Status</span>
                <span class="col-span-2">
                    <span class="px-3 py-1 rounded-full text-sm 
                        {{ $pengaduan->status == 'proses' ? 'bg-yellow-200 text-yellow-700' : '' }}
                        {{ $pengaduan->status == 'selesai' ? 'bg-green-200 text-green-700' : '' }}
                        {{ $pengaduan->status == '0' ? 'bg-red-200 text-red-700' : '' }}">
                        {{ ucfirst($pengaduan->status) }}
                    </span>
                </span>
            </div>

            <div>
                <span class="font-semibold text-gray-700 block mb-2">Foto</span>
                @if($pengaduan->foto)
                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" 
                         alt="Foto Laporan" 
                         class="h-48 w-48 object-cover rounded-lg shadow border">
                @else
                    <span class="text-gray-500 italic">Tidak ada foto</span>
                @endif
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-6">
            <a href="{{ route('admin.dashboard') }}" 
               class="inline-block bg-purple-600 text-white px-6 py-2 rounded-lg shadow hover:bg-purple-700 transition">
                ← Kembali ke Dashboard
            </a>
        </div>
    </div>
</body>
</html>
