<?php

namespace App\Exports;

use App\Skkl;
use App\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SkklExport implements FromCollection, WithHeadings, ShouldAutoSize
{   
    public function __construct($param, $status)
    {
        $this->param = $param;
        $this->status = $status;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $pemrakarsa = User::join('initiators', 'users.email', 'initiators.email')
        ->where('initiators.user_type', 'Pemrakarsa')
        ->orWhere('initiators.user_type', 'Pemerintah')
        ->select('users.id', 'users.name', 'users.email')
        ->get();

        $data = Skkl::select(
            'id',
            'noreg',
            'created_at',
            'user_id',
            'nama_usaha_baru',
            'status',
            'pic_pemohon',
            'no_hp_pic',
            'nama_operator',
            'jenis_perubahan',
            'nomor_validasi',
            'tgl_validasi',
            'perihal',
            'tgl_rpd',
            'count',
            'pelaku_usaha',
            'created_at'
        );
        
        $this->param == 'sudah' ? $data->where('nama_operator', '!=', NULL) : '';
        $this->param == 'belum' ? $data->where('nama_operator', NULL) : '';

        $this->status == 1 ? $data->where('status', 'Belum') : '';
        $this->status == 2 ? $data->where('status', 'Submit') : '';
        $this->status == 3 ? $data->where('status', 'Proses') : '';
        $this->status == 4 ? $data->where('status', 'Draft') : '';
        $this->status == 5 ? $data->where('status', 'Final') : '';
        $this->status == 6 ? $data->where('status', 'Batal')->orWhere('status', 'Ditolak') : '';
        $data = $data->orderBy('tgl_validasi', 'ASC')->get();

        for ($i=0; $i < count($data); $i++) { 
            $data[$i]->count = $i + 1;
            if ($data[$i]->status == "Belum") {
                $status = 'Belum diproses';
            } elseif ($data[$i]->status == "Submit") {
                $status = 'Sudah Submit';
            } elseif ($data[$i]->status == "Proses") {
                $status = 'Proses Validasi';
            } elseif ($data[$i]->status == "Draft") {
                $status = 'Drafting';
            } elseif ($data[$i]->status == "Final") {
                $status = 'Selesai';
            } elseif ($data[$i]->status == "Batal") {
                $status = 'Dibatalkan';
            } else {
                $status = 'Ditolak';
            }

            $data[$i]->status = $status;

            foreach ($pemrakarsa as $user) {
                if ($data[$i]->user_id == $user->id) {
                    $data[$i]->pelaku_usaha = $user->name;
                }
            }

            $pic = $data[$i]->pic_pemohon . ' | ' . $data[$i]->no_hp_pic;
            $data[$i]->pic_pemohon = $pic;

            if ($data[$i]->nama_operator == null) {
                $data[$i]->nama_operator = '-';
            }

            if ($data[$i]->jenis_perubahan == 'perkep1') {
                $perkep = 'Perubahan Kepemilikkan';
            } elseif ($data[$i]->jenis_perubahan == 'perkep2') {
                $perkep = 'Perubahan Kepemilikkan dan Integrasi Pertek/Rintek';
            } elseif ($data[$i]->jenis_perubahan == 'perkep3') {
                $perkep = 'Integrasi Pertek/Rintek';
            }
            $data[$i]->jenis_perubahan = $perkep;

            $tgl = $data[$i]->created_at->format('d-m-Y, H:i:s');
            $data[$i]->tgl_rpd = $tgl;
        }

        $export = array();

        for ($i=0; $i < count($data); $i++) { 
            $export[$i] = array();
            $export[$i]['no'] = $data[$i]->count;
            $export[$i]['noreg'] = $data[$i]->noreg;
            $export[$i]['tanggal_dibuat'] = $data[$i]->tgl_rpd;
            $export[$i]['pemrakarsa'] = $data[$i]->pelaku_usaha;
            $export[$i]['nama_usaha'] = $data[$i]->nama_usaha_baru;
            $export[$i]['status'] = $data[$i]->status;
            $export[$i]['pic'] = $data[$i]->pic_pemohon;
            $export[$i]['nama_pjm'] = $data[$i]->nama_operator;
            $export[$i]['jenis_perubahan'] = $data[$i]->jenis_perubahan;
            $export[$i]['nomor_verif'] = $data[$i]->nomor_validasi;
            $export[$i]['tgl_verif'] = $data[$i]->tgl_validasi;
            $export[$i]['permohonan'] = $data[$i]->perihal;
        }

        return collect($export);
    }

    public function headings(): array
    {
        return [
            'No',
            'Nomor Registrasi',
            'Tanggal Dibuat',
            'Pemrakarsa',
            'Nama Usaha/Kegiatan',
            'Status',
            'PIC',
            'Nama PJM',
            'Jenis Permohonan',
            'Nomor Verif PTSP',
            'Tanggal Verif PTSP',
            'Permohonan dari Pemrakarsa',
        ];
    }
}
