<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatUserResource extends JsonResource
{

	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request)
	{
		if($this->name) {
			$name = trim($this->name);
		}
		else {
			$name = $this->email;
		}
		return [
			'id' => $this->id,
			'name' => $name,
			'last_visited_at' => $this->pivot->last_visited_at,
		];
	}
}
