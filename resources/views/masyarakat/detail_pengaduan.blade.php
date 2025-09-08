@extends('layouts.masyarakat')

@section('content')
<div class="max-w-2xl mx-auto mt-10 p-8 bg-white rounded-2xl shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-center text-purple-700">Detail Pengaduan</h2>
    <div class="mb-4">
        <span class="font-semibold text-gray-700">Tanggal:</span> {{ $pengaduan->tgl_pengaduan }}
    </div>
    <div class="mb-4">
        <span class="font-semibold text-gray-700">NIK:</span> {{ $pengaduan->nik }}
    </div>
    <div class="mb-4">
        <span class="font-semibold text-gray-700">Isi Laporan:</span>
        <div class="mt-2 p-3 bg-gray-100 rounded">{{ $pengaduan->isi_laporan }}</div>
    </div>
    <div class="mb-4">
        <span class="font-semibold text-gray-700">Status:</span>
        @if($pengaduan->status == '0')
            <span class="bg-gray-300 text-gray-800 px-2 py-1 rounded-full">Belum direspon</span>
        @elseif($pengaduan->status == 'proses')
            <span class="bg-yellow-300 text-yellow-800 px-2 py-1 rounded-full">Proses</span>
        @elseif($pengaduan->status == 'selesai')
            <span class="bg-green-300 text-green-800 px-2 py-1 rounded-full">Selesai</span>
        @else
            <span class="bg-red-300 text-red-800 px-2 py-1 rounded-full">Unknown</span>
        @endif
    </div>
    <div class="mb-4">
        <span class="font-semibold text-gray-700">Foto:</span>
        @if($pengaduan->foto)
            <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto" class="w-32 h-32 object-cover rounded-lg mt-2" />
        @else
            <span class="text-gray-500">-</span>
        @endif
    </div>
    <a href="{{ route('masyarakat.dashboard') }}" class="mt-6 inline-block bg-purple-500 text-white px-6 py-2 rounded-full shadow hover:bg-purple-600 transition">Kembali</a>
</div>
@endsection
