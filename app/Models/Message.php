<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'receiver_id',
    ];
        public function groups() : BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_user');
    }
}
