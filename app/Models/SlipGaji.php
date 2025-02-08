<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlipGaji extends Model
{
    use HasFactory;

    protected $table = 'slip_gaji';
    protected $fillable = ['karyawan_id', 'gaji_bersih', 'pajak', 'potongan_bpjs', 'tanggal_gajian'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function potongan()
    {
        return $this->hasMany(Potongan::class);
    }
}
