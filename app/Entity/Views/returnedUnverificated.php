<?php

namespace App\Entity\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class returnedUnverificated extends Model
{
    use HasFactory;
    protected $connection = "recaps";
    protected $table = "returned_unverificated_data";
    protected $primaryKey = "id";
}
