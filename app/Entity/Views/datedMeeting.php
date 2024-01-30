<?php

namespace App\Entity\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class datedMeeting extends Model
{
    use HasFactory;
    protected $connection = "recaps";
    protected $table = "dated_meeting_data";
    protected $primaryKey = "id";
}
