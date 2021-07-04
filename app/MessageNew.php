<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageNew extends Model
{
	protected $fillable = [
		'author_id',
		'user_id',
		'blogger_id',
		'advertiser_id',
		'chat_id',
		'text',
		'file_id',
		'is_read',
		'created_at',
		'updated_at'
	];

	public function user()
	{
		return $this->hasOne(User::class, 'id', 'user_id');
	}
	public function blogger()
	{
		return $this->hasOne(User::class, 'id', 'blogger_id');
	}
	public function advertiser()
	{
		return $this->hasOne(User::class, 'id', 'advertiser_id');
	}
	public function chat()
	{
		return $this->hasOne(Chat::class, 'id', 'chat_id');
	}

	public function author()
	{
		return $this->hasOne(User::class, 'id', 'author_id');
	}

/*
	public function file()
	{
		return $this->belongsTo(MessageFile::class, 'file_id', 'id');
	}*/
}
