   <div>
       @if (!$this->isAdmin())
       <div class="drawer drawer-end" x-cloak>
           <input id="help-drawer" wire:model="modalOpen" type="checkbox" class="drawer-toggle" />
           <div class="drawer-content flex justify-center items-center">
               <label for="help-drawer" class="z-199">
                   <div class="p-1.5 rounded-md hover:bg-gray-100 transition-colors tooltip hover:tooltip-open tooltip-bottom"
                       data-tip="Help & Support">
                       <i data-lucide="help-circle" class="size-5"></i>
                   </div>
               </label>
           </div>
           <div class="drawer-side z-200">
               <label for="help-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
               <div class="bg-base-200 min-h-full w-96 overflow-y-auto max-h-screen">
                   <!-- Header -->
                   <div class="flex items-center justify-between px-4 py-3 border-b border-base-300">
                       <span class="font-semibold text-lg">Help & Support</span>
                   </div>

                   <!-- Form Content -->
                   <div class="p-4 overflow-visible">
                       <!-- Success Alert -->
                       @if ($showAlert)
                       <div class="alert alert-success mb-4 rounded-lg" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => { show = false;
                                                    $wire.set('showAlert', false); }, 5000)"
                           x-transition:enter="transition ease-out duration-300"
                           x-transition:enter-start="opacity-0 transform scale-90"
                           x-transition:enter-end="opacity-100 transform scale-100"
                           x-transition:leave="transition ease-in duration-300"
                           x-transition:leave-start="opacity-100 transform scale-100"
                           x-transition:leave-end="opacity-0 transform scale-90">
                           <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                               viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                   d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                           </svg>
                           <span>{{ $alertMessage }}</span>
                       </div>
                       @endif

                       @if ($showForm)
                       <!-- Support Form -->
                       <form wire:submit.prevent="submitConcern" class="space-y-4">

                           <!-- Category -->
                           <div class="relative z-50">
                               <label for="category" class="block text-sm font-semibold text-gray-700 mb-1">Issue
                                   Category</label>
                               <div class="relative">
                                   <select id="category" wire:model="category"
                                       class="select select-bordered w-full rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent">
                                       <option value="">Select a category</option>
                                       <option value="login_access">Login & Access Issues</option>
                                       <option value="profile_account">Profile & Account Problems</option>
                                       <option value="events_volunteering">Events & Volunteering</option>
                                       <option value="technical_bugs">Technical Issues & Bugs</option>
                                       <option value="payments_donations">Payments & Donations</option>
                                       <option value="reporting_content">Report User/Content</option>
                                       <option value="feature_request">Feature Request</option>
                                       <option value="other">Other</option>
                                   </select>
                               </div>
                               @error('category')
                               <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                               @enderror
                           </div>

                           <!-- Priority Level -->
                           <div class="relative z-40">
                               <label for="priority" class="block text-sm font-semibold text-gray-700 mb-1">How
                                   urgent is
                                   this?</label>
                               <div class="relative">
                                   <select id="priority" wire:model="priority"
                                       class="select select-bordered w-full rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent">
                                       <option value="">Select priority</option>
                                       <option value="low">Low - General question</option>
                                       <option value="medium">Medium - Issue affecting experience</option>
                                       <option value="high">High - Cannot use features</option>
                                       <option value="urgent">Urgent - Completely blocked</option>
                                   </select>
                               </div>
                               @error('priority')
                               <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                               @enderror
                           </div>

                           <!-- Title/Subject -->
                           <div>
                               <label for="subject" class="block text-sm font-semibold text-gray-700 mb-1">Subject</label>
                               <input type="text" id="subject" wire:model="subject"
                                   class="input input-bordered w-full rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent"
                                   placeholder="Brief summary of your issue">
                               @error('subject')
                               <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                               @enderror
                           </div>

                           <!-- Description -->
                           <div>
                               <label for="message"
                                   class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                               <textarea id="message" wire:model="message" rows="4"
                                   class="textarea textarea-bordered w-full rounded-lg px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent"
                                   placeholder="Describe your issue with any error messages or steps taken."></textarea>
                               @error('message')
                               <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                               @enderror
                           </div>

                           <!-- Buttons -->
                           <div class="flex justify-end space-x-3 mt-6">
                               <button type="button" wire:click="closeModal" class="btn btn-outline btn-neutral font-bold">
                                   Cancel
                               </button>
                               <button type="submit" class="btn btn-primary font-bold">
                                   Submit Request
                               </button>
                           </div>
                       </form>

                       <!-- Previous Requests Section (Always visible when form is shown) -->
                       @if ($userTickets->count() > 0)
                       <div class="mt-8 pt-6 border-t border-base-300">
                           <div class="flex items-center justify-between mb-3">
                               <h3 class="text-md font-semibold">Previous Support Requests</h3>
                               <button wire:click="togglePreviousRequests" class="btn btn-ghost btn-xs text-xs">
                                   @if ($showPreviousRequests)
                                   <i data-lucide="chevron-up" class="size-4 mr-1"></i>
                                   Hide
                                   @else
                                   <i data-lucide="chevron-down" class="size-4 mr-1"></i>
                                   Show ({{ $userTickets->count() }})
                                   @endif
                               </button>
                           </div>

                           @if ($showPreviousRequests)
                           <div class="space-y-2 max-h-48 overflow-y-auto">
                               @foreach ($userTickets->take(5) as $ticket)
                               <div class="bg-base-100 p-2.5 rounded border border-base-300">
                                   <div class="flex justify-between items-start mb-1">
                                       <h4 class="font-medium text-xs truncate pr-2">
                                           {{ $ticket->subject }}
                                       </h4>
                                       <span
                                           class="badge badge-xs 
                                                                                                                                                            @if ($ticket->status === 'open') badge-warning
                                                                                                                                                            @elseif($ticket->status === 'in_progress') badge-info  
                                                                                                                                                            @elseif($ticket->status === 'resolved') badge-success
                                                                                                                                                            @else badge-neutral @endif">
                                           {{ ucfirst($ticket->status) }}
                                       </span>
                                   </div>
                                   <div class="flex justify-between items-center">
                                       <p class="text-xs text-gray-500">
                                           {{ $ticket->created_at->format('M j, Y') }}
                                       </p>
                                       @if ($ticket->status !== 'closed' && $ticket->status !== 'resolved')
                                       <button wire:click="resolveTicket({{ $ticket->id }})"
                                           class="btn btn-xs btn-success tooltip tooltip-left" data-tip="Mark as Resolved">
                                           <i data-lucide="check" class="size-3"></i>
                                       </button>
                                       @endif
                                   </div>
                               </div>
                               @endforeach
                           </div>
                           @endif
                       </div>
                       @endif
                       @else
                       <!-- Show submitted tickets and option to create new -->
                       <div class="space-y-4">
                           <!-- Recent Tickets -->
                           @if ($userTickets->count() > 0)
                           <div class="mb-6">
                               <h3 class="text-lg font-semibold mb-3">Your Recent Support Requests</h3>
                               <div class="space-y-3 max-h-60 overflow-y-auto">
                                   @foreach ($userTickets->take(3) as $ticket)
                                   <div class="bg-base-100 p-3 rounded-lg border border-base-300">
                                       <div class="flex justify-between items-start mb-2">
                                           <h4 class="font-medium text-sm">{{ $ticket->subject }}</h4>
                                           <span
                                               class="badge badge-sm 
                                                                                                                                        @if ($ticket->status === 'open') badge-warning
                                                                                                                                        @elseif($ticket->status === 'in_progress') badge-info  
                                                                                                                                        @elseif($ticket->status === 'resolved') badge-success
                                                                                                                                        @else badge-neutral @endif">
                                               {{ ucfirst($ticket->status) }}
                                           </span>
                                       </div>
                                       <p class="text-xs text-gray-600 mb-1">
                                           Category: {{ $this->formatCategoryName($ticket->category) }} |
                                           Priority: {{ $this->formatPriorityName($ticket->priority) }}
                                       </p>
                                       <div class="flex justify-between items-center">
                                           <p class="text-xs text-gray-500">
                                               {{ $ticket->created_at->format('M j, Y g:i A') }}
                                           </p>
                                           @if ($ticket->status !== 'closed' && $ticket->status !== 'resolved')
                                           <button wire:click="resolveTicket({{ $ticket->id }})"
                                               class="btn btn-xs btn-success tooltip tooltip-left"
                                               data-tip="Mark as Resolved">
                                               <i data-lucide="check" class="size-3"></i>
                                           </button>
                                           @endif
                                       </div>
                                   </div>
                                   @endforeach
                               </div>
                           </div>
                           @endif

                           <!-- Submit New Request Button -->
                           <div class="text-center">
                               <button wire:click="showNewForm" class="btn btn-primary font-bold">
                                   Submit New Support Request
                               </button>
                           </div>
                       </div>
                       @endif
                   </div>
               </div>
           </div>
       </div>
       @endif
   </div>