<?php

namespace App\Http\Controllers;

use App\ChatNew;
use App\Http\Resources\ChatResource;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatNewController extends Controller
{

	public function index()
	{
		$chats = $this->getChats(Auth::user());

		return ChatResource::collection($chats);
	}
	public function getChats(User $user): Collection
	{
		$chats = ChatNew::query()
			->whereHas('users', function (Builder $query) use ($user) {
				$query->where('user_id', '=', $user->id);
			})
			->with(['users', 'lastMessage'])
			->orderBy('updated_at')
			->get();

		return $chats;
	}

	public function getChatByTwoUsers(User $user1, User $user2)
	{
		$chats = $this->getChats($user1);

		$chat = $chats->filter(function ($chat, $key) use ($user1, $user2) {
			foreach ($chat->users as $user) {
				if($user->id == $user2->id) {
					return true;
				}
			}

			return false;
		})->first();

		return $chat;
	}

	public function createChat(User $blogger, User $advertiser): ChatNew
	{
		$chat = ChatNew::create();
		$chat->users()->attach([$blogger->id, $advertiser->id]);

		return $chat;
	}
}
