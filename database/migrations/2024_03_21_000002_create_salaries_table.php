<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Tunjangan
            $table->decimal('tunjangan_istri_suami', 12, 2)->default(0);
            $table->decimal('tunjangan_anak', 12, 2)->default(0);
            $table->decimal('tunjangan_jabatan', 12, 2)->default(0);
            $table->decimal('tunjangan_operasional', 12, 2)->default(0);
            $table->decimal('tunjangan_beras', 12, 2)->default(0);
            $table->decimal('tunjangan_khusus', 12, 2)->default(0);
            $table->decimal('tunjangan_kinerja', 12, 2)->default(0);
            $table->decimal('uang_lauk_pauk', 12, 2)->default(0);
            
            // Potongan
            $table->decimal('potongan_iuran_wajib', 12, 2)->default(0);
            $table->decimal('potongan_pph21', 12, 2)->default(0);
            $table->decimal('potongan_koperasi', 12, 2)->default(0);
            $table->decimal('potongan_pinjaman', 12, 2)->default(0);
            $table->decimal('potongan_tabungan', 12, 2)->default(0);
            
            // Total
            $table->decimal('total_tunjangan', 12, 2)->default(0);
            $table->decimal('total_potongan', 12, 2)->default(0);
            $table->decimal('gaji_bersih', 12, 2)->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
}; 