<?php

namespace App\Entity\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ptspValidated extends Model
{
    use HasFactory;
    protected $connection = "recaps";
    protected $table = "ptsp_validated_data";
    protected $primaryKey = "id";
}
