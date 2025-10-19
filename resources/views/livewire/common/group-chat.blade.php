<div x-data="{}" x-init="$nextTick(() => $refs.messageContainer.scrollTop = $refs.messageContainer.scrollHeight)">
    <div class="flex flex-col h-[87vh] bg-white rounded-lg border border-gray-200 shadow-sm">
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
        <div class="flex-1 flex flex-col-reverse overflow-y-scroll p-4" x-ref="messageContainer">
            <div>
                <div wire:poll="loadMessages">
                    <!-- Dynamic Messages -->
                    @forelse($messages as $message)
                        @php
                            // Dummy data for demonstration
                            $dummyAvatars = [
                                'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face&auto=format&q=80',
                                'https://images.unsplash.com/photo-1494790108755-2616b612b1c5?w=150&h=150&fit=crop&crop=face&auto=format&q=80',
                                'https://images.unsplash.com/photo-1527980965255-d3b416303d12?w=150&h=150&fit=crop&crop=face&auto=format&q=80',
                                'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop&crop=face&auto=format&q=80',
                                'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face&auto=format&q=80'
                            ];
                            $dummyNames = ['John Smith', 'Sarah Wilson', 'Mike Johnson', 'Emma Davis', 'Alex Chen'];
                            $messageIndex = $loop->index % count($dummyAvatars);
                            $messageAvatar = $dummyAvatars[$messageIndex];
                            $messageSender = $dummyNames[$messageIndex];
                        @endphp

                        @if(\App\Services\Messaging::isMessageMine($message))
                            <!-- Current User Message -->
                            <div class="flex justify-end items-start gap-3 mb-4">
                                <div class="flex flex-col items-end max-w-[70%]">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-xs text-gray-600">You</span>
                                    </div>
                                    <div class="bg-gray-800 text-white rounded-lg px-3 py-2">
                                        <p class="text-sm">{{ $message->content }}</p>
                                    </div>
                                    <span class="text-xs text-gray-500 mt-1">
                                        {{ $message->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <div class="flex-shrink-0">
                                    <x-common.avatar
                                        size="32"
                                        :src="\App\Services\Profile::getProfilePictureUrl(auth()->user())"
                                        :name="auth()->user()->name"/>
                                </div>
                            </div>
                        @else
                            <!-- Other User Message -->
                            <div class="flex justify-start items-start gap-3 mb-4">
                                <div class="flex-shrink-0">
                                    <x-common.avatar
                                        size="32"
                                        :src="\App\Services\Profile::getProfilePictureUrl($message->user)"
                                        :name="$message->user->name"/>
                                </div>
                                <div class="flex flex-col items-start max-w-[70%]">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-xs text-gray-600">{{ $message->user->name }}</span>
                                    </div>
                                    <div class="bg-gray-200 rounded-lg px-3 py-2">
                                        <p class="text-sm text-gray-800">{{ $message->content }}</p>
                                    </div>
                                    <span class="text-xs text-gray-500 mt-1">
                                        {{ $message->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="h-full flex items-center justify-center text-gray-500">
                            <p class="text-center">No messages yet. Start the conversation!</p>
                        </div>
                    @endforelse
                </div>
            </div>
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
