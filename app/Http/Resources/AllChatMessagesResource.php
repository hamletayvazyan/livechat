<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllChatMessagesResource extends ResourceCollection
{
	public function toArray($request)
	{
		$chatMessages = [];

		foreach ($this->collection as $resource) {
			$chatMessages[] = new ChatMessageResource($resource);
		}

		return $chatMessages;
	}
}
