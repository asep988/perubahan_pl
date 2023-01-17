<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rkl extends Model
{
    use HasFactory;

    protected $connection = 'perubahan_pl';
    protected $table = 'rkl';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_skkl',
        'dampak_dikelola',
        'sumber_dampak',
        'indikator',
        'bentuk_pengelolaan',
        'lokasi'
    ];

    public function il_skkl()
    {
        return $this->belongsTo(Skkl::class, 'id_skkl', 'id');
    }
}
