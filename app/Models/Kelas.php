<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelatih_id',
        'nama_kelas',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'kapasitas',
        'status'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function pelatih()
    {
        return $this->belongsTo(User::class, 'pelatih_id');
    }

    public function peserta()
    {
        return $this->belongsToMany(User::class, 'kelas_peserta', 'kelas_id', 'user_id')
            ->withTimestamps();
    }
} 