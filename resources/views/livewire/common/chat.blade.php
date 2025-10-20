<div x-data="chat({ drawerOpen: $wire.entangle('drawerOpen') })" class="drawer drawer-end z-99999" x-cloak
    wire:poll.5s="refreshChats">
    <input id="my-drawer" wire:model="drawerOpen" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex justify-center items-center">
        <label for="my-drawer" class="z-199">
            <div class="p-1.5 rounded-sm drawer-button hover:bg-neutral-200 transition-colors tooltip hover:tooltip-open tooltip-bottom relative"
                data-tip="Chat">
                <i data-lucide="message-circle" class="size-5"></i>
                @if($totalUnreadCount > 0)
                    <span
                        class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold shadow-lg">
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
            <div class=" flex items-center justify-between px-4 py-3 border-b border-base-300">
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
                        $otherUser = \App\Services\Messaging::getDirectChatOtherParty($chat);
                        $profilePicture = $otherUser->getProfilePictureUrl();
                    @endphp
                    <li>
                        <a wire:click="openChat({{ $chat->id }})"
                            class="flex items-center gap-3 px-4 py-3 hover:bg-base-300 transition hover:cursor-pointer {{ $hasUnread ? 'bg-blue-50 border-l-4 border-l-blue-500' : '' }}">
                            <div class="relative">
                                @if($profilePicture)
                                    <img src="{{ $profilePicture }}" alt="{{ $otherUser->name }}"
                                        class="rounded-full w-10 h-10 border border-base-300 object-cover">
                                @else
                                    <div class="rounded-full w-10 h-10 border border-base-300 bg-gray-300"></div>
                                @endif
                                @if($hasUnread && $unreadCount > 0)
                                    <span
                                        class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
                                        {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                                    </span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="{{ $hasUnread ? 'font-bold text-gray-900' : 'font-medium' }}">
                                    {{ $otherUser->name }}
                                </div>
                                <div
                                    class="text-xs {{ $hasUnread ? 'text-gray-600 font-semibold' : 'text-base-content/70' }} truncate user-select-none">
                                    @if($lastMessage)
                                        {{ $lastMessage->content }}
                                    @endif
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-1">
                                <span
                                    class="text-xs {{ $hasUnread ? 'text-blue-600 font-semibold' : 'text-base-content/50' }}">
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
        <div class="fixed right-10 bottom-0 w-[40vw] h-[50vh] bg-base-200 shadow-2xl rounded-t-lg border border-neutral-300 flex flex-col transform transition-all duration-500 ease-out"
            style="z-index: 999999 !important;" x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 100)"
            x-show="shown" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-full"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-full">
            <!-- Chat Header -->
            <div class="flex items-center gap-3 px-4 py-3 border-b border-base-300 bg-base-100 rounded-t-lg">
                @php
                    $otherParty = \App\Services\Messaging::getDirectChatOtherParty($currentChat);
                    $currentUserRole = auth()->user()->role->name ?? 'volunteer';
                    $otherPartyPicture = $otherParty->getProfilePictureUrl();
                @endphp
                @if($otherPartyPicture)
                    <img src="{{ $otherPartyPicture }}" alt="{{ $otherParty->name }}"
                        class="rounded-full w-10 h-10 border border-base-300 object-cover">
                @else
                    <div class="rounded-full w-10 h-10 border border-base-300 bg-gray-300"></div>
                @endif
                <div>
                    <div class="font-semibold">{{ $otherParty->name }}</div>
                    <div class="text-xs text-base-content/70 flex items-center gap-1">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
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
                <div x-ref="messages" class="px-4 py-2 space-y-3"
                    x-init="$nextTick(() => $refs.messageContainer.scrollTop = $refs.messageContainer.scrollHeight)">
                    @forelse(\App\Services\Messaging::getMessagesForChatDisplay($currentChat) as $message)
                        @if(\App\Services\Messaging::isMessageMine($message))
                            <!-- Current User Message -->
                            <div class="flex justify-end items-start gap-3 mb-4">
                                <div class="flex flex-col items-end max-w-[70%]">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-xs text-gray-600">You</span>
                                    </div>
                                    <div class="bg-gray-800 text-white rounded-lg px-3 py-2">
                                        @if($message->content)
                                            <p class="text-sm">{{ $message->content }}</p>
                                        @endif

                                        {{-- File attachment for current user --}}
                                        @if($message->file_id)
                                            <div class="@if($message->content) mt-2 pt-2 border-t border-gray-600 @endif">
                                                <div class="flex items-center gap-2 bg-gray-700 rounded-lg p-2">
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-medium text-white truncate">
                                                            {{ $message->file->original_name ?? $message->file->file_name }}
                                                        </p>
                                                        <p class="text-xs text-gray-300">
                                                            {{ $message->file->file_size ? number_format($message->file->file_size / 1024, 1) . ' KB' : '2.4 MB' }}
                                                        </p>
                                                    </div>
                                                    <a href="{{ \App\Services\FileManager::getTemporaryUrl($message->file_id) }}"
                                                        download="{{ $message->file->original_name ?? $message->file->file_name }}">
                                                        <button
                                                            class="p-1 text-gray-300 hover:text-white hover:bg-gray-600 rounded transition-colors">
                                                            <i data-lucide="download" class="w-4 h-4"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <span class="text-xs text-gray-500 mt-1">
                                        {{ $message->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <div class="flex-shrink-0">
                                    <x-common.avatar size="32" :src="\App\Services\Profile::getProfilePictureUrl(auth()->user())"
                                        :name="auth()->user()->name" />
                                </div>
                            </div>
                        @else
                            <!-- Other User Message -->
                            <div class="flex justify-start items-start gap-3 mb-4">
                                <div class="flex-shrink-0">
                                    @php
                                        $otherUser = \App\Services\Messaging::getDirectChatOtherParty($currentChat);
                                    @endphp
                                    <x-common.avatar size="32" :src="\App\Services\Profile::getProfilePictureUrl($otherUser)"
                                        :name="$otherUser->name" />
                                </div>
                                <div class="flex flex-col items-start max-w-[70%]">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-xs text-gray-600">{{ $otherUser->name }}</span>
                                    </div>
                                    <div class="bg-gray-200 rounded-lg px-3 py-2">
                                        @if($message->content)
                                            <p class="text-sm text-gray-800">{{ $message->content }}</p>
                                        @endif

                                        {{-- File attachment for other users --}}
                                        @if($message->file_id)
                                            <div class="@if($message->content) mt-2 pt-2 border-t border-gray-300 @endif">
                                                <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-lg p-2">
                                                    <div
                                                        class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                                        <i data-lucide="file" class="w-4 h-4 text-gray-600"></i>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-medium text-gray-800 truncate">
                                                            {{ $message->file->original_name ?? $message->file->file_name }}
                                                        </p>
                                                        <p class="text-xs text-gray-500">
                                                            {{ $message->file->file_size ? number_format($message->file->file_size / 1024, 1) . ' KB' : '2.4 MB' }}
                                                        </p>
                                                    </div>
                                                    <a href="{{ \App\Services\FileManager::getTemporaryUrl($message->file_id) }}"
                                                        download="{{ $message->file->original_name ?? $message->file->file_name }}">
                                                        <button
                                                            class="p-1 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded transition-colors">
                                                            <i data-lucide="download" class="w-4 h-4"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <span class="text-xs text-gray-500 mt-1">
                                        {{ $message->created_at->diffForHumans() }}
                                    </span>
                                </div>
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
            <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-cancel="uploading = false"
                x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress"
                class="relative border-t border-base-300 bg-base-100">

                <!-- File Upload Progress Indicator -->
                <div x-show="uploading || $wire.attachment" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
                    class="absolute inset-x-4 -top-20 bg-white border border-gray-200 rounded-lg shadow-lg p-3 mb-2">

                    <!-- Upload Progress -->
                    <div x-show="uploading" class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Uploading file...</span>
                            <span class="text-sm text-gray-500" x-text="progress + '%'"></span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full transition-all duration-300"
                                :style="'width: ' + progress + '%'"></div>
                        </div>
                    </div>

                    <!-- File Selected -->
                    <div x-show="!uploading && $wire.attachment" class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                <i data-lucide="file" class="w-4 h-4 text-gray-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">
                                    @if ($attachment)
                                        {{ $attachment->getClientOriginalName() }}
                                    @endif
                                </p>
                                <p class="text-xs text-gray-500">Ready to send</p>
                            </div>
                        </div>
                        <button wire:click="removeAttachment"
                            class="p-1 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full transition-colors">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <!-- Input Area -->
                <div class="px-4 py-3 flex items-center gap-3">
                    <label for="file-upload-{{ $currentChat->id }}"
                        class="flex items-center p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                        <i data-lucide="paperclip" class="w-4 h-4"></i>
                    </label>
                    <input id="file-upload-{{ $currentChat->id }}" type="file" wire:model="attachment" class="hidden"
                        accept="image/*,.pdf,.doc,.docx,.txt">

                    <div class="flex-1 relative">
                        <input wire:model="input" type="text"
                            class="w-full px-4 py-2 pr-12 border border-gray-300 rounded-full input"
                            placeholder="Type your message..." wire:keydown.enter="sendMessage({{ $currentChat->id }})">
                    </div>
                    <button wire:click="sendMessage({{ $currentChat->id }})" wire:loading.attr="disabled"
                        wire:target="sendMessage"
                        class="size-10 aspect-square flex items-center justify-center rounded-full overflow-hidden bg-primary text-white hover:bg-primary/90 transition-colors">
                        <span wire:loading.remove wire:target="sendMessage">
                            <i data-lucide="send" class="w-4 h-4"></i>
                        </span>
                        <span wire:loading wire:target="sendMessage" class="loading loading-spinner loading-xs"></span>
                    </button>
                </div>
                <div class="px-4 pb-2 text-xs text-gray-500">
                    Press Enter to send
                </div>
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