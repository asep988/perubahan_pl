<?php

namespace App\Entity\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class returnedRejected extends Model
{
    use HasFactory;
    protected $connection = "recaps";
    protected $table = "returned_rejected_data";
    protected $primaryKey = "id";
}
