<?php

namespace App\Entity\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class afterMeeting extends Model
{
    use HasFactory;
    protected $connection = "recaps";
    protected $table = "after_meeting_data";
    protected $primaryKey = "id";
}
