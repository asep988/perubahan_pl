<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class initiator extends Model
{
    use HasFactory;
    protected $connection = 'public';
    protected $table = 'initiators';
}
