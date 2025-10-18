<x-admin.dashboard-layout>
    <!-- Header Section (matching Dispute Handling style) -->
    <div class="mb-8 mt-8 ml-4 lg:ml-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl sm:text-5xl font-bold text-accent mb-2">
                    Help & Support
                    <span class="bg-gradient-to-r from-primary to-green-600 bg-clip-text text-transparent">
                        Management
                    </span>
                </h1>
                <p class="text-slate-600 text-lg">Manage user support tickets, inquiries, and technical assistance requests
                </p>
            </div>
            <!-- Optionally, you can add a badge or quick action here if needed -->
        </div>
    </div>
    <div class="px-4 sm:px-6 lg:px-8 py-8 ml-4 lg:ml-8">
        <div class="tabs tabs-lift">
            <!-- Support Tickets Tab -->
            <label class="tab flex gap-1">
                <input type="radio" name="support_tabs" checked="checked" />
                <i class="fas fa-headset mr-2 text-primary"></i>
                <span class="font-semibold">Support Tickets</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <!-- Search & Filters -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <div class="flex gap-2 w-full md:w-auto">
                        <input type="text" wire:model.live="search" placeholder="Search tickets, users..."
                            class="input input-bordered w-full md:w-64 rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent" />
                        <select wire:model.live="statusFilter"
                            class="select select-bordered rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent">
                            <option value="all">All Status</option>
                            <option value="open">Open</option>
                            <option value="in_progress">In Progress</option>
                            <option value="resolved">Resolved</option>
                            <option value="closed">Closed</option>
                        </select>
                        <select wire:model.live="priorityFilter"
                            class="select select-bordered rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent">
                            <option value="all">All Priority</option>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                            <option value="urgent">Urgent</option>
                        </select>
                        <select wire:model.live="categoryFilter"
                            class="select select-bordered rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent">
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
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-3xl shadow-xl">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent rounded-tl-3xl">Ticket ID
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">User</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Category</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Subject</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Priority</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Status</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Date</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent rounded-tr-3xl">Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tickets as $ticket)
                                <tr>
                                    <td class="px-6 py-4">#{{ $ticket->id }}</td>
                                    <td class="px-6 py-4">{{ $ticket->user_name }}</td>
                                    <td class="px-6 py-4">{{ ucfirst(str_replace('_', ' ', $ticket->category)) }}</td>
                                    <td class="px-6 py-4">{{ $ticket->subject }}</td>
                                    <td class="px-6 py-4">
                                        <span class="badge 
                                            @if($ticket->priority === 'urgent') badge-error
                                            @elseif($ticket->priority === 'high') badge-warning  
                                            @elseif($ticket->priority === 'medium') badge-info
                                            @else badge-neutral @endif badge-sm">
                                            {{ ucfirst($ticket->priority) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <select wire:change="updateStatus({{ $ticket->id }}, $event.target.value)"
                                            class="select select-bordered select-xs
                                            @if($ticket->status === 'open') border-blue-300 text-blue-700
                                            @elseif($ticket->status === 'in_progress') border-yellow-300 text-yellow-700
                                            @elseif($ticket->status === 'resolved') border-green-300 text-green-700
                                            @else border-gray-300 text-gray-700 @endif">
                                            <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open
                                            </option>
                                            <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress
                                            </option>
                                            <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Resolved
                                            </option>
                                            <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed
                                            </option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4">{{ $ticket->created_at->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <button onclick="view_ticket_{{ $ticket->id }}.showModal()"
                                            class="font-bold flex items-center justify-center w-10 h-10 rounded-xl bg-white text-black hover:bg-black/10 transition group relative"
                                            title="View Details">
                                            <i data-lucide="eye" class="w-5 h-5"></i>
                                            <span class="absolute left-1/2 -translate-x-1/2 -top-8 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">View Details
                                            </span>
                                        </button>
                                        <button wire:click="resolveTicket({{ $ticket->id }})"
                                            class="font-bold flex items-center justify-center w-10 h-10 rounded-xl bg-white text-black hover:bg-black/10 transition group relative"
                                            title="Resolve">
                                            <i data-lucide="check-circle" class="w-5 h-5"></i>
                                            <span class="absolute left-1/2 -translate-x-1/2 -top-8 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Resolve
                                            </span>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal for viewing ticket details -->
                                <dialog id="view_ticket_{{ $ticket->id }}" class="modal">
                                    <div class="modal-box w-11/12 max-w-2xl">
                                        <div class="flex justify-between items-center mb-4">
                                            <h3 class="font-bold text-lg">Support Ticket Details</h3>
                                            <button onclick="view_ticket_{{ $ticket->id }}.close()" class="btn btn-sm btn-circle btn-ghost">✕
                                            </button>
                                        </div>
                                        <!-- Ticket Details -->
                                        <div class="mb-4">
                                            <h4 class="font-semibold text-base-content mb-2">Ticket Information</h4>
                                            <div class="bg-base-200 p-4 rounded-lg">
                                                <div class="space-y-1">
                                                    <p class="text-sm"><span class="font-medium">Ticket ID:</span> #{{ $ticket->id }}
                                                    </p>
                                                    <p class="text-sm"><span class="font-medium">User:</span> {{ $ticket->user_name }}
                                                    </p>
                                                    <p class="text-sm"><span class="font-medium">Role:</span> {{ ucfirst($ticket->user_role) }}
                                                    </p>
                                                    <p class="text-sm"><span class="font-medium">Category:</span> {{ ucfirst(str_replace('_', ' ', $ticket->category)) }}
                                                    </p>
                                                    <p class="text-sm"><span class="font-medium">Priority:</span> {{ ucfirst($ticket->priority) }}
                                                    </p>
                                                    <p class="text-sm"><span class="font-medium">Status:</span> {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                                    </p>
                                                    <p class="text-sm"><span class="font-medium">Date:</span> {{ $ticket->created_at->format('Y-m-d') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Subject -->
                                        <div class="mb-4">
                                            <h4 class="font-semibold text-base-content mb-2">Subject</h4>
                                            <div class="bg-base-200 p-4 rounded-lg">
                                                <p class="text-sm">{{ $ticket->subject }}</p>
                                            </div>
                                        </div>
                                        <!-- Message -->
                                        <div class="mb-6">
                                            <h4 class="font-semibold text-base-content mb-2">Message</h4>
                                            <div class="bg-base-200 p-4 rounded-lg">
                                                <p class="text-sm whitespace-pre-wrap">{{ $ticket->message }}</p>
                                            </div>
                                        </div>
                                        <!-- Action Buttons -->
                                        <div class="modal-action flex gap-2">
                                            <button wire:click="updateStatus({{ $ticket->id }}, 'resolved')" class="btn btn-outline btn-success">Mark as Resolved</button>
                                            <button onclick="view_ticket_{{ $ticket->id }}.close()" class="btn btn-outline btn-neutral">Close</button>
                                        </div>
                                    </div>
                                    <div class="modal-backdrop" onclick="view_ticket_{{ $ticket->id }}.close()"></div>
                                </dialog>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center gap-4">
                                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                                <i data-lucide="inbox" class="w-8 h-8 text-gray-400"></i>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">No support tickets found</h3>
                                                <p class="text-sm text-gray-500 mt-1">No tickets match your current filters.</p>
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
        <div class="toast toast-end">
            <div class="alert alert-success">
                <i data-lucide="check-circle" class="w-4 h-4"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif
</x-admin.dashboard-layout>
