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
        'provinsi' => 'array',
        'region' => 'array', //baru
        'nama_kbli' => 'array',
        'kbli_baru' => 'array',
        'pertek' => 'array',
        'jenis_peraturan' => 'array',
        'pejabat_daerah' => 'array',
        'nomor_peraturan' => 'array',
        'perihal_peraturan' => 'array',
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
        'status',
        'nama_kbli', //baru
        'jenis_perubahan',
        'pejabat_pl',
        'region',
        'nomor_validasi',
        'tgl_validasi',
        'jenis_persetujuan',
        'pejabat_daerah',
        'nomor_peraturan',
        'perihal_peraturan',
        'nomor_rpd',
        'tgl_rpd',
        'pertek',
        'rintek_upload',
        'rintek_limbah_upload',
        'tgl_update',
        'pic_pemohon',
        'no_hp_pic',
        'noreg',
        'note',
        'count',
        'rintek2_upload',
        'rintek3_upload',
        'rintek4_upload'
    ];

    public function il_pkplh()
    {
        return $this->hasMany(il_pkplh::class, 'id_pkplh', 'id');
    }

    public function uklupl()
    {
        return $this->hasOne(Uklupl::class, 'id_uklupl', 'id');
    }

    public function Pertek_pkplh()
    {
        return $this->hasMany(Pertek_pkplh::class, 'id_pkplh', 'id');
    }

    public function Chat_pkplh()
    {
        return $this->hasMany(Chat_pkplh::class, 'id_pkplh', 'id');
    }
}
