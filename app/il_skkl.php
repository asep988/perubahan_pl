<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Skkl;

class il_skkl extends Model
{
    use HasFactory;
    protected $connection = 'perubahan_pl';
    protected $table = 'il_skkl';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_skkl',
        'jenis_sk',
        'menerbitkan',
        'nomor_surat',
        'tgl_surat',
        'perihal_surat'
    ];

    public function skkl()
    {
        return $this->belongsTo(Skkl::class, 'id_skkl', 'id');
    }
}
