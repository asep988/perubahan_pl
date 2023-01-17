<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rpl extends Model
{
    use HasFactory;

    protected $connection = 'perubahan_pl';
    protected $table = 'rpl';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jenis_dampak',
        'id_skkl',
        'indikator',
        'sumber_dampak',
        'metode',
        'lokasi',
        'waktu',
        'pelaksana',
        'pengawas',
        'penerima'
    ];

    public function il_skkl()
    {
        return $this->belongsTo(Skkl::class, 'id_skkl', 'id');
    }
}