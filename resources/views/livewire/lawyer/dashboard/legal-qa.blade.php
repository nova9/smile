<x-lawyer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-teal-500/10 to-teal-600/10 text-black rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-teal-500/20">
                    <i data-lucide="help-circle" class="w-5 h-5 mr-2 text-teal-600"></i>
                    Legal Q&A Support
                </div>
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800 leading-tight relative">
                        Legal <span class="text-accent">Q&A Support</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-green-500/30" viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Provide legal consultation and answer client questions
                    </p>
                </div>
            </div>

            <!-- Pending Questions -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Pending Questions</h3>
                <div class="space-y-4">
                    @foreach($pendingQuestions as $question)
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-all duration-200">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800 mb-2">{{ $question['question'] }}</h4>
                                <div class="flex gap-4 text-sm text-gray-600">
                                    <span>Client: {{ $question['client'] }}</span>
                                    <span>Category: {{ $question['category'] }}</span>
                                    <span>{{ $question['submitted_at'] }}</span>
                                </div>
                            </div>
                            <span class="px-3 py-1 text-xs font-medium rounded-full 
                                @if($question['priority'] == 'high') bg-red-100 text-red-700
                                @elseif($question['priority'] == 'medium') bg-orange-100 text-orange-700
                                @else bg-green-100 text-green-700 @endif">
                                {{ ucfirst($question['priority']) }} Priority
                            </span>
                        </div>
                        <div class="flex gap-3">
                            <button class="btn btn-accent btn-sm">Answer Question</button>
                            <button class="btn btn-outline btn-sm">Schedule Call</button>
                            <button class="btn btn-outline btn-sm">Request Details</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Answered Questions -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Recently Answered</h3>
                <div class="space-y-4">
                    @foreach($answeredQuestions as $answered)
                    <div class="flex items-start justify-between p-4 border border-gray-200 rounded-lg">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800 mb-1">{{ $answered['question'] }}</h4>
                            <div class="flex gap-4 text-sm text-gray-600">
                                <span>{{ $answered['client'] }}</span>
                                <span>Answered {{ $answered['answered_at'] }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 text-xs font-medium rounded-full 
                                @if($answered['status'] == 'satisfied') bg-green-100 text-green-700
                                @else bg-orange-100 text-orange-700 @endif">
                                {{ ucfirst(str_replace('_', ' ', $answered['status'])) }}
                            </span>
                            <button class="btn btn-outline btn-sm">View</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</x-lawyer.dashboard-layout>