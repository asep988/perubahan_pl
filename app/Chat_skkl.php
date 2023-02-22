<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat_skkl extends Model
{
    use HasFactory;
    protected $connection = 'perubahan_pl';
    protected $table = 'chat_skkl';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_skkl',
        'chat',
        'nama',
        'sender'
    ];

    public function Skkl()
    {
        return $this->belongsTo(Skkl::class, 'id_skkl', 'id');
    }
}
