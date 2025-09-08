@extends('layouts.masyarakat')

@section('content')
<div class="max-w-xl mx-auto mt-10 p-8 bg-white rounded-2xl shadow-lg">
	<h2 class="text-2xl font-bold mb-6 text-center text-purple-700">Register Masyarakat</h2>

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

	<form action="{{ route('register') }}" method="POST" class="space-y-4">
		@csrf
		<div>
			<label class="block mb-1 font-semibold text-gray-700">NIK</label>
			<input type="text" name="nik" value="{{ old('nik') }}" required maxlength="16"
				class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none" placeholder="Masukkan NIK">
		</div>
		<div>
			<label class="block mb-1 font-semibold text-gray-700">Nama</label>
			<input type="text" name="nama" value="{{ old('nama') }}" required
				class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none" placeholder="Masukkan Nama">
		</div>
		<div>
			<label class="block mb-1 font-semibold text-gray-700">Username</label>
			<input type="text" name="username" value="{{ old('username') }}" required
				class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none" placeholder="Masukkan Username">
		</div>
		<div>
			<label class="block mb-1 font-semibold text-gray-700">Password</label>
			<input type="password" name="password" required minlength="4"
				class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none" placeholder="Masukkan Password">
		</div>
		<div>
			<label class="block mb-1 font-semibold text-gray-700">Telp</label>
			<input type="text" name="telp" value="{{ old('telp') }}" required
				class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none" placeholder="Masukkan Nomor Telepon">
		</div>
		<button type="submit" class="bg-purple-500 text-white font-semibold px-6 py-2 rounded-full shadow hover:bg-purple-600 transition w-full">Daftar</button>
	</form>
</div>
@endsection
