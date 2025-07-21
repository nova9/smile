<x-lawyer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-500/10 to-gray-600/10 text-black rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-gray-500/20">
                    <i data-lucide="archive" class="w-5 h-5 mr-2 text-gray-600"></i>
                    Contract Archive
                </div>
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800 leading-tight relative">
                        Contract <span class="text-accent">Archive</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-green-500/30" viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Access and manage archived contracts
                    </p>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="flex justify-between items-center">
                <div class="flex gap-3">
                    <input type="text" placeholder="Search contracts..." class="input input-bordered w-80">
                    <select class="select select-bordered">
                        <option>All Types</option>
                        <option>Service Agreement</option>
                        <option>Employment Contract</option>
                        <option>Partnership Agreement</option>
                    </select>
                </div>
                <button class="btn btn-outline">
                    <i data-lucide="filter" class="w-4 h-4 mr-2"></i>
                    Filter
                </button>
            </div>

            <!-- Archived Contracts -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Archived Contracts</h3>
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left font-semibold text-gray-700">Contract</th>
                                <th class="text-left font-semibold text-gray-700">Type</th>
                                <th class="text-left font-semibold text-gray-700">Client</th>
                                <th class="text-left font-semibold text-gray-700">Archived</th>
                                <th class="text-left font-semibold text-gray-700">Size</th>
                                <th class="text-left font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($archivedContracts as $contract)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 bg-gray-100 rounded-full">
                                            <i data-lucide="file-text" class="w-4 h-4 text-gray-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-800">{{ $contract['title'] }}</h4>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-sm text-gray-600">{{ $contract['type'] }}</span>
                                </td>
                                <td>
                                    <span class="text-sm text-gray-600">{{ $contract['client'] }}</span>
                                </td>
                                <td>
                                    <span class="text-sm text-gray-500">{{ $contract['archived_date'] }}</span>
                                </td>
                                <td>
                                    <span class="text-sm text-gray-500">{{ $contract['file_size'] }}</span>
                                </td>
                                <td>
                                    <div class="flex gap-2">
                                        <button class="btn btn-outline btn-sm">View</button>
                                        <button class="btn btn-outline btn-sm">Download</button>
                                        <button class="btn btn-accent btn-sm">Restore</button>
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