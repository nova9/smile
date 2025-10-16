<div class="drawer drawer-end" x-cloak>
    <input id="drawer" wire:model="drawerOpen" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content">
        <label for="drawer" class="z-199">
            <div class="p-1.5 rounded-md hover:bg-gray-100 transition-colors tooltip hover:tooltip-open tooltip-bottom"
                data-tip="Notifications">
                <i data-lucide="bell" class="size-5"></i>
                @php $unread = $notifications->count(); @endphp
                @if ($unread)
                    <span
                        class="absolute top-0 right-0 inline-block w-4 h-4 bg-red-500 text-white text-xs rounded-full text-center leading-4">{{ $unread }}</span>
                @endif
            </div>
        </label>
    </div>
    <div class="drawer-side z-200">
        <label for="drawer" aria-label="close sidebar" class="drawer-overlay"></label>
        <div class="bg-base-200 min-h-full w-80">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-3 border-b border-base-300">
                <span class="font-semibold text-lg">Notifications</span>
            </div>
            <!-- Notification Items -->
            <ul>
                @forelse($notifications as $notification)
                    @php
                        $data = is_array($notification->data)
                            ? $notification->data
                            : json_decode($notification->data, true);
                    @endphp
                    <li class="px-4 py-3 border-b border-base-300 @if ($notification->read_at === null) bg-blue-50 @endif">
                        <div class="flex items-center gap-3">
                            <i data-lucide="info" class="size-5 text-blue-500"></i>
                            <div class="flex-1">
                                <a href="{{ $data['event_url'] ?? '#' }}" wire:click.prevent="markAsRead('{{ $notification->id }}')">
                                    <div class="font-medium">
                                        {{ $data['name'] ?? 'New notification' }}
                                    </div>
                                    <div class="text-sm text-base-content/80">
                                        {{ $data['message'] ?? '' }}
                                    </div>
                                    <div class="text-xs text-base-content/70">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </div>
                                </a>
                                @if ($notification->read_at === null)
                                    <span class="inline-block w-2 h-2 bg-blue-500 rounded-full"></span>
                                @endif
                            </div>
                    </li>
                @empty
                    <li class="px-4 py-3 text-center text-base-content/70">No notifications available.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
