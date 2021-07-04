<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Database\Eloquent\Collection;

class MessageResource extends JsonResource
{
	public $userId;
	public $newMessages;
	public $newMessageCount;
	public $oldMessages;

	public function __construct(Collection $newMessages, int $newMessageCount, Collection $oldMessages, int $userId)
	{
		parent::toArray($newMessages);

		$this->userId = $userId;
		$this->newMessages = $newMessages;
		$this->newMessageCount = $newMessageCount;
		$this->oldMessages = $oldMessages;
	}


	public function toArray($request)
	{
		$data = [];

		$data['message_count'] = $this->newMessageCount;
		$data['new_messages'] = $this->getMessages($this->newMessages);
		$data['old_messages'] = $this->getMessages($this->oldMessages);

		return $data;
	}

	private function getMessages(Collection $messages)
	{
		$data = [];

		foreach($messages as $message) {
			$data[] = [
				'id' => $message->id,
				'text' => $message->text,

				'author_name' => optional($message->author)->name,
//				'author_last_name' => optional($message->author)->last_name,
//				'author_avatar' => optional($message->author)->avatar_url,

				'chat_id' => $message->chat_id,

				'created_at' => $message->created_at,
			];
		}

		return $data;
	}
}
