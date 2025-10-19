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
                                                            {{ $message->file->original_name }}
                                                        </p>
                                                        <p class="text-xs text-gray-300">2.4 MB</p>
                                                    </div>
                                                    <a href="{{\App\Services\FileManager::getTemporaryUrl($message->file_id)}}"
                                                        download="{{ $message->file->original_name }}">
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
                                    <x-common.avatar size="32"
                                        :src="\App\Services\Profile::getProfilePictureUrl(auth()->user())"
                                        :name="auth()->user()->name" />
                                </div>
                            </div>
                        @else
                            <!-- Other User Message -->
                            <div class="flex justify-start items-start gap-3 mb-4">
                                <div class="flex-shrink-0">
                                    <x-common.avatar size="32"
                                        :src="\App\Services\Profile::getProfilePictureUrl($message->user)"
                                        :name="$message->user->name" />
                                </div>
                                <div class="flex flex-col items-start max-w-[70%]">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-xs text-gray-600">{{ $message->user->name }}</span>
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
                                                            {{ $message->file->original_name }}
                                                        </p>
                                                        <p class="text-xs text-gray-500">2.4 MB</p>
                                                    </div>
                                                    <a href="{{\App\Services\FileManager::getTemporaryUrl($message->file_id)}}"
                                                        download="{{ $message->file->original_name }}">
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
                        <div class="h-full flex items-center justify-center text-gray-500">
                            <p class="text-center">No messages yet. Start the conversation!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Chat Input -->
        <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
            x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-cancel="uploading = false"
            x-on:livewire-upload-error="uploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress"
            class="relative border-t border-gray-200 p-4">
            <!-- File Upload Progress Indicator -->
            <div x-show="uploading || $wire.fileInput" x-transition:enter="transition ease-out duration-200"
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
                <div x-show="!uploading && $wire.fileInput" class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                            <i data-lucide="file" class="w-4 h-4 text-gray-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">
                                @if ($fileInput)
                                    {{ $fileInput->getClientOriginalName() }}
                                @endif
                            </p>
                            <p class="text-xs text-gray-500">Ready to send</p>
                        </div>
                    </div>
                    <button wire:click="clearFileInput"
                        class="p-1 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full transition-colors">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
            <div class="flex gap-3">
                <label for="fileInput"
                    class="flex items-center p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <i data-lucide="paperclip" class="w-4 h-4"></i>
                </label>
                <input type="file" name="fileInput" id="fileInput" class="hidden" wire:model="fileInput">

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
