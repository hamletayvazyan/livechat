<?php

namespace App\Http\Controllers;

use App\ChatNew;
use App\Events\ChatMessageCreated;
use App\Http\Resources\AllChatMessagesResource;
use App\Http\Resources\ChatMessageResource;
use App\Http\Resources\MessageResource;
use App\MessageNew;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response as IlluminateResponse;

class MessageNewController extends Controller
{
	public function getNewMessages(int $userId, int $number=null) : Collection
	{
		$messages = MessageNew::query()
			->where('user_id', $userId)
			->where('is_read', false)
			->with('author')
			->orderByDesc('created_at')
			->take($number)->get();

		return $messages;
	}

	public function getNewMessageCount(int $userId) : int
	{
		$messageCount = MessageNew::query()
			->where('user_id', $userId)
			->where('is_read', false)
			->count();

		return $messageCount;
	}

	public function getOldChatMessages(int $userId, int $number=null) : Collection
	{
		$messages = MessageNew::query()
			->where('user_id', $userId)
			->where('is_read', true)
			->with('author')
			->orderByDesc('created_at')
			->take($number)->get();

		return $messages;
	}

	/**
	 * @param $userId
	 * @param $chatId
	 * @return Collection
	 */
	public function getChatMessagesRepo($userId, ChatNew $chat, $lastMessageId = null) : Collection
	{
		$messages = MessageNew::query()
			->where('user_id', $userId)
			->where('chat_id', $chat->id)
			->when($lastMessageId, function ($query) use ($lastMessageId) {
				$query->where('id', '<', $lastMessageId);
			})
			->orderByDesc('created_at')
			->limit(100)
			->get();

		return $messages;

	}

	/**
	 * @param $userId
	 * @param $message
	 * @param null $consultationId
	 * @return bool
	 */
	public function store($userId, $message, $user2): bool
	{
		$createdAt = now();

		MessageNew::create(
			[
				'author_id' => $userId,
				'user_id' => $user2,
				'text' => $message,
				'created_at' => $createdAt,
				'updated_at' => $createdAt,
			]
		);
/*
 *
		if($userId == $consultation->consultant_id)
		{
			// message sended by consultant
			Mail::to($messageToClient->user->email)->send(new SendNewMessageAtConsultationEmailNotify($messageToClient));
		}*/

		return true;
	}

	/**
	 * @param int $userId
	 * @param ChatNew $chat
	 * @param $text
	 * @return MessageNew
	 */
	public function storeChatMessageRepo($userId, ChatNew $chat, $text): MessageNew
	{
		$createdAt = now();
		$chat->load('users');

		foreach ($chat->users as $user) {
			if($user->id == $userId) {
				$messageNew = $this->storeAuthorMessage($userId, $chat->id, $text, $createdAt);
			}
			else {
				$this->storeChatMessageForUser($user->id, $userId, $chat->id, $text, $createdAt);
			}
		}

		return $messageNew;
	}

	/**
	 * @param int $authorId
	 * @param int $chatId
	 * @param string $text
	 * @param string $createdAt
	 * @return MessageNew
	 */
	private function storeAuthorMessage($authorId, $chatId, $text, $createdAt) : MessageNew
	{
		return MessageNew::create(
			[
				'author_id' => $authorId,
				'user_id' => $authorId,
				'blogger_id' => $authorId,
				'advertiser_id' => $authorId,
				'chat_id' => $chatId,
				'text' => is_null($text) ? '' : $text,
				'is_read' => true,
				'created_at' => $createdAt,
				'updated_at' => $createdAt,
			]
		);
	}

	/**
	 * @param int $userId
	 * @param int $authorId
	 * @param int $chatId
	 * @param string $text
	 * @param string $createdAt
	 * @return MessageNew
	 */
	private function storeChatMessageForUser($userId, $authorId, $chatId, $text, $createdAt) : MessageNew
	{
		$message = MessageNew::create(
			[
				'author_id' => $authorId,
				'user_id' => $userId,
				'blogger_id' => $authorId,
				'advertiser_id' => $authorId,
				'chat_id' => $chatId,
				'text' => is_null($text) ? '' : $text,
				'created_at' => $createdAt,
				'updated_at' => $createdAt,
			]
		);
		event(new ChatMessageCreated($message, $userId, $chatId));
//		broadcast(new ChatMessageCreated($message, $userId, $chatId))->toOthers();

		/*$lock = Cache::lock('user_lock_unread_msg:' . $userId, 1800);

		$user = User::find($userId);
		if ($result = $lock->get()) {
			if($user->telegram_id == null) {
				SendEmailNotificationUnreadMessages::dispatch($userId)->delay(now()->addSeconds(1800));
			}
		}

		if($user->telegram_id != null) {
			$author = User::find($authorId);
			try {
				ChatStep::sendNotificationMessage($user, $author, $message->text);
			} catch (\Throwable $th) {
				//
			}
		}*/

		return $message;
	}

	/**
	 * @param int $userId
	 * @param array $ids
	 */
	public function markReadMessages($userId, $ids):void
	{
		MessageNew::query()
			->whereIn('id', $ids)
			->where('user_id', $userId)
			->update(
				['is_read' => 1]
			);
	}

	/**
	 * @param int $userId
	 * @param array $ids
	 */
	public function markReadChatMessages($userId, $ids):void
	{
		MessageNew::query()
			->whereIn('chat_id', $ids)
			->where('user_id', $userId)
			->update(
				['is_read' => 1]
			);
	}

	/**
	 * @param int $userId
	 */
	public function markReadAllUserMessages($userId):void
	{
		MessageNew::query()
			->where('user_id', $userId)
			->update(
				['is_read' => 1]
			);
	}

	public function getMessages()
	{
		$userId = Auth::id();

		$newMessages = $this->getNewMessages($userId, 5);
		$newMessageCount = $this->getNewMessageCount($userId);
		$oldMessages = $this->getOldChatMessages($userId, (5 - $newMessages->count()));

		return new MessageResource($newMessages, $newMessageCount, $oldMessages, $userId);
	}

	public function getChatMessages(ChatNew $chat, Request $request)
	{
		$messages = $this->getChatMessagesRepo(Auth::id(), $chat, $request->lastMessageId);

		return new AllChatMessagesResource($messages);
	}

	public function storeChatMessage(ChatNew $chat, Request $request)
	{
		$message = $this->storeChatMessageRepo(Auth::id(), $chat, $request->text);

		return (new ChatMessageResource($message))->response()->setStatusCode(201);
	}

	public function markReadMessage(Request $request)
	{
		switch ($request->type){
			case 'message':
				$this->markReadMessages(Auth::id(), $request->ids);
				break;
			case 'chat':
				$this->markReadChatMessages(Auth::id(), $request->ids);
				break;
			case 'all':
				$this->markReadAllChatMessages(Auth::id());
				break;
		}

		return response()->json(['message' => 'Success'], IlluminateResponse::HTTP_OK);
	}

}
