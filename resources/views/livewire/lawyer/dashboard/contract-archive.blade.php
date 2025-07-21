<x-lawyer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500/10 to-green-600/10 text-black rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-green-500/20">
                    <i data-lucide="archive" class="w-5 h-5 mr-2 text-green-600"></i>
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
                        View and manage completed legal contracts
                    </p>
                </div>
            </div>

            <!-- Archive Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total Archived</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $stats['total_archived'] }}</p>
                        </div>
                        <div class="p-3 bg-gray-100 rounded-full">
                            <i data-lucide="archive" class="w-6 h-6 text-gray-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">This Month</p>
                            <p class="text-3xl font-bold text-green-600">{{ $stats['this_month'] }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full">
                            <i data-lucide="calendar" class="w-6 h-6 text-green-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total Value</p>
                            <p class="text-3xl font-bold text-accent">{{ $stats['total_value'] }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full">
                            <i data-lucide="trending-up" class="w-6 h-6 text-accent"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Avg. Completion</p>
                            <p class="text-3xl font-bold text-black">{{ $stats['avg_completion'] }}</p>
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
                    <h3 class="text-lg font-semibold text-gray-800">Archive Filters</h3>
                    <div class="flex flex-wrap gap-4">
                        <div class="relative">
                            <input type="text" id="searchFilter" placeholder="Search contracts..."
                                class="input input-bordered input-sm pl-10 w-64"
                                oninput="applyFilters()">
                            <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <select id="contractTypeFilter" class="select select-bordered select-sm" onchange="applyFilters()">
                            <option value="">All Types</option>
                            <option value="Volunteer Service Agreement">Volunteer Service Agreement</option>
                            <option value="Employment Contract">Employment Contract</option>
                            <option value="Partnership Agreement">Partnership Agreement</option>
                            <option value="NDA">NDA</option>
                        </select>
                        <select id="yearFilter" class="select select-bordered select-sm" onchange="applyFilters()">
                            <option value="">All Years</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                        </select>
                        <button class="btn btn-outline btn-sm" onclick="resetFilters()">
                            <i data-lucide="filter" class="w-4 h-4 mr-2"></i>
                            Reset Filters
                        </button>
                    </div>
                </div>
            </div>

            <!-- Archived Contracts -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">Archived Contracts</h3>
                    <div class="flex gap-2">
                        <span id="resultCount" class="text-sm text-gray-500">Showing {{ count($archivedContracts) }} contracts</span>
                        <button class="btn btn-outline btn-sm">
                            <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                            Export All
                        </button>
                    </div>
                </div>

                <div id="contractsList" class="space-y-4">
                    @foreach($archivedContracts as $contract)
                    <div class="contract-card border border-gray-200 rounded-lg p-6 hover:shadow-md transition-all duration-200 bg-gradient-to-r from-green-50/50 to-white"
                        data-type="{{ $contract['type'] }}"
                        data-year="{{ \Carbon\Carbon::parse($contract['signed_date'])->year }}">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h4 class="font-semibold text-gray-800 text-lg">{{ $contract['title'] }}</h4>
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="check-circle" class="w-4 h-4 text-green-600"></i>
                                        <span class="text-xs text-green-600 font-medium">Completed</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 text-sm text-gray-600">
                                    <span>{{ $contract['organization'] }}</span>
                                    <span class="text-gray-400">•</span>
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="scroll-text" class="w-3 h-3 text-gray-500"></i>
                                        <span>{{ $contract['type'] }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="flex items-center gap-2 mb-1">
                                    <i data-lucide="calendar" class="w-3 h-3 text-gray-500"></i>
                                    <span class="text-xs text-gray-500">{{ $contract['signed_date'] }}</span>
                                </div>
                                <div class="flex gap-2">
                                    <button class="btn btn-outline btn-sm" onclick="viewArchivedContract({{ json_encode($contract) }})">
                                        <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                        View
                                    </button>
                                    <button class="btn btn-success btn-sm" onclick="downloadArchivedContract({{ json_encode($contract) }})">
                                        <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                                        Download
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- No Results Message -->
                <div id="noResults" class="hidden text-center py-12">
                    <i data-lucide="archive" class="w-16 h-16 mx-auto text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-600 mb-2">No contracts found</h3>
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

    <!-- Archive View Modal -->
    <div id="archiveViewModal" class="fixed inset-0 bg-white/95 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden border border-gray-200">
            <!-- Modal Header -->
            <div class="bg-gray-800 text-white p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 id="archiveModalTitle" class="text-2xl font-bold">Archived Contract</h2>
                        <p id="archiveModalSubtitle" class="text-gray-300 mt-1">Contract details and history</p>
                    </div>
                    <button onclick="closeArchiveViewModal()" class="text-white hover:text-gray-200 transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="p-6 overflow-y-auto max-h-[70vh]">
                <!-- Contract Information -->
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <h3 class="font-semibold text-green-800 mb-3">Contract Information</h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p><span class="font-medium">Contract ID:</span> <span id="modalContractId" class="font-mono">-</span></p>
                            <p><span class="font-medium">Organization:</span> <span id="modalOrganization">-</span></p>
                            <p><span class="font-medium">Type:</span> <span id="modalType">-</span></p>
                        </div>
                        <div>
                            <p><span class="font-medium">Value:</span> <span id="modalValue">-</span></p>
                            <p><span class="font-medium">Signed Date:</span> <span id="modalSignedDate">-</span></p>
                            <p><span class="font-medium">Archived Date:</span> <span id="modalArchivedDate">-</span></p>
                        </div>
                    </div>
                </div>

                <!-- Full Contract Details -->
                <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                    <h3 class="font-semibold text-gray-800 mb-3">Contract Details</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div>
                            <span class="font-medium text-gray-700">Duration:</span>
                            <p id="modalDuration" class="text-gray-600">-</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Completion Time:</span>
                            <p id="modalCompletionTime" class="text-gray-600">-</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Status:</span>
                            <span id="modalFinalStatus" class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">-</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Last Accessed:</span>
                            <p id="modalLastAccessed" class="text-gray-600">-</p>
                        </div>
                    </div>
                </div>

                <!-- Contract Preview -->
                <div id="archivedContractPreview" class="prose max-w-none">
                    <!-- Contract content will be loaded here -->
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-200">
                <button onclick="closeArchiveViewModal()" class="btn btn-outline">Close</button>
                <div class="flex gap-3">
                    <button class="btn btn-outline" onclick="shareContract(currentArchivedContract)">
                        <i data-lucide="share" class="w-4 h-4 mr-2"></i>
                        Share
                    </button>
                    <button id="downloadArchivedBtn" class="btn btn-success">
                        <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                        Download PDF
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-lawyer.dashboard-layout>

<script>
    let currentArchivedContract = null;
    let allContracts = @json($archivedContracts);

    function viewArchivedContract(contract) {
        currentArchivedContract = contract;

        // Update modal header
        document.getElementById('archiveModalTitle').textContent = contract.title;
        document.getElementById('archiveModalSubtitle').textContent = `${contract.type} • Archived Contract`;

        // Update contract information
        document.getElementById('modalContractId').textContent = contract.contract_id;
        document.getElementById('modalOrganization').textContent = contract.organization;
        document.getElementById('modalType').textContent = contract.type;
        document.getElementById('modalValue').textContent = contract.value;
        document.getElementById('modalSignedDate').textContent = contract.signed_date;
        document.getElementById('modalArchivedDate').textContent = contract.archived_date;

        // Update detailed information
        document.getElementById('modalDuration').textContent = contract.duration;
        document.getElementById('modalCompletionTime').textContent = contract.completion_time;
        document.getElementById('modalFinalStatus').textContent = contract.final_status;
        document.getElementById('modalLastAccessed').textContent = contract.last_accessed || 'Never';

        // Generate archived contract preview
        const contractHTML = generateArchivedContractHTML(contract);
        document.getElementById('archivedContractPreview').innerHTML = contractHTML;

        // Set download handler
        document.getElementById('downloadArchivedBtn').onclick = () => downloadArchivedContract(contract);

        document.getElementById('archiveViewModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeArchiveViewModal() {
        document.getElementById('archiveViewModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        currentArchivedContract = null;
    }

    function applyFilters() {
        const searchQuery = document.getElementById('searchFilter').value.toLowerCase();
        const typeFilter = document.getElementById('contractTypeFilter').value;
        const yearFilter = document.getElementById('yearFilter').value;

        const contractCards = document.querySelectorAll('.contract-card');
        let visibleCount = 0;

        contractCards.forEach(card => {
            const cardType = card.getAttribute('data-type');
            const cardYear = card.getAttribute('data-year');
            const cardTitle = card.querySelector('h4').textContent.toLowerCase();
            const cardOrganization = card.querySelector('.text-gray-600').textContent.toLowerCase();

            const searchMatch = !searchQuery ||
                cardTitle.includes(searchQuery) ||
                cardOrganization.includes(searchQuery);
            const typeMatch = !typeFilter || cardType === typeFilter;
            const yearMatch = !yearFilter || cardYear === yearFilter;

            if (searchMatch && typeMatch && yearMatch) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Update result count
        document.getElementById('resultCount').textContent = `Showing ${visibleCount} contracts`;

        // Show/hide no results message
        const noResults = document.getElementById('noResults');
        if (visibleCount === 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
    }

    function resetFilters() {
        document.getElementById('searchFilter').value = '';
        document.getElementById('contractTypeFilter').value = '';
        document.getElementById('yearFilter').value = '';
        applyFilters();
    }

    function downloadArchivedContract(contract) {
        alert(`Downloading archived contract: "${contract.title}"\n\nContract ID: ${contract.contract_id}\nSigned: ${contract.signed_date}\n\nThe PDF would be generated and downloaded in a real implementation.`);
    }

    function shareContract(contract) {
        const shareText = `Contract: ${contract.title}\nOrganization: ${contract.organization}\nType: ${contract.type}\nCompleted: ${contract.signed_date}`;

        if (navigator.share) {
            navigator.share({
                title: contract.title,
                text: shareText,
                url: window.location.href
            });
        } else {
            // Fallback - copy to clipboard
            navigator.clipboard.writeText(shareText).then(() => {
                alert('Contract details copied to clipboard!');
            });
        }
    }

    function generateArchivedContractHTML(contract) {
        const baseHTML = `
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">${contract.type.toUpperCase()}</h2>
                <p class="text-gray-600 mt-2">Contract No: ${contract.contract_id}</p>
                <div class="mt-2 inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                    <span>Completed & Archived</span>
                </div>
            </div>
        `;

        if (contract.type === 'Volunteer Service Agreement') {
            return baseHTML + `
                <div class="space-y-4 text-sm text-gray-700 leading-relaxed">
                    <p><strong>This Volunteer Service Agreement</strong> was completed on ${contract.signed_date} between:</p>

                    <div class="ml-4 space-y-4 mb-6">
                        <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                            <p class="font-semibold text-green-800 mb-3">ORGANIZATION:</p>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p><strong>Organization:</strong> ${contract.organization}</p>
                                    <p><strong>Representative:</strong> ${contract.representative || 'Not specified'}</p>
                                </div>
                                <div>
                                    <p><strong>Contract Value:</strong> ${contract.value}</p>
                                    <p><strong>Duration:</strong> ${contract.duration}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
                        <p class="font-semibold text-gray-800 mb-3">LEGAL EXECUTION:</p>
                        <p class="text-gray-700">✓ This contract has been legally executed with digital signature</p>
                        <p class="text-sm text-gray-600 mt-2">
                            Lawyer: {{ auth()->user()->name }}<br>
                            License: [LICENSE_NUMBER]<br>
                            Signature Date: ${contract.signed_date}
                        </p>
                    </div>
                </div>
            `;
        }

        return baseHTML + `
            <div class="space-y-4 text-sm text-gray-700 leading-relaxed">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p><strong>Contract Title:</strong> ${contract.title}</p>
                        <p><strong>Organization:</strong> ${contract.organization}</p>
                        <p><strong>Contract Value:</strong> ${contract.value}</p>
                    </div>
                    <div>
                        <p><strong>Signed Date:</strong> ${contract.signed_date}</p>
                        <p><strong>Archived Date:</strong> ${contract.archived_date}</p>
                        <p><strong>Status:</strong> <span class="text-green-600 font-medium">${contract.final_status}</span></p>
                    </div>
                </div>
            </div>
        `;
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(e) {
        if (e.target.id === 'archiveViewModal') closeArchiveViewModal();
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeArchiveViewModal();
    });
</script>