<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class MasyarakatController extends Controller
{
    public function dashboard(\Illuminate\Http\Request $request)
    {
        if (!Auth::guard('masyarakat')->check()) {
            return redirect()->route('login');
        }
        $query = \App\Models\Pengaduan::query();
        if ($request->filled('search')) {
            $query->where('isi_laporan', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $pengaduans = $query->orderBy('tgl_pengaduan', 'desc')->paginate(9);
        return view('masyarakat.dashboard', compact('pengaduans'));
    }

    public function detailPengaduan($id)
    {
        if (!Auth::guard('masyarakat')->check()) {
            return redirect()->route('login');
        }
        $pengaduan = \App\Models\Pengaduan::findOrFail($id);
        return view('masyarakat.detail_pengaduan', compact('pengaduan'));
    }

    public function showFormPengaduan()
    {
        if (!Auth::guard('masyarakat')->check()) {
            return redirect()->route('login');
        }
        return view('masyarakat.form_pengaduan');
    }

    public function storePengaduan(\Illuminate\Http\Request $request)
    {
        if (!Auth::guard('masyarakat')->check()) {
            return redirect()->route('login');
        }
        $request->validate([
            'isi_pengaduan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengaduan_foto', 'public');
        }

        \App\Models\Pengaduan::create([
            'tgl_pengaduan' => now(),
            'nik' => Auth::guard('masyarakat')->user()->nik,
            'isi_laporan' => $request->isi_pengaduan,
            'foto' => $fotoPath,
            'status' => 'proses',
        ]);

        return redirect()->route('masyarakat.dashboard')->with('success', 'Pengaduan berhasil dikirim!');
    }
    public function showRegisterForm()
    {
        return view('masyarakat.auth.register');
    }
}
