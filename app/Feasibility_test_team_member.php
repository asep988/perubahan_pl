<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feasibility_test_team_member extends Model
{
    use HasFactory;
    protected $connection = 'public';
    protected $table = 'feasibility_test_team_members';
}
