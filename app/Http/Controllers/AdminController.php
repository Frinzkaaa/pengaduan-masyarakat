<?php
namespace App\Http\Controllers;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Pastikan user sudah login guard admin
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('login');
        }
        return view('admin.dashboard');
    }
}