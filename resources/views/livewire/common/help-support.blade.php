<div class="drawer drawer-end" x-cloak>
    <input id="help-drawer" wire:model="modalOpen" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content">
        <label for="help-drawer" class="z-199">
            <div class="p-1.5 rounded-md hover:bg-gray-100 transition-colors tooltip hover:tooltip-open tooltip-bottom"
                data-tip="Help & Support">
                <i data-lucide="help-circle" class="size-5"></i>
            </div>
        </label>
    </div>
    <div class="drawer-side z-200">
        <label for="help-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
        <div class="bg-base-200 min-h-full w-80 overflow-y-auto max-h-screen">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-3 border-b border-base-300">
                <span class="font-semibold text-lg">Help & Support</span>
            </div>

            <!-- Form Content -->
            <div class="p-4 overflow-visible">
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
                        <label for="priority" class="block text-sm font-semibold text-gray-700 mb-1">How urgent is
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
                        <label for="message" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
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
            </div>
        </div>
    </div>
</div>

@if (session()->has('help-success'))
    <div class="fixed top-4 right-4 z-50 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg">
        {{ session('help-success') }}
    </div>
@endif

@if (session()->has('help-error'))
    <div class="fixed top-4 right-4 z-50 bg-red-500 text-white px-4 py-2 rounded-md shadow-lg">
        {{ session('help-error') }}
    </div>
@endif