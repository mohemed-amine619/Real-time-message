<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Message extends Model
{
    //
    use HasFactory;

    protected $fillable =[
        'message',
        'sender_id',
        'group_id',
        'reciever_id',
    ];
        public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user');
    }
}
