<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_peserta',
        'kelas_id',
        'instruktur',
        'hari',
        'sesi',
        'payment',
    ];

    public function kelas()
    {
        return $this->belongsTo(Product::class, 'kelas_id');
    }

        public function product()
    {
        return $this->belongsTo(Product::class, 'kelas_id');
    }

    public function pelatih()
    {
        return $this->belongsTo(Pelatih::class, 'pelatih_id');
    }

    






}
