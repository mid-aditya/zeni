<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salaries extends Model
{
    use HasFactory;

    protected $table = 'salaries';

    protected $fillable = [
        'user_id', 'periode', 'created_by',
        'gaji_pokok', 'tunjangan_istri', 'tunjangan_anak',
        'tunjangan_jabatan', 'tunjangan_operasional',
        'tunjangan_beras', 'tunjangan_khusus', 'tunjangan_kinerja',
        'ulp',
        'iuran_wajib', 'pph21', 'potongan_koperasi', 'potongan_pinjaman',
        'potongan_tabungan',
        'total_pendapatan', 'total_potongan', 'gaji_bersih'
    ];

    protected $casts = [
        'gaji_pokok' => 'integer',
        'tunjangan_istri' => 'integer',
        'tunjangan_anak' => 'integer',
        'tunjangan_jabatan' => 'integer',
        'tunjangan_operasional' => 'integer',
        'tunjangan_beras' => 'integer',
        'tunjangan_khusus' => 'integer',
        'tunjangan_kinerja' => 'integer',
        'ulp' => 'integer',
        'iuran_wajib' => 'integer',
        'pph21' => 'integer',
        'potongan_koperasi' => 'integer',
        'potongan_pinjaman' => 'integer',
        'potongan_tabungan' => 'integer',
        'total_pendapatan' => 'integer',
        'total_potongan' => 'integer',
        'gaji_bersih' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scope untuk mengambil data berdasarkan periode terbaru
    public function scopePeriodeTerbaru($query)
    {
        return $query->orderBy('periode', 'desc');
    }
}