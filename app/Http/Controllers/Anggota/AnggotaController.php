<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Salaries;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $salaries = Salaries::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung total gaji
        $totalGaji = $salaries->sum('gaji_bersih');
        $totalPendapatan = $salaries->sum('total_pendapatan');
        $totalPotongan = $salaries->sum('total_potongan');

        return view('anggota.dashboard', compact('salaries', 'totalGaji', 'totalPendapatan', 'totalPotongan'));
    }

    public function showSalary(Salaries $salary)
    {
        // Pastikan salary milik user yang sedang login
        if ($salary->user_id !== auth()->id()) {
            abort(403);
        }

        return view('anggota.salary-detail', compact('salary'));
    }
} 