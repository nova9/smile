<div x-data="{ open: false }" wire:cloak>
    <div class=" rounded-md hover:bg-gray-100 p-1 transition-colors relative">
        <div class="flex items-center justify-between" @click.outside="open = false" @click="open = !open">
            <div class="flex items-center gap-2">
                <x-common.avatar size="32" :src="$profilePicture" :name="auth()->user()->name" />
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
                <x-common.avatar size="32" :src="$profilePicture" :name="auth()->user()->name" />
                <div class="text-xs">
                    <p class="font-medium">{{ auth()->user()->name }}</p>
                    <p>{{ auth()->user()->email }}</p>
                </div>
            </div>
            {{-- divider --}}
            <div class="border-[0.5px] border-gray-200"></div>

            <ul class="menu w-full space-y-1">
                <li>
                    <a href="/profile" class="hover:bg-gray-100">
                        <i data-lucide="circle-user" class="size-5"></i>
                        <span>Profile</span>
                    </a>
                </li>
                @if (auth()->user()->role->name == 'requester')
                    @if (auth()->user()->upgrade()->exists())
                        <div>
                            <div
                                class="relative overflow-hidden bg-gradient-to-r from-amber-400/20 via-yellow-500/20 to-orange-500/20 rounded-lg border border-amber-300/30 p-3 cursor-default">
                                <!-- Shimmer overlay -->
                                <div
                                    class="absolute inset-0 -skew-x-12 -translate-x-full bg-gradient-to-r from-transparent via-white/20 to-transparent animate-pulse">
                                </div>

                                <div class="relative flex items-center gap-3">
                                    <div class="relative">
                                        <i data-lucide="crown" class="size-6 text-amber-600"></i>
                                        <!-- Glow effect -->
                                        <div class="absolute inset-0 -m-1 bg-amber-400/30 rounded-full blur-sm"></div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-amber-800 text-sm">Organization</span>
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-sm">
                                                Premium
                                            </span>
                                        </div>
                                        <p class="text-xs text-amber-700/80 mt-0.5">Enhanced features unlocked</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <li>
                            <a href="/requester/dashboard/upgrade"
                                class="hover:bg-gradient-to-r hover:from-primary/10 hover:to-green-600/10 hover:text-primary transition-all duration-200">
                                <i data-lucide="building-2" class="size-5"></i>
                                <span>Upgrade</span>
                                <span class="badge badge-primary badge-sm ml-auto">New</span>
                            </a>
                        </li>
                    @endif

                @endif
            </ul>
            {{-- divider --}}
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
