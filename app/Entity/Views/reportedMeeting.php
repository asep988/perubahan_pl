<?php

namespace App\Entity\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportedMeeting extends Model
{
    use HasFactory;
    protected $connection = "recaps";
    protected $table = "reported_meeting_data";
    protected $primaryKey = "id";
}
