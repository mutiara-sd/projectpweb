<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'makanan', 'alamat', 'jumlah', 'keterangan',
    ];

    public function pengguna()
    {
        return $this->belongsTo(User::class); // relasi ke user, pastikan sesuai kebutuhanmu
    }
}
