<div class="fixed bottom-4 right-4 z-50">
        <!-- Chatbot Toggle Button -->
        <button id="chatbot-toggle" class="bg-primary text-white p-4 rounded-full shadow-lg hover:bg-primay-700 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
        </button>

        <!-- Chatbot Window -->
        <div id="chatbot-window" class="hidden w-80 sm:w-96 bg-white rounded-lg shadow-xl flex flex-col max-h-[80vh]">
            <!-- Chat Header -->
            <div class="bg-primary text-white p-4 rounded-t-lg flex justify-between items-center">
                <h2 class="text-lg font-semibold">AI Assistant</h2>
                <button id="chatbot-close" class="text-white hover:text-gray-200 focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Chat Messages Area -->
            <div id="chat-messages" class="flex-1 p-4 overflow-y-auto space-y-4 bg-gray-50">
                <div class="flex justify-start">
                    <div class="bg-blue-100 text-blue-800 p-3 rounded-lg max-w-xs">
                        Hello! How can I assist you today?
                    </div>
                </div>
                @foreach($messages as $msg)
                <div class="flex {{ $msg['role'] === 'user' ? 'justify-end' : 'justify-start' }}">
                    <div class="px-4 py-2 rounded-lg {{ $msg['role'] === 'user' ? 'bg-green-100 text-right' : 'bg-gray-100 text-left' }}">
                        {{ $msg['content'] }}
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Chat Input Area -->
            <div class="p-4 border-t bg-white">
                <div class="flex space-x-2">
                 <form wire:submit.prevent="sendMessage" class="flex gap-2">
                    <input id="chat-input" type="text" wire:model.defer="input" class="flex-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Type your message..." autocomplete="off">
                    <button id="chat-send" type="submit" class="bg-primary text-white p-2 rounded-lg hover:bg-primay-700 focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        </div>
</div>

    <script>
        // JavaScript to toggle chatbot window
        const toggleButton = document.getElementById('chatbot-toggle');
        const closeButton = document.getElementById('chatbot-close');
        const chatbotWindow = document.getElementById('chatbot-window');

        toggleButton.addEventListener('click', () => {
            chatbotWindow.classList.toggle('hidden');
        });

        closeButton.addEventListener('click', () => {
            chatbotWindow.classList.add('hidden');
        });
    </script>

