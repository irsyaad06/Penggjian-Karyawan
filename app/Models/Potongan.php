<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potongan extends Model
{
    use HasFactory;

    protected $table = 'potongan';
    protected $fillable = ['slip_gaji_id', 'pajak', 'bpjs', 'potongan_lainnya'];

    public function slipGaji()
    {
        return $this->belongsTo(SlipGaji::class);
    }
}
