<x-admin.dashboard-layout>
    <div class="min-h-screen p-6">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl sm:text-5xl font-bold text-accent mb-2">
                        Help & Support
                        <span class="bg-gradient-to-r from-primary to-green-600 bg-clip-text text-transparent">
                            Management
                        </span>
                    </h1>
                    <p class="text-slate-600 text-lg">Manage user support tickets, inquiries, and technical assistance
                        requests
                    </p>
                </div>
            </div>
        </div>
        <!-- Support Tickets Section -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 p-6">
            <!-- Search & Filters -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <div class="flex gap-2 w-full md:w-auto">
                        <input type="text" wire:model.live="search" placeholder="Search tickets, users..."
                            class="input input-bordered w-full md:w-64 rounded-xl px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-accent/20 transition-all duration-200 border border-slate-200 focus:border-accent bg-white" />
                        <select wire:model.live="statusFilter"
                            class="select select-bordered rounded-xl px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-accent/20 transition-all duration-200 border border-slate-200 focus:border-accent bg-white">
                            <option value="all">All Status</option>
                            <option value="open">Open</option>
                            <option value="in_progress">In Progress</option>
                            <option value="resolved">Resolved</option>
                            <option value="closed">Closed</option>
                        </select>
                        <select wire:model.live="priorityFilter"
                            class="select select-bordered rounded-xl px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-accent/20 transition-all duration-200 border border-slate-200 focus:border-accent bg-white">
                            <option value="all">All Priority</option>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                            <option value="urgent">Urgent</option>
                        </select>
                        <select wire:model.live="categoryFilter"
                            class="select select-bordered rounded-xl px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-accent/20 transition-all duration-200 border border-slate-200 focus:border-accent bg-white">
                            <option value="all">All Categories</option>
                            <option value="login_access">Login & Access</option>
                            <option value="profile_account">Profile & Account</option>
                            <option value="events_volunteering">Events & Volunteering</option>
                            <option value="technical_bugs">Technical Issues</option>
                            <option value="payments_donations">Payments & Donations</option>
                            <option value="reporting_content">Report User/Content</option>
                            <option value="feature_request">Feature Request</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                
                <!-- Tickets Table -->
                <div class="border border-slate-200 overflow-hidden rounded-2xl shadow-sm">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Ticket ID</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">User</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Category</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Subject</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Priority</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Status</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Date</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tickets as $ticket)
                                <tr class="border-t border-slate-100 hover:bg-slate-50/50 transition-colors duration-200">
                                    <td class="px-6 py-4 text-sm font-medium text-slate-900">#{{ $ticket->id }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ $ticket->user_name }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ ucfirst(str_replace('_', ' ', $ticket->category)) }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ $ticket->subject }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-medium 
                                                            @if($ticket->priority === 'urgent') bg-gradient-to-r from-rose-100 to-red-100 text-rose-700
                                                            @elseif($ticket->priority === 'high') bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-700  
                                                            @elseif($ticket->priority === 'medium') bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700
                                                            @else bg-gradient-to-r from-slate-100 to-gray-100 text-slate-700 @endif">
                                            {{ ucfirst($ticket->priority) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-medium 
                                                            @if($ticket->status === 'open') bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-700
                                                            @elseif($ticket->status === 'in_progress') bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700
                                                            @elseif($ticket->status === 'resolved') bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-700
                                                            @else bg-gradient-to-r from-slate-100 to-gray-100 text-slate-700 @endif">
                                            @if($ticket->status === 'in_progress')
                                                <div class="w-2 h-2 bg-blue-500 rounded-full mr-2 animate-pulse"></div>
                                                Active
                                            @else
                                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ $ticket->created_at->format('M j, Y') }}</td>
                                    <td class="px-6 py-4">
                                        <button onclick="view_ticket_{{ $ticket->id }}.showModal()"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white text-slate-600 hover:bg-slate-100 transition-colors border border-slate-200 shadow-sm group relative"
                                            title="View Details">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                            <span
                                                class="absolute left-1/2 -translate-x-1/2 -top-8 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">View
                                                Details
                                            </span>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal for viewing ticket details -->
                                <dialog id="view_ticket_{{ $ticket->id }}" class="modal">
                                    <div class="modal-box w-11/12 max-w-2xl bg-white/90 backdrop-blur-sm border border-white/20 rounded-2xl">
                                        <div class="flex justify-between items-center mb-6">
                                            <h3 class="font-bold text-xl text-accent">Support Ticket Details</h3>
                                            <button onclick="view_ticket_{{ $ticket->id }}.close()"
                                                class="btn btn-sm btn-circle btn-ghost hover:bg-slate-100">✕
                                            </button>
                                        </div>
                                        <!-- Ticket Details -->
                                        <div class="mb-6">
                                            <h4 class="font-semibold text-base text-slate-700 mb-3">Ticket Information</h4>
                                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                                                <div class="space-y-2">
                                                    <p class="text-sm"><span class="font-medium text-slate-600">Ticket ID:</span>
                                                        <span class="text-slate-900">#{{ $ticket->id }}</span>
                                                    </p>
                                                    <p class="text-sm"><span class="font-medium text-slate-600">User:</span>
                                                        <span class="text-slate-900">{{ $ticket->user_name ?? ($ticket->user->name ?? 'Unknown User') }}</span>
                                                    </p>
                                                    <p class="text-sm"><span class="font-medium text-slate-600">Role:</span>
                                                        <span class="text-slate-900">
                                                        @if($ticket->user && $ticket->user->role)
                                                            {{ $ticket->user->role->name }}
                                                        @elseif($ticket->user && $ticket->user->role_id)
                                                            {{ \App\Models\Role::find($ticket->user->role_id)?->name ?? 'Unknown Role' }}
                                                        @else
                                                            N/A
                                                        @endif
                                                        </span>
                                                    </p>
                                                    <p class="text-sm"><span class="font-medium text-slate-600">Category:</span>
                                                        <span class="text-slate-900">{{ ucfirst(str_replace('_', ' ', $ticket->category)) }}</span>
                                                    </p>
                                                    <p class="text-sm"><span class="font-medium text-slate-600">Priority:</span>
                                                        <span class="text-slate-900">{{ ucfirst($ticket->priority) }}</span>
                                                    </p>
                                                    <p class="text-sm"><span class="font-medium text-slate-600">Status:</span>
                                                        <span class="text-slate-900">{{ ucfirst(str_replace('_', ' ', $ticket->status)) }}</span>
                                                    </p>
                                                    <p class="text-sm"><span class="font-medium text-slate-600">Date:</span>
                                                        <span class="text-slate-900">{{ $ticket->created_at->format('M j, Y') }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Subject -->
                                        <div class="mb-6">
                                            <h4 class="font-semibold text-base text-slate-700 mb-3">Subject</h4>
                                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                                                <p class="text-sm text-slate-900">{{ $ticket->subject }}</p>
                                            </div>
                                        </div>
                                        <!-- Message -->
                                        <div class="mb-6">
                                            <h4 class="font-semibold text-base text-slate-700 mb-3">Message</h4>
                                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                                                <p class="text-sm text-slate-900 whitespace-pre-wrap">{{ $ticket->message }}</p>
                                            </div>
                                        </div>
                                        <!-- Action Buttons -->
                                        <div class="modal-action flex gap-3">
                                            <button wire:click="chatWithUser({{ $ticket->id }})"
                                                onclick="view_ticket_{{ $ticket->id }}.close()" wire:loading.attr="disabled"
                                                wire:loading.class="opacity-75 cursor-not-allowed"
                                                class="btn btn-primary rounded-xl">
                                                <div wire:loading.remove wire:target="chatWithUser({{ $ticket->id }})">
                                                    <i data-lucide="message-circle" class="w-4 h-4 mr-1"></i>
                                                    Chat with User
                                                </div>
                                                <div wire:loading wire:target="chatWithUser({{ $ticket->id }})"
                                                    class="flex items-center">
                                                    <svg class="animate-spin h-4 w-4 mr-1"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                                            stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor"
                                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                        </path>
                                                    </svg>
                                                    Connecting...
                                                </div>
                                            </button>
                                            <button wire:click="updateStatus({{ $ticket->id }}, 'resolved')"
                                                class="btn btn-success rounded-xl">Mark as Resolved</button>
                                            <button onclick="view_ticket_{{ $ticket->id }}.close()"
                                                class="btn btn-ghost rounded-xl">Close</button>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="modal-backdrop" onclick="view_ticket_{{ $ticket->id }}.close()"></div>
                                </dialog>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center gap-4">
                                            <div
                                                class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center">
                                                <i data-lucide="inbox" class="w-8 h-8 text-slate-400"></i>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-slate-900">No support tickets found</h3>
                                                <p class="text-sm text-slate-500 mt-1">No tickets match your current filters.
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Toast -->
    @if (session()->has('success'))
        <div class="toast toast-end" id="success-toast" x-data="{ show: true }" x-show="show"
            x-init="setTimeout(() => show = false, 3000)" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-full"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform translate-x-full">
            <div class="alert alert-success rounded-xl shadow-lg border border-emerald-200 bg-emerald-50">
                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
                <span class="text-emerald-700">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Error Toast -->
    @if (session()->has('error'))
        <div class="toast toast-end">
            <div class="alert alert-error rounded-xl shadow-lg border border-rose-200 bg-rose-50">
                <i data-lucide="x-circle" class="w-4 h-4 text-rose-600"></i>
                <span class="text-rose-700">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('livewire:init', () => {
            // Handle forced modal closing when chat opens
            Livewire.on('forceCloseModal', (event) => {
                const ticketId = event.ticketId;
                const modal = document.getElementById(`view_ticket_${ticketId}`);
                if (modal && modal.open) {
                    modal.close();
                }

                // Also close any other open modals as a fallback
                setTimeout(() => {
                    document.querySelectorAll('.modal').forEach(modal => {
                        if (modal.open) {
                            modal.close();
                        }
                    });
                }, 100);
            });

            // Hide success toast when chat opens
            Livewire.on('openChat', () => {
                const successToast = document.getElementById('success-toast');
                if (successToast) {
                    // Use Alpine.js to hide the toast smoothly
                    const alpineData = Alpine.$data(successToast);
                    if (alpineData) {
                        alpineData.show = false;
                    }
                }
            });

            // Also hide success toast when chat closes or any interaction happens
            document.addEventListener('click', (e) => {
                // Hide toast when clicking anywhere outside the toast
                const successToast = document.getElementById('success-toast');
                if (successToast && !successToast.contains(e.target)) {
                    const alpineData = Alpine.$data(successToast);
                    if (alpineData) {
                        alpineData.show = false;
                    }
                }
            });
        });
    </script>
</x-admin.dashboard-layout>