<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_makanan',
        'kategori',
        'deskripsi_makanan',
        'alamat',
        'jumlah',
        'kadaluwarsa',
        'halal',
        'gambar',
        'user_id' // opsional, jika kamu menghubungkan donasi ke pengguna tertentu
    ];

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function penerimas()
    {
        return $this->hasMany(Penerima::class);
    }
}
