<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nrp' => 'required|string|size:8|unique:users',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:siswa,anggota', // Validasi role
        ]);

        User::create([
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Menggunakan role dari input form
            'status' => 'approved', // Set status langsung approved
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login dengan akun Anda.');
    }
} 