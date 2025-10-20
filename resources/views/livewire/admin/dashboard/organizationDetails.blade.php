<x-admin.dashboard-layout>
    <!-- Organization Header -->
    <div class="bg-gradient-to-r from-primary/10 to-green-600/10 shadow-lg rounded-3xl mt-6">
        <div class="px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center justify-between flex-wrap gap-6">
                <div class="flex items-center space-x-4">
                    <div>
                        <h1
                            class="text-3xl font-bold bg-gradient-to-r from-accent to-primary bg-clip-text text-transparent">
                            {{ $organization->name }}
                        </h1>
                        <p class="text-gray-600 font-medium">{{ $organization->email }}</p>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-2 items-end sm:items-center">
                    @if($organization->is_restricted)
                        <span
                            class="px-4 py-1.5 bg-red-100 text-red-800 text-sm font-semibold rounded-full shadow inline-flex items-center gap-1">
                            <i class="fas fa-ban"></i>
                            Restricted
                        </span>
                    @else
                        <span
                            class="px-4 py-1.5 bg-green-100 text-green-800 text-sm font-semibold rounded-full shadow inline-flex items-center gap-1">
                            <i class="fas fa-check-circle"></i>
                            Active
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content -->
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="tabs tabs-lift">
            <label class="tab flex gap-1">
                <input type="radio" name="org_tabs" checked="checked" />
                <i class="fas fa-calendar-alt mr-2 text-accent"></i>
                <span class="font-semibold">Opportunities</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <!-- Opportunities Tab -->
                <h2
                    class="text-xl font-bold bg-gradient-to-r from-accent to-primary bg-clip-text text-transparent mb-6">
                    Volunteer Events</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-2xl shadow-xl">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Id</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Title</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Status</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Start Date</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">End Date</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Volunteers</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                                <tr>
                                    <td class="px-6 py-4">{{ $event->id }}</td>
                                    <td class="px-6 py-4">{{ $event->name }}</td>
                                    <td class="px-6 py-4">
                                        <span class="badge badge-info">{{ ucfirst($event->status ?? 'Draft') }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $event->starts_at ? \Carbon\Carbon::parse($event->starts_at)->format('Y-m-d') : '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $event->ends_at ? \Carbon\Carbon::parse($event->ends_at)->format('Y-m-d') : '-' }}
                                    </td>
                                    <td class="px-6 py-4">{{ $event->users_count }}</td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <x-admin.action-button type="view"
                                            url="{{ url('/admin/dashboard/event-details/' . $event->id) }}" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">No events found for this
                                        organization.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <label class="tab flex gap-1">
                <input type="radio" name="org_tabs" />
                <i class="fas fa-exclamation-triangle mr-2 text-error"></i>
                <span class="font-semibold">Reports/Complaints</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <h2
                    class="text-xl font-bold bg-gradient-to-r from-accent to-primary bg-clip-text text-transparent mb-6">
                    Reports for {{ $organization->name }}
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Report Card 1 -->
                    <div class="bg-white rounded-2xl shadow-xl p-6 flex flex-col gap-3">
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-accent">Report ID: RPT-001</span>
                            <span
                                class="px-3 py-1 bg-red-100 text-red-800 text-xs font-bold rounded-full shadow">Open</span>
                        </div>

                        <div>
                            <span class="font-medium text-gray-700">Reason:</span>
                            <span class="text-gray-900">Financial misconduct</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Date:</span>
                            <span class="text-gray-900">2024-06-20</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Details:</span>
                            <span class="text-gray-900">Did not disclose how they handled fimaces</span>
                        </div>
                        <div class="flex gap-2 mt-2">
                            <button class="btn btn-outline btn-success font-bold">Resolve</button>
                            <button class="btn btn-outline btn-error font-bold">Dismiss</button>
                        </div>
                    </div>
                    <!-- Report Card 2 -->
                    <div class="bg-white rounded-2xl shadow-xl p-6 flex flex-col gap-3">
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-accent">Report ID: RPT-002</span>
                            <span
                                class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold rounded-full shadow">Closed</span>
                        </div>

                        <div>
                            <span class="font-medium text-gray-700">Reason:</span>
                            <span class="text-gray-900">Late attendance</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Date:</span>
                            <span class="text-gray-900">2024-05-10</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Details:</span>
                            <span class="text-gray-900">Did not start thge event on time , people had to wait for
                                hours</span>
                        </div>

                    </div>
                </div>
                <div class="mt-8 flex justify-end">
                    <button class="btn btn-error font-bold">Suspend organization</button>
                </div>
            </div>
        </div>
    </div>
</x-admin.dashboard-layout>