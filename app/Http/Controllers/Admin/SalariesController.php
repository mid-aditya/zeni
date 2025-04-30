<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Salaries;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalariesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Get users without ordering by name since the column doesn't exist
$users = User::where('role', 'anggota')->get();

        $salaries = Salaries::with('user')->latest()->get();

        return view('admin.salaries.index', compact('salaries', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan_istri' => 'required|numeric|min:0',
            'tunjangan_anak' => 'required|numeric|min:0',
            'tunjangan_jabatan' => 'required|numeric|min:0',
            'tunjangan_operasional' => 'required|numeric|min:0',
            'tunjangan_beras' => 'required|numeric|min:0',
            'tunjangan_khusus' => 'required|numeric|min:0',
            'tunjangan_kinerja' => 'required|numeric|min:0',
            'uang_lauk_pauk' => 'required|numeric|min:0',
            'iuran_wajib' => 'required|numeric|min:0',
            'pph_21' => 'required|numeric|min:0',
            'potongan_koperasi' => 'required|numeric|min:0',
            'potongan_pinjaman' => 'required|numeric|min:0',
            'potongan_tabungan' => 'required|numeric|min:0'
        ]);

        // Calculate totals
        $validated['total_pendapatan'] = 
            $validated['gaji_pokok'] + 
            $validated['tunjangan_istri'] + 
            $validated['tunjangan_anak'] + 
            $validated['tunjangan_jabatan'] + 
            $validated['tunjangan_operasional'] + 
            $validated['tunjangan_beras'] + 
            $validated['tunjangan_khusus'] + 
            $validated['tunjangan_kinerja'] + 
            $validated['uang_lauk_pauk'];

        $validated['total_potongan'] = 
            $validated['iuran_wajib'] + 
            $validated['pph_21'] + 
            $validated['potongan_koperasi'] + 
            $validated['potongan_pinjaman'] + 
            $validated['potongan_tabungan'];

        $validated['gaji_bersih'] = $validated['total_pendapatan'] - $validated['total_potongan'];

        // Add required fields
        $validated['periode'] = date('Y-m'); // Current month and year
        $validated['created_by'] = auth()->id();
        
        // Rename fields to match database
        $validated['ulp'] = $validated['uang_lauk_pauk'];
        $validated['pph21'] = $validated['pph_21'];
        unset($validated['uang_lauk_pauk']);
        unset($validated['pph_21']);

        Salaries::create($validated);

        return redirect()->route('admin.salaries.index')
            ->with('success', 'Data gaji berhasil ditambahkan');
    }

    public function show(Salaries $salary)
    {
        return view('admin.salaries.show', compact('salary'));
    }

    public function edit(Salaries $salary)
    {
        $users = User::where('role', 'anggota')->get();
        return view('admin.salaries.edit', compact('salary', 'users'));
    }

    public function update(Request $request, Salaries $salary)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan_istri' => 'required|numeric|min:0',
            'tunjangan_anak' => 'required|numeric|min:0',
            'tunjangan_jabatan' => 'required|numeric|min:0',
            'tunjangan_operasional' => 'required|numeric|min:0',
            'tunjangan_beras' => 'required|numeric|min:0',
            'tunjangan_khusus' => 'required|numeric|min:0',
            'tunjangan_kinerja' => 'required|numeric|min:0',
            'uang_lauk_pauk' => 'required|numeric|min:0',
            'iuran_wajib' => 'required|numeric|min:0',
            'pph_21' => 'required|numeric|min:0',
            'potongan_koperasi' => 'required|numeric|min:0',
            'potongan_pinjaman' => 'required|numeric|min:0',
            'potongan_tabungan' => 'required|numeric|min:0'
        ]);

        // Calculate totals
        $validated['total_pendapatan'] =
            $validated['gaji_pokok'] +
            $validated['tunjangan_istri'] +
            $validated['tunjangan_anak'] +
            $validated['tunjangan_jabatan'] +
            $validated['tunjangan_operasional'] +
            $validated['tunjangan_beras'] +
            $validated['tunjangan_khusus'] +
            $validated['tunjangan_kinerja'] +
            $validated['uang_lauk_pauk'];

        $validated['total_potongan'] =
            $validated['iuran_wajib'] +
            $validated['pph_21'] +
            $validated['potongan_koperasi'] +
            $validated['potongan_pinjaman'] +
            $validated['potongan_tabungan'];

        $validated['gaji_bersih'] = $validated['total_pendapatan'] - $validated['total_potongan'];

        // Rename fields to match database
        $validated['ulp'] = $validated['uang_lauk_pauk'];
        $validated['pph21'] = $validated['pph_21'];
        unset($validated['uang_lauk_pauk']);
        unset($validated['pph_21']);

        $salary->update($validated);

        return redirect()->route('admin.salaries.index')
            ->with('success', 'Data gaji berhasil diperbarui');
    }

    public function destroy(Salaries $salary)
    {
        $salary->delete();
        return redirect()->route('admin.salaries.index')
            ->with('success', 'Data gaji berhasil dihapus');
    }
}