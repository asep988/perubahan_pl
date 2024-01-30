<?php

namespace App\Entity\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class verificated extends Model
{
    use HasFactory;
    protected $connection = "recaps";
    protected $table = "total_verificated_data";
    protected $primaryKey = "id";
}
