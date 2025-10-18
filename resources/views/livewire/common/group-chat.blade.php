<div>
    <div class="flex flex-col h-[600px] bg-white rounded-lg border border-gray-200 shadow-sm">
        <!-- Chat Header -->
        <div
            class="flex items-center justify-between p-4 border-b border-gray-200 bg-gray-50 rounded-t-lg">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                        <i data-lucide="users" class="w-5 h-5 text-white"></i>
                    </div>
                    <div
                        class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white">
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">{{ $event->name }} - Team Chat</h3>
                    <p class="text-sm text-gray-500">12 volunteers online</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button
                    class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <i data-lucide="phone" class="w-4 h-4"></i>
                </button>
                <button
                    class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <i data-lucide="video" class="w-4 h-4"></i>
                </button>
                <button
                    class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
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

            <!-- Message 1 -->
            <div class="flex items-start gap-3">
                <div
                    class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-xs font-semibold text-white">SA</span>
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="font-medium text-gray-900 text-sm">Sarah Anderson</span>
                        <span class="text-xs text-gray-500">10:30 AM</span>
                    </div>
                    <div class="bg-gray-100 rounded-lg p-3 text-sm text-gray-800">
                        Hey everyone! Really excited to be part of this event. Has anyone received the
                        orientation materials yet?
                    </div>
                </div>
            </div>

            <!-- Message 2 -->
            <div class="flex items-start gap-3">
                <div
                    class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-xs font-semibold text-white">MJ</span>
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="font-medium text-gray-900 text-sm">Mike Johnson</span>
                        <span class="text-xs text-gray-500">10:32 AM</span>
                    </div>
                    <div class="bg-gray-100 rounded-lg p-3 text-sm text-gray-800">
                        Yes! I got them yesterday. They're in the Files section above. Really
                        comprehensive guide!
                    </div>
                </div>
            </div>

            <!-- Current User Message -->
            <div class="flex items-start gap-3 flex-row-reverse">
                <div
                    class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span
                                        class="text-xs font-semibold text-white">{{ substr(auth()->user()->name ?? 'You', 0, 2) }}</span>
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1 justify-end">
                        <span class="text-xs text-gray-500">10:35 AM</span>
                        <span
                            class="font-medium text-gray-900 text-sm">{{ auth()->user()->name ?? 'You' }}</span>
                    </div>
                    <div class="bg-blue-500 text-white rounded-lg p-3 text-sm">
                        Perfect! Thanks Mike. Looking forward to working with everyone 🙌
                    </div>
                </div>
            </div>

            <!-- Message 3 -->
            <div class="flex items-start gap-3">
                <div
                    class="w-8 h-8 bg-pink-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-xs font-semibold text-white">EL</span>
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="font-medium text-gray-900 text-sm">Emma Lopez</span>
                        <span class="text-xs text-gray-500">10:38 AM</span>
                    </div>
                    <div class="bg-gray-100 rounded-lg p-3 text-sm text-gray-800">
                        Just a reminder - the meeting point tomorrow is at the main entrance. See you
                        all there! 📍
                    </div>
                </div>
            </div>

            <!-- Message 4 with attachment -->
            <div class="flex items-start gap-3">
                <div
                    class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-xs font-semibold text-white">DJ</span>
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="font-medium text-gray-900 text-sm">David Kim</span>
                        <span class="text-xs text-gray-500">11:15 AM</span>
                    </div>
                    <div class="bg-gray-100 rounded-lg p-3 text-sm text-gray-800">
                        I've prepared a quick checklist for tomorrow. Hope this helps everyone!
                    </div>
                    <div
                        class="mt-2 p-3 bg-white border border-gray-200 rounded-lg flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                            <i data-lucide="file-text" class="w-5 h-5 text-blue-500"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900 text-sm">Event Checklist.pdf</p>
                            <p class="text-xs text-gray-500">245 KB</p>
                        </div>
                        <button
                            class="text-blue-500 hover:text-blue-600 text-sm font-medium">Download</button>
                    </div>
                </div>
            </div>

            <!-- Typing Indicator -->
            <div class="flex items-start gap-3">
                <div
                    class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-xs font-semibold text-gray-600">AL</span>
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="font-medium text-gray-900 text-sm">Alex Thompson</span>
                        <span class="text-xs text-gray-500">typing...</span>
                    </div>
                    <div class="bg-gray-100 rounded-lg p-3 w-16">
                        <div class="flex space-x-1">
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"
                                 style="animation-delay: 0.1s"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"
                                 style="animation-delay: 0.2s"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Input -->
        <div class="border-t border-gray-200 p-4">
            <div class="flex gap-3">
                <button
                    class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <i data-lucide="paperclip" class="w-4 h-4"></i>
                </button>
                <div class="flex-1 relative">
                    <input type="text" placeholder="Type your message..."
                           wire:model="inputMessage"
                           class="w-full px-4 py-2 pr-12 border border-gray-300 rounded-full input">
                </div>
                <button
                    wire:click="sendMessage"
                    wire:keydown.enter="sendMessage"
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
