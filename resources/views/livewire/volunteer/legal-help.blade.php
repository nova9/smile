<div>
    {{-- Flash Messages --}}
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" 
             class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" 
             class="fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg z-50">
            {{ session('error') }}
        </div>
    @endif

    {{-- Legal Help Sidebar Item --}}
    <li>
        <a href="#" class="hover:bg-gray-100 px-2" wire:click="requestLegalHelp">
            <i data-lucide="scale" class="size-6"></i>
            <span x-show="!navClosed">Legal Help</span>
        </a>
    </li>
</div>