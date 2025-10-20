<x-requester.dashboard-layout>
    <div class="min-h-screen bg-gray-50 p-6">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-12 h-12 bg-gray-900 rounded-lg flex items-center justify-center">
                    <i data-lucide="award" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Issued Certificates</h1>
                    <p class="text-gray-600">View and manage all certificates issued to volunteers</p>
                </div>
            </div>
        </div>

        <!-- Certificates Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Event
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Description
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Issued On
                            </th>
                            <th
                                class="px-6 py-4 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($issuedCertificates as $certificate)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <i data-lucide="calendar" class="w-5 h-5 text-gray-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">
                                                {{ $certificate->event->name ?? 'Certificate' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-600 max-w-md">
                                        {{ $certificate->event->description ? \Illuminate\Support\Str::limit($certificate->event->description, 80) : '-' }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2 text-gray-600">
                                        <i data-lucide="calendar-check" class="w-4 h-4"></i>
                                        <span
                                            class="text-sm">{{ \Carbon\Carbon::parse($certificate->issued_at)->format('M d, Y') }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('certificate.show', ['id' => $certificate->event_id, 'volunteerid' => $certificate->issued_to]) }}"
                                        target="_blank"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                        View Certificate
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-16">
                                    <div class="text-center">
                                        <div
                                            class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <i data-lucide="award" class="w-8 h-8 text-gray-400"></i>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No Certificates Issued</h3>
                                        <p class="text-gray-600">Certificates will appear here once you issue them to
                                            volunteers.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-requester.dashboard-layout>
