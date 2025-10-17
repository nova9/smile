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
        <div class="bg-base-200 min-h-full w-80">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-3 border-b border-base-300">
                <span class="font-semibold text-lg">Help & Support</span>
            </div>

            <!-- Form Content -->
            <div class="p-4">
                <form wire:submit.prevent="submitConcern" class="space-y-4">

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-base-content mb-1">Email</label>
                        <input type="email" id="email" wire:model="email"
                            class="w-full px-3 py-2 border border-base-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary bg-base-100"
                            placeholder="your.email@example.com">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Title/Subject -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-base-content mb-1">Title</label>
                        <input type="text" id="subject" wire:model="subject"
                            class="w-full px-3 py-2 border border-base-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary bg-base-100"
                            placeholder="Brief description of your issue">
                        @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="message"
                            class="block text-sm font-medium text-base-content mb-1">Description</label>
                        <textarea id="message" wire:model="message" rows="6"
                            class="w-full px-3 py-2 border border-base-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary bg-base-100"
                            placeholder="Please provide detailed information about your support request..."></textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" wire:click="closeModal"
                            class="px-4 py-2 text-sm font-medium text-base-content bg-base-100 border border-base-300 rounded-md hover:bg-base-200">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700">
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