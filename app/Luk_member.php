<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Luk_member extends Model
{
    use HasFactory;
    protected $connection = 'public';
    protected $table = 'luk_members';
}
