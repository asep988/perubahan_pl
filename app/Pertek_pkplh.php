<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertek_pkplh extends Model
{
    use HasFactory;
    protected $connection = 'perubahan_pl';
    protected $table = 'pertek_pkplh';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pkplh',
        'pertek',
        'surat_pertek',
        'nomor_pertek',
        'tgl_pertek',
        'perihal_pertek',
    ];

    public function Pkplh()
    {
        return $this->belongsTo(Pkplh::class, 'id_pkplh', 'id');
    }
}
