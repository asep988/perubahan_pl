<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pkplh extends Model
{
    use HasFactory;

    protected $connection = 'perubahan_pl';
    protected $table = 'pkplh';
    protected $primaryKey = 'id';
    protected $casts = [
        'kabupaten_kota' => 'array',
        'provinsi' => 'array'
    ];
    protected $fillable = [
        'user_id',
        'nama_operator',
        'pelaku_usaha',
        'nama_usaha',
        'jenis_usaha',
        'penanggung',
        'nib',
        'kbli',
        'jabatan',
        'alamat',
        'lokasi',
        'pelaku_usaha_baru',
        'nama_usaha_baru',
        'jenis_usaha_baru',
        'penanggung_baru',
        'nib_baru',
        'kbli_baru',
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

    public function il_pkplh()
    {
        return $this->hasMany(il_pkplh::class, 'id_pkplh', 'id');
    }

    public function uklupl()
    {
        return $this->hasOne(Uklupl::class, 'id_uklupl', 'id');
    }
}
