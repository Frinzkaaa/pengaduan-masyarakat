<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pengaduan;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('login');
        }
        $pengaduans = Pengaduan::all();
        return view('admin.dashboard', compact('pengaduans'));
    }

    // Export PDF
    public function exportPdf()
    {
        $pengaduans = Pengaduan::all();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.pengaduan_pdf', compact('pengaduans'));
        return $pdf->download('data_pengaduan.pdf');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,proses,selesai'
        ]);
        // Debug: cek value status yang dikirim
        // 
        // Jika ingin melihat di log: \Log::info('Status:', [$request->status]);
        // Jika ingin tampilkan di view:
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = $request->status;
        $pengaduan->save();
        return back()->with('success', 'Status pengaduan berhasil diupdate ke: ' . $request->status);
    }


    public function laporan()
    {
        $pengaduans = Pengaduan::all();
        return view('admin.laporan', compact('pengaduans'));
    }

    public function detailPengaduan($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('admin.detail_pengaduan', compact('pengaduan'));
    }
}
