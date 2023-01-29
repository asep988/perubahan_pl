<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tuk_secretary_member extends Model
{
    use HasFactory;
    protected $connection = 'public';
    protected $table = 'tuk_secretary_members';
}
