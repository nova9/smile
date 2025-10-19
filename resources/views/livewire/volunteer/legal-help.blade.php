<div>
    {{-- Toast Notifications --}}
    @if (session()->has('success'))
        <div 
            x-data="{ show: false }" 
            x-init="show = true; setTimeout(() => show = false, 4000)" 
            x-show="show" 
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0"
            class="fixed top-4 right-4 bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4 rounded-lg shadow-xl border border-green-400" 
            style="z-index: 1000000;"
        >
            <div class="flex items-center gap-3">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <div>
                    <div class="font-semibold">Connected Successfully!</div>
                    <div class="text-sm text-green-100">{{ session('success') }}</div>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div 
            x-data="{ show: false }" 
            x-init="show = true; setTimeout(() => show = false, 5000)" 
            x-show="show" 
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0"
            class="fixed top-4 right-4 bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-4 rounded-lg shadow-xl border border-red-400" 
            style="z-index: 1000000;"
        >
            <div class="flex items-center gap-3">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <div>
                    <div class="font-semibold">Connection Failed</div>
                    <div class="text-sm text-red-100">{{ session('error') }}</div>
                </div>
            </div>
        </div>
    @endif

    {{-- Legal Help Sidebar Item --}}
    <li>
        <a href="#" 
           class="hover:bg-gray-100 px-2" 
           wire:click="requestLegalHelp" 
           wire:loading.attr="disabled"
           wire:loading.class="opacity-75 cursor-not-allowed">
            <i data-lucide="gavel" class="size-6" wire:loading.remove wire:target="requestLegalHelp"></i>
            <svg wire:loading wire:target="requestLegalHelp" class="animate-spin size-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span x-show="!navClosed">Legal Help</span>
        </a>
    </li>
</div>