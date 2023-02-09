<?php

namespace App\Imports;

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

    }

    public function startRow(): int
    {
        return 3;
    }
}
