<?php

namespace App\Entity\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class incomplete extends Model
{
    use HasFactory;
    protected $connection = "recaps";
    protected $table = "incomplete_data";
    protected $primaryKey = "id";
}
