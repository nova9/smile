<x-requester.dashboard-layout>
    <div class="container mx-auto py-8 px-4">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-primary">My Events</h1>
            <a href="/requester/dashboard/my-events/create">
                <button class="btn btn-primary">
                    + Create New Event

                </button>
            </a>
        </div>
        <div class="overflow-x-auto bg-base-100 rounded-lg shadow border border-base-200">
            <table class="table w-full">
                <thead>
                    <tr class="bg-base-200 text-base-content/80">
                        <th class="py-3 px-4 text-left">Event</th>
                        <th class="py-3 px-4 text-left">Description</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th class="py-3 px-4 text-left">Volunteers</th>
                        <th class="py-3 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-base-300/40 transition">
                        <td class="py-3 px-4 font-semibold text-primary">Community Clean-Up</td>
                        <td class="py-3 px-4 text-base-content">Help us clean the local park. Volunteers needed for various tasks.</td>
                        <td class="py-3 px-4"><span class="badge badge-success">Open</span></td>
                        <td class="py-3 px-4">12</td>
                        <td class="py-3 px-4">
                            <a href="#" class="btn btn-outline btn-xs">View</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-base-300/40 transition">
                        <td class="py-3 px-4 font-semibold text-primary">Food Drive</td>
                        <td class="py-3 px-4 text-base-content">Join our food drive to support families in need.</td>
                        <td class="py-3 px-4"><span class="badge badge-warning">In Progress</span></td>
                        <td class="py-3 px-4">8</td>
                        <td class="py-3 px-4">
                            <a href="#" class="btn btn-outline btn-xs">View</a>
                        </td>
                    </tr>
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
