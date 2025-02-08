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
        Schema::create('pajak_penghasilan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id');
            $table->year('tahun');  // Menyimpan tahun
            $table->string('bulan');  // Menggunakan string untuk bulan (contoh: "January", "February")
            $table->decimal('jumlah_pajak', 10, 2);
            $table->enum('status_pembayaran', ['belum_bayar', 'sudah_bayar']);
            $table->timestamps();

            $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pajak_penghasilan');
    }
};
