@extends('layouts.app')

@section('title', 'Siswa Dashboard')

@section('content')
<div class="container py-4">
    <!-- User Info Button -->
    <div class="text-end mb-4">
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#userInfoModal">
            <i class="fas fa-user"></i> Informasi Pengguna
        </button>
    </div>

    <!-- Available Classes -->
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Kelas yang Tersedia</h4>
            @if($availableClasses->isNotEmpty())
                @foreach($availableClasses as $class)
                    <div class="class-section mb-4">
                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <h5 class="card-title">{{ $class->title }} ({{ $class->subject }})</h5>
                                <p>{{ $class->description }}</p>
                                <p><strong>Waktu:</strong> {{ $class->start_time->format('d/m/Y H:i') }} - {{ $class->end_time->format('d/m/Y H:i') }}</p>
                                <p><strong>Pelatih:</strong> {{ $class->pelatih->nama }}</p>
                                <form action="{{ route('siswa.classes.join', $class->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Bergabung</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info">
                    Tidak ada kelas yang tersedia
                </div>
            @endif
        </div>
    </div>

    <!-- Joined Classes -->
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Kelas yang Diikuti</h4>
            @if($joinedClasses->isNotEmpty())
                @foreach($joinedClasses as $class)
                    <div class="class-section mb-4">
                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <h5 class="card-title">{{ $class->title }} ({{ $class->subject }})</h5>
                                <p>{{ $class->description }}</p>
                                <p><strong>Waktu:</strong> {{ $class->start_time->format('d/m/Y H:i') }} - {{ $class->end_time->format('d/m/Y H:i') }}</p>
                                <p><strong>Pelatih:</strong> {{ $class->pelatih->nama }}</p>
                                <p><strong>Nilai:</strong> 
                                    @if($class->pivot->score)
                                        {{ $class->pivot->score }}
                                    @else
                                        Belum dinilai
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info">
                    Anda belum mengikuti kelas apapun
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
                                <p><strong>Pelatih:</strong> {{ $class->pelatih->nama }}</p>
                                <p><strong>Nilai:</strong> 
                                    @if($class->pivot->score)
                                        {{ $class->pivot->score }}
                                    @else
                                        Belum dinilai
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $pastClasses->links() }}
                </div>
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
                    <p><strong>NRP:</strong> {{ auth()->user()->nrp }}</p>
                    <p><strong>Role:</strong> {{ ucfirst(auth()->user()->role) }}</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

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

/* Pagination Styling */
.pagination {
    margin-bottom: 0;
}

.pagination .page-item .page-link {
    background-color: #1e1e1e;
    border-color: #3d3d3d;
    color: white;
}

.pagination .page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.pagination .page-item.disabled .page-link {
    background-color: #1e1e1e;
    border-color: #3d3d3d;
    color: #6c757d;
}

.pagination .page-item .page-link:hover {
    background-color: #2c2c2c;
    border-color: #3d3d3d;
    color: white;
}
</style>
@endsection