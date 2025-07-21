<x-lawyer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500/10 to-green-600/10 text-black rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-green-500/20">
                    <i data-lucide="pen-tool" class="w-5 h-5 mr-2 text-green-600"></i>
                    Digital Signature
                </div>
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800 leading-tight relative">
                        Digital <span class="text-accent">Signature</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-green-500/30" viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Manage digital signatures and consent handling
                    </p>
                </div>
            </div>

            <!-- Pending Signatures -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Pending Signatures</h3>
                <div class="space-y-4">
                    @foreach($pendingSignatures as $signature)
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-all duration-200">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="font-semibold text-gray-800">{{ $signature['contract_title'] }}</h4>
                                <p class="text-sm text-gray-600">Client: {{ $signature['client_name'] }}</p>
                                <p class="text-xs text-gray-500">Sent: {{ $signature['sent_date'] }}</p>
                            </div>
                            <span class="px-3 py-1 text-xs font-medium rounded-full 
                                @if($signature['status'] == 'awaiting_signature') bg-orange-100 text-orange-700
                                @else bg-blue-100 text-blue-700 @endif">
                                {{ ucfirst(str_replace('_', ' ', $signature['status'])) }}
                            </span>
                        </div>
                        <div class="flex gap-3">
                            <button class="btn btn-accent btn-sm">Send Reminder</button>
                            <button class="btn btn-outline btn-sm">View Document</button>
                            <button class="btn btn-outline btn-sm">Download</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Completed Signatures -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Completed Signatures</h3>
                <div class="space-y-4">
                    @foreach($completedSignatures as $completed)
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                        <div>
                            <h4 class="font-medium text-gray-800">{{ $completed['contract_title'] }}</h4>
                            <p class="text-sm text-gray-600">{{ $completed['client_name'] }}</p>
                            <p class="text-xs text-gray-500">Signed: {{ $completed['signed_date'] }}</p>
                        </div>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
                                Completed
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