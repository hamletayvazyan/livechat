<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ChatNew extends Model
{
	public function users()
	{
		return $this->belongsToMany(User::class, 'chat_users', 'chat_id', 'user_id')->withPivot('last_visited_at');
	}

	public function messages()
	{
		return $this->hasMany(MessageNew::class, 'chat_id', 'id');
	}

	public function lastMessage()
	{
		return $this->messages()->orderByDesc('created_at')->limit(1);
	}

	public function getUserUnreadAttribute()
	{
		return $this->messages()->where('user_id', Auth::id())->where('is_read', false)->count();
	}
}
