<div
    x-data="chat({ drawerOpen: $wire.entangle('drawerOpen') })"
    class="drawer drawer-end z-99999"
    x-cloak
>
    <input id="my-drawer" wire:model="drawerOpen" type="checkbox" class="drawer-toggle"/>
    <div class="drawer-content">
        <label for="my-drawer">
            <div class="p-1.5 rounded-sm drawer-button hover:bg-neutral-200 transition-colors">
                <i data-lucide="message-circle" class="size-5"></i>
            </div>
        </label>
    </div>
    <div class="drawer-side">
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
                    <li>
                        <a wire:click="openChat({{ $chat->id }})"
                           class="flex items-center gap-3 px-4 py-3 hover:bg-base-300 transition hover:cursor-pointer">
                            <img src="https://i.pravatar.cc/40?img=1" alt="User"
                                 class="rounded-full w-10 h-10 border border-base-300">
                            <div class="flex-1">
                                <div
                                    class="font-medium">{{ \App\Services\Messaging::getDirectChatOtherParty($chat)->name }}</div>
                                <div class="text-xs text-base-content/70 truncate user-select-none">
                                    @if(\App\Services\Messaging::getMessagesForChat($chat))
                                        {{ \App\Services\Messaging::getMessagesForChat($chat)[0]->content }}
                                    @endif
                                </div>
                            </div>
                            <span class="text-xs text-base-content/50">{{ \App\Services\Messaging::getMessagesForChat($chat)[0]->created_at->diffForHumans() }}</span>
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
        <div class="fixed right-10 bottom-0 w-[40vw] h-[50vh] bg-base-200 shadow-2xl rounded-t-lg border border-neutral-300 flex flex-col">
            <!-- Chat Header -->
            <div class="flex items-center gap-3 px-4 py-3 border-b border-base-300 bg-base-100 rounded-t-lg">
                <img src="https://i.pravatar.cc/40?img=2" alt="User"
                     class="rounded-full w-10 h-10 border border-base-300">
                <div>
                    <div
                        class="font-semibold">{{ \App\Services\Messaging::getDirectChatOtherParty($currentChat)->name }}</div>
                    <div class="text-xs text-base-content/70">Online</div>
                </div>
                <button wire:click="closeChat" class="ml-auto text-base-content/50 hover:text-base-content transition">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>
            <!-- Messages -->
            <div class="flex-1 flex flex-col-reverse overflow-scroll">
                <div x-ref="messages" class="px-4 py-2 space-y-3">
                    @forelse(\App\Services\Messaging::getMessagesForChat($currentChat) as $message)
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
