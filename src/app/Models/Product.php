<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
      use HasFactory;

    protected $fillable = [
        'nama_kelas',
        'sesi',
        'hari',
        'kuota_peserta',
        'harga',
        'nama_instruktur',
    ];

    public function pesertas()
    {
        return $this->hasMany(Peserta::class, 'kelas_id');
    }



    public function pelatihs()
    {
        return $this->hasMany(Pelatih::class, 'kelas_id');
    }


    

}

