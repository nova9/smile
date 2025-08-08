<?php

namespace App\Services;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;

class Messaging
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function getDirectChatTo(User $authUser, User $user): ?Chat
    {
        return Chat::query()->whereHas('users', fn($q) => $q->whereIn('users.id', [$authUser, $user->id]))
            ->withCount('users')
            ->where('users_count', 2)
            ->first();
    }

    public static function getAllDirectChats()
    {
        return Chat::query()->whereHas('users', fn($q) => $q->where('users.id', auth()->id()))
            ->withCount('users')
            ->where('users_count', 2)
            ->get();
    }

    public static function isMessageMine($message): bool
    {
        return $message->user->id === auth()->id();
    }

    public static function sendMessage($content, $chatId)
    {
        Message::query()->create([
            'user_id' => auth()->id(),
            'chat_id' => $chatId,
            'content' => $content,
        ]);
    }

    public static function getMessagesForChat(Chat $chat)
    {
        return $chat->messages()->with('user')->get();
    }

    public static function getDirectChatOtherParty($chat)
    {
        return $chat->users->where('id', '!=', auth()->id())->first();
    }

    public static function initializeDirectChatTo(User $authUser, User $user): bool
    {
        $existingChat = static::getDirectChatTo($authUser, $user);

        if ($existingChat) {
            return false;
        }

        $chat = $authUser->chats()->create();
        $user->chats()->attach($chat->id);

        return true;
    }
}
