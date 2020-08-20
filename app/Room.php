<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name'
    ];

    public function Chat() {
        return $this->hasMany(Chat::class, 'room_id', 'id');
    }
}
