<x-volunteer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500/10 to-green-600/10 text-black rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-green-500/20">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd"></path>
                    </svg>
                    Your Profile
                </div>
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800 leading-tight relative">
                        My <span class="text-accent">Profile</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-green-500/30"
                             viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2"
                                  stroke-linecap="round"/>
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Manage your personal information and showcase your skills
                    </p>
                </div>
            </div>

            <!-- Profile Card -->
            <div class="relative group">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-green-500/20 via-green-500/10 to-gray-800/20 rounded-3xl transform rotate-1 group-hover:rotate-0 transition-transform duration-300"></div>
                <div class="relative bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                    <div class="flex flex-col md:flex-row items-start justify-between gap-6">
                        <div class="flex items-center gap-6">
                            <div class="relative">
                                <div class="avatar">
                                    <div class="mask mask-squircle h-20 w-20 ring-4 ring-green-500/20">
                                        <img id="profilePhoto"
                                             src="https://img.daisyui.com/images/profile/demo/2@94.webp" alt="Profile"/>
                                    </div>
                                </div>
                                <div
                                    class="absolute -bottom-1 -right-1 w-6 h-6 bg-black rounded-full flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <h3 id="nameDisplay" class="font-bold text-2xl ">{{auth()->user()->name}}</h3>
                                <input id="nameInput" type="text" value="John Doe"
                                       class="hidden mt-1 block w-full border border-gray-300 rounded-md p-2"/>
                                <button class="btn btn-accent btn-sm">Upload Photo</button>

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
                        <form wire:submit.prevent="save" wire:ignore class="space-y-4 sm:space-y-6" method="post">
                            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8 ">

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
                                        <!-- Map Location Picker -->
                                        <div class="mb-6" wire:ignore>
                                            <div class="border border-gray-300 rounded-lg overflow-hidden">
                                                <div id="map" class="w-full h-96 bg-gray-100 relative">
                                                    <!-- Map will be initialized here -->
                                                    <div class="absolute inset-0 flex items-center justify-center">
                                                        {{--                                    loading state--}}
                                                        <div class="flex items-center gap-2">
                                                            <button class="btn btn-sm btn-accent"
                                                                    onclick="initializeMap()"
                                                                    type="button"
                                                            >
                                                                <i data-lucide="refresh-cw" class="size-4"></i>
                                                                <span class="ml-1">Reload Map</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Selected coordinates display -->
                                            <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                                                <div class="flex items-center justify-between mb-3">
                                                    <div class="flex items-center gap-2">
                                                        <i data-lucide="navigation" class="size-4 text-accent"></i>
                                                        <h4 class="text-sm font-medium text-gray-700">Selected
                                                            Location</h4>
                                                    </div>
                                                    <button type="button"
                                                            onclick="getCurrentLocation()"
                                                            class="btn btn-sm bg-accent hover:bg-green-700 text-white border-none shadow-sm hover:shadow-md transition-all duration-200 group"
                                                            title="Use my current location">
                                                        <i data-lucide="crosshair"
                                                           class="size-4 group-hover:rotate-90 transition-transform duration-200"></i>
                                                        <span class="hidden sm:inline ml-1">Current Location</span>
                                                    </button>


                                                </div>

                                                <div id="coordinates-display" class="hidden">
                                                    <div
                                                        class="flex items-center gap-4 p-3 bg-white/50 rounded-lg border border-green-100">
                                                        <div class="flex items-center gap-2 text-sm text-gray-600">
                                                            <i data-lucide="map-pin" class="size-4 text-accent"></i>
                                                            <span class="font-medium">Coordinates:</span>
                                                        </div>
                                                        <div class="flex items-center gap-4 text-sm font-mono">
                                                            <span id="lat-display" class="text-gray-700"></span>
                                                            <span class="text-gray-400">•</span>
                                                            <span id="lng-display" class="text-gray-700"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="no-location"
                                                     class="flex items-center justify-center text-gray-500">
                                                    <div class="text-center">
                                                        <i data-lucide="map"
                                                           class="size-8 mx-auto mb-2 text-accent"></i>
                                                        <p class="text-sm">Click on the map to select a location</p>
                                                    </div>
                                                </div>

                                                <!-- Hidden inputs for form submission -->
                                                <input wire:model.defer="latitude" type="hidden" id="latitude">
                                                <input wire:model.defer="longitude" type="hidden" id="longitude">
                                            </div>

                                            @error('latitude') <p
                                                class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                            @error('longitude') <p
                                                class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="flex flex-col gap-10 ">
                                <div class=" w-full flex flex-col gap-6 ">
                                    <div class="space-y-6">

                                        <fieldset class="border border-gray-300 rounded-md p-4">
                                            <legend class="text-sm font-medium text-gray-700 px-2">Name</legend>
                                            <input id="name" wire:model="name" name="name" type="text"
                                                   class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200">
                                        </fieldset>
                                        <fieldset class="border border-gray-300 rounded-md p-4">
                                            <legend class="text-sm font-medium text-gray-700 px-2">Email</legend>
                                            <input id="email" wire:model="email" name="email" type="email"
                                                   class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200">
                                        </fieldset>
                                         <fieldset class="border border-gray-300 rounded-md p-4">
                                            <legend class="text-sm font-medium text-gray-700 px-2">Age</legend>
                                            <input id="age" wire:model="age" name="age" type="text"
                                                   class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200">
                                        </fieldset>
                                        
                                        <fieldset class="border border-gray-300 rounded-md p-4">
                                            <legend class="text-sm font-medium text-gray-700 px-2">Contact</legend>
                                            <input id="contact_number" wire:model="contact_number"
                                                   name="contact_number" type="text"
                                                   class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200">
                                        </fieldset>
                                        <fieldset class="border border-gray-300 rounded-md p-4">
                                            <legend class="text-sm font-medium text-gray-700 px-2">Gender</legend>
                                            <input id="gender" wire:model="gender" name="gender" type="text"
                                                   class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200">
                                        </fieldset>
                                    </div>

                                    <div class="w-full ">
                                        <label class="text-sm font-medium text-gray-700 flex gap-1">
                                            <i data-lucide="book-open-text" class="size-4 "></i>
                                            <span>Skills</span>
                                        </label>
                                        <div id="skillsList" class="flex flex-wrap gap-2 mt-2">
                                            <div class="md:col-span-2">

                                                <!-- Selected Skills Display -->
                                                @if(count($skills) > 0)
                                                    <div
                                                        class="flex flex-wrap gap-2 mb-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                                        @foreach($skills as $index => $skill)
                                                            <span
                                                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-accent rounded-full">
                                            {{ $skill }}
                                            <button type="button" wire:click="removeSkill{{ $index }})"
                                                    class="ml-2 text-white hover:cursor-pointer">
                                                <i data-lucide="x" class="w-3 h-3 hover:cursor-pointer"></i>
                                            </button>
                                        </span>
                                                        @endforeach
                                                    </div>
                                                @endif

                                                <!-- Add New Skill Input -->
                                                <div class="flex gap-2 mb-4">
                                                    <input wire:model="newSkill" wire:keydown.enter.prevent="addSkill"
                                                           type="text"
                                                           class="input input-bordered flex-1 focus:border-green-600 focus:ring focus:ring-green-200 transition-all"
                                                           placeholder="Type a skill and press Enter">
                                                    <button type="button" wire:click="addSkill"
                                                            class="btn btn-accent text-white border-none shadow-sm hover:shadow-md transition-all">
                                                        <i data-lucide="plus" class="w-4 h-4"></i>
                                                        Add
                                                    </button>
                                                </div>

                                                @if($availableSkills && count($availableSkills) > 0)
                                                    <div class="mt-3">
                                                        <p class="text-xs text-gray-600 mb-2">Or choose from existing
                                                            skills:</p>
                                                        <div class="flex flex-wrap gap-2">
                                                            @foreach($availableSkills as $availableSkill)
                                                                @if(!in_array($availableSkill, $skills))
                                                                    <button
                                                                        type="button"
                                                                        wire:click="addExistingSkill('{{ $availableSkill }}')"
                                                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors"
                                                                    >
                                                                        <i data-lucide="plus" class="w-3 h-3 mr-1"></i>
                                                                        {{ $availableSkill }}
                                                                    </button>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif

                                                <p class="text-xs text-gray-500 mt-2">Skills help volunteers find events
                                                    that match
                                                    their interests</p>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-accent">Save Changes</button>
                                </div>
                            </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </main>
