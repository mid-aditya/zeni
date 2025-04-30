@extends('layouts.app')

@section('title', 'Dashboard Anggota')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Ringkasan Gaji -->
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ringkasan Gaji</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Gaji Bersih</h5>
                                    <h3 class="card-text">Rp {{ number_format($totalGaji, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Pendapatan</h5>
                                    <h3 class="card-text">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Potongan</h5>
                                    <h3 class="card-text">Rp {{ number_format($totalPotongan, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Gaji -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Gaji</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-dark">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Gaji Pokok</th>
                                    <th>Total Pendapatan</th>
                                    <th>Total Potongan</th>
                                    <th>Gaji Bersih</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($salaries as $salary)
                                    <tr>
                                        <td>{{ $salary->created_at ? $salary->created_at->format('d M Y') : '-' }}</td>
                                        <td>Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($salary->total_pendapatan, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($salary->total_potongan, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($salary->gaji_bersih, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('anggota.salary.show', $salary) }}" class="btn btn-info btn-sm">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada data gaji</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
