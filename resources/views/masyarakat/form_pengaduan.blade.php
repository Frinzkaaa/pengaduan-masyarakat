@extends('layouts.masyarakat')

@section('content')
<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-2xl shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Tambah Pengaduan</h2>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan error --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Isi Pengaduan</label>
            <textarea name="isi_pengaduan" rows="4"
                      class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                      placeholder="Tuliskan isi pengaduan Anda di sini..." required></textarea>
        </div>
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Unggah Foto (opsional)</label>
            <div class="relative">
                <input type="file" name="foto" id="foto"
                       class="sr-only" accept="image/*">
                <label for="foto"
                       class="cursor-pointer bg-gray-200 text-gray-700 px-4 py-2 rounded-lg inline-block hover:bg-gray-300 transition">
                    Pilih File
                </label>
                <span id="file-name" class="ml-2 text-sm text-gray-600">Belum ada file dipilih</span>
            </div>
        </div>
        <button type="submit"
                class="bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg w-full hover:bg-blue-600 transition">
            Kirim Pengaduan
        </button>
    </form>
</div>

{{-- Script untuk menampilkan nama file --}}
<script>
    const inputFile = document.getElementById('foto');
    const fileName = document.getElementById('file-name');

    inputFile.addEventListener('change', function() {
        fileName.textContent = this.files.length > 0 ? this.files[0].name : 'Belum ada file dipilih';
    });
</script>
@endsection
