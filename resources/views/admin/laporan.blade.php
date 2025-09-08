<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-purple-200 via-pink-200 to-blue-100 min-h-screen font-poppins">
    <div class="container mx-auto py-10 px-6">
        <h1 class="text-3xl font-bold text-purple-700 mb-8">📑 Laporan Pengaduan Masyarakat</h1>

        <div class="bg-white bg-opacity-80 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-purple-100 text-purple-800 text-left">
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">NIK</th>
                        <th class="px-4 py-3">Isi Laporan</th>
                        <th class="px-4 py-3">Foto</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($pengaduans as $pengaduan)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $pengaduan->tgl_pengaduan }}</td>
                        <td class="px-4 py-3">{{ $pengaduan->nik }}</td>
                        <td class="px-4 py-3">{{ $pengaduan->isi_laporan }}</td>
                        <td class="px-4 py-3">
                            @if($pengaduan->foto)
                                <img src="{{ asset('storage/' . $pengaduan->foto) }}" 
                                     alt="Foto" 
                                     class="h-16 w-16 object-cover rounded-lg shadow">
                            @else
                                <span class="text-gray-400 italic">Tidak ada</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-3 py-1 rounded-full text-sm
                                {{ $pengaduan->status == '0' ? 'bg-red-200 text-red-700' : '' }}
                                {{ $pengaduan->status == 'proses' ? 'bg-yellow-200 text-yellow-700' : '' }}
                                {{ $pengaduan->status == 'selesai' ? 'bg-green-200 text-green-700' : '' }}">
                                {{ ucfirst($pengaduan->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
