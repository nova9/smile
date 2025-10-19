<div x-data="{ navClosed: $persist(false) }" class="flex h-screen overflow-hidden">
    {{-- Sidebar --}}
    <div class="z-100 border-r border-gray-200 bg-stone-50 flex flex-col p-1.5 sticky">
        <div class="flex mb-4" :class="navClosed ? '' : 'w-64'">
            <div class="flex justify-center w-full mt-2" x-show="!navClosed">
                <img src="{{ asset('storage/assets/logo.svg') }}" alt="logo" class="h-8 select-none">
            </div>
            <div class="p-1" x-show="navClosed">
                <x-common.logo class="size-8 text-primary" />
            </div>
        </div>
        <div>
            <ul class="menu rounded-box w-full space-y-1 m-0 p-0">
                {{ $items }}
            </ul>
        </div>

        <div class="flex-1">
            {{-- spacer --}}
        </div>

        <livewire:common.user-nav />
    </div>


    {{-- Main content --}}
    <div class="flex flex-col flex-grow">
        {{-- Top Bar --}}
        <div class="h-12 px-3 shrink-0 flex items-center border-b border-gray-200">
            <div class="p-1.5 rounded-md hover:bg-gray-100 transition-colors" @click="navClosed = !navClosed">
                <i data-lucide="panel-left" class="size-4 "></i>
            </div>

            {{--            {{request()->path()}} --}}

            <div class="flex-1">
                {{-- spacer --}}
            </div>

            <div class="flex ">
                @if(auth()->user()->role['name'] == 'volunteer' || auth()->user()->role['name'] == 'requester')
                <livewire:common.legal-help />
                @endif
                <livewire:common.notification />
                <livewire:common.help-support />
                <livewire:common.chat />
               
                <livewire:common.chatbot />

            </div>
        </div>
        <div class="overflow-scroll">
            {{ $slot }}
        </div>


    </div>

</div>
