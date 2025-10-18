<div
    x-data="chat({ drawerOpen: $wire.entangle('drawerOpen') })"
    class="drawer drawer-end z-99999"
    x-cloak
    wire:poll.5s="refreshChats"
>
    <input id="my-drawer" wire:model="drawerOpen" type="checkbox" class="drawer-toggle"/>
    <div class="drawer-content">
        <label for="my-drawer" class="z-199">
            <div class="p-1.5 rounded-sm drawer-button hover:bg-neutral-200 transition-colors tooltip hover:tooltip-open tooltip-bottom relative" data-tip="Chat">
                <i data-lucide="message-circle" class="size-5"></i>
                @if($totalUnreadCount > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold shadow-lg">
                        {{ $totalUnreadCount > 9 ? '9+' : $totalUnreadCount }}
                    </span>
                @endif
            </div>
        </label>
    </div>
    <div class="drawer-side z-200">
        <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
        <div class="bg-base-200 min-h-full w-80">
            <!-- Header -->
            <div
                class=" flex items-center justify-between px-4 py-3 border-b border-base-300">
                <span class="font-semibold text-lg">Chats</span>
            </div>
            <!-- Chat Items -->
            <ul>
                @forelse($chats as $chat)
                    @php
                        $hasUnread = \App\Services\Messaging::hasUnreadMessages($chat);
                        $unreadCount = \App\Services\Messaging::getUnreadMessageCount($chat);
                        $messages = \App\Services\Messaging::getMessagesForChat($chat);
                        $lastMessage = $messages->first(); // First message is latest due to desc order
                    @endphp
                    <li>
                        <a wire:click="openChat({{ $chat->id }})"
                           class="flex items-center gap-3 px-4 py-3 hover:bg-base-300 transition hover:cursor-pointer {{ $hasUnread ? 'bg-blue-50 border-l-4 border-l-blue-500' : '' }}">
                            <div class="relative">
                                <img src="https://i.pravatar.cc/40?img=1" alt="User"
                                     class="rounded-full w-10 h-10 border border-base-300">
                                @if($hasUnread && $unreadCount > 0)
                                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
                                        {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                                    </span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="{{ $hasUnread ? 'font-bold text-gray-900' : 'font-medium' }}">
                                    {{ \App\Services\Messaging::getDirectChatOtherParty($chat)->name }}
                                </div>
                                <div class="text-xs {{ $hasUnread ? 'text-gray-600 font-semibold' : 'text-base-content/70' }} truncate user-select-none">
                                    @if($lastMessage)
                                        {{ $lastMessage->content }}
                                    @endif
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-1">
                                <span class="text-xs {{ $hasUnread ? 'text-blue-600 font-semibold' : 'text-base-content/50' }}">
                                    {{ $lastMessage ? $lastMessage->created_at->diffForHumans() : '' }}
                                </span>
                                @if($hasUnread)
                                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                @endif
                            </div>
                        </a>
                    </li>
                @empty
                    <li class="px-4 py-3 text-center text-base-content/70">
                        No chats available.
                    </li>
                @endforelse

            </ul>
        </div>
    </div>

    @if($currentChat)
        <!-- Chat Box -->
        <div 
            class="fixed right-10 bottom-0 w-[40vw] h-[50vh] bg-base-200 shadow-2xl rounded-t-lg border border-neutral-300 flex flex-col transform transition-all duration-500 ease-out" 
            style="z-index: 999999 !important;"
            x-data="{ shown: false }" 
            x-init="setTimeout(() => shown = true, 100)" 
            x-show="shown"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-full"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-full"
        >
            <!-- Chat Header -->
            <div class="flex items-center gap-3 px-4 py-3 border-b border-base-300 bg-base-100 rounded-t-lg">
                <img src="https://i.pravatar.cc/40?img=2" alt="User"
                     class="rounded-full w-10 h-10 border border-base-300">
                <div>
                    <div
                        class="font-semibold">{{ \App\Services\Messaging::getDirectChatOtherParty($currentChat)->name }}</div>
                    <div class="text-xs text-base-content/70 flex items-center gap-1">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        @php
                            $otherParty = \App\Services\Messaging::getDirectChatOtherParty($currentChat);
                            $currentUserRole = auth()->user()->role->name ?? 'volunteer';
                        @endphp
                        @if($currentUserRole === 'lawyer')
                            Ready to Help
                        @elseif($otherParty->role->name === 'lawyer')
                            Legal Advisor Online
                        @else
                            Online
                        @endif
                    </div>
                </div>
                <button wire:click="closeChat" class="ml-auto text-base-content/50 hover:text-base-content transition">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>
            <!-- Messages -->
            <div class="flex-1 flex flex-col-reverse overflow-scroll" x-ref="messageContainer">
                <div x-ref="messages" class="px-4 py-2 space-y-3" x-init="$nextTick(() => $refs.messageContainer.scrollTop = $refs.messageContainer.scrollHeight)">
                    @forelse(\App\Services\Messaging::getMessagesForChatDisplay($currentChat) as $message)
                        @if(\App\Services\Messaging::isMessageMine($message))
                            <div class="flex flex-col items-end">
                                <div
                                    class="bg-primary text-primary-content rounded-lg px-3 py-2 text-sm max-w-[70%]">{{ $message->content }}</div>
                                <span
                                    class="text-xs text-base-content/50 mt-1">{{ $message->created_at->diffForHumans() }}</span>
                            </div>
                        @else
                            <div class="flex flex-col items-start">
                                <div
                                    class="bg-base-300 rounded-lg px-3 py-2 text-sm max-w-[70%]">{{ $message->content }}</div>
                                <span
                                    class="text-xs text-base-content/50 mt-1">{{ $message->created_at->diffForHumans() }}</span>
                            </div>
                        @endif
                    @empty
                        <div class="flex items-center justify-center h-full text-base-content/70">
                            <p class="text-center">No messages yet. Start the conversation!</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <!-- Input -->
            <div class="border-t border-base-300 px-4 py-3 bg-base-100 flex items-center gap-2">
                <input
                    wire:model="input"
                    type="text"
                    class="input input-bordered w-full text-sm"
                    placeholder="Type a message..."
                    x-on:keydown.enter.stop.prevent="sendMessage({{ $currentChat->id }})"
                >
                <button class="btn btn-primary btn-sm" x-on:click="sendMessage({{ $currentChat->id }})">Send</button>
            </div>
        </div>
    @endif
</div>

<script>
    function chat(config) {
        return {
            drawerOpen: config.drawerOpen,
            sendMessage(chatId) {
                this.$wire.sendMessage(chatId)
            }
        }
    }
</script>
