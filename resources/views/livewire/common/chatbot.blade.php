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
    <!-- Chatbot Toggle Button -->
    <button id="chatbot-toggle-btn" aria-label="Toggle chat" x-show="!open" x-on:click="toggle()"
    class="p-1.5 rounded-sm drawer-button hover:bg-neutral-200 transition-colors tooltip hover:tooltip-open tooltip-bottom" data-tip="SmileBot"
    >
        
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
    </button>
    <div class="fixed bottom-4 right-4 z-50">


        <!-- Chatbot Window -->
        <div id="chatbot-window" class="w-80 sm:w-96 bg-white rounded-lg shadow-xl flex flex-col max-h-[80vh]"
            x-show="open">
            <!-- Chat Header -->
            <div class="bg-neutral text-white p-4 rounded-t-lg flex justify-between items-center">
                <h2 class="text-lg font-semibold">Smile Assistant</h2>
                <button id="chatbot-close-btn"
                    class="text-white hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-emerald-700"
                    aria-label="Close chat" x-on:click="toggle()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Chat Messages Area -->
            <div class="flex-1 p-4 overflow-y-auto space-y-4 bg-gray-50">
                @foreach ($messages as $msg)
                    <div class="flex {{ $msg['role'] === 'user' ? 'justify-end' : 'justify-start' }}">
                        <div
                            class="px-4 py-2 rounded-lg max-w-[80%] text-sm shadow {{ $msg['role'] === 'user' ? 'bg-gray-100 text-gray-800 rounded-br-none' : 'bg-gray-100 text-gray-800 rounded-bl-none' }}">
                            @if ($msg['role'] === 'assistant' && preg_match('/\d+\./', $msg['content']))
                                @php
                                    $lines = preg_split('/\r?\n/', $msg['content']);
                                    $intro = [];
                                    $list = [];
                                    $after = [];
                                    $inList = false;
                                    foreach ($lines as $line) {
                                        if (preg_match('/^\d+\./', trim($line))) {
                                            $inList = true;
                                            $list[] = trim($line);
                                        } elseif ($inList && trim($line) === '') {
                                            $inList = false;
                                        } elseif ($inList) {
                                            $list[count($list) - 1] .= ' ' . trim($line);
                                        } elseif (!$inList) {
                                            if (empty($list)) {
                                                $intro[] = $line;
                                            } else {
                                                $after[] = $line;
                                            }
                                        }
                                    }
                                @endphp
                                @if (!empty($intro))
                                    <div class="mb-2 font-semibold">{{ implode(' ', $intro) }}</div>
                                @endif
                                <ol class="list-decimal list-inside space-y-1">
                                    @foreach ($list as $item)
                                        <li>{{ preg_replace('/^\d+\.\s*/', '', $item) }}</li>
                                    @endforeach
                                </ol>
                                @if (!empty($after))
                                    <div class="mt-2">{{ implode(' ', $after) }}</div>
                                @endif
                            @else
                                {{ strip_tags($msg['content']) }}
                            @endif
                        </div>
                    </div>
                @endforeach
                @if (empty($messages))
                    <div class="text-gray-500 flex justify-center p-4">
                        <img src="{{ asset('storage/assets/logo.svg') }}" class="h-16 my-3">
                    </div>
                @endif
            </div>

        <!-- Chat Input Area -->
        <div class="p-4  bg-white">
            <form wire:submit.prevent="sendMessage" class="flex space-x-2">
                <input wire:model.defer="input" type="text" class="input input-bordered w-full text-sm"
                    placeholder="Type a message..." autocomplete="off" aria-label="Type your message">
                <button type="submit"
                    class="bg-neutral text-white p-2 rounded-lg  focus:outline-none focus:ring-2 focus:ring-emerald-700 transition-colors duration-300"
                    aria-label="Send message">
                    {{-- when the sendMessage is running remove the icon that is what wire:targe --}}
                   <span wire:loading.remove.flex wire:target="sendMessage" aria-hidden="true">
                       <i  data-lucide="send-horizontal"></i>
                    </span>
                    <span wire:loading.flex wire:target="sendMessage" aria-hidden="true">

                      <i data-lucide="loader-circle" class="animate-spin"></i>
                    </span>
                </button>
            </form>
        </div>
    </div>
</div>
</div>
