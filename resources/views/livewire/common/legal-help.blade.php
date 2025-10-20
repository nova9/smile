<div>
    {{-- Legal Help Sidebar Item --}}
        <a href="#"

           wire:click="requestLegalHelp"
           wire:loading.attr="disabled"
           wire:loading.class="opacity-75 cursor-not-allowed">
            <div wire:loading.remove wire:target="requestLegalHelp" class="flex items-center gap-3">
                <span x-show="!navClosed"  class="p-1 rounded-sm drawer-button hover:bg-neutral-200 transition-colors tooltip hover:tooltip-open tooltip-bottom" data-tip="legal help">
                    <i data-lucide="gavel"></i>
                </span>
            </div>
            <div wire:loading wire:target="requestLegalHelp" class="flex items-center gap-2">
                <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span x-show="!navClosed" class="text-sm">Connecting...</span>
            </div>
        </a>
</div>
