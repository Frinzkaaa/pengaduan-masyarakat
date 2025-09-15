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
    <!-- Hero Header -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-purple-400 to-pink-400 rounded-2xl shadow-lg p-8 flex flex-col md:flex-row items-center justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-white flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 inline-block text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2z" /></svg>
                    Dashboard Admin
                </h1>
                <p class="mt-2 text-purple-100">Selamat datang, <span class="font-bold">{{ Auth::guard('admin')->user()->username }}</span>! Kelola pengaduan masyarakat dengan mudah dan responsif.</p>
            </div>
        </div>
    </div>

    <!-- Tombol Export PDF -->
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.pengaduan.exportPdf') }}" target="_blank" class="bg-gradient-to-r from-green-400 to-green-600 text-white px-6 py-2 rounded-xl shadow hover:opacity-90 transition font-semibold flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Export PDF
        </a>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow p-4 flex flex-col items-center">
            <span class="text-purple-500 font-bold text-lg">Total</span>
            <span class="text-2xl font-extrabold">{{ $pengaduans->count() }}</span>
        </div>
        <div class="bg-yellow-100 rounded-xl shadow p-4 flex flex-col items-center">
            <span class="text-yellow-700 font-bold text-lg">Proses</span>
            <span class="text-2xl font-extrabold">{{ $pengaduans->where('status','proses')->count() }}</span>
        </div>
        <div class="bg-green-100 rounded-xl shadow p-4 flex flex-col items-center">
            <span class="text-green-700 font-bold text-lg">Selesai</span>
            <span class="text-2xl font-extrabold">{{ $pengaduans->where('status','selesai')->count() }}</span>
        </div>
        <div class="bg-gray-100 rounded-xl shadow p-4 flex flex-col items-center">
            <span class="text-gray-700 font-bold text-lg">Belum direspon</span>
            <span class="text-2xl font-extrabold">{{ $pengaduans->where('status','0')->count() }}</span>
        </div>
    </div>

    <!-- Tabel Modern -->
    <div class="bg-white bg-opacity-90 rounded-2xl shadow-xl p-8 mb-8 overflow-x-auto">
        <h2 class="text-xl font-bold text-pink-400 mb-6 text-center">Daftar Pengaduan Masyarakat</h2>
        <table class="min-w-full table-auto rounded-xl overflow-hidden">
            <thead>
                <tr class="bg-gradient-to-r from-purple-100 to-pink-100">
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">NIK</th>
                    <th class="px-4 py-2 text-left">Isi Laporan</th>
                    <th class="px-4 py-2 text-left">Foto</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengaduans as $pengaduan)
                <tr class="hover:bg-purple-50 transition">
                    <td class="border-b px-4 py-2">{{ $pengaduan->tgl_pengaduan }}</td>
                    <td class="border-b px-4 py-2">{{ $pengaduan->nik }}</td>
                    <td class="border-b px-4 py-2">{{ $pengaduan->isi_laporan }}</td>
                    <td class="border-b px-4 py-2">
                        @if($pengaduan->foto)
                            <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto" class="w-16 h-16 object-cover rounded-lg shadow" />
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="border-b px-4 py-2">
                        <form action="{{ route('admin.pengaduan.status', $pengaduan->id_pengaduan) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <select name="status" class="border rounded-full px-3 py-1 bg-gray-100">
                                <option value="0" @if($pengaduan->status == '0') selected @endif>Belum direspon</option>
                                <option value="proses" @if($pengaduan->status == 'proses') selected @endif>Proses</option>
                                <option value="selesai" @if($pengaduan->status == 'selesai') selected @endif>Selesai</option>
                            </select>
                            <button type="submit" class="bg-yellow-400 text-white px-3 py-1 rounded-full shadow hover:bg-yellow-500 transition">Update</button>
                        </form>
                        <span class="ml-2 px-3 py-1 rounded-full text-xs font-bold
                            {{ $pengaduan->status == 'selesai' ? 'bg-green-100 text-green-700' :
                               ($pengaduan->status == 'proses' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-700') }}">
                            {{ $pengaduan->status == '0' ? 'Belum direspon' : ucfirst($pengaduan->status) }}
                        </span>
                    </td>
                    <td class="border-b px-4 py-2">
                        <a href="{{ route('admin.pengaduan.detail', $pengaduan->id_pengaduan) }}" class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 py-2 rounded-xl shadow hover:opacity-90 transition">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
