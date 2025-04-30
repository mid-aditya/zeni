@extends('layouts.app')

@section('title', 'Pelatih Dashboard')

@section('content')
<div class="container py-4">
    <!-- User Info Button -->
    <div class="text-end mb-4">
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#userInfoModal">
            <i class="fas fa-user"></i> Informasi Pengguna
        </button>
    </div>

    <!-- Create New Class -->
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Buat Kelas Baru</h4>
            <form action="{{ route('pelatih.classes.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="subject" class="form-label">Materi</label>
                    <select class="form-select" id="subject" name="subject" required>
                        <option value="">Pilih Materi</option>
                        @foreach(App\Models\ClassModel::SUBJECTS as $subject)
                            <option value="{{ $subject }}">{{ $subject }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Kelas</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Buat Kelas</button>
            </form>
        </div>
    </div>

    <!-- Active Classes -->
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Kelas Aktif</h4>
            @if($activeClasses->isNotEmpty())
                @foreach($activeClasses as $class)
                    <div class="class-section mb-4">
                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <h5 class="card-title">{{ $class->title }} ({{ $class->subject }})</h5>
                                <p>{{ $class->description }}</p>
                                <p><strong>Waktu:</strong> {{ $class->start_time->format('d/m/Y H:i') }} - {{ $class->end_time->format('d/m/Y H:i') }}</p>
                                
                                <h6 class="mt-3">Daftar Siswa yang Bergabung</h6>
                                <div class="table-responsive">
                                    <table class="table table-dark table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nama Siswa</th>
                                                <th>NRP</th>
                                                <th>Status</th>
                                                <th>Nilai</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($class->participants as $siswa)
                                                <tr>
                                                    <td>{{ $siswa->nama }}</td>
                                                    <td>{{ $siswa->nrp }}</td>
                                                    <td>
                                                        @if($siswa->pivot->score)
                                                            <span class="badge bg-success">Sudah Dinilai</span>
                                                        @else
                                                            <span class="badge bg-warning">Belum Dinilai</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($siswa->pivot->score)
                                                            {{ $siswa->pivot->score }}
                                                        @else
                                                            - 
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(!$siswa->pivot->score)
                                                            <button type="button" class="btn btn-primary btn-sm" 
                                                                    onclick="showScoreModal('{{ $class->id }}', '{{ $siswa->id }}', '{{ $siswa->nama }}')">
                                                                Beri Nilai
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    <form action="{{ route('pelatih.classes.destroy', $class->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Tutup Kelas</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info">
                    Tidak ada kelas aktif
                </div>
            @endif
        </div>
    </div>

    <!-- Past Classes -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Kelas Selesai</h4>
            @if($pastClasses->isNotEmpty())
                @foreach($pastClasses as $class)
                    <div class="class-section mb-4">
                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <h5 class="card-title">{{ $class->title }} ({{ $class->subject }})</h5>
                                <p>{{ $class->description }}</p>
                                <p><strong>Waktu:</strong> {{ $class->start_time->format('d/m/Y H:i') }} - {{ $class->end_time->format('d/m/Y H:i') }}</p>
                                
                                <h6 class="mt-3">Daftar Siswa</h6>
                                <div class="table-responsive">
                                    <table class="table table-dark table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nama Siswa</th>
                                                <th>NRP</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($class->participants as $siswa)
                                                <tr>
                                                    <td>{{ $siswa->nama }}</td>
                                                    <td>{{ $siswa->nrp }}</td>
                                                    <td>
                                                        @if($siswa->pivot->score)
                                                            {{ $siswa->pivot->score }}
                                                        @else
                                                            - 
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info">
                    Tidak ada kelas selesai
                </div>
            @endif
        </div>
    </div>
</div>

<!-- User Info Modal -->
<div class="modal fade" id="userInfoModal" tabindex="-1" aria-labelledby="userInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="userInfoModalLabel">Informasi Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="user-info">
                    <p><strong>Nama:</strong> {{ auth()->user()->nama }}</p>
                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                    <p><strong>Role:</strong> {{ ucfirst(auth()->user()->role) }}</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Score Modal -->
<div class="modal fade" id="scoreModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title">Beri Nilai - <span id="siswaNama"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="scoreForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="score" class="form-label">Nilai (0-100)</label>
                        <input type="number" class="form-control" id="score" name="score" 
                               min="0" max="100" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function showScoreModal(classId, siswaId, siswaNama) {
    const modal = new bootstrap.Modal(document.getElementById('scoreModal'));
    document.getElementById('siswaNama').textContent = siswaNama;
    document.getElementById('scoreForm').action = `/pelatih/beri-nilai/${classId}/${siswaId}`;
    modal.show();
}

// Fix modal backdrop issue
document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('hidden.bs.modal', function () {
        document.body.classList.remove('modal-open');
        const backdrop = document.querySelector('.modal-backdrop');
        if (backdrop) {
            backdrop.remove();
        }
    });
});
</script>
@endpush
@endsection

<style>
.table-dark {
    background-color: #1e1e1e !important;
    color: white !important;
}

.table-dark thead th {
    background-color: #2c2c2c !important;
    border-color: #3d3d3d !important;
}

.table-dark tbody td {
    border-color: #3d3d3d !important;
}

.table-dark tbody tr:hover {
    background-color: #2c2c2c !important;
}

.card.bg-dark {
    background-color: #1e1e1e !important;
    border: 1px solid #3d3d3d;
}
</style>
