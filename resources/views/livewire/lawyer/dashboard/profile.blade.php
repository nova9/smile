<x-lawyer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500/10 to-green-600/10 text-black rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-green-500/20">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Legal Professional
                </div>
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800 leading-tight relative">
                        My <span class="text-accent">Profile</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-green-500/30"
                            viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" />
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        View your professional information and legal credentials
                    </p>
                </div>
            </div>

            <!-- Profile Card -->
            <div class="group">
                <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                    <div class="flex flex-col md:flex-row items-start justify-between gap-6">
                        <div class="flex items-center gap-6">
                            <div class="relative">
                                <div class="avatar">
                                    <div class="mask mask-squircle h-20 w-20 ring-4 ring-green-500/20">
                                        <img id="profilePhoto"
                                            src="https://img.daisyui.com/images/profile/demo/2@94.webp" alt="Profile" />
                                    </div>
                                </div>
                                <div
                                    class="absolute -bottom-1 -right-1 w-6 h-6 bg-black rounded-full flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <h3 id="nameDisplay" class="font-bold text-2xl ">{{auth()->user()->name}}</h3>
                                <p class="text-gray-600 text-sm">Legal Professional</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-8">
                            <div class="text-center">
                                <div class="relative">
                                    <p id="completionText"
                                        class="text-3xl font-bold">{{$completion * 100}}%</p>
                                    <div
                                        class="absolute -inset-2 bg-gradient-to-r from-green-500/20 to-green-600/20 rounded-lg -z-10 opacity-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 w-full bg-gray-200 rounded-full h-2.5">
                        <div id="completionBar" class="bg-black h-2.5 rounded-full"
                            style="width:{{$completion * 100}}%"></div>
                    </div>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="w-full">
                            <label class="text-sm font-medium text-gray-700 flex gap-1">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span>Location</span>
                            </label>
                            <div class="card bg-white shadow-md">
                                <div class="card-body">
                                    <!-- Map Location Display -->
                                    <div class="mb-6">
                                        <div class="border border-gray-300 rounded-lg overflow-hidden">
                                            <div id="map" class="w-full h-96 bg-gray-100 relative">
                                                <div class="absolute inset-0 flex items-center justify-center">
                                                    <div class="flex items-center gap-2">
                                                        <button class="btn btn-sm btn-accent"
                                                            onclick="initializeMap()"
                                                            type="button">
                                                            <i data-lucide="refresh-cw" class="size-4"></i>
                                                            <span class="ml-1">Load Map</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Location display -->
                                        <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                                            <div class="flex items-center justify-between mb-3">
                                                <div class="flex items-center gap-2">
                                                    <i data-lucide="navigation" class="size-4 text-accent"></i>
                                                    <h4 class="text-sm font-medium text-gray-700">Location</h4>
                                                </div>
                                            </div>

                                            @if($latitude && $longitude)
                                            <div id="coordinates-display">
                                                <div
                                                    class="flex items-center gap-4 p-3 bg-white/50 rounded-lg border border-green-100">
                                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                                        <i data-lucide="map-pin" class="size-4 text-accent"></i>
                                                        <span class="font-medium">Coordinates:</span>
                                                    </div>
                                                    <div class="flex items-center gap-4 text-sm font-mono">
                                                        <span class="text-gray-700">Lat: {{number_format($latitude, 6)}}</span>
                                                        <span class="text-gray-400">•</span>
                                                        <span class="text-gray-700">Lng: {{number_format($longitude, 6)}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="flex items-center justify-center text-gray-500">
                                                <div class="text-center">
                                                    <i data-lucide="map" class="size-8 mx-auto mb-2 text-accent"></i>
                                                    <p class="text-sm">No location set</p>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-10">
                            <div class="w-full flex flex-col gap-6">
                                <div class="space-y-6">
                                    <fieldset class="border border-gray-300 rounded-md p-4">
                                        <legend class="text-sm font-medium text-gray-700 px-2">Name</legend>
                                        <div class="w-full p-2 text-gray-700">{{ $name }}</div>
                                    </fieldset>

                                    <fieldset class="border border-gray-300 rounded-md p-4">
                                        <legend class="text-sm font-medium text-gray-700 px-2">Email</legend>
                                        <div class="w-full p-2 text-gray-700">{{ $email }}</div>
                                    </fieldset>

                                    <fieldset class="border border-gray-300 rounded-md p-4">
                                        <legend class="text-sm font-medium text-gray-700 px-2">Age</legend>
                                        <div class="w-full p-2 text-gray-700">{{ $age ?: '-' }}</div>
                                    </fieldset>

                                    <fieldset class="border border-gray-300 rounded-md p-4">
                                        <legend class="text-sm font-medium text-gray-700 px-2">Contact</legend>
                                        <div class="w-full p-2 text-gray-700">{{ $contact_number ?: '-' }}</div>
                                    </fieldset>

                                    <fieldset class="border border-gray-300 rounded-md p-4">
                                        <legend class="text-sm font-medium text-gray-700 px-2">Gender</legend>
                                        <div class="w-full p-2 text-gray-700">{{ $gender ? ucfirst($gender) : '-' }}</div>
                                    </fieldset>

                                    <!-- Lawyer-specific fields -->
                                    <fieldset class="border border-gray-300 rounded-md p-4">
                                        <legend class="text-sm font-medium text-gray-700 px-2">License Number</legend>
                                        <div class="w-full p-2 text-gray-700">{{ $license_number ?: '-' }}</div>
                                    </fieldset>

                                    <fieldset class="border border-gray-300 rounded-md p-4">
                                        <legend class="text-sm font-medium text-gray-700 px-2">Specialization</legend>
                                        <div class="w-full p-2 text-gray-700">
                                            @if($specialization)
                                            {{ str_replace('_', ' ', ucwords($specialization, '_')) }}
                                            @else
                                            -
                                            @endif
                                        </div>
                                    </fieldset>

                                    <fieldset class="border border-gray-300 rounded-md p-4">
                                        <legend class="text-sm font-medium text-gray-700 px-2">Years of Experience</legend>
                                        <div class="w-full p-2 text-gray-700">{{ $experience_years ? $experience_years . ' years' : '-' }}</div>
                                    </fieldset>

                                    <fieldset class="border border-gray-300 rounded-md p-4">
                                        <legend class="text-sm font-medium text-gray-700 px-2">Bar Association</legend>
                                        <div class="w-full p-2 text-gray-700">{{ $bar_association ?: '-' }}</div>
                                    </fieldset>
                                </div>

                                <div class="w-full">
                                    <fieldset class="border border-gray-300 rounded-md p-4">
                                        <legend class="flex gap-1 text-sm font-medium text-gray-700 px-2">
                                            <i data-lucide="book-open-text" class="size-4"></i>
                                            <span>Legal Skills & Expertise</span>
                                        </legend>
                                        <div class="w-full p-2 text-gray-700 min-h-[76px]">
                                            @if(is_array($skills) && count($skills) > 0)
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($skills as $skill)
                                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">{{ $skill }}</span>
                                                @endforeach
                                            </div>
                                            @else
                                            -
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-500 mt-2">Legal expertise and specializations</p>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-lawyer.dashboard-layout>

@assets
<script>
    let map;
    let marker;

    function initializeMap() {
        const initialLat = Number({
            {
                $latitude ?? '7.8731'
            }
        });
        const initialLng = Number({
            {
                $longitude ?? '80.7718'
            }
        });
        const mapOptions = {
            center: {
                lat: !isNaN(initialLat) ? initialLat : 7.8731,
                lng: !isNaN(initialLng) ? initialLng : 80.7718
            },
            zoom: 7,
            mapId: "198a0e442491558328ee7d20"
        };

        map = new google.maps.Map(document.getElementById("map"), mapOptions);

        if (!isNaN(initialLat) && !isNaN(initialLng)) {
            const initialPos = {
                lat: initialLat,
                lng: initialLng
            };
            marker = new google.maps.marker.AdvancedMarkerElement({
                map,
                position: initialPos,
                title: "Lawyer Location"
            });
        }
    }

    // Load the Google Maps script
    function loadScript() {
        const script = document.createElement("script");
        script.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyBNNa55DL19ILQw2A6_DXQzZyu8YzYPf5s&loading=async&callback=initializeMap&libraries=marker`;
        script.async = true;
        document.head.appendChild(script);
    }

    window.addEventListener("load", loadScript);
</script>
@endassets