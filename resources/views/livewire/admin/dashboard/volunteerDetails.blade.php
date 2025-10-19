<x-admin.dashboard-layout>
    <div class="min-h-screen p-6">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl sm:text-5xl font-bold text-accent mb-2">
                        Volunteer
                        <span class="bg-gradient-to-r from-primary to-green-600 bg-clip-text text-transparent">
                            Details
                        </span>
                    </h1>
                    <p class="text-slate-600 text-lg">Detailed information about {{ $volunteer->name }}</p>
                </div>
                <div class="flex gap-3">
                    
                </div>
            </div>
        </div>

        <!-- Volunteer Info Card -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-1">{{ $volunteer->name }}</h2>
                    <p class="text-slate-600 mb-1">ID: VOL-{{ $volunteer->id }}</p>
                    <p class="text-slate-600">Joined: {{ $volunteer->created_at->format('M j, Y') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-slate-600">Email</p>
                    <p class="font-medium text-slate-900">{{ $volunteer->email }}</p>
                </div>
            </div>
        </div>

        <!-- Tabs Section -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 p-6">
            <div class="tabs tabs-lifted">
                <input type="radio" name="vol_tabs" class="tab" aria-label="Profile & Verification" checked />
                <div class="tab-content bg-white border-slate-200 rounded-2xl p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Volunteer Details -->
                        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                            <h3 class="text-lg font-semibold text-accent mb-4">Volunteer Details</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-600 mb-1">Full Name</label>
                                    <p class="text-slate-900 font-medium">{{ $volunteer->name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-600 mb-1">Email</label>
                                    <p class="text-slate-900 font-medium">{{ $volunteer->email }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-600 mb-1">Phone</label>
                                    <p class="text-slate-900 font-medium">{{ $attributes['contact_number'] ?? '-' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-600 mb-1">Location</label>
                                    <p class="text-slate-900 font-medium">
                                        @php
                                            $lat = $attributes['latitude'] ?? null;
                                            $lng = $attributes['longitude'] ?? null;
                                        @endphp
                                        @if($lat && $lng)
                                            Latitude: {{ $lat }}, Longitude: {{ $lng }}
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-600 mb-1">Skills</label>
                                    <div class="text-slate-900 font-medium">
                                        @php
                                            $skills = $attributes['skills'] ?? null;
                                            $skillsArr = [];
                                            if ($skills) {
                                                if (is_array($skills)) {
                                                    $skillsArr = $skills;
                                                } elseif (is_string($skills)) {
                                                    $decoded = json_decode($skills, true);
                                                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                                        $skillsArr = $decoded;
                                                    } else {
                                                        $skillsArr = array_map('trim', explode(',', $skills));
                                                    }
                                                }
                                            }
                                        @endphp
                                        @if(!empty($skillsArr))
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($skillsArr as $skill)
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-medium bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700">{{ $skill }}</span>
                                                @endforeach
                                            </div>
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-600 mb-1">Bio</label>
                                    <p class="text-slate-900 font-medium">{{ $attributes['bio'] ?? '-' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-600 mb-1">Gender</label>
                                    <p class="text-slate-900 font-medium">{{ $attributes['gender'] ?? '-' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-600 mb-1">Age</label>
                                    <p class="text-slate-900 font-medium">{{ $attributes['age'] ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Documents Card -->
                        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                            <h3 class="text-lg font-semibold text-accent mb-4">Uploaded Documents</h3>
                            <p class="text-sm text-slate-600 mb-4">Uploaded Documents (2/5 files uploaded)</p>
                            <div class="space-y-3">
                                <div
                                    class="flex items-center justify-between p-4 bg-white rounded-xl border border-slate-100">
                                    <div class="flex items-center space-x-3">
                                        <i data-lucide="file-text" class="w-5 h-5 text-red-500"></i>
                                        <div>
                                            <p class="text-sm font-medium text-slate-900">id_card.pdf</p>
                                            <p class="text-xs text-slate-500">Uploaded: May 15, 2025</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-red-100 text-red-800">PDF</span>
                                        <button class="btn btn-sm btn-outline btn-accent rounded-lg">Download</button>
                                    </div>
                                </div>
                                <div
                                    class="flex items-center justify-between p-4 bg-white rounded-xl border border-slate-100">
                                    <div class="flex items-center space-x-3">
                                        <i data-lucide="file-text" class="w-5 h-5 text-red-500"></i>
                                        <div>
                                            <p class="text-sm font-medium text-slate-900">background_check.pdf</p>
                                            <p class="text-xs text-slate-500">Uploaded: May 16, 2025</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-red-100 text-red-800">PDF</span>
                                        <button class="btn btn-sm btn-outline btn-accent rounded-lg">Download</button>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm text-red-600 mt-4 font-medium">Max 5 files allowed per volunteer.</p>
                        </div>
                    </div>
                </div>

                <input type="radio" name="vol_tabs" class="tab" aria-label="Events" />
                <div class="tab-content bg-white border-slate-200 rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-accent mb-6">Participated Events</h3>
                    <div class="border border-slate-200 overflow-hidden rounded-2xl shadow-sm">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr class="bg-slate-50">
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-accent">ID</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Title</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Status</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Start Date</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-accent">End Date</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Role</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($events as $event)
                                    <tr
                                        class="border-t border-slate-100 hover:bg-slate-50/50 transition-colors duration-200">
                                        <td class="px-6 py-4 text-sm font-medium text-slate-900">#{{ $event->id }}</td>
                                        <td class="px-6 py-4 text-sm text-slate-600">{{ $event->name }}</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-medium 
                                                    @if(optional($event->pivot)->status === 'accepted') bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-700
                                                    @elseif(optional($event->pivot)->status === 'pending') bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-700
                                                    @elseif(optional($event->pivot)->status === 'rejected' || optional($event->pivot)->status === 'cancelled') bg-gradient-to-r from-rose-100 to-red-100 text-rose-700
                                                    @else bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700 @endif">
                                                {{ ucfirst(optional($event->pivot)->status ?? 'N/A') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-600">
                                            {{ $event->starts_at ? \Carbon\Carbon::parse($event->starts_at)->format('M j, Y') : '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-600">
                                            {{ $event->ends_at ? \Carbon\Carbon::parse($event->ends_at)->format('M j, Y') : '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-600">
                                            {{ optional($event->pivot)->role ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ url('/admin/dashboard/event-details/' . $event->id) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white text-slate-600 hover:bg-slate-100 transition-colors border border-slate-200 shadow-sm group relative"
                                                title="View Details">
                                                <i data-lucide="eye" class="w-4 h-4"></i>
                                                <span
                                                    class="absolute left-1/2 -translate-x-1/2 -top-8 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">View
                                                    Details</span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center gap-4">
                                                <div
                                                    class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center">
                                                    <i data-lucide="calendar-x" class="w-8 h-8 text-slate-400"></i>
                                                </div>
                                                <div>
                                                    <h3 class="font-semibold text-slate-900">No events found</h3>
                                                    <p class="text-sm text-slate-500 mt-1">This volunteer hasn't
                                                        participated in any events yet.</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <input type="radio" name="vol_tabs" class="tab" aria-label="Reports/Complaints" />
                <div class="tab-content bg-white border-slate-200 rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-accent mb-6">Reports for Volunteer: {{ $volunteer->name }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Report Card 1 -->
                        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                            <div class="flex items-center justify-between mb-4">
                                <span class="font-medium text-accent">Report ID: RPT-003</span>
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-medium bg-gradient-to-r from-rose-100 to-red-100 text-rose-700">Open</span>
                            </div>
                            <div class="space-y-3">
                                <div>
                                    <span class="text-sm font-medium text-slate-600">Type:</span>
                                    <span class="text-sm text-slate-900 ml-2">Volunteer</span>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-slate-600">Reason:</span>
                                    <span class="text-sm text-slate-900 ml-2">Missed deadline</span>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-slate-600">Date:</span>
                                    <span class="text-sm text-slate-900 ml-2">Jun 20, 2025</span>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-slate-600">Details:</span>
                                    <span class="text-sm text-slate-900 ml-2">Did not submit required report on
                                        time.</span>
                                </div>
                            </div>
                            <div class="flex gap-2 mt-4">
                                <button class="btn btn-sm btn-success rounded-xl">Resolve</button>
                                <button class="btn btn-sm btn-warning rounded-xl">Suspend</button>
                            </div>
                        </div>

                        <!-- Report Card 2 -->
                        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                            <div class="flex items-center justify-between mb-4">
                                <span class="font-medium text-accent">Report ID: RPT-004</span>
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-medium bg-gradient-to-r from-slate-100 to-gray-100 text-slate-700">Closed</span>
                            </div>
                            <div class="space-y-3">
                                <div>
                                    <span class="text-sm font-medium text-slate-600">Type:</span>
                                    <span class="text-sm text-slate-900 ml-2">Volunteer</span>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-slate-600">Reason:</span>
                                    <span class="text-sm text-slate-900 ml-2">Late attendance</span>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-slate-600">Date:</span>
                                    <span class="text-sm text-slate-900 ml-2">May 10, 2025</span>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-slate-600">Details:</span>
                                    <span class="text-sm text-slate-900 ml-2">Arrived late to scheduled activity.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const params = new URLSearchParams(window.location.search);
            if (params.get('tab') === 'reports') {
                document.querySelectorAll('input[name="vol_tabs"]').forEach((el, idx) => {
                    // Assuming Reports/Complaints is now the 3rd tab (index 2)
                    if (idx === 2) el.checked = true;
                });
            }
        });
    </script>
</x-admin.dashboard-layout>