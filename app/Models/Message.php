<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function sender() : BelongsTo
    {
        return $this->belongsTo(User::class , 'sender_id');
    }
    public function receiver() : BelongsTo
    {
        return $this->belongsTo(User::class , 'receiver_id');
    }
    public function attachement() : HasMany
    {
        return $this -> hasMany(Message_Attachmemnt::class);
    }
        public function group() : BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
