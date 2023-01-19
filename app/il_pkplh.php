<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class il_pkplh extends Model
{
    use HasFactory;

    protected $connection = 'perubahan_pl';
    protected $table = 'il_pkplh';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pkplh',
        'jenis_sk',
        'menerbitkan',
        'nomor_surat',
        'tgl_surat',
        'perihal_surat'
    ];

    public function pkplh()
    {
        return $this->belongsTo(Pkplh::class, 'id_pkplh', 'id');
    }
}
