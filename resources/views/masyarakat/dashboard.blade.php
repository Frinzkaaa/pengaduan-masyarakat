
@extends('layouts.masyarakat')

@section('content')
@php
    use Illuminate\Support\Facades\Auth;
@endphp
<div class="min-h-screen bg-gradient-to-br from-purple-100 to-pink-100 py-10 px-2 md:px-8">
    <!-- Hero Header -->
    <div class="text-center mb-10">
        <div class="inline-block bg-gradient-to-r from-purple-400 to-pink-400 rounded-2xl shadow-lg px-6 py-6 mb-4 animate-fade-in">
            <h1 class="text-4xl font-extrabold text-white flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 inline-block text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2z" /></svg>
                Sistem Pengaduan Masyarakat
            </h1>
            <p class="mt-2 text-purple-100">Laporkan masalah di sekitar Anda, kami siap menindaklanjutinya</p>
        </div>
    </div>

    <!-- Fitur Card Section -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10 max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
            <span class="text-purple-500 font-bold text-lg">Total</span>
            <span class="text-2xl font-extrabold">{{ $pengaduans->total() }}</span>
        </div>
        <div class="bg-yellow-100 rounded-xl shadow p-6 flex flex-col items-center">
            <span class="text-yellow-700 font-bold text-lg">Proses</span>
            <span class="text-2xl font-extrabold">{{ $pengaduans->filter(fn($p)=>$p->status=='proses')->count() }}</span>
        </div>
        <div class="bg-green-100 rounded-xl shadow p-6 flex flex-col items-center">
            <span class="text-green-700 font-bold text-lg">Selesai</span>
            <span class="text-2xl font-extrabold">{{ $pengaduans->filter(fn($p)=>$p->status=='selesai')->count() }}</span>
        </div>
        <div class="bg-gray-100 rounded-xl shadow p-6 flex flex-col items-center">
            <span class="text-gray-700 font-bold text-lg">Belum direspon</span>
            <span class="text-2xl font-extrabold">{{ $pengaduans->filter(fn($p)=>$p->status=='0')->count() }}</span>
        </div>
    </div>

    <!-- Section: Layanan & Info -->
    <div class="bg-white bg-opacity-80 rounded-2xl shadow-lg p-8 mb-10 max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="flex-1 text-center md:text-left">
            <h2 class="text-2xl font-bold text-purple-700 mb-2">Layanan Pengaduan</h2>
            <p class="text-gray-600 mb-4">Sampaikan keluhan Anda secara online, mudah dan cepat. Semua laporan akan ditindaklanjuti oleh petugas terkait.</p>
            <a href="{{ route('pengaduan.form') }}" class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-5 py-2 rounded-xl shadow hover:opacity-90 transition font-semibold">Buat Pengaduan</a>
        </div>
        <div class="flex-1 flex flex-col gap-4">
            <div class="bg-purple-100 rounded-xl p-4 flex items-center gap-3">
                <span class="bg-white rounded-full p-2 shadow"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2z" /></svg></span>
                <span class="font-semibold text-purple-700">Jam Layanan: 08.00 - 16.00</span>
            </div>
            <div class="bg-pink-100 rounded-xl p-4 flex items-center gap-3">
                <span class="bg-white rounded-full p-2 shadow"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-9 0a9 9 0 0118 0c0 2.5-2.5 7-9 7s-9-4.5-9-7z" /></svg></span>
                <span class="font-semibold text-pink-700">Petugas Siap Membantu</span>
            </div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="max-w-4xl mx-auto mb-8">
        <form action="{{ route('masyarakat.dashboard') }}" method="GET" class="flex flex-col md:flex-row gap-4 w-full">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari laporan..."
                   class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none">
            <select name="status"
                    class="w-full md:w-auto px-4 py-2 border rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none">
                <option value="">Semua Status</option>
                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Belum direspon</option>
                <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded-xl hover:bg-purple-600 w-full md:w-auto">Filter</button>
        </form>
    </div>

    <!-- Section: Pengaduan Grid Modern -->
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($pengaduans as $item)
            <div class="bg-white shadow-xl rounded-2xl p-6 flex flex-col justify-between hover:scale-[1.03] transition-transform duration-200 border border-purple-100">
                <div>
                    <h3 class="text-lg font-bold text-purple-700 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2z" /></svg>
                        {{ $item->judul ?? 'Pengaduan' }}
                    </h3>
                    <p class="text-gray-600 mt-2">{{ \Illuminate\Support\Str::limit($item->isi_laporan, 100) }}</p>
                    <p class="text-sm text-purple-500 mt-2">Oleh: <span class="font-semibold">{{ $item->masyarakat->nama ?? '-' }}</span></p>
                </div>
                <div class="mt-4 flex flex-col gap-2 md:flex-row justify-between items-center">
                    <span class="text-sm text-gray-500">{{ $item->tgl_pengaduan }}</span>
                    <span class="px-3 py-1 rounded-full text-xs font-bold
                        {{ $item->status == 'selesai' ? 'bg-green-100 text-green-700' :
                           ($item->status == 'proses' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-700') }}">
                        {{ $item->status == '0' ? 'Belum direspon' : ucfirst($item->status) }}
                    </span>
                </div>
                <a href="{{ route('masyarakat.pengaduan.detail', $item->id_pengaduan) }}"
                    class="block mt-4 text-center bg-gradient-to-r from-purple-500 to-pink-500 text-white py-2 rounded-xl font-semibold shadow hover:opacity-90 transition">
                    Lihat Detail
                </a>
            </div>
        @empty
            <div class="col-span-3 text-center py-10">
                <p class="text-gray-500">Belum ada pengaduan</p>
            </div>
        @endforelse
    </div>

    <!-- Section: Team (Petugas) -->
    <div class="max-w-5xl mx-auto mt-16 mb-8">
        <h2 class="text-2xl font-bold text-center text-purple-700 mb-6">Petugas Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 justify-items-center">
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
                <img src="https://ui-avatars.com/api/?name=Petugas+1&background=8b5cf6&color=fff&size=128" alt="Petugas 1" class="w-20 h-20 rounded-full mb-3">
                <span class="font-bold text-purple-700">Petugas 1</span>
                <span class="text-gray-500 text-sm">Admin</span>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
                <img src="https://ui-avatars.com/api/?name=Petugas+2&background=ec4899&color=fff&size=128" alt="Petugas 2" class="w-20 h-20 rounded-full mb-3">
                <span class="font-bold text-pink-500">Petugas 2</span>
                <span class="text-gray-500 text-sm">Petugas</span>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
                <img src="https://ui-avatars.com/api/?name=Petugas+3&background=22c55e&color=fff&size=128" alt="Petugas 3" class="w-20 h-20 rounded-full mb-3">
                <span class="font-bold text-green-600">Petugas 3</span>
                <span class="text-gray-500 text-sm">Petugas</span>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-10 flex justify-center">
        {{ $pengaduans->links() }}
    </div>
</div>
@endsection
