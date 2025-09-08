@extends('layouts.masyarakat')

@section('content')
@php
    use Illuminate\Support\Facades\Auth;
@endphp
    <div class="min-h-screen bg-gradient-to-br from-purple-100 to-pink-100 py-10 px-5">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800">Layanan Pengaduan Masyarakat</h1>
            <p class="mt-2 text-gray-600">Laporkan masalah di sekitar Anda, kami siap menindaklanjutinya</p>
            <a href="{{ route('pengaduan.form') }}"
               class="inline-block mt-5 px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white font-medium rounded-xl shadow-md hover:opacity-90 transition">
               Buat Pengaduan Baru
            </a>
        </div>

        <!-- Filter & Search -->
        <div class="max-w-4xl mx-auto mb-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <form action="{{ route('masyarakat.dashboard') }}" method="GET" class="w-full md:w-1/2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari laporan..."
                       class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none">
            </form>
            <div>
                <select name="status" onchange="this.form.submit()"
                        class="px-4 py-2 border rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none">
                    <option value="">Semua Status</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Belum direspon</option>
                    <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
        </div>

        <!-- Card Grid -->
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($pengaduans as $item)
                <div class="bg-white shadow-lg rounded-2xl p-5 flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">{{ $item->judul ?? 'Pengaduan' }}</h3>
                        <p class="text-gray-600 mt-2">{{ \Illuminate\Support\Str::limit($item->isi_laporan, 100) }}</p>
                        <p class="text-sm text-purple-500 mt-2">Oleh: <span class="font-semibold">{{ $item->masyarakat->nama ?? '-' }}</span></p>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-sm text-gray-500">{{ $item->tgl_pengaduan }}</span>
                        <span class="px-3 py-1 rounded-full text-xs
                            {{ $item->status == 'selesai' ? 'bg-green-100 text-green-700' :
                               ($item->status == 'proses' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-700') }}">
                            {{ $item->status == '0' ? 'Belum direspon' : ucfirst($item->status) }}
                        </span>
                    </div>
                          <a href="{{ route('masyarakat.pengaduan.detail', $item->id_pengaduan) }}"
                              class="block mt-4 text-center bg-gradient-to-r from-purple-500 to-pink-500 text-white py-2 rounded-xl hover:opacity-90 transition">
                              Lihat Detail
                          </a>
                </div>
            @empty
                <div class="col-span-3 text-center py-10">
                    <p class="text-gray-500">Belum ada pengaduan</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $pengaduans->links() }}
        </div>
    </div>
@endsection
