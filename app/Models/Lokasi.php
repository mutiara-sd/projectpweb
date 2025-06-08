<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'lokasi_id';
    protected $fillable = ['nama_lokasi'];

    public function users()
    {
        return $this->hasMany(User::class, 'lokasi_id', 'lokasi_id');
    }
    
}
