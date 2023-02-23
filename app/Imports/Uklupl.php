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
                'tahap_kegiatan' => $row[0],
                'sumber_dampak' => $row[1],
                'jenis_dampak' => $row[2],
                'besaran_dampak' => $row[3],
                'bentuk_pengelolaan' => $row[4],
                'lokasi_pengelolaan' => $row[5],
                'periode_pengelolaan' => $row[6],
                'bentuk_pemantauan' => $row[7],
                'lokasi_pemantauan' => $row[8],
                'periode_pemantauan' => $row[9],
                'institusi' => $row[10],
                'keterangan' => $row[11],
            ]);
        }
    }

    public function startRow(): int
    {
        return 3;
    }
}
