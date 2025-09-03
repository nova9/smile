<div class="fixed bottom-4 right-4 z-50">
    <!-- Chatbot Toggle Button -->
    <button id="chatbot-toggle-btn"
        class="bg-emerald-500 text-white p-4 rounded-full shadow-lg hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-700 transition-colors duration-300"
        aria-label="Toggle chat">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
    </button>

    <!-- Chatbot Window -->
    <div id="chatbot-window" class="w-80 sm:w-96 bg-white rounded-lg shadow-xl flex flex-col max-h-[80vh]">
        <!-- Chat Header -->
        <div class="bg-emerald-500 text-white p-4 rounded-t-lg flex justify-between items-center">
            <h2 class="text-lg font-semibold">Smile Assistant</h2>
            <button id="chatbot-close-btn"
                class="text-white hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-emerald-700"
                aria-label="Close chat">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Chat Messages Area -->
        <div class="flex-1 p-4 overflow-y-auto space-y-4 bg-gray-50">
            @foreach ($messages as $msg)
                <div class="{{ $msg['role'] === 'user' ? 'flex justify-end' : 'flex justify-start' }}">
                    <div
                        class="{{ $msg['role'] === 'user' ? 'chat-bubble-user' : 'chat-bubble-assistant' }} px-4 py-2 rounded-lg max-w-[80%] text-sm">
                        {{ $msg['content'] }}
                    </div>
                </div>
            @endforeach
            @if (empty($messages))
                <div class="text-gray-500 text-center p-4">
                    Ask about the Smile platform!
                </div>
            @endif
        </div>

        <!-- Chat Input Area -->
        <div class="p-4 border-t bg-white">
            <form wire:submit.prevent="sendMessage" class="flex space-x-2">
                <input wire:model.defer="input" type="text" class="input input-bordered w-full text-sm"
                    placeholder="Type a message..." autocomplete="off" aria-label="Type your message">
                <button type="submit"
                    class="bg-emerald-500 text-white p-2 rounded-lg hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-700 transition-colors duration-300"
                    aria-label="Send message">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>


<script>
    // Persist chat open/close state
    const chatbotWindow = document.getElementById('chatbot-window');
    const chatbotToggleBtn = document.getElementById('chatbot-toggle-btn');
    const chatbotCloseBtn = document.getElementById('chatbot-close-btn');

    chatbotToggleBtn.addEventListener('click', function() {
        chatbotWindow.classList.toggle('hidden');
        localStorage.setItem('chatbotOpen', !chatbotWindow.classList.contains('hidden'));
    });

    chatbotCloseBtn.addEventListener('click', function() {
        chatbotWindow.classList.add('hidden');
        localStorage.setItem('chatbotOpen', false);
    });
    // Restore chat window state after Livewire updates
    document.addEventListener('livewire:update', function() {
        if (localStorage.getItem('chatbotOpen') === 'true') {
            chatbotWindow.classList.remove('hidden');
        } else {
            chatbotWindow.classList.add('hidden');
        }
    });
</script>
