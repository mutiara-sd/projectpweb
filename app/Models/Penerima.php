<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{
    use HasFactory;

    protected $fillable = [
        'donasi_id',
        'nama',
        'no_hp',
        'alamat',
        'tanggal_ambil',
        'jumlah_diambil',
    ];

    public function donasi()
    {
        return $this->belongsTo(Donasi::class);
    }
}
