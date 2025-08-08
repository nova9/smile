<div x-data="{ navClosed: $persist(false) }" class="flex h-screen overflow-hidden">
    {{--    Sidebar--}}
    <div class="z-999 border-r border-gray-200 bg-stone-50 flex flex-col p-1.5 sticky">
        <div class="flex mb-4" :class="navClosed ? '' : 'w-64'">
            <div class="flex justify-center w-full mt-2" x-show="!navClosed">
                <img src="{{ asset('storage/assets/logo.svg') }}" alt="logo" class="h-8 select-none">
            </div>
            <div class="p-1" x-show="navClosed">
                <x-common.logo class="size-8 text-primary"/>
            </div>
        </div>
        <div>
            <ul class="menu rounded-box w-full space-y-1 m-0 p-0">
                {{ $items }}
            </ul>
        </div>

        <div class="flex-1">
            {{--                spacer--}}
        </div>

        <div x-data="{ open: false }" wire:cloak>
            <div class=" rounded-md hover:bg-gray-100 p-1 transition-colors relative">
                <div class="flex items-center justify-between" @click.outside="open = false" @click="open = !open">
                    <div class="flex items-center gap-2">
                        <img src="https://picsum.photos/300/300" class="size-8 rounded-lg" alt="">
                        <div class="text-xs" x-show="!navClosed">
                            <p class="font-medium">{{ auth()->user()->name }}</p>
                            <p>{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <div class="-space-y-1.5 ml-4" x-show="!navClosed">
                        <i data-lucide="chevron-up" class="size-4"></i>
                        <i data-lucide="chevron-down" class="size-4"></i>
                    </div>
                </div>


                <div x-show="open"
                     class="absolute min-w-56 bottom-0 z-500 -right-1 translate-x-full bg-white rounded-box border border-gray-200 shadow-lg w-fit">
                    <div class="flex items-center py-1 gap-2 m-2">
                        <div class="size-8">
                            <img src="https://picsum.photos/300/300" class="rounded-lg" alt="">

                        </div>
                        <div class="text-xs">
                            <p class="font-medium">{{ auth()->user()->name }}</p>
                            <p>{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    {{--                        divider --}}
                    <div class="border-[0.5px] border-gray-200"></div>

                    <ul class="menu w-full space-y-1">
                        <li>
                            <a href="/profile" class="hover:bg-gray-100">
                                <i data-lucide="circle-user" class="size-5"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                    </ul>
                    {{--                        divider --}}
                    <div class="border-[0.5px] border-gray-200"></div>

                    <form method="POST" action="/logout">

                        <ul class="menu w-full space-y-1 text-error">
                            <li>
                                @csrf
                                <button type="submit" class="flex items-center gap-2 hover:cursor-pointer">
                                    <i data-lucide="log-out" class="size-5"></i>
                                    <span>Log out</span>
                                </button>
                            </li>
                        </ul>
                    </form>

                </div>
            </div>
        </div>
    </div>


    {{--    Main content--}}
    <div class="flex flex-col flex-grow">
        {{-- Top Bar --}}
        <div class="h-12 px-3 shrink-0 flex items-center border-b border-gray-200">
            <div class="p-1.5 rounded-md hover:bg-gray-100 transition-colors" @click="navClosed = !navClosed">
                <i data-lucide="panel-left" class="size-4 "></i>
            </div>

            {{request()->path()}}

            <div class="flex-1">
                {{--                    spacer--}}
            </div>

            <div class="flex items-center gap-2">
                <livewire:common.chat/>
                <div
                    class="p-1.5 rounded-md hover:bg-gray-100 transition-colors tooltip hover:tooltip-open tooltip-bottom"
                    data-tip="notifications">
                    <i data-lucide="bell" class="size-5"></i>
                </div>
            </div>
        </div>
        <div class="overflow-scroll">
            {{ $slot }}
        </div>
    </div>
</div>

