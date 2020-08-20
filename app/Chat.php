<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'room_id',
        'sender_id',
        'receiver_id',
        'message',
    ];
    protected $with = ['sender', 'receiver'];
    public function scopeBySender($query, $sender)
    {
        $query->where('sender_id', $sender);
    }

    public function scopeByReceiver($query, $sender)
    {
        $query->where('receiver_id', $sender);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id')->select(['id', 'name']);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id')->select(['id', 'name']);
    }

    public function room() {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
