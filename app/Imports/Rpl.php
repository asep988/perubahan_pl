<?php

namespace App\Imports;

use App\rpl as AppRpl;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Rpl implements ToCollection, WithStartRow
{
    /**
    * @param Collection $collection
    */

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            AppRpl::create([
                'id_skkl' => $this->id,
                'tahap_kegiatan' => $row[0],
                'jenis_dph' => $row[1],
                'jenis_dampak' => $row[2],
                'indikator' => $row[3],
                'sumber_dampak' => $row[4],
                'metode' => $row[5],
                'lokasi' => $row[6],
                'waktu' => $row[7],
                'pelaksana' => $row[8],
                'pengawas' => $row[9],
                'penerima' => $row[10],
            ]);
        }
    }

    public function startRow(): int
    {
        return 3;
    }
}
