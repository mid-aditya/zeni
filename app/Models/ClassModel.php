<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';

    const SUBJECTS = [
        'Materi Konstruksi',
        'Materi Rintangan',
        'Materi PBB Militer',
        'Materi Jihandak',
        'Materi Menembak'
    ];

    protected $fillable = [
        'subject',
        'title',
        'description',
        'pelatih_id',
        'start_time',
        'end_time',
        'is_active'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_active' => 'boolean'
    ];

    public function pelatih()
    {
        return $this->belongsTo(User::class, 'pelatih_id');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'class_participants', 'class_id', 'siswa_id')
            ->withPivot('score')
            ->withTimestamps();
    }

    public function isActive()
    {
        return $this->is_active && $this->end_time->isFuture();
    }
} 