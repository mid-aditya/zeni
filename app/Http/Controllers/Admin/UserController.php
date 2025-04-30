<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('status', 'approved')->get();
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,pelatih,siswa,anggota',
        ]);

        $user->update([
            'role' => $request->role,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Role pengguna berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nrp' => 'required|string|size:8|unique:users',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|in:pelatih,siswa,anggota',
            'password' => 'required|string|min:8',
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'nrp' => $request->nrp,
                'nama' => $request->nama,
                'tanggal_lahir' => $request->tanggal_lahir,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'status' => 'approved',
            ]);

            DB::commit();

            return redirect()->route('admin.dashboard')
                ->with('success', 'Pengguna berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menambahkan pengguna.');
        }
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.dashboard')
            ->with('success', 'Pengguna berhasil dihapus.');
    }

    public function approve(User $user)
    {
        try {
            DB::beginTransaction();

            // Prevent approving admin accounts
            if ($user->role === 'admin') {
                return back()->with('error', 'Tidak dapat menyetujui akun admin.');
            }

            // Update user status
            $user->status = 'approved';
            $user->save();

            DB::commit();

            return redirect()->route('admin.dashboard')
                ->with('success', 'Akun berhasil disetujui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menyetujui akun.');
        }
    }

    public function reject(User $user)
    {
        try {
            DB::beginTransaction();

            // Prevent rejecting admin accounts
            if ($user->role === 'admin') {
                return back()->with('error', 'Tidak dapat menolak akun admin.');
            }

            // Update user status
            $user->status = 'rejected';
            $user->save();

            DB::commit();

            return redirect()->route('admin.dashboard')
                ->with('success', 'Akun berhasil ditolak.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menolak akun.');
        }
    }
}
