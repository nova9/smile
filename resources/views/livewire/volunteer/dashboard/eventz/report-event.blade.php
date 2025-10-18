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
        <div class="mt-4 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200 text-green-800 rounded-xl flex items-start gap-3 shadow-sm animate-slideIn">
            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                <i data-lucide="check" class="text-white size-5"></i>
            </div>
            <div class="flex-1">
                <p class="font-semibold mb-0.5">Success!</p>
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mt-4 p-4 bg-gradient-to-r from-red-50 to-orange-50 border-2 border-red-200 text-red-800 rounded-xl flex items-start gap-3 shadow-sm animate-slideIn">
            <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
                <i data-lucide="alert-triangle" class="text-white size-5"></i>
            </div>
            <div class="flex-1">
                <p class="font-semibold mb-0.5">Error!</p>
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Report Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-gradient-to-br from-gray-900 via-slate-800 to-gray-900 bg-opacity-60 backdrop-blur-md flex items-center justify-center z-50 animate-fadeIn" 
             wire:click="closeModal"
             x-data="{ show: false }"
             x-init="setTimeout(() => show = true, 10)"
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full mx-4 overflow-hidden transform transition-all"
                 wire:click.stop
                 x-show="show"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4">
                
                <!-- Header with gradient background -->
                <div class="bg-gradient-to-r from-red-500 to-orange-500 px-6 py-5 relative">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                            <i data-lucide="flag" class="text-white size-6"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">Report Event</h3>
                            <p class="text-white text-opacity-90 text-sm">Help us keep the community safe</p>
                        </div>
                    </div>
                    <button wire:click="closeModal" 
                            class="absolute top-4 right-4 w-8 h-8 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-full flex items-center justify-center transition-all duration-200">
                        <i data-lucide="x" class="text-white size-5"></i>
                    </button>
                </div>

                <form wire:submit.prevent="submit" class="p-6">
                    <!-- Reason Dropdown -->
                    <div class="mb-5">
                        <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                            <i data-lucide="list" class="size-4 text-red-500"></i>
                            Reason for Report <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select 
                                wire:model="reason" 
                                class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 appearance-none bg-white hover:border-gray-300 cursor-pointer"
                                required>
                                <option value="">Select a reason...</option>
                                <option value="Inappropriate Content">🚫 Inappropriate Content</option>
                                <option value="Misleading Information">⚠️ Misleading Information</option>
                                <option value="Scam or Fraud">💰 Scam or Fraud</option>
                                <option value="Safety Concerns">🛡️ Safety Concerns</option>
                                <option value="Event Cancelled">❌ Event Cancelled (No Notice)</option>
                                <option value="Duplicate Event">📋 Duplicate Event</option>
                                <option value="Other">💭 Other</option>
                            </select>
                            <i data-lucide="chevron-down" class="absolute left-3 top-1/2 -translate-y-1/2 size-5 text-gray-400 pointer-events-none"></i>
                        </div>
                        @error('reason') 
                            <div class="flex items-center gap-1 mt-2 text-red-600 text-sm">
                                <i data-lucide="alert-circle" class="size-4"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Additional Details -->
                    <div class="mb-6">
                        <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                            <i data-lucide="message-square" class="size-4 text-red-500"></i>
                            Additional Details (Optional)
                        </label>
                        <div class="relative">
                            <textarea 
                                wire:model="details" 
                                rows="4"
                                maxlength="500"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 resize-none transition-all duration-200 hover:border-gray-300"
                                placeholder="Provide more information about why you're reporting this event..."></textarea>
                            <div class="absolute bottom-3 right-3 flex items-center gap-1">
                                <div class="px-2 py-1 rounded-lg text-xs font-medium
                                    {{ strlen($details) > 450 ? 'bg-red-100 text-red-700' : (strlen($details) > 400 ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-600') }}">
                                    {{ strlen($details) }}/500
                                </div>
                            </div>
                        </div>
                        @error('details') 
                            <div class="flex items-center gap-1 mt-2 text-red-600 text-sm">
                                <i data-lucide="alert-circle" class="size-4"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Info Box -->
                    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                        <div class="flex gap-3">
                            <i data-lucide="info" class="size-5 text-blue-600 flex-shrink-0 mt-0.5"></i>
                            <div class="text-sm text-blue-800">
                                <p class="font-medium mb-1">What happens next?</p>
                                <p class="text-blue-700">Your report will be reviewed by our admin team. We'll take appropriate action to ensure community safety.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3">
                        <button 
                            type="button"
                            wire:click="closeModal"
                            class="flex-1 px-4 py-3 border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 font-medium flex items-center justify-center gap-2">
                            <i data-lucide="x" class="size-4"></i>
                            Cancel
                        </button>
                        <button 
                            type="submit"
                            wire:loading.attr="disabled"
                            class="flex-1 px-4 py-3 bg-gradient-to-r from-red-600 to-orange-600 text-white rounded-xl hover:from-red-700 hover:to-orange-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                            <span wire:loading.remove wire:target="submit">
                                <i data-lucide="send" class="size-4"></i>
                            </span>
                            <span wire:loading wire:target="submit">
                                <svg class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </span>
                            <span wire:loading.remove wire:target="submit">Submit Report</span>
                            <span wire:loading wire:target="submit">Submitting...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
