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
                            <div class="flex flex-col gap-2 items-center"
                                 x-data="{ uploading: false, progress: 0 }"
                                 x-on:livewire-upload-start="uploading = true"
                                 x-on:livewire-upload-finish="uploading = false"
                                 x-on:livewire-upload-cancel="uploading = false"
                                 x-on:livewire-upload-error="uploading = false"
                                 x-on:livewire-upload-progress="progress = $event.detail.progress">
                                
                                <div class="avatar">
                                    <div class="mask mask-squircle h-24 w-24 ring-4 ring-green-500/20">
                                        @if($profile_picture_url)
                                            <img id="profilePhoto" src="{{ $profile_picture_url }}" alt="Profile" />
                                        @elseif($profile_picture)
                                            <img id="profilePhoto" src="{{ $profile_picture->temporaryUrl() }}" alt="Profile" />
                                        @else
                                            <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                                <i data-lucide="user" class="size-10 text-gray-500"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex gap-1">
                                    <label class="bg-black rounded-full px-4 py-1 text-white cursor-pointer text-xs">
                                        Edit
                                        <input accept="image/*" wire:model="profile_picture" type="file" class="hidden"/>
                                    </label>

                                    @if($profile_picture)
                                        <button
                                            type="button"
                                            wire:click="saveProfilePicture"
                                            class="bg-black rounded-full px-4 py-1 text-white cursor-pointer text-xs">
                                            Save
                                        </button>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="space-y-1">
                                <h3 id="nameDisplay" class="font-bold text-2xl">{{auth()->user()->name}}</h3>
                                <p class="text-gray-600 text-sm">Legal Professional</p>
                            </div>
                        </div>
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
                                    <div class="mb-6" wire:ignore>
                                        <div class="border border-gray-300 rounded-lg overflow-hidden">
                                            <div id="map" class="w-full h-96 bg-gray-100 relative">
                                                <!-- Map will be initialized here -->
                                                <div class="absolute inset-0 flex items-center justify-center">
                                                    <div class="flex items-center gap-2">
                                                        <button class="btn btn-sm btn-accent"
                                                                onclick="initializeMap()"
                                                                type="button">
                                                            <i data-lucide="refresh-cw" class="size-4"></i>
                                                            <span class="ml-1">Reload Map</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Selected coordinates display -->
                                        <div class="mt-2">
                                            <div class="bg-white/80 rounded-md p-2 border border-gray-200">
                                                <!-- No location selected state -->
                                                <div id="no-location" class="text-center">
                                                    <p class="text-xs text-gray-500">
                                                        Click on the map to select your location
                                                    </p>
                                                </div>

                                                <div class="hidden" id="coordinates-display">
                                                    <div class="flex items-center justify-between">
                                                        <div class="flex items-center gap-2">
                                                            <button type="button"
                                                                    onclick="getCurrentLocation()"
                                                                    class="btn btn-xs btn-secondary"
                                                                    title="Use my current location">
                                                                <i data-lucide="crosshair" class="size-3"></i>
                                                            </button>
                                                        </div>
                                                        <div class="flex items-center gap-3 text-xs font-mono text-gray-700">
                                                            <span id="lat-display"></span>
                                                            <span class="text-gray-400">•</span>
                                                            <span id="lng-display"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Hidden inputs for form submission -->
                                            <input wire:model="latitude" type="hidden" id="latitude">
                                            <input wire:model="longitude" type="hidden" id="longitude">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-10">
                            <form wire:submit.prevent="save" class="w-full flex flex-col gap-6">
                                <!-- Success Message -->
                                @if (session()->has('success'))
                                    <div class="alert alert-success shadow-lg">
                                        <div>
                                            <i data-lucide="check-circle" class="size-5"></i>
                                            <span>{{ session('success') }}</span>
                                        </div>
                                    </div>
                                @endif

                                <div class="space-y-4">
                                    <!-- Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                                        <input type="text" wire:model="name" 
                                            class="input input-bordered w-full"
                                            placeholder="Enter your full name">
                                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Email (Read-only) -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                        <input type="text" value="{{ $email }}" disabled
                                            class="input input-bordered w-full bg-gray-50 text-gray-500">
                                    </div>

                                    <!-- Contact Number -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Contact Number</label>
                                        <input type="text" wire:model="contact_number" 
                                            class="input input-bordered w-full"
                                            placeholder="Enter your contact number">
                                        @error('contact_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Gender -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                                        <select wire:model="gender" class="select select-bordered w-full">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                        @error('gender') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- License Number -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">License Number</label>
                                        <input type="text" wire:model="license_number" 
                                            class="input input-bordered w-full"
                                            placeholder="Enter your license number">
                                        @error('license_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Specialization -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Specialization</label>
                                        <input type="text" wire:model="specialization" 
                                            class="input input-bordered w-full"
                                            placeholder="e.g., Criminal Law, Corporate Law">
                                        @error('specialization') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Years of Experience -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Years of Experience</label>
                                        <input type="number" wire:model="experience_years" 
                                            class="input input-bordered w-full"
                                            placeholder="Years of practice" min="0" max="70">
                                        @error('experience_years') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Save Button -->
                                <div class="mt-6">
                                    <button type="submit" 
                                        class="btn btn-block bg-black hover:bg-gray-800 text-white border-0"
                                        wire:loading.attr="disabled">
                                        <span wire:loading.remove wire:target="save">Save Changes</span>
                                        <span wire:loading wire:target="save" class="loading loading-spinner loading-sm"></span>
                                    </button>
                                </div>
                            </form>
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

        // If initial coordinates exist, place marker
        if (!isNaN(initialLat) && !isNaN(initialLng)) {
            const initialPos = { lat: initialLat, lng: initialLng };
            placeMarker(initialPos);
        }

        // Add click listener to map
        map.addListener('click', (event) => {
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

        // Create a new marker
        marker = new google.maps.marker.AdvancedMarkerElement({
            map,
            position: pos,
            title: "Lawyer Location"
        });

        // Set the latitude and longitude input values
        document.getElementById("latitude").value = pos.lat;
        document.getElementById("longitude").value = pos.lng;

        // Dispatch Livewire event
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
                    
                    // Set the map center to the current location
                    const pos = {
                        lat: latitude,
                        lng: longitude
                    };
                    map.setCenter(pos);
                    placeMarker(pos);
                },
                function (error) {
                    console.error("Error getting location:", error.message);
                    alert('Unable to get your location. Please enable location permissions.');
                }
            );
        } else {
            alert('Geolocation is not supported by this browser.');
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