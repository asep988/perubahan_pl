<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skkl extends Model
{
    use HasFactory;

    protected $connection = 'perubahan_pl';
    protected $table = 'skkl';
    protected $primaryKey = 'id';
    protected $casts = [
        'kabupaten_kota' => 'array',
        'provinsi' => 'array'
    ];
    protected $fillable = [
        'user_id',
        'pelaku_usaha',
        'nama_usaha',
        'jenis_usaha',
        'penanggung',
        'nib',
        'knli',
        'jabatan',
        'alamat',
        'lokasi',
        'pelaku_usaha_baru',
        'nama_usaha_baru',
        'jenis_usaha_baru',
        'penanggung_baru',
        'nib_baru',
        'knli_baru',
        'jabatan_baru',
        'alamat_baru',
        'lokasi_baru',
        'kabupaten_kota',
        'provinsi',
        'link_drive',
        'nomor_pl',
        'tgl_pl',
        'perihal',
        'ruang_lingkup',
        'file',
        'status'
    ];

    public function il_skkl()
    {
        return $this->hasMany(il_skkl::class, 'id_skkl', 'id');
    }

    public function rkl()
    {
        return $this->hasMany(rkl::class, 'id_skkl', 'id');
    }
}
