@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="welcome-text text-center">
    Selamat Datang, {{ auth()->user()->nama }}
</div>

<!-- Alert container for all actions -->
<div id="alertContainer">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

<div class="row">
    <div class="col-md-12">
        <!-- <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Permintaan Akun Baru</h5>
            </div>
            <div class="card-body">
                @if($pendingUsers->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th>NRP</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingUsers as $user)
                                    <tr>
                                        <td>{{ $user->nrp }}</td>
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->tanggal_lahir->format('d F Y') }}</td>
                                        <td>{{ ucfirst($user->role) }}</td>
                                        <td>
                                            <span class="badge bg-warning">{{ ucfirst($user->status) }}</span>
                                        </td>
                                        <td>
                                            @if($user->role !== 'admin' && $user->status === 'pending')
                                                <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="d-inline form-with-alert" data-success-message="Akun berhasil disetujui">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin menyetujui akun ini?')">Setujui</button>
                                                </form>
                                                <form action="{{ route('admin.users.reject', $user->id) }}" method="POST" class="d-inline form-with-alert" data-success-message="Akun berhasil ditolak">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menolak akun ini?')">Tolak</button>
                                                </form>
                                            @else
                                                <span class="badge bg-info">{{ $user->role === 'admin' ? 'Akun Admin' : 'Tidak Dapat Diubah' }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center mb-0">Tidak ada permintaan akun baru</p>
                @endif
            </div>
        </div> -->
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card dashboard-card mb-4">
            <div class="card-body">
                <h5 class="card-title">Kelola Pengguna</h5>
                <p class="card-text">Kelola pengguna dan peran mereka</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#manageUsersModal">
                    Kelola Pengguna
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card dashboard-card mb-4">
            <div class="card-body">
                <h5 class="card-title">Tambah Pengguna</h5>
                <p class="card-text">Tambah pengguna baru ke sistem</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    Tambah Pengguna
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card dashboard-card mb-4">
            <div class="card-body">
                <h5 class="card-title">Kelola Gaji</h5>
                <p class="card-text">Kelola gaji anggota dan lakukan pembayaran</p>
                <a href="{{ route('admin.salaries.index') }}" class="btn btn-primary">
                    Kelola Gaji
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Manage Users Modal -->
<div class="modal fade" id="manageUsersModal" tabindex="-1" aria-labelledby="manageUsersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title" id="manageUsersModalLabel">Kelola Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>NRP</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($approvedUsers as $user)
                                <tr>
                                    <td>{{ $user->nrp }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                            Edit
                                        </button>
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline form-with-alert" data-success-message="Pengguna berhasil dihapus">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</button>
                                            </form>
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
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Tambah Pengguna Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.users.store') }}" method="POST" id="addUserForm" class="form-with-alert" data-success-message="Pengguna berhasil ditambahkan">
                    @csrf
                    <div class="mb-3">
                        <label for="nrp" class="form-label">NRP</label>
                        <input type="text" class="form-control" id="nrp" name="nrp" required maxlength="8" pattern="[0-9]{8}">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required minlength="8">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="pelatih">Pelatih</option>
                            <option value="siswa">Siswa</option>
                            <option value="anggota">Anggota</option>
                        </select>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modals -->
@foreach($approvedUsers as $user)
<div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="form-with-alert" data-success-message="Pengguna berhasil diperbarui">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="role{{ $user->id }}" class="form-label">Role</label>
                        <select class="form-select" id="role{{ $user->id }}" name="role" required>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="pelatih" {{ $user->role === 'pelatih' ? 'selected' : '' }}>Pelatih</option>
                            <option value="anggota" {{ $user->role === 'anggota' ? 'selected' : '' }}>Anggota</option>
                        </select>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle the form submissions with AJAX
    const forms = document.querySelectorAll('.form-with-alert');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const successMessage = this.getAttribute('data-success-message');
            const formData = new FormData(this);
            const url = this.getAttribute('action');
            const method = formData.get('_method') || this.getAttribute('method');
            
            // Store reference to the modal if this form is inside one
            const modal = this.closest('.modal');
            
            fetch(url, {
                method: method.toUpperCase(),
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
                credentials: 'same-origin',
            })
            .then(response => response.json())
            .then(data => {
                // Close modal if the form was in one
                if (modal) {
                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                }
                
                // Show alert
                showAlert(successMessage || data.message || 'Operasi berhasil', 'success');
                
                // Reload page after a short delay to refresh data
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Terjadi kesalahan. Silakan coba lagi.', 'danger');
            });
            
            e.preventDefault();
        });
    });
    
    // Function to show alert
    function showAlert(message, type = 'success') {
        const alertContainer = document.getElementById('alertContainer');
        
        const alertHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        
        alertContainer.innerHTML = alertHTML;
        
        // Auto-dismiss after 5 seconds
        setTimeout(() => {
            const alertElement = alertContainer.querySelector('.alert');
            if (alertElement) {
                const bsAlert = new bootstrap.Alert(alertElement);
                bsAlert.close();
            }
        }, 5000);
    }
});
</script>
@endsection