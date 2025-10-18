<div>
    <!-- Report Button -->
    <button 
        wire:click="openModal" 
        class="w-full btn btn-error btn-outline">
        <i class="fas fa-flag mr-2"></i>
        Report Event
    </button>

    <!-- Success/Error Messages -->
    @if (session()->has('success'))
        <div class="mt-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mt-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-center">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Report Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" wire:click="closeModal">
            <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full mx-4 p-6" wire:click.stop>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-bold text-gray-900">Report Event</h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form wire:submit.prevent="submit">
                    <!-- Reason Dropdown -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Reason for Report <span class="text-red-500">*</span>
                        </label>
                        <select 
                            wire:model="reason" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                            required>
                            <option value="">Select a reason...</option>
                            <option value="Inappropriate Content">Inappropriate Content</option>
                            <option value="Misleading Information">Misleading Information</option>
                            <option value="Scam or Fraud">Scam or Fraud</option>
                            <option value="Safety Concerns">Safety Concerns</option>
                            <option value="Event Cancelled">Event Cancelled (No Notice)</option>
                            <option value="Duplicate Event">Duplicate Event</option>
                            <option value="Other">Other</option>
                        </select>
                        @error('reason') 
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Additional Details -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Additional Details (Optional)
                        </label>
                        <textarea 
                            wire:model="details" 
                            rows="4"
                            maxlength="500"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 resize-none"
                            placeholder="Provide more information about why you're reporting this event..."></textarea>
                        <div class="text-right text-sm text-gray-500 mt-1">
                            {{ strlen($details) }}/500 characters
                        </div>
                        @error('details') 
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3">
                        <button 
                            type="button"
                            wire:click="closeModal"
                            class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                            Cancel
                        </button>
                        <button 
                            type="submit"
                            class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                            Submit Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
