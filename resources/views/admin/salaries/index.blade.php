@extends('layouts.app')

@section('title', 'Daftar Gaji')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title m-0">Daftar Gaji</h3>
                    <div>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSalaryModal">
                            <i class="fas fa-plus"></i> Tambah Gaji
                        </button>
                    </div>
                </div>
                
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Enhanced Debug Info -->
                    @if(isset($debugInfo))
                    <div class="alert alert-info mb-3">
                        <strong>Debug Info:</strong>
                        <ul>
                            <li>Total users found: {{ $debugInfo['totalUsers'] }}</li>
                            <li>User names: {{ implode(', ', $debugInfo['userNames']) }}</li>
                            <li>User roles: {{ implode(', ', $debugInfo['userRoles']) }}</li>
                            <li>All roles in system: {{ implode(', ', $debugInfo['allRoles']) }}</li>
                        </ul>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-dark">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NRP</th>
                                    <th>Total Pendapatan</th>
                                    <th>Total Potongan</th>
                                    <th>Gaji Bersih</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($salaries as $salary)
                                    <tr>
                                        <td>{{ $salary->user->nama }}</td>
                                        <td>{{ $salary->user->nrp }}</td>
                                        <td>Rp {{ number_format($salary->total_pendapatan, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($salary->total_potongan, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($salary->gaji_bersih, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <button type="button" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#showSalaryModal{{ $salary->id }}">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </button>
                                                <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#editSalaryModal{{ $salary->id }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <form action="{{ route('admin.salaries.destroy', $salary->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data gaji</td>
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

<!-- Modal Show -->
@foreach($salaries as $salary)
<div class="modal fade" id="showSalaryModal{{ $salary->id }}" tabindex="-1" aria-labelledby="showSalaryModalLabel{{ $salary->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: #1e1e1e;">
            <div class="modal-header">
                <h5 class="modal-title" id="showSalaryModalLabel{{ $salary->id }}">Detail Gaji</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informasi Karyawan</h6>
                        <p><strong>Nama:</strong> {{ $salary->user->nama }}</p>
                        <p><strong>NRP:</strong> {{ $salary->user->nrp }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Periode</h6>
                        <p><strong>Bulan/Tahun:</strong> {{ $salary->periode }}</p>
                    </div>
                </div>
                
                <hr>
                
                <h6>Pendapatan</h6>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Gaji Pokok:</strong> Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</p>
                        <p><strong>Tunjangan Istri:</strong> Rp {{ number_format($salary->tunjangan_istri, 0, ',', '.') }}</p>
                        <p><strong>Tunjangan Anak:</strong> Rp {{ number_format($salary->tunjangan_anak, 0, ',', '.') }}</p>
                        <p><strong>Tunjangan Jabatan:</strong> Rp {{ number_format($salary->tunjangan_jabatan, 0, ',', '.') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Tunjangan Operasional:</strong> Rp {{ number_format($salary->tunjangan_operasional, 0, ',', '.') }}</p>
                        <p><strong>Tunjangan Beras:</strong> Rp {{ number_format($salary->tunjangan_beras, 0, ',', '.') }}</p>
                        <p><strong>Tunjangan Khusus:</strong> Rp {{ number_format($salary->tunjangan_khusus, 0, ',', '.') }}</p>
                        <p><strong>Tunjangan Kinerja:</strong> Rp {{ number_format($salary->tunjangan_kinerja, 0, ',', '.') }}</p>
                        <p><strong>Uang Lauk Pauk:</strong> Rp {{ number_format($salary->ulp, 0, ',', '.') }}</p>
                    </div>
                </div>
                
                <hr>
                
                <h6>Potongan</h6>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Iuran Wajib:</strong> Rp {{ number_format($salary->iuran_wajib, 0, ',', '.') }}</p>
                        <p><strong>PPh 21:</strong> Rp {{ number_format($salary->pph21, 0, ',', '.') }}</p>
                        <p><strong>Potongan Koperasi:</strong> Rp {{ number_format($salary->potongan_koperasi, 0, ',', '.') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Potongan Pinjaman:</strong> Rp {{ number_format($salary->potongan_pinjaman, 0, ',', '.') }}</p>
                        <p><strong>Potongan Tabungan:</strong> Rp {{ number_format($salary->potongan_tabungan, 0, ',', '.') }}</p>
                    </div>
                </div>
                
                <hr>
                
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Total Pendapatan:</strong></p>
                        <h5 class="text-success">Rp {{ number_format($salary->total_pendapatan, 0, ',', '.') }}</h5>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Total Potongan:</strong></p>
                        <h5 class="text-danger">Rp {{ number_format($salary->total_potongan, 0, ',', '.') }}</h5>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Gaji Bersih:</strong></p>
                        <h5 class="text-primary">Rp {{ number_format($salary->gaji_bersih, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Edit -->
@foreach($salaries as $salary)
<div class="modal fade" id="editSalaryModal{{ $salary->id }}" tabindex="-1" aria-labelledby="editSalaryModalLabel{{ $salary->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: #1e1e1e;">
            <div class="modal-header">
                <h5 class="modal-title" id="editSalaryModalLabel{{ $salary->id }}">Edit Data Gaji</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.salaries.update', $salary->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Nama Karyawan</label>
                        <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                            <option value="">Pilih Karyawan</option>
                            @if($users->count() > 0)
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $salary->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->nama }} (NRP: {{ $user->nrp }})
                                    </option>
                                @endforeach
                            @else
                                <option value="" disabled>Tidak ada karyawan tersedia</option>
                            @endif
                        </select>
                        @error('user_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <h5 class="mt-4">Pendapatan</h5>
                    
                    <!-- Gaji Pokok -->
                    <div class="mb-3">
                        <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control pendapatan-item" id="gaji_pokok" name="gaji_pokok" value="{{ $salary->gaji_pokok }}" required>
                        </div>
                    </div>
                    
                    <!-- Tunjangan Istri -->
                    <div class="mb-3">
                        <label for="tunjangan_istri" class="form-label">Tunjangan Istri</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control pendapatan-item" id="tunjangan_istri" name="tunjangan_istri" value="{{ $salary->tunjangan_istri }}" required>
                        </div>
                    </div>
                    
                    <!-- Tunjangan Anak -->
                    <div class="mb-3">
                        <label for="tunjangan_anak" class="form-label">Tunjangan Anak</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control pendapatan-item" id="tunjangan_anak" name="tunjangan_anak" value="{{ $salary->tunjangan_anak }}" required>
                        </div>
                    </div>
                    
                    <!-- Tunjangan Jabatan -->
                    <div class="mb-3">
                        <label for="tunjangan_jabatan" class="form-label">Tunjangan Jabatan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control pendapatan-item" id="tunjangan_jabatan" name="tunjangan_jabatan" value="{{ $salary->tunjangan_jabatan }}" required>
                        </div>
                    </div>
                    
                    <!-- Tunjangan Operasional -->
                    <div class="mb-3">
                        <label for="tunjangan_operasional" class="form-label">Tunjangan Operasional</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control pendapatan-item" id="tunjangan_operasional" name="tunjangan_operasional" value="{{ $salary->tunjangan_operasional }}" required>
                        </div>
                    </div>
                    
                    <!-- Tunjangan Beras -->
                    <div class="mb-3">
                        <label for="tunjangan_beras" class="form-label">Tunjangan Beras</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control pendapatan-item" id="tunjangan_beras" name="tunjangan_beras" value="{{ $salary->tunjangan_beras }}" required>
                        </div>
                    </div>
                    
                    <!-- Tunjangan Khusus -->
                    <div class="mb-3">
                        <label for="tunjangan_khusus" class="form-label">Tunjangan Khusus</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control pendapatan-item" id="tunjangan_khusus" name="tunjangan_khusus" value="{{ $salary->tunjangan_khusus }}" required>
                        </div>
                    </div>
                    
                    <!-- Tunjangan Kinerja -->
                    <div class="mb-3">
                        <label for="tunjangan_kinerja" class="form-label">Tunjangan Kinerja</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control pendapatan-item" id="tunjangan_kinerja" name="tunjangan_kinerja" value="{{ $salary->tunjangan_kinerja }}" required>
                        </div>
                    </div>
                    
                    <!-- Uang Lauk Pauk -->
                    <div class="mb-3">
                        <label for="uang_lauk_pauk" class="form-label">Uang Lauk Pauk</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control pendapatan-item" id="uang_lauk_pauk" name="uang_lauk_pauk" value="{{ $salary->ulp }}" required>
                        </div>
                    </div>
                    
                    <hr>
                    <h5 class="mt-4">Potongan</h5>
                    
                    <!-- Iuran Wajib -->
                    <div class="mb-3">
                        <label for="iuran_wajib" class="form-label">Iuran Wajib</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control potongan-item" id="iuran_wajib" name="iuran_wajib" value="{{ $salary->iuran_wajib }}" required>
                        </div>
                    </div>
                    
                    <!-- Potongan PPh 21 -->
                    <div class="mb-3">
                        <label for="pph_21" class="form-label">Potongan PPh 21</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control potongan-item" id="pph_21" name="pph_21" value="{{ $salary->pph21 }}" required>
                        </div>
                    </div>
                    
                    <!-- Potongan Koperasi -->
                    <div class="mb-3">
                        <label for="potongan_koperasi" class="form-label">Potongan Koperasi</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control potongan-item" id="potongan_koperasi" name="potongan_koperasi" value="{{ $salary->potongan_koperasi }}" required>
                        </div>
                    </div>
                    
                    <!-- Potongan Pinjaman -->
                    <div class="mb-3">
                        <label for="potongan_pinjaman" class="form-label">Potongan Pinjaman</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control potongan-item" id="potongan_pinjaman" name="potongan_pinjaman" value="{{ $salary->potongan_pinjaman }}" required>
                        </div>
                    </div>
                    
                    <!-- Potongan Tabungan -->
                    <div class="mb-3">
                        <label for="potongan_tabungan" class="form-label">Potongan Tabungan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control potongan-item" id="potongan_tabungan" name="potongan_tabungan" value="{{ $salary->potongan_tabungan }}" required>
                        </div>
                    </div>

                    <!-- Jumlah -->
                    <div class="card bg-dark mb-3">
                        <div class="card-header">
                            <h5 class="m-0">Ringkasan Gaji</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong>Total Pendapatan:</strong></p>
                                    <h5 class="text-success">Rp <span id="total-pendapatan">{{ number_format($salary->total_pendapatan, 0, ',', '.') }}</span></h5>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Total Potongan:</strong></p>
                                    <h5 class="text-danger">Rp <span id="total-potongan">{{ number_format($salary->total_potongan, 0, ',', '.') }}</span></h5>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Gaji Bersih:</strong></p>
                                    <h5 class="text-primary">Rp <span id="gaji-bersih">{{ number_format($salary->gaji_bersih, 0, ',', '.') }}</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Create Salary -->
<div class="modal fade" id="createSalaryModal" tabindex="-1" aria-labelledby="createSalaryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: #1e1e1e;">
            <div class="modal-header">
                <h5 class="modal-title" id="createSalaryModalLabel">Tambah Data Gaji</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.salaries.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Nama Karyawan</label>
                        <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                            <option value="">Pilih Karyawan</option>
                            @if($users->count() > 0)
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->nama }} (NRP: {{ $user->nrp }})
                                    </option>
                                @endforeach
                            @else
                                <option value="" disabled>Tidak ada karyawan tersedia</option>
                            @endif
                        </select>
                        @error('user_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <h5 class="mt-4">Pendapatan</h5>
                    
                    <!-- Gaji Pokok -->
                    <div class="mb-3">
                        <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control pendapatan-item" id="gaji_pokok" name="gaji_pokok" value="0" required>
                        </div>
                    </div>
                    
                    <!-- Tunjangan Istri -->
                    <div class="mb-3">
                        <label for="tunjangan_istri" class="form-label">Tunjangan Istri</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control pendapatan-item" id="tunjangan_istri" name="tunjangan_istri" value="0" required>
                        </div>
                    </div>
                    
                    <!-- Tunjangan Anak -->
                    <div class="mb-3">
                        <label for="tunjangan_anak" class="form-label">Tunjangan Anak</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control pendapatan-item" id="tunjangan_anak" name="tunjangan_anak" value="0" required>
                        </div>
                    </div>
                    
                    <!-- Tunjangan Jabatan -->
                    <div class="mb-3">
                        <label for="tunjangan_jabatan" class="form-label">Tunjangan Jabatan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control pendapatan-item" id="tunjangan_jabatan" name="tunjangan_jabatan" value="0" required>
                        </div>
                    </div>
                    
                    <!-- Tunjangan Operasional -->
                    <div class="mb-3">
                        <label for="tunjangan_operasional" class="form-label">Tunjangan Operasional</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control pendapatan-item" id="tunjangan_operasional" name="tunjangan_operasional" value="0" required>
                        </div>
                    </div>
                    
                    <!-- Tunjangan Beras -->
                    <div class="mb-3">
                        <label for="tunjangan_beras" class="form-label">Tunjangan Beras</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control pendapatan-item" id="tunjangan_beras" name="tunjangan_beras" value="0" required>
                        </div>
                    </div>
                    
                    <!-- Tunjangan Khusus -->
                    <div class="mb-3">
                        <label for="tunjangan_khusus" class="form-label">Tunjangan Khusus</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control pendapatan-item" id="tunjangan_khusus" name="tunjangan_khusus" value="0" required>
                        </div>
                    </div>
                    
                    <!-- Tunjangan Kinerja -->
                    <div class="mb-3">
                        <label for="tunjangan_kinerja" class="form-label">Tunjangan Kinerja</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control pendapatan-item" id="tunjangan_kinerja" name="tunjangan_kinerja" value="0" required>
                        </div>
                    </div>
                    
                    <!-- Uang Lauk Pauk -->
                    <div class="mb-3">
                        <label for="uang_lauk_pauk" class="form-label">Uang Lauk Pauk</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control pendapatan-item" id="uang_lauk_pauk" name="uang_lauk_pauk" value="0" required>
                        </div>
                    </div>
                    
                    <hr>
                    <h5 class="mt-4">Potongan</h5>
                    
                    <!-- Iuran Wajib -->
                    <div class="mb-3">
                        <label for="iuran_wajib" class="form-label">Iuran Wajib</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control potongan-item" id="iuran_wajib" name="iuran_wajib" value="0" required>
                        </div>
                    </div>
                    
                    <!-- Potongan PPh 21 -->
                    <div class="mb-3">
                        <label for="pph_21" class="form-label">Potongan PPh 21</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control potongan-item" id="pph_21" name="pph_21" value="0" required>
                        </div>
                    </div>
                    
                    <!-- Potongan Koperasi -->
                    <div class="mb-3">
                        <label for="potongan_koperasi" class="form-label">Potongan Koperasi</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control potongan-item" id="potongan_koperasi" name="potongan_koperasi" value="0" required>
                        </div>
                    </div>
                    
                    <!-- Potongan Pinjaman -->
                    <div class="mb-3">
                        <label for="potongan_pinjaman" class="form-label">Potongan Pinjaman</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control potongan-item" id="potongan_pinjaman" name="potongan_pinjaman" value="0" required>
                        </div>
                    </div>
                    
                    <!-- Potongan Tabungan -->
                    <div class="mb-3">
                        <label for="potongan_tabungan" class="form-label">Potongan Tabungan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control potongan-item" id="potongan_tabungan" name="potongan_tabungan" value="0" required>
                        </div>
                    </div>

                    <!-- Jumlah -->
                    <div class="card bg-dark mb-3">
                        <div class="card-header">
                            <h5 class="m-0">Ringkasan Gaji</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong>Total Pendapatan:</strong></p>
                                    <h5 class="text-success">Rp <span id="total-pendapatan">0</span></h5>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Total Potongan:</strong></p>
                                    <h5 class="text-danger">Rp <span id="total-potongan">0</span></h5>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Gaji Bersih:</strong></p>
                                    <h5 class="text-primary">Rp <span id="gaji-bersih">0</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk kalkulasi total -->
@section('scripts')
<script>
    $(document).ready(function() {
        // Update field calculation
        function updateCalculation() {
            // Get values from input fields
            const gajiPokok = parseInt($('#gaji_pokok').val()) || 0;
            const tunjanganIstri = parseInt($('#tunjangan_istri').val()) || 0;
            const tunjanganAnak = parseInt($('#tunjangan_anak').val()) || 0;
            const tunjanganJabatan = parseInt($('#tunjangan_jabatan').val()) || 0;
            const tunjanganOperasional = parseInt($('#tunjangan_operasional').val()) || 0;
            const tunjanganBeras = parseInt($('#tunjangan_beras').val()) || 0;
            const tunjanganKhusus = parseInt($('#tunjangan_khusus').val()) || 0;
            const tunjanganKinerja = parseInt($('#tunjangan_kinerja').val()) || 0;
            const uangLaukPauk = parseInt($('#uang_lauk_pauk').val()) || 0;
            
            // Calculate total pendapatan
            const totalPendapatan = gajiPokok + tunjanganIstri + tunjanganAnak + 
                tunjanganJabatan + tunjanganOperasional + tunjanganBeras + 
                tunjanganKhusus + tunjanganKinerja + uangLaukPauk;
            
            // Calculate deductions
            const iuranWajib = parseInt($('#iuran_wajib').val()) || 0;
            const pph21 = parseInt($('#pph_21').val()) || 0;
            const potonganKoperasi = parseInt($('#potongan_koperasi').val()) || 0;
            const potonganPinjaman = parseInt($('#potongan_pinjaman').val()) || 0;
            const potonganTabungan = parseInt($('#potongan_tabungan').val()) || 0;
            
            const totalPotongan = iuranWajib + pph21 + potonganKoperasi + 
                potonganPinjaman + potonganTabungan;
            
            // Calculate net salary
            const gajiBersih = totalPendapatan - totalPotongan;
            
            // Format numbers with dot as thousand separator
            function formatRupiah(angka) {
                return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
            
            // Update display
            $('#total-pendapatan').text(formatRupiah(totalPendapatan));
            $('#total-potongan').text(formatRupiah(totalPotongan));
            $('#gaji-bersih').text(formatRupiah(gajiBersih));
        }
        
        // Trigger calculation on any input change
        $('.pendapatan-item, .potongan-item').on('input', function() {
            updateCalculation();
        });
        
        // Initial calculation
        updateCalculation();
    });
</script>
@endsection

@endsection