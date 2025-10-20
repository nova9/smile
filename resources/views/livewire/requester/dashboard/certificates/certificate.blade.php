<x-requester.dashboard-layout>
     <style>
        @media print {
            @page {
                size: A4;
                margin: 1cm;
            }

        /* Hide Everything Except Certificate */
            body,
            * {
                visibility: hidden;
            }

            #certificate,
            #certificate * {
                visibility: visible;
            }

            #certificate { 
                position: absolute;  /* takes the certificate out of the normal flow */
                top: 0;
                left: 0;
                margin: 0;
                padding: 1.5cm;
                width: 100%;
                height: auto;
                max-height: 100vh;
                box-sizing: border-box;
                box-shadow: none;
                border-radius: 0;
                border: none;
                background: white;
                page-break-inside: avoid;
                page-break-after: avoid;
            }

            #certificate .certificate-pattern {
                padding: 1cm 1.5cm !important; /* !important to override tailwindcss */
            }

            #certificate h1 {
                font-size: 2rem !important;
            }

            #certificate h2 {
                font-size: 2.5rem !important;
            }

            #certificate .text-5xl,
            #certificate .sm\:text-6xl {
                font-size: 2.5rem !important;
            }

            #certificate .text-4xl,
            #certificate .sm\:text-5xl {
                font-size: 2rem !important;
            }

            #certificate .mb-12 {
                margin-bottom: 1.5rem !important;
            }

            #certificate .mb-10 {
                margin-bottom: 1.25rem !important;
            }

            #certificate .p-8 {
                padding: 1rem !important;
            }
        }

        .certificate-pattern {
            background-image:
                linear-gradient(rgba(0, 0, 0, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.02) 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>

    <div class="min-h-screen bg-gray-50 py-12 px-4 flex flex-col items-center justify-center print:bg-none">
        <!-- Modern Certificate Card -->
        <div id="certificate"
            class="bg-white rounded-2xl shadow-lg border border-gray-200 p-0 max-w-4xl w-full relative overflow-hidden">

            <!-- Decorative Top Border -->
            <div class="h-2 bg-gradient-to-r from-gray-900 via-gray-700 to-gray-900"></div>

            <!-- Certificate Content -->
            <div class="certificate-pattern p-12 sm:p-16">
                <!-- Header Section -->
                <div class="flex flex-col items-center mb-12">
                    <div class="w-20 h-20  rounded-full flex items-center justify-center mb-6 shadow-sm">
                        <svg  xmlns="http://www.w3.org/2000/svg" class="size-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-award-icon lucide-award"><path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"/><circle cx="12" cy="8" r="6"/></svg>
                    </div>
                    <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 text-center tracking-tight mb-3">
                        Certificate of Achievement
                    </h1>
                    <div class="flex items-center gap-2 text-gray-500">
                        <div class="w-16 h-px bg-gray-300"></div>
                        <i data-lucide="star" class="w-4 h-4"></i>
                        <div class="w-16 h-px bg-gray-300"></div>
                    </div>
                </div>

                <!-- Recipient Section -->
                <div class="text-center mb-10">
                    <p class="text-sm uppercase tracking-wider text-gray-600 font-medium mb-4">This is awarded to</p>
                    <h2 class="text-5xl sm:text-6xl font-bold text-gray-900 mb-4 tracking-tight">
                        {{ $volunteer_name }}
                    </h2>
                    <p class="text-lg text-gray-600 italic">For exceptional volunteer service and dedication</p>
                </div>

                <!-- Event Details -->
                <div class="bg-gray-50 rounded-xl p-8 mb-10 border border-gray-200">
                    <p class="text-gray-700 text-center leading-relaxed mb-6">
                        In recognition of <span class="font-semibold text-gray-900">{{ $volunteer_name }}</span>'s
                        outstanding commitment and valuable contribution to the success of our community initiative.
                        Their dedication has made a meaningful impact.
                    </p>

                    <div class="space-y-4">
                        <div class="text-center">
                            <p class="text-sm text-gray-500 mb-1">Event</p>
                            <p class="text-xl font-bold text-gray-900">{{ $certificate['name'] }}</p>
                        </div>

                        @if ($certificate['description'])
                            <p class="text-center text-gray-600 text-sm">{{ $certificate['description'] }}</p>
                        @endif

                        <div class="text-center pt-2">
                            <p class="text-sm text-gray-500 mb-1">Organized by</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $requester['name'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Date Information -->
                <div class="flex flex-col sm:flex-row justify-center items-center gap-4 sm:gap-8 mb-12">
                    <div class="flex items-center gap-2 text-gray-600">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span class="text-sm">
                            <span class="font-medium">Start:</span>
                            {{ \Carbon\Carbon::parse($certificate['starts_at'])->format('M d, Y') }}
                        </span>
                    </div>
                    <div class="w-px h-6 bg-gray-300 hidden sm:block"></div>
                    <div class="flex items-center gap-2 text-gray-600">
                        <i data-lucide="calendar-check" class="w-4 h-4"></i>
                        <span class="text-sm">
                            <span class="font-medium">End:</span>
                            {{ \Carbon\Carbon::parse($certificate['ends_at'])->format('M d, Y') }}
                        </span>
                    </div>
                </div>

                <!-- Signature Section -->
                <div class="flex flex-col sm:flex-row justify-between items-center pt-8 border-t border-gray-200">
                    <div class="flex flex-col items-center sm:items-start mb-4 sm:mb-0">
                        <div class="h-px w-48 bg-gray-900 mb-2"></div>
                        <p class="font-semibold text-gray-900">Authorized Signature</p>
                        <p class="text-sm text-gray-500">Organization Coordinator</p>
                    </div>

                    <div class="flex flex-col items-center sm:items-end">
                        <div class="flex items-center gap-2 text-gray-500 text-xs">
                            <i data-lucide="check-circle" class="w-3.5 h-3.5"></i>
                            <span>Issued on {{ now()->format('F d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Decorative Bottom Border -->
            <div class="h-2 bg-gradient-to-r from-gray-900 via-gray-700 to-gray-900"></div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col items-center gap-4 mt-8 print:hidden w-full max-w-4xl">
            @if (!$isIssued)
                <button wire:click="issueCertificate({{ $volunteerid }})" type="button"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white font-semibold rounded-lg shadow-sm transition-colors">
                    <i data-lucide="award" class="w-5 h-5"></i>
                    Issue Certificate
                </button>
            @else
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg">
                    <i data-lucide="check-circle" class="w-4 h-4 text-green-600"></i>
                    <span class="text-sm font-medium">Certificate Issued</span>
                </div>
            @endif

            <button onclick="window.print()"
                class="inline-flex items-center gap-2 px-6 py-2.5 bg-white hover:bg-gray-50 text-gray-700 font-medium rounded-lg border border-gray-300 transition-colors">
                <i data-lucide="printer" class="w-4 h-4"></i>
                Print Certificate
            </button>
        </div>
    </div>
</x-requester.dashboard-layout>
