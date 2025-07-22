<x-lawyer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500/10 to-green-600/10 text-black rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-green-500/20">
                    <i data-lucide="help-circle" class="w-5 h-5 mr-2 text-green-600"></i>
                    Legal Q&A Support
                </div>
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800 leading-tight relative">
                        Legal <span class="text-accent">Support</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-green-500/30" viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Provide legal consultation and answer questions
                    </p>
                </div>
            </div>

            <!-- Support Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total Questions</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $stats['total_questions'] }}</p>
                        </div>
                        <div class="p-3 bg-gray-100 rounded-full">
                            <i data-lucide="message-square" class="w-6 h-6 text-gray-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Pending</p>
                            <p class="text-3xl font-bold text-red-600">{{ $stats['pending_questions'] }}</p>
                        </div>
                        <div class="p-3 bg-red-100 rounded-full">
                            <i data-lucide="clock" class="w-6 h-6 text-red-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Answered</p>
                            <p class="text-3xl font-bold text-green-600">{{ $stats['answered_questions'] }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full">
                            <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Avg. Response</p>
                            <p class="text-3xl font-bold text-black">{{ $stats['avg_response_time'] }}</p>
                        </div>
                        <div class="p-3 bg-gray-100 rounded-full">
                            <i data-lucide="clock" class="w-6 h-6 text-black"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50">
                <div class="flex flex-wrap gap-4 items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Question Filters</h3>
                    <div class="flex flex-wrap gap-4">
                        <select id="statusFilter" class="select select-bordered select-sm" onchange="applyFilters()">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="answered">Answered</option>
                            <option value="closed">Closed</option>
                        </select>
                        <select id="categoryFilter" class="select select-bordered select-sm" onchange="applyFilters()">
                            <option value="">All Categories</option>
                            <option value="contract_law">Contract Law</option>
                            <option value="employment_law">Employment Law</option>
                            <option value="corporate_law">Corporate Law</option>
                            <option value="family_law">Family Law</option>
                        </select>
                        <button class="btn btn-outline btn-sm" onclick="resetFilters()">
                            <i data-lucide="filter" class="w-4 h-4 mr-2"></i>
                            Reset Filters
                        </button>
                    </div>
                </div>
            </div>

            <!-- Q&A Questions -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">Legal Questions</h3>
                    <span id="resultCount" class="text-sm text-gray-500">Showing {{ count($questions) }} questions</span>
                </div>

                <div id="questionsList" class="space-y-4">
                    @foreach($questions as $question)
                    <div class="question-card border border-gray-200 rounded-lg p-6 hover:shadow-md transition-all duration-200"
                        data-status="{{ $question['status'] }}"
                        data-category="{{ $question['category'] }}">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h4 class="font-semibold text-gray-800 text-lg">{{ $question['title'] }}</h4>
                                    <span class="px-3 py-1 text-xs font-medium rounded-full 
                                        @if($question['status'] == 'pending') bg-red-100 text-red-700
                                        @elseif($question['status'] == 'answered') bg-green-100 text-green-700
                                        @else bg-gray-100 text-gray-700 @endif">
                                        {{ ucfirst($question['status']) }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-4 text-sm text-gray-600 mb-3">
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="user" class="w-3 h-3 text-gray-500"></i>
                                        <span>{{ $question['client_name'] }}</span>
                                    </div>
                                    <span class="text-gray-400">•</span>
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="bookmark" class="w-3 h-3 text-gray-500"></i>
                                        <span>{{ str_replace('_', ' ', ucwords($question['category'], '_')) }}</span>
                                    </div>
                                    <span class="text-gray-400">•</span>
                                    <span>{{ $question['submitted_date'] }}</span>
                                </div>
                                <p class="text-sm text-gray-700 line-clamp-3">{{ $question['question'] }}</p>
                            </div>
                            <div class="flex gap-2">
                                <button class="btn btn-outline btn-sm" onclick="viewQuestion({{ json_encode($question) }})">
                                    <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                    View
                                </button>
                                @if($question['status'] == 'pending')
                                <button class="btn btn-accent btn-sm" onclick="answerQuestion({{ json_encode($question) }})">
                                    <i data-lucide="message-square" class="w-4 h-4 mr-2"></i>
                                    Answer
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- No Results Message -->
                <div id="noResults" class="hidden text-center py-12">
                    <i data-lucide="message-square" class="w-16 h-16 mx-auto text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-600 mb-2">No questions found</h3>
                    <p class="text-gray-500">Try adjusting your filters to see more results</p>
                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-8">
                    <div class="join">
                        <button class="join-item btn btn-sm">«</button>
                        <button class="join-item btn btn-sm btn-active">1</button>
                        <button class="join-item btn btn-sm">2</button>
                        <button class="join-item btn btn-sm">3</button>
                        <button class="join-item btn btn-sm">»</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Question View/Answer Modal -->
    <div id="questionModal" class="fixed inset-0 bg-white/95 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden border border-gray-200">
            <!-- Modal Header -->
            <div class="bg-green-600 text-white p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 id="modalTitle" class="text-2xl font-bold">Legal Question</h2>
                        <p id="modalSubtitle" class="text-green-100 mt-1">Question details and response</p>
                    </div>
                    <button onclick="closeQuestionModal()" class="text-white hover:text-gray-200 transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="p-6 overflow-y-auto max-h-[70vh]">
                <!-- Question Information -->
                <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                    <h3 class="font-semibold text-gray-800 mb-3">Question Details</h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p><span class="font-medium">Client:</span> <span id="modalClientName">-</span></p>
                            <p><span class="font-medium">Category:</span> <span id="modalCategory">-</span></p>
                        </div>
                        <div>
                            <p><span class="font-medium">Status:</span> <span id="modalStatus">-</span></p>
                            <p><span class="font-medium">Submitted:</span> <span id="modalDate">-</span></p>
                        </div>
                    </div>
                </div>

                <!-- Question Content -->
                <div class="mb-6">
                    <h3 class="font-semibold text-gray-800 mb-3">Question</h3>
                    <div id="modalQuestion" class="p-4 bg-blue-50 border border-blue-200 rounded-lg text-gray-700">
                        <!-- Question content will be loaded here -->
                    </div>
                </div>

                <!-- Answer Section -->
                <div id="answerSection" class="mb-6">
                    <h3 class="font-semibold text-gray-800 mb-3">Your Answer</h3>
                    <textarea id="answerText" rows="8" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Provide your legal advice and answer here..."></textarea>
                </div>

                <!-- Existing Answer Display -->
                <div id="existingAnswerSection" class="hidden mb-6">
                    <h3 class="font-semibold text-gray-800 mb-3">Legal Answer</h3>
                    <div id="modalAnswer" class="p-4 bg-green-50 border border-green-200 rounded-lg text-gray-700">
                        <!-- Answer content will be loaded here -->
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-200">
                <button onclick="closeQuestionModal()" class="btn btn-outline">Close</button>
                <div class="flex gap-3">
                    <button id="submitAnswerBtn" class="btn btn-accent">
                        <i data-lucide="send" class="w-4 h-4 mr-2"></i>
                        Submit Answer
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-lawyer.dashboard-layout>

<script>
    let currentQuestion = null;

    function applyFilters() {
        const statusFilter = document.getElementById('statusFilter').value;
        const categoryFilter = document.getElementById('categoryFilter').value;

        const questionCards = document.querySelectorAll('.question-card');
        let visibleCount = 0;

        questionCards.forEach(card => {
            const cardStatus = card.getAttribute('data-status');
            const cardCategory = card.getAttribute('data-category');

            const statusMatch = !statusFilter || cardStatus === statusFilter;
            const categoryMatch = !categoryFilter || cardCategory === categoryFilter;

            if (statusMatch && categoryMatch) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        document.getElementById('resultCount').textContent = `Showing ${visibleCount} questions`;

        const noResults = document.getElementById('noResults');
        if (visibleCount === 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
    }

    function resetFilters() {
        document.getElementById('statusFilter').value = '';
        document.getElementById('categoryFilter').value = '';
        applyFilters();
    }

    function viewQuestion(question) {
        currentQuestion = question;

        document.getElementById('modalTitle').textContent = question.title;
        document.getElementById('modalSubtitle').textContent = `${question.category.replace('_', ' ')} • Legal Question`;

        document.getElementById('modalClientName').textContent = question.client_name;
        document.getElementById('modalCategory').textContent = question.category.replace('_', ' ');
        document.getElementById('modalStatus').textContent = question.status;
        document.getElementById('modalDate').textContent = question.submitted_date;
        document.getElementById('modalQuestion').textContent = question.question;

        // Show existing answer if available
        if (question.status === 'answered' && question.answer) {
            document.getElementById('answerSection').classList.add('hidden');
            document.getElementById('existingAnswerSection').classList.remove('hidden');
            document.getElementById('modalAnswer').textContent = question.answer;
            document.getElementById('submitAnswerBtn').style.display = 'none';
        } else {
            document.getElementById('answerSection').classList.remove('hidden');
            document.getElementById('existingAnswerSection').classList.add('hidden');
            document.getElementById('submitAnswerBtn').style.display = 'inline-flex';
        }

        document.getElementById('questionModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function answerQuestion(question) {
        viewQuestion(question);
        document.getElementById('answerText').focus();
    }

    function closeQuestionModal() {
        document.getElementById('questionModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        document.getElementById('answerText').value = '';
        currentQuestion = null;
    }

    // Submit answer functionality
    document.getElementById('submitAnswerBtn').addEventListener('click', function() {
        const answerText = document.getElementById('answerText').value;

        if (!answerText.trim()) {
            alert('Please provide an answer before submitting.');
            return;
        }

        if (confirm('Submit this legal answer? This action cannot be undone.')) {
            alert(`Answer submitted successfully!\n\nThe client will be notified of your response.`);
            closeQuestionModal();
            // In real implementation, this would update the backend
        }
    });

    // Close modal when clicking outside
    document.addEventListener('click', function(e) {
        if (e.target.id === 'questionModal') closeQuestionModal();
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeQuestionModal();
    });
</script>