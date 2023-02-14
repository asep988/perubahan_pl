<?php

namespace App\Imports;

use App\Uklupl as AppUklupl;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class Uklupl implements ToCollection
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
            AppUklupl::create([
                'id_pkplh' => $this->id,
                'sumber_dampak' => $row[0],
                'jenis_dampak' => $row[1],
                'besaran_dampak' => $row[2],
                'bentuk_pengelolaan' => $row[3],
                'lokasi_pengelolaan' => $row[4],
                'periode_pengelolaan' => $row[5],
                'bentuk_pemantauan' => $row[6],
                'lokasi_pemantauan' => $row[7],
                'periode_pemantauan' => $row[8],
                'institusi' => $row[9],
                'keterangan' => $row[10],
            ]);
        }
    }

    public function startRow(): int
    {
        return 3;
    }
}
