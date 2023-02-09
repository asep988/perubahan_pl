<?php

namespace App\Imports;

use App\rkl as AppRkl;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Rkl implements ToCollection, WithStartRow
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
            AppRkl::create([
                'id_skkl' => $this->id,
                'tahap_kegiatan' => $row[0],
                'jenis_dph' => $row[1],
                'dampak_dikelola' => $row[2],
                'sumber_dampak' => $row[3],
                'indikator' => $row[4],
                'bentuk_pengelolaan' => $row[5],
                'lokasi' => $row[6],
                'periode' => $row[7],
                'institusi' => $row[8],
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
