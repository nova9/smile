<x-lawyer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500/10 to-green-600/10 text-black rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-green-500/20">
                    <i data-lucide="edit-3" class="w-5 h-5 mr-2 text-green-600"></i>
                    Contract Drafting
                </div>
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800 leading-tight relative">
                        Contract <span class="text-accent">Drafting</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-green-500/30" viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Create and manage legal contracts efficiently
                    </p>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="flex justify-between items-center">
                <button class="btn btn-accent" onclick="openContractModal()">
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                    New Contract
                </button>
            </div>

            <!-- Current Contracts -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Current Drafts</h3>
                <div class="space-y-4">
                    @foreach($contracts as $contract)
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-all duration-200">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="font-semibold text-gray-800 text-lg">{{ $contract['title'] }}</h4>
                                <p class="text-sm text-gray-600">{{ $contract['type'] }}</p>
                            </div>
                            <span class="px-3 py-1 text-xs font-medium rounded-full 
                                @if($contract['status'] == 'in_progress') bg-green-100 text-green-700
                                @elseif($contract['status'] == 'draft') bg-gray-100 text-gray-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ ucfirst(str_replace('_', ' ', $contract['status'])) }}
                            </span>
                        </div>
                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-2">
                                <span>Progress</span>
                                <span>{{ $contract['progress'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: {{ $contract['progress'] }}%"></div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Created: {{ $contract['created_at'] }}</span>
                            <div class="flex gap-2">
                                <button class="btn btn-accent btn-sm">Edit</button>
                                <button class="btn btn-outline btn-sm">View</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Templates -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Contract Templates</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($templates as $template)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-all duration-200 cursor-pointer hover:border-green-300">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-green-100 rounded-full">
                                <i data-lucide="file-text" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">{{ $template['name'] }}</h4>
                                <p class="text-xs text-gray-500">{{ $template['category'] }}</p>
                            </div>
                        </div>
                        <button class="btn btn-accent btn-sm w-full">Use Template</button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <!-- Contract Template Modal -->
    <div id="contractModal" class="fixed inset-0 bg-white/95 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden border border-gray-200">
            <!-- Modal Header -->
            <div class="bg-green-600 text-white p-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold">New Contract Template</h2>
                    <button onclick="closeContractModal()" class="text-white hover:text-gray-200 transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                <p class="text-green-100 mt-2">Service Agreement Template</p>
            </div>

            <!-- Modal Content -->
            <div class="p-6 overflow-y-auto max-h-[70vh]">
                <!-- Contract Form -->
                <form class="space-y-6">
                    <!-- Client Information Section -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i data-lucide="building-2" class="w-5 h-5 text-green-600"></i>
                            Client Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Client Name</label>
                                <input type="text" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Enter client name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                                <input type="text" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Enter company name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="client@example.com">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                <input type="tel" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="+1 (555) 123-4567">
                            </div>
                        </div>
                    </div>

                    <!-- Contract Details Section -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i data-lucide="file-text" class="w-5 h-5 text-green-600"></i>
                            Contract Details
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Contract Type</label>
                                <select class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <option>Service Agreement</option>
                                    <option>Employment Contract</option>
                                    <option>NDA</option>
                                    <option>Partnership Agreement</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Contract Value</label>
                                <input type="number" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="$0.00">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                                <input type="date" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                                <input type="date" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>
                        </div>
                    </div>

                    <!-- Contract Template Preview -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i data-lucide="eye" class="w-5 h-5 text-green-600"></i>
                            Contract Template Preview
                        </h3>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                            <div class="prose max-w-none">
                                <div class="text-center mb-6">
                                    <h2 class="text-2xl font-bold text-gray-800">SERVICE AGREEMENT</h2>
                                    <p class="text-gray-600 mt-2">Contract No: SA-2024-001</p>
                                </div>

                                <div class="space-y-4 text-sm text-gray-700 leading-relaxed">
                                    <p><strong>This Service Agreement</strong> ("Agreement") is entered into on <span class="bg-yellow-200 px-1 rounded">[START_DATE]</span> between:</p>

                                    <div class="ml-4">
                                        <p><strong>Service Provider:</strong> [Your Law Firm]<br>
                                            Address: [Your Address]<br>
                                            Email: [Your Email]</p>

                                        <p class="mt-3"><strong>Client:</strong> <span class="bg-yellow-200 px-1 rounded">[CLIENT_NAME]</span><br>
                                            Company: <span class="bg-yellow-200 px-1 rounded">[COMPANY_NAME]</span><br>
                                            Email: <span class="bg-yellow-200 px-1 rounded">[CLIENT_EMAIL]</span></p>
                                    </div>

                                    <p><strong>1. SERVICES TO BE PROVIDED</strong></p>
                                    <p class="ml-4">The Service Provider agrees to provide legal consultation and advisory services as mutually agreed upon by both parties.</p>

                                    <p><strong>2. COMPENSATION</strong></p>
                                    <p class="ml-4">The Client agrees to pay <span class="bg-yellow-200 px-1 rounded">[CONTRACT_VALUE]</span> for the services outlined in this agreement.</p>

                                    <p><strong>3. TERM</strong></p>
                                    <p class="ml-4">This agreement shall commence on <span class="bg-yellow-200 px-1 rounded">[START_DATE]</span> and shall continue until <span class="bg-yellow-200 px-1 rounded">[END_DATE]</span>.</p>

                                    <p><strong>4. CONFIDENTIALITY</strong></p>
                                    <p class="ml-4">Both parties agree to maintain strict confidentiality regarding all information shared during the course of this agreement.</p>
                                </div>

                                <div class="mt-8 grid grid-cols-2 gap-8">
                                    <div class="text-center">
                                        <div class="border-t border-gray-400 pt-2">
                                            <p class="text-sm font-medium">Service Provider Signature</p>
                                            <p class="text-xs text-gray-500">Date: _______________</p>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="border-t border-gray-400 pt-2">
                                            <p class="text-sm font-medium">Client Signature</p>
                                            <p class="text-xs text-gray-500">Date: _______________</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-200">
                <button onclick="closeContractModal()" class="btn btn-outline">
                    Cancel
                </button>
                <div class="flex gap-3">
                    <button class="btn btn-outline">
                        <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                        Preview
                    </button>
                    <button class="btn btn-accent">
                        <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                        Save Draft
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-lawyer.dashboard-layout>

<script>
    function openContractModal() {
        document.getElementById('contractModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeContractModal() {
        document.getElementById('contractModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.getElementById('contractModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeContractModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeContractModal();
        }
    });
</script>