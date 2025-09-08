@extends('layouts.admin')

@section('content')
@php
    use Illuminate\Support\Facades\Auth;
@endphp
    @if(session('success'))
        <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black opacity-40"></div>
            <div class="bg-white rounded shadow-lg p-8 text-center z-50">
                <h2 class="text-xl font-bold mb-4 text-green-600">{{ session('success') }}</h2>
                <button onclick="document.getElementById('successModal').style.display='none'" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Tutup</button>
            </div>
        </div>
        <script>
            setTimeout(function(){
                document.getElementById('successModal').style.display = 'none';
            }, 3000);
        </script>
    @endif
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-purple-600">Hai, {{ Auth::guard('admin')->user()->username }}</h1>
    </div>
    <!-- Tombol logout dipindahkan ke navbar -->
    <!-- Tombol dipindahkan ke navbar -->
    <div class="bg-white bg-opacity-80 rounded-2xl shadow-xl p-8 mb-8">
        <h2 class="text-xl font-bold text-pink-400 mb-6 text-center">Daftar Pengaduan Masyarakat</h2>
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">NIK</th>
                    <th class="px-4 py-2">Isi Laporan</th>
                    <th class="px-4 py-2">Foto</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengaduans as $pengaduan)
                <tr>
                    <td class="border px-4 py-2">{{ $pengaduan->tgl_pengaduan }}</td>
                    <td class="border px-4 py-2">{{ $pengaduan->nik }}</td>
                    <td class="border px-4 py-2">{{ $pengaduan->isi_laporan }}</td>
                    <td class="border px-4 py-2">
                        @if($pengaduan->foto)
                            <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto" class="w-16 h-16 object-cover" />
                        @else
                            -
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        <form action="{{ route('admin.pengaduan.status', $pengaduan->id_pengaduan) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <select name="status" class="border rounded-full px-3 py-1 bg-gray-100">
                                <option value="0" @if($pengaduan->status == '0') selected @endif>Belum direspon</option>
                                <option value="proses" @if($pengaduan->status == 'proses') selected @endif>Proses</option>
                                <option value="selesai" @if($pengaduan->status == 'selesai') selected @endif>Selesai</option>
                            </select>
                            <button type="submit" class="bg-yellow-400 text-white px-3 py-1 rounded-full shadow hover:bg-yellow-500 transition">Update</button>
                        </form>
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.pengaduan.detail', $pengaduan->id_pengaduan) }}" class="bg-gray-400 text-white px-3 py-1 rounded-full shadow hover:bg-gray-600 transition">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
