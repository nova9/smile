<x-volunteer.dashboard-layout>
    <style>
        @media print {
            body, * {
                visibility: hidden;
            }

            #certificate, #certificate * {
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

    <div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-primary/10 to-accent/10 py-16 print:bg-none">
        <div class="flex  mb-4 print-hidden">
            <button onclick="window.print()" class="btn btn-neutral btn-sm">
                Print Certificate
            </button>
        </div>
        <div id="certificate" class="bg-white  shadow-2xl p-40 max-w-5xl w-full relative">

            <div class="flex flex-col items-center gap-10">
                <img src="{{ asset('storage/assets/logo.svg') }}" alt="Smile Volunteer Logo"
                     class="h-10 xl:h-12 select-none transition-transform duration-300 group-hover:scale-105">

                <div>
                    <h2 class="text-4xl sm:text-5xl font-bold text-primary leading-tight text-center relative">
                        Certificate of Appreciation
                        <svg class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-32 h-3 text-accent/30"
                             viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2"
                                  stroke-linecap="round"/>
                        </svg>
                    </h2>


                </div>

                <div class="flex flex-col items-center">
                    <span class="text-xl font-semibold text-accent mb-4">This is awarded to</span>
                    <span class="text-3xl  text-primary mb-4">{{ auth()->user()->name }}</span>
                    <span class="text-base text-gray-600 mb-4">for outstanding participation</span>
                    <p class="text-base text-gray-600 text-center">In recognition of your outstanding dedication and
                        selfless contribution as a volunteer in organizing and supporting our events. Your efforts have
                        made a significant impact on our community.</p>
                    <img src="{{ asset('storage/assets/cert.png') }}" alt="Smile Volunteer Logo"
                         class="h-20 xl:h-20 select-none transition-transform duration-300 group-hover:scale-105">
                </div>

                <div class="flex flex-col items-center">

                    <h1 class="text-lg text-primary mb-2 text-center">The event {{ $certificate['name'] }}</h1>
                    <p class="text-lg text-gray-600 text-center mb-4">{{ $certificate['description'] }}</p>
                    <h1 class="text-lg text-primary mb-2 text-center">Organized by {{ $requester['name'] }}</h1>
                </div>
            </div>
            <div class="flex justify-between items-center text-gray-500 text-base mt-8 mb-8">
                <div>
                    <span class="font-semibold">Start Date:</span>
                    {{ \Carbon\Carbon::parse($certificate['starts_at'])->format('F d, Y') }}
                </div>
                <div>
                    <span class="font-semibold">End Date:</span>
                    {{ \Carbon\Carbon::parse($certificate['ends_at'])->format('F d, Y') }}
                </div>
            </div>
            <div class="flex justify-between items-center mt-10">
                <div class="flex flex-col items-center">
                    <span class="font-bold text-primary">Signature</span>
                    <span class="text-xs text-gray-400">Organization Coordinator</span>
                </div>
                <span class="text-gray-400 text-xs">Generated on {{ now()->format('F d, Y') }}</span>
            </div>
        </div>
    </div>

</x-volunteer.dashboard-layout>


