<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat_pkplh extends Model
{
    use HasFactory;
    protected $connection = 'perubahan_pl';
    protected $table = 'chat_pkplh';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pkplh',
        'chat',
        'nama',
        'sender'
    ];

    public function Pkplh()
    {
        return $this->belongsTo(Pkplh::class, 'id_pkplh', 'id');
    }
}