</x-volunteer.dashboard-layout>
@assets
<script>
    let map;
    let marker;
    function initializeMap() {
        const initialLat = Number({{ $latitude ?? '7.8731' }});
        const initialLng = Number({{ $longitude ?? '80.7718' }});
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
            const initialPos = { lat: initialLat, lng: initialLng };
            placeMarker(initialPos);
            document.getElementById("latitude").value = initialLat;
            document.getElementById("longitude").value = initialLng;
            document.getElementById("lat-display").innerText = `Lat: ${initialLat.toFixed(6)}`;
            document.getElementById("lng-display").innerText = `Lng: ${initialLng.toFixed(6)}`;
            document.getElementById("coordinates-display").classList.remove("hidden");
            document.getElementById("no-location").classList.add("hidden");
        }

        map.addListener("click", (event) => {
            const pos = {
                lat: event.latLng.lat(),
                lng: event.latLng.lng()
            };
            placeMarker(pos);
        });
    }

    function placeMarker(pos) {
        // If a marker already exists, remove it
        if (marker) {
            marker.setMap(null);
        }

        console.log(google)

        // Create a new marker
        marker = new google.maps.marker.AdvancedMarkerElement({
            map,
            position: pos,
            title: "Hello, Sri Lanka!"
        });

        // Set the latitude and longitude input values
        document.getElementById("latitude").value = pos.lat;
        document.getElementById("longitude").value = pos.lng;

        Livewire.dispatch('coordinates', pos);


        // Update the coordinates display
        document.getElementById("lat-display").innerText = `Lat: ${pos.lat.toFixed(6)}`;
        document.getElementById("lng-display").innerText = `Lng: ${pos.lng.toFixed(6)}`;
        document.getElementById("coordinates-display").classList.remove("hidden");
        document.getElementById("no-location").classList.add("hidden");
    }

    function getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    console.log("Latitude:", latitude);
                    console.log("Longitude:", longitude);
                    // Set the map center to the current location
                    const pos = {
                        lat: latitude,
                        lng: longitude
                    }
                    map.setCenter(pos);
                    placeMarker(pos)
                },
                function (error) {
                    console.error("Error getting location:", error.message);
                }
            );
        } else {
            console.log("Geolocation is not supported by this browser.");
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
