<?php

namespace App\Entity\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class processed extends Model
{
    use HasFactory;
    protected $connection = "recaps";
    protected $table = "processed_data";
    protected $primaryKey = "id";
}
