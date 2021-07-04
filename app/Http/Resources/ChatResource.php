<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
	    $lastMessage = $this->lastMessage->first();
	    if($lastMessage) {
		    $lastMessageData =  [
			    'date' => $lastMessage->created_at,
			    'text' => $lastMessage->text,
		    ];
	    }
	    else {
		    $lastMessageData = [];
	    }

	    return [
		    'id' => $this->id,
		    'users' => ChatUserResource::collection($this->users),
		    'lastMessage' => $lastMessageData,
		    'userUnread' => $this->userUnread,
	    ];
    }
}
