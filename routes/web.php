<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SalariesController;
use App\Http\Controllers\Anggota\AnggotaController;
use App\Http\Controllers\Pelatih\PelatihController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Dashboard Routes
Route::middleware(['auth'])->group(function () {
    // Admin Routes
    Route::middleware(['auth', \App\Http\Middleware\CheckRoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            if (auth()->user()->role !== 'admin') {
                return redirect()->route('login');
            }
            $pendingUsers = \App\Models\User::where('status', 'pending')->get();
            $approvedUsers = \App\Models\User::where('status', 'approved')->get();
            return view('admin.dashboard', compact('pendingUsers', 'approvedUsers'));
        })->name('dashboard');
        
        // Salaries Routes
        Route::resource('salaries', SalariesController::class);
        
        // Users Routes
        Route::resource('users', UserController::class);
        Route::put('users/{id}/approve', [UserController::class, 'approve'])->name('users.approve');
        Route::put('users/{id}/reject', [UserController::class, 'reject'])->name('users.reject');

    });

    // Pelatih Routes
    Route::middleware(['auth', \App\Http\Middleware\CheckRoleMiddleware::class . ':pelatih'])->prefix('pelatih')->name('pelatih.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Pelatih\PelatihController::class, 'dashboard'])->name('dashboard');
        Route::post('/set-materi', [App\Http\Controllers\Pelatih\PelatihController::class, 'setMateri'])->name('set-materi');
        Route::post('/beri-nilai/{class}/{siswa}', [App\Http\Controllers\Pelatih\PelatihController::class, 'beriNilai'])->name('beri-nilai');
        Route::get('/export-nilai', [App\Http\Controllers\Pelatih\PelatihController::class, 'exportNilai'])->name('export-nilai');
        
        // Kelas Routes
        Route::get('/classes', [App\Http\Controllers\Pelatih\PelatihController::class, 'classes'])->name('classes.index');
        Route::get('/classes/create', [App\Http\Controllers\Pelatih\PelatihController::class, 'createClass'])->name('classes.create');
        Route::post('/classes', [App\Http\Controllers\Pelatih\PelatihController::class, 'storeClass'])->name('classes.store');
        Route::get('/classes/{class}', [App\Http\Controllers\Pelatih\PelatihController::class, 'showClass'])->name('classes.show');
        Route::get('/classes/{class}/edit', [App\Http\Controllers\Pelatih\PelatihController::class, 'editClass'])->name('classes.edit');
        Route::put('/classes/{class}', [App\Http\Controllers\Pelatih\PelatihController::class, 'updateClass'])->name('classes.update');
        Route::delete('/classes/{class}', [App\Http\Controllers\Pelatih\PelatihController::class, 'destroyClass'])->name('classes.destroy');
        Route::post('/classes/{class}/add-participant', [App\Http\Controllers\Pelatih\PelatihController::class, 'addParticipant'])->name('classes.add-participant');
        Route::delete('/classes/{class}/remove-participant/{participant}', [App\Http\Controllers\Pelatih\PelatihController::class, 'removeParticipant'])->name('classes.remove-participant');
    });

    // Siswa Routes
    Route::middleware(['auth', \App\Http\Middleware\CheckRoleMiddleware::class . ':siswa'])->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Siswa\SiswaController::class, 'dashboard'])->name('dashboard');
        Route::get('/classes', [App\Http\Controllers\Siswa\SiswaController::class, 'classes'])->name('classes.index');
        Route::post('/classes/{class}/join', [App\Http\Controllers\Siswa\SiswaController::class, 'joinClass'])->name('classes.join');
        Route::get('/classes/{class}', [App\Http\Controllers\Siswa\SiswaController::class, 'showClass'])->name('classes.show');
        Route::get('/profile', [App\Http\Controllers\Siswa\SiswaController::class, 'profile'])->name('profile');
        Route::put('/profile', [App\Http\Controllers\Siswa\SiswaController::class, 'updateProfile'])->name('profile.update');
    });

    // Anggota Routes
    Route::prefix('anggota')->name('anggota.')->group(function () {
        Route::get('/dashboard', [AnggotaController::class, 'dashboard'])->name('dashboard');
        Route::get('/salary/{salary}', [AnggotaController::class, 'showSalary'])->name('salary.show');
    });
});
