<x-requester.dashboard-layout>
    <style>
        @media print {

            body,
            * {
                visibility: hidden;
            }

            #certificate,
            #certificate * {
                visibility: visible;
            }

            #certificate {
                position: absolute;
                top: 0;
                left: 0;
                margin: 0;
                padding: 2cm;
                box-sizing: border-box;
                box-shadow: none;
                border-radius: 0;
                border: none;
                background: white;
            }
        }
    </style>

    <div class="min-h-screen py-16 flex flex-col items-center justify-center print:bg-none">
        <!-- Premium Certificate Card -->
        <div id="certificate"
            class="bg-white rounded-[2.5rem] shadow-2xl border-4 border-green-500 p-0 max-w-3xl w-full relative">
            <!-- Logo or Gold Seal -->
            <div class="flex flex-col items-center pt-12 pb-2">
                <svg class="w-20 h-20 text-green-500 mb-2" fill="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" fill="currentColor" />
                    <text x="12" y="16" text-anchor="middle" font-size="12" fill="#fff" font-family="Arial">★</text>
                </svg>
                <h1 class="text-5xl font-serif font-bold text-green-700 text-center tracking-wide mb-2">Certificate of
                    Appreciation</h1>
                <svg class="w-36 h-5 text-green-300 mb-2" viewBox="0 0 100 12" fill="none">
                    <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" />
                </svg>
            </div>
            <div class="px-10 sm:px-16 pb-12 pt-2 flex flex-col items-center gap-8">
                <span class="text-xl font-semibold text-green-700 mb-2 mt-2">This certificate is awarded to</span>
                <span class="text-4xl sm:text-5xl font-serif font-bold text-blue-900 mb-2">{{ $volunteer_name }}</span>
                <span class="text-lg text-gray-600 mb-2 italic">for outstanding participation</span>
                <p class="text-lg text-gray-700 text-center mb-4 px-2">In recognition of <span
                        class="font-semibold text-green-700">{{ $volunteer_name }}</span>'s outstanding dedication and
                    selfless contribution as a volunteer in organizing and supporting our events. Their efforts have
                    made a significant impact on our community.</p>
                <div class="w-full border-t border-green-300 my-4"></div>
                <div class="flex flex-col items-center gap-2">
                    <h2 class="text-lg font-bold text-blue-900 text-center">Event: <span
                            class="text-green-700">{{ $certificate['name'] }}</span></h2>
                    <p class="text-base text-gray-600 text-center mb-2">{{ $certificate['description'] }}</p>
                    <h2 class="text-lg font-bold text-blue-900 text-center">Organized by <span
                            class="text-green-700">{{ $requester['name'] }}</span></h2>
                </div>
                <div
                    class="flex flex-col sm:flex-row justify-between items-center text-gray-500 text-base mt-8 mb-8 gap-4 w-full">
                    <div class="bg-green-50 rounded-xl px-4 py-2 shadow-sm">
                        <span class="font-semibold text-green-700">Start Date:</span>
                        {{ \Carbon\Carbon::parse($certificate['starts_at'])->format('F d, Y') }}
                    </div>
                    <div class="bg-green-50 rounded-xl px-4 py-2 shadow-sm">
                        <span class="font-semibold text-green-700">End Date:</span>
                        {{ \Carbon\Carbon::parse($certificate['ends_at'])->format('F d, Y') }}
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row justify-between items-center mt-10 gap-4 w-full">
                    <div class="flex flex-col items-center">
                        <span class="font-bold text-blue-900 mb-1">Signature</span>
                        <span class="text-lg text-green-700 font-[cursive] italic">Organization Coordinator</span>
                    </div>
                    <span class="text-gray-400 text-xs">Generated on {{ now()->format('F d, Y') }}</span>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-center mt-8 print:hidden w-full">
            @if (!$isIssued)
                <button wire:click="issueCertificate({{ $volunteerid }})" type="button"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl shadow transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m-6 4h12m-6 4h6m-9-8h6m-9 4h6m-9 4h6" />
                    </svg>
                    Issue Certificate
                </button>
            @endif
            <span class="text-gray-500 text-sm mt-4">You are viewing the certificate issued to this volunteer.</span>
        </div>
    </div>
</x-requester.dashboard-layout>
