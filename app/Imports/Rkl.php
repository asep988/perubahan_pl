<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class Rkl implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $row, $id)
    {
        
    }
}
