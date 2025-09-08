<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('masyarakat.auth.login');
    }

    public function showAdminLoginForm()
    {
        return view('admin.auth.login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

    $admin = DB::table('admins')
            ->where('username', $request->username)
            ->first();

        if (!$admin) {
            return back()->with('error', 'Username tidak ditemukan.');
        }

        if ($request->password !== $admin->password) {
            return back()->with('error', 'Password salah.');
        }

    Auth::guard('admin')->loginUsingId($admin->id);
        return redirect()->route('admin.dashboard');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = DB::table('masyarakats')
            ->where('username', $request->username)
            ->first();

        if (!$user) {
            return back()->with('error', 'Username tidak ditemukan.');
        }

        // Cek password tanpa hash
        if ($request->password !== $user->password) {
            return back()->with('error', 'Password salah.');
        }

        // Login dengan guard masyarakat
        Auth::guard('masyarakat')->loginUsingId($user->nik);
        return redirect()->route('masyarakat.dashboard');
    }

    public function showRegisterForm()
    {
        return view('masyarakat.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:masyarakats,nik',
            'nama' => 'required',
            'username' => 'required|unique:masyarakats,username',
            'password' => 'required|min:4',
            'telp' => 'required'
        ]);

        DB::table('masyarakats')->insert([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password,
            'telp' => $request->telp
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil, silakan login.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
