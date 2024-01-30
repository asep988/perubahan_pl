<?php

namespace App\Entity\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class undatedVerificated extends Model
{
    use HasFactory;
    protected $connection = "recaps";
    protected $table = "undated_verificated_data";
    protected $primaryKey = "id";
}
