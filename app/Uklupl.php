<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uklupl extends Model
{
    use HasFactory;
    protected $connection = 'perubahan_pl';
    protected $table = 'uklupl';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pkplh',
        'sumber_dampak',
        'jenis_dampak',
        'besaran_dampak',
        'bentuk_pengelolaan',
        'lokasi_pengelolaan',
        'periode_pengelolaan',
        'bentuk_pemantauan',
        'lokasi_pemantauan',
        'periode_pemantauan',
        'institusi',
        'keterangan'
    ];

    public function pkplh()
    {
        return $this->belongsTo(Pkplh::class, 'id_pkplh', 'id');
    }
}
