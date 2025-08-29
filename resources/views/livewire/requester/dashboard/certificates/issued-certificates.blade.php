<x-requester.dashboard-layout>
    <div class="min-h-screen p-6">
        <div
            class="inline-flex items-center mb-10 px-6 py-3 bg-gradient-to-r from-primary/10 to-green-600/10 text-primary rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-primary/20">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Issued Certificates
        </div>



        <!-- Issued Certificates Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-emerald-600 mb-6">Issued Certificates</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-xl shadow-md">
                    <thead>
                        <tr class="bg-emerald-50 text-emerald-700">
                            <th class="py-3 px-4 text-left font-semibold">Event</th>
                            <th class="py-3 px-4 text-left font-semibold">Description</th>
                            <th class="py-3 px-4 text-left font-semibold">Issued On</th>
                            <th class="py-3 px-4 text-center font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($issuedCertificates as $certificate)
                            <tr class="border-b hover:bg-emerald-50">
                                <td class="py-3 px-4">{{ $certificate->event->name ?? 'Certificate' }}</td>
                                <td class="py-3 px-4">{{ $certificate->event->description ?? '-' }}</td>
                                <td class="py-3 px-4">{{ \Carbon\Carbon::parse($certificate->issued_at)->format('M d, Y') }}</td>
                                <td class="py-3 px-4 text-center">
                                    <a href="{{ route('certificate.show', ['id' => $certificate->event_id, 'volunteerid' => $certificate->issued_to]) }}"
                                        target="_blank"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg text-sm font-medium shadow transition">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 px-4 text-center text-emerald-600 font-bold">No
                                    Certificates Issued</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</x-requester.dashboard-layout>
