<div>
    <div x-data="{ open: true }" class="flex h-screen">
        <div class="border-r border-gray-200 bg-stone-50 flex flex-col">
            <div class="m-6">
                <img src="{{ asset('storage/assets/logo.svg') }}" alt="logo" class="h-8 select-none">
            </div>
            <div>
                <ul class="menu rounded-box w-full space-y-1">
                    <li>
                        <a href="/requester/dashboard" class="hover:bg-gray-100" wire:current="menu-active">
                            <i data-lucide="house" class="size-5"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/requester/events" class="hover:bg-gray-100" wire:current="menu-active">
                            <i data-lucide="calendar" class="size-5"></i>
                            <span>Events</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="flex-1">
                {{--                spacer--}}
            </div>

            <div x-data="{ open: false }">
                <div class="px-2 m-2 rounded-md hover:bg-gray-100 relative">
                    <div class="flex items-center py-1 gap-2" @click.outside="open = false" @click="open = !open">
                        <img src="https://picsum.photos/300/300" class="size-8 rounded-full" alt="">
                        <div class="text-xs">
                            <p class="font-medium">Thathsara Madusha</p>
                            <p>thathsaramadhhusha@gmail.com</p>
                        </div>
                        <div class="-space-y-1.5 ml-4">
                            <i data-lucide="chevron-up" class="size-4"></i>
                            <i data-lucide="chevron-down" class="size-4"></i>
                        </div>
                    </div>


                    <div x-show="open" class="absolute bottom-0 -right-1 translate-x-full bg-white rounded-box border border-gray-200 shadow-lg">
                        <div class="flex items-center py-1 gap-2 m-2">
                            <img src="https://picsum.photos/300/300" class="size-8 rounded-full" alt="">
                            <div class="text-xs">
                                <p class="font-medium">Thathsara Madusha</p>
                                <p>thathsaramadhhusha@gmail.com</p>
                            </div>
                        </div>
{{--                        divider --}}
                        <div class="border-[0.5px] border-gray-200"></div>

                        <ul class="menu w-full space-y-1">
                            <li>
                                <a href="/requester/upgrade" class="hover:bg-gray-100">
                                    <i data-lucide="sparkles" class="size-5"></i>
                                    <span>Upgrade to Pro</span>
                                </a>
                            </li>
                            <li>
                                <a href="/requester/profile" class="hover:bg-gray-100">
                                    <i data-lucide="circle-user" class="size-5"></i>
                                    <span>Profile</span>
                                </a>
                            </li>
                        </ul>
                        {{--                        divider --}}
                        <div class="border-[0.5px] border-gray-200"></div>

                        <ul class="menu w-full space-y-1 text-error">
                            <li>
                                    <form class="hover:bg-gray-100" method="POST" action="/logout">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-2">
                                            <i data-lucide="log-out" class="size-5"></i>
                                            <span>Log out</span>
                                        </button>
                                    </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="flex flex-col flex-grow">
            <div class="h-14 px-3 flex items-center border-b border-gray-200">
                <div class="p-1.5 rounded-md hover:bg-gray-100 transition-colors">
                    <i data-lucide="panel-left" class="size-4 "></i>
                </div>

                <div class="flex-1">
                    {{--                    spacer--}}
                </div>

                <div class="flex items-center gap-2">
                    <div class="p-1.5 rounded-md hover:bg-gray-100 transition-colors">
                        <i data-lucide="message-circle" class="size-5"></i>
                    </div>
                    <div class="p-1.5 rounded-md hover:bg-gray-100 transition-colors">
                        <i data-lucide="bell" class="size-5"></i>
                    </div>
                </div>
            </div>
            <div class="p-2">
                contnet
            </div>
        </div>
    </div>


</div>
