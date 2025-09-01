<x-requester.dashboard-layout>
    <div class="container mx-auto mt-4 px-4">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-primary">My Events</h1>
                <p class="text-neutral-500">You can manage event you organize here</p>
            </div>
            <a href="/requester/dashboard/my-events/create" wire:navigate>
                <button class="btn btn-primary">
                    + Create New Event

                </button>
            </a>
        </div>

{{--        Search--}}
        <div class="relative mb-2">
            <input wire:model.live="search" class="input focus:outline-0 w-full" type="text" placeholder="Search">
            <div class="absolute z-10 right-0 top-1/2 -translate-y-1/2 mr-3 pointer-events-none">
                <i data-lucide="search" class="text-gray-400"></i>
            </div>
        </div>

        <div class="overflow-x-auto bg-base-100 rounded-lg shadow border border-gray-50">
            <table class="table w-full">
                <thead>
                <tr class="bg-gray-100 text-base-content/80">
                    <th class="py-3 px-4 text-left">Event</th>
                    <th class="py-3 px-4 text-left">Description</th>
                    <th class="py-3 px-4 text-left">Tags</th>
                    <th class="py-3 px-4 text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($events as $event)

                    <tr class="hover:bg-base-300/40 transition">
                        <td class="py-3 px-4 font-semibold text-primary">
                            <a href="{{ route('requester.event.show', $event->id) }}"
                               wire:navigate>{{ $event->name }}
                            </a>
                        </td>
                        <td class="py-3 px-4 text-base-content max-w-[350px]">
                            <span class="line-clamp-3 overflow-hidden">{{ $event->description }}</span>
                        </td>
                        <td>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($event->tags->take(2) as $tag)
                                    <span class="badge text-xs rounded-full badge-primary">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td class=" flex gap-2 justify-end">
                            <button class="btn btn-sm">
                                <a href="{{ route('requester.event.edit', $event->id) }}" wire:navigate>Edit</a>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-6 text-center text-base-content/60">
                            <p class="text-lg">No events found.</p>
                            <p class="text-sm">You haven't created any events yet. Click "Create New Event" to get
                                started!</p>
                        </td>
                    </tr>

                @endforelse

                <!-- End example rows -->
                </tbody>
            </table>
        </div>
        <div class="mt-8 text-center text-base-content/60 text-sm">
            <!-- Placeholder for empty state -->
            <!-- <p>You haven't created any events yet. Click "Create New Event" to get started!</p> -->
        </div>
    </div>
</x-requester.dashboard-layout>
