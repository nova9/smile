<div>
    <div class="flex flex-col h-[600px] bg-white rounded-lg border border-gray-200 shadow-sm">
        <!-- Chat Header -->
        <div class="flex items-center justify-between p-4 border-b border-gray-200 bg-gray-50 rounded-t-lg">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                        <i data-lucide="users" class="w-5 h-5 text-white"></i>
                    </div>
                    <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white">
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">{{ $event->name }} - Team Chat</h3>
                    <p class="text-sm text-gray-500">12 volunteers online</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <i data-lucide="phone" class="w-4 h-4"></i>
                </button>
                <button class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <i data-lucide="video" class="w-4 h-4"></i>
                </button>
                <button class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <i data-lucide="more-vertical" class="w-4 h-4"></i>
                </button>
            </div>
        </div>

        <!-- Chat Messages -->
        <div class="flex-1 overflow-y-auto p-4 space-y-4">
            <!-- System Message -->
            <div class="flex justify-center">
                <div class="bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full">
                    Welcome to the {{ $event->name }} team chat! 🎉
                </div>
            </div>

            <!-- Dynamic Messages -->
            @forelse(\App\Services\Messaging::getMessagesForChatDisplay($event->chat) as $message)
                @if(\App\Services\Messaging::isMessageMine($message))
                    <!-- Current User Message -->
                    <div class="flex flex-col items-end">
                        <div class="bg-primary text-primary-content rounded-lg px-3 py-2 text-sm max-w-[70%]">
                            {{ $message->content }}
                        </div>
                        <span class="text-xs text-base-content/50 mt-1">
                            {{ $message->created_at->diffForHumans() }}
                        </span>
                    </div>
                @else
                    <!-- Other User Message -->
                    <div class="flex flex-col items-start">
                        <div class="bg-base-300 rounded-lg px-3 py-2 text-sm max-w-[70%]">
                            {{ $message->content }}
                        </div>
                        <span class="text-xs text-base-content/50 mt-1">
                            {{ $message->created_at->diffForHumans() }}
                        </span>
                    </div>
                @endif
            @empty
                <div class="flex items-center justify-center h-full text-base-content/70">
                    <p class="text-center">No messages yet. Start the conversation!</p>
                </div>
            @endforelse
        </div>

        <!-- Chat Input -->
        <div class="border-t border-gray-200 p-4">
            <div class="flex gap-3">
                <button class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <i data-lucide="paperclip" class="w-4 h-4"></i>
                </button>
                <div class="flex-1 relative">
                    <input type="text" placeholder="Type your message..." wire:model="inputMessage"
                        wire:keydown.enter="sendMessage"
                        class="w-full px-4 py-2 pr-12 border border-gray-300 rounded-full input">
                </div>
                <button wire:click="sendMessage"
                    class="size-10 aspect-square flex items-center justify-center rounded-full overflow-hidden bg-primary text-white hover:bg-primary/90 transition-colors">
                    <i data-lucide="send" class="w-4 h-4"></i>
                </button>
            </div>
            <div class="mt-2 text-xs text-gray-500">
                Press Enter to send
            </div>
        </div>
    </div>

</div>