@extends('layouts.app')

@section('title', 'Detail Gaji')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Gaji - {{ $salary->created_at ? $salary->created_at->format('F Y') : 'Tidak Ada Tanggal' }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Pendapatan -->
                        <div class="col-md-6">
                            <h4 class="mb-3">Pendapatan</h4>
                            <table class="table table-bordered table-dark">
                                <tr>
                                    <th>Gaji Pokok</th>
                                    <td class="text-end">Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Tunjangan Istri/Suami</th>
                                    <td class="text-end">Rp {{ number_format($salary->tunjangan_istri, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Tunjangan Anak</th>
                                    <td class="text-end">Rp {{ number_format($salary->tunjangan_anak, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Tunjangan Jabatan</th>
                                    <td class="text-end">Rp {{ number_format($salary->tunjangan_jabatan, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Tunjangan Operasional</th>
                                    <td class="text-end">Rp {{ number_format($salary->tunjangan_operasional, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Tunjangan Beras</th>
                                    <td class="text-end">Rp {{ number_format($salary->tunjangan_beras, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Tunjangan Khusus</th>
                                    <td class="text-end">Rp {{ number_format($salary->tunjangan_khusus, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Tunjangan Kinerja</th>
                                    <td class="text-end">Rp {{ number_format($salary->tunjangan_kinerja, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Uang Lauk Pauk (ULP)</th>
                                    <td class="text-end">Rp {{ number_format($salary->ulp, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="table-primary">
                                    <th>Total Pendapatan</th>
                                    <td class="text-end">Rp {{ number_format($salary->total_pendapatan, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Potongan -->
                        <div class="col-md-6">
                            <h4 class="mb-3">Potongan</h4>
                            <table class="table table-bordered table-dark">
                                <tr>
                                    <th>Iuran Wajib</th>
                                    <td class="text-end">Rp {{ number_format($salary->iuran_wajib, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>PPh 21</th>
                                    <td class="text-end">Rp {{ number_format($salary->pph21, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Potongan Koperasi</th>
                                    <td class="text-end">Rp {{ number_format($salary->potongan_koperasi, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Potongan Pinjaman</th>
                                    <td class="text-end">Rp {{ number_format($salary->potongan_pinjaman, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Potongan Tabungan</th>
                                    <td class="text-end">Rp {{ number_format($salary->potongan_tabungan, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="table-danger">
                                    <th>Total Potongan</th>
                                    <td class="text-end">Rp {{ number_format($salary->total_potongan, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h4 class="card-title">Gaji Bersih</h4>
                                    <h2 class="card-text">Rp {{ number_format($salary->gaji_bersih, 0, ',', '.') }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('anggota.dashboard') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 