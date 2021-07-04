<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ChatMessageResource extends JsonResource
{
	public $userId;

	public function __construct($resource, int $userId=null)
	{
		parent::__construct($resource);
		$this->resource = $resource;

		$this->userId = ($userId) ? $userId : Auth::id();
	}
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
	public function toArray($request)
	{
		return [
			'id' => $this->id,
			'author_id' => (int) $this->author_id,
			'isMine' => ($this->user_id == $this->author_id),
			'text' => $this->text,
			'isRead' => (bool) $this->is_read,
			'created_at' => $this->created_at
		];
	}
}
