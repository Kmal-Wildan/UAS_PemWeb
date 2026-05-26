<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Demo login untuk Progres I (ganti dengan Auth::attempt pada Progres II)
        $role = str_contains($request->email, 'admin') ? 'admin' : 'user';
        $name = $role === 'admin' ? 'Administrator' : 'User Biasa';

        session([
            'role' => $role,
            'user_name' => $name,
            'email' => $request->email,
        ]);

        return redirect()->route($role === 'admin' ? 'dashboard.admin' : 'dashboard.user')
            ->with('success', 'Login berhasil! Selamat datang, ' . $name);
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('login')->with('success', 'Anda telah keluar.');
    }
}
