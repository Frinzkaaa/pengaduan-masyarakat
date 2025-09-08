<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    public function form()
    {
        return view('pengaduan.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'isi_laporan' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_pengaduan', 'public');
        }

        Pengaduan::create([
            'tgl_pengaduan' => now(),
            'nik' => session('user')->nik,
            'isi_laporan' => $request->isi_laporan,
            'foto' => $fotoPath,
            'status' => '0'
        ]);

        return back()->with('success', 'Pengaduan berhasil dikirim!');
    }
}
