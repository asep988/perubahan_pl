<?php

namespace App\Entity\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unverificated extends Model
{
    use HasFactory;
    protected $connection = "recaps";
    protected $table = "unverificated_data";
    protected $primaryKey = "id";
}
