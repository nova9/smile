<x-lawyer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500/10 to-green-600/10 text-black rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-green-500/20">
                    <i data-lucide="settings" class="w-5 h-5 mr-2 text-green-600"></i>
                    Contract Customization
                </div>
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800 leading-tight relative">
                        Contract <span class="text-accent">Customization</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-green-500/30" viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Customize contract templates and clauses
                    </p>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="flex justify-between items-center">
                <button class="btn btn-accent">
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                    Create Template
                </button>
            </div>

            <!-- Template Management -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Template Management</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($templates as $template)
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-all duration-200">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-green-100 rounded-full">
                                <i data-lucide="file-text" class="w-5 h-5 text-green-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">{{ $template['name'] }}</h4>
                                <p class="text-sm text-gray-600">{{ $template['category'] }}</p>
                            </div>
                        </div>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Last modified:</span>
                                <span class="text-gray-500">{{ $template['last_modified'] }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Usage count:</span>
                                <span class="text-gray-500">{{ $template['usage_count'] }}</span>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button class="btn btn-accent btn-sm flex-1">Edit</button>
                            <button class="btn btn-outline btn-sm">Copy</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Custom Fields -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">Custom Fields</h3>
                    <button class="btn btn-accent btn-sm">
                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                        Add Field
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left font-semibold text-gray-700">Field Name</th>
                                <th class="text-left font-semibold text-gray-700">Type</th>
                                <th class="text-left font-semibold text-gray-700">Required</th>
                                <th class="text-left font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customFields as $field)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="font-medium text-gray-800">{{ $field['name'] }}</td>
                                <td class="text-gray-600">{{ $field['type'] }}</td>
                                <td>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full 
                                        @if($field['required']) bg-red-100 text-red-700 
                                        @else bg-gray-100 text-gray-700 @endif">
                                        {{ $field['required'] ? 'Required' : 'Optional' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="flex gap-2">
                                        <button class="btn btn-outline btn-sm">Edit</button>
                                        <button class="btn bg-red-600 text-white btn-sm hover:bg-red-700">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</x-lawyer.dashboard-layout>