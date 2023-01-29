<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Skkl;

class Pertek_skkl extends Model
{
    use HasFactory;
    protected $connection = 'perubahan_pl';
    protected $table = 'pertek_skkl';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_skkl',
        'pertek',
        'judul_pertek',
        'surat_pertek',
        'nomor_pertek',
        'tgl_pertek',
        'perihal_pertek',
    ];

    public function Skkl()
    {
        return $this->belongsTo(Skkl::class, 'id_skkl', 'id');
    }
}
