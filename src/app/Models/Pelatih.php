<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatih extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelatih',
        'email',
        'no_hp',
    ];

    public function kelas()
    {
        return $this->hasMany(Product::class, 'pelatih_id');
    }

    public function semuaPeserta()
    {
        return $this->hasManyThrough(Peserta::class, Product::class, 'pelatih_id', 'kelas_id');
    }



    

}
