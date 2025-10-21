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
        // Get all chats where the auth user is a participant
        $chats = Chat::query()
            ->whereHas('users', fn($q) => $q->where('users.id', $authUser->id))
            ->with('users')
            ->get();

        // Find the chat that has exactly 2 users: the auth user and the target user
        return $chats->first(function ($chat) use ($authUser, $user) {
            $userIds = $chat->users->pluck('id')->sort()->values();
            $expectedIds = collect([$authUser->id, $user->id])->sort()->values();
            return $userIds->count() === 2 && $userIds->toArray() === $expectedIds->toArray();
        });
    }

    public static function getAllDirectChats()
    {
        return Chat::query()->whereHas('users', fn($q) => $q->where('users.id', auth()->id()))
            ->withCount('users')
            ->having('users_count', 2)
            ->get();
    }

    public static function isMessageMine($message): bool
    {
        return $message->user->id === auth()->id();
    }

    public static function sendMessage($content, $chatId, $fileId = null)
    {
        Message::query()->create([
            'user_id' => auth()->id(),
            'chat_id' => $chatId,
            'content' => $content,
            'file_id' => $fileId,
        ]);
    }

    public static function getMessagesForChat(Chat $chat)
    {
        return $chat->messages()->with('user')->orderBy('created_at', 'desc')->get();
    }

    public static function getMessagesForChatDisplay(Chat $chat)
    {
        return $chat->messages()->with('user')->orderBy('created_at', 'asc')->get();
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

        // Create a new chat
        $chat = Chat::create();

        // Attach both users to the chat
        $chat->users()->attach([$authUser->id, $user->id]);

        return true;
    }

    public static function hasUnreadMessages(Chat $chat): bool
    {
        return $chat->messages()
            ->where('user_id', '!=', auth()->id())
            ->whereNull('read_at')
            ->exists();
    }

    public static function getUnreadMessageCount(Chat $chat): int
    {
        return $chat->messages()
            ->where('user_id', '!=', auth()->id())
            ->whereNull('read_at')
            ->count();
    }

    public static function markMessagesAsRead(Chat $chat): void
    {
        $chat->messages()
            ->where('user_id', '!=', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }

    public static function getLastMessageTime(Chat $chat): ?string
    {
        $lastMessage = $chat->messages()->latest()->first();
        return $lastMessage ? $lastMessage->created_at->diffForHumans() : null;
    }
}
