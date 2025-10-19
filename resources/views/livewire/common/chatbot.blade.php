<div x-data="{
    open: localStorage.getItem('chatbotOpen') === 'true',
    toggle() {
        this.open = !this.open;
        localStorage.setItem('chatbotOpen', this.open);
    },

    init() {
        this.$watch('open', value => localStorage.setItem('chatbotOpen', value));
        // Listen for Livewire updates to restore state
        document.addEventListener('livewire:update', () => {
            this.open = localStorage.getItem('chatbotOpen') === 'true';
        });
    }
}">
    <!-- Floating container -->

    <!-- Chatbot Toggle Button -->
    <button id="chatbot-toggle-btn" aria-label="Toggle chat" x-on:click="toggle()"
        class="p-3 rounded-full bg-primary text-white shadow-lg  focus:outline-none focus:ring-2 focus:ring-emerald-300 transition "
        title="Smile Assistant">
        <i data-lucide="bot" class="w-4 h-4"></i>
    </button>
    <div class="fixed bottom-4 right-4 z-50 flex flex-col items-end gap-3">
        <!-- Chatbot Window -->
        <div id="chatbot-window" x-transition.opacity.duration.200
            class="w-80 sm:w-96 bg-white rounded-lg shadow-2xl flex flex-col max-h-[80vh] overflow-hidden ring-1 ring-gray-100"
            x-show="open" x-cloak>
            <!-- Chat Header -->
            <div class="bg-primary text-white p-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="bg-white/20 rounded-full p-1">
                        <i data-lucide="bot" class="text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-semibold">Smile Assistant</h2>
                        <p class="text-xs text-white/80">Ask me anything — forms, or guidance</p>
                    </div>
                </div>
                <button id="chatbot-close-btn"
                    class="p-1 rounded-md bg-white/10 hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-emerald-300"
                    aria-label="Close chat" x-on:click="toggle()">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Chat Messages Area -->
            <div class="flex-1 p-4 overflow-y-auto space-y-3 bg-gray-50">
                @foreach ($messages as $msg)
                    <div class="flex {{ $msg['role'] === 'user' ? 'justify-end' : 'justify-start' }}">
                        <div
                            class="max-w-[80%] text-sm px-4 py-2 rounded-lg shadow-sm leading-relaxed break-words 
                            {{ $msg['role'] === 'user' ? 'bg-primary text-white rounded-br-none' : 'bg-white text-gray-800 rounded-bl-none' }}">
                            {!! nl2br(e(strip_tags($msg['content']))) !!}
                            {{-- nl2br replaces newline characters ("\n") with HTML <br /> tags so line breaks show in the browser. --}}
                            {{-- strip_tags($s) — removes any HTML tags (strips <...> elements).
e($s) — escapes special HTML characters (like <, >, &, ") into entities to prevent XSS. --}}
                        </div>
                    </div>
                @endforeach

                @if (empty($messages))
                    <div class="text-gray-500 flex justify-center p-6">
                        <img src="{{ asset('storage/assets/logo.svg') }}" class="h-16 my-3">
                    </div>
                @endif
            </div>

            <!-- Chat Input Area -->
            <div class="p-3 bg-white border-t border-gray-100">
                <form wire:submit.prevent="sendMessage" class="flex items-center gap-2">
                    <input wire:model.defer="input" type="text"
                        class="input input-bordered w-full text-sm rounded-md" placeholder="Type a message..."
                        autocomplete="off" aria-label="Type your message">
                    <button type="submit"
                        class="inline-flex items-center justify-center bg-primary text-white p-2 rounded-md hover:bg- focus:outline-none focus:ring-2 focus:ring-emerald-300 transition">
                        <span wire:loading.remove.flex wire:target="sendMessage" aria-hidden="true">
                            <i data-lucide="send-horizontal" class="w-4 h-4"></i>
                        </span>
                        <span wire:loading.flex wire:target="sendMessage" aria-hidden="true">
                            <i data-lucide="loader-circle" class="animate-spin w-4 h-4"></i>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
