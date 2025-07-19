<x-requester.dashboard-layout>
    <div class="p-6 max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Create New Event</h1>
            <p class="text-gray-600 mt-2">Organize a meaningful volunteer opportunity for your community</p>
        </div>

        <form wire:submit.prevent="save" class="space-y-8">
            <!-- Basic Information Card -->
            <div class="card bg-white shadow-md">
                <div class="card-body">
                    <h2 class="card-title text-xl mb-4 flex items-center">
                        <i data-lucide="info" class="size-5 mr-2 text-primary"></i>
                        Basic Information
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Event Name -->
                        <div class="md:col-span-2">
                            <x-common.auth.input
                                name="name"
                                label="Event Name"
                                placeholder="e.g., Community Food Drive"
                                required
                            />
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                            <select wire:model="category_id" id="category_id" class="select select-bordered w-full @error('category_id') select-error @enderror">
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Max Participants -->
                        <div>
                            <label for="max_participants" class="block text-sm font-medium text-gray-700 mb-2">Maximum Participants</label>
                            <input wire:model="max_participants" type="number" id="max_participants" class="input input-bordered w-full" placeholder="e.g., 50" min="1">
                            @error('max_participants') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                            <textarea wire:model="description" id="description" rows="4" class="textarea textarea-bordered w-full @error('description') textarea-error @enderror" placeholder="Describe the event, activities, and what volunteers will be doing..."></textarea>
                            @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Date & Time Card -->
            <div class="card bg-white shadow-md">
                <div class="card-body">
                    <h2 class="card-title text-xl mb-4 flex items-center">
                        <i data-lucide="calendar" class="size-5 mr-2 text-primary"></i>
                        Date & Time
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Start Date & Time -->
                        <div>
                            <label for="starts_at" class="block text-sm font-medium text-gray-700 mb-2">Start Date & Time *</label>
                            <input wire:model="starts_at" type="datetime-local" id="starts_at" class="input input-bordered w-full @error('starts_at') input-error @enderror">
                            @error('starts_at') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- End Date & Time -->
                        <div>
                            <label for="ends_at" class="block text-sm font-medium text-gray-700 mb-2">End Date & Time *</label>
                            <input wire:model="ends_at" type="datetime-local" id="ends_at" class="input input-bordered w-full @error('ends_at') input-error @enderror">
                            @error('ends_at') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Location Card -->
            <div class="card bg-white shadow-md">
                <div class="card-body">
                    <h2 class="card-title text-xl mb-4 flex items-center">
                        <i data-lucide="map-pin" class="size-5 mr-2 text-primary"></i>
                        Location Details
                    </h2>

                    <!-- Map Location Picker -->
                    <div class="mb-6">
                        <div class="border border-gray-300 rounded-lg overflow-hidden">
                            <div id="map" class="w-full h-96 bg-gray-100 relative">
                                <!-- Map will be initialized here -->
                                <div class="absolute inset-0 flex items-center justify-center">
{{--                                    loading state--}}
                                    <div class="flex items-center gap-2">
                                        <button
                                            type="button"
                                            onclick="initializeMap()"
                                            class="btn btn-sm bg-primary"
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
                                    <i data-lucide="navigation" class="size-4 text-primary"></i>
                                    <h4 class="text-sm font-medium text-gray-700">Selected Location</h4>
                                </div>
                                <button type="button"
                                        onclick="getCurrentLocation()"
                                        class="btn btn-sm bg-primary hover:bg-green-700 text-white border-none shadow-sm hover:shadow-md transition-all duration-200 group"
                                        title="Use my current location">
                                    <i data-lucide="crosshair" class="size-4 group-hover:rotate-90 transition-transform duration-200"></i>
                                    <span class="hidden sm:inline ml-1">Current Location</span>
                                </button>
                            </div>

                            <div id="coordinates-display" class="hidden">
                                <div class="flex items-center gap-4 p-3 bg-white/50 rounded-lg border border-green-100">
                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                        <i data-lucide="map-pin" class="size-4 text-primary0"></i>
                                        <span class="font-medium">Coordinates:</span>
                                    </div>
                                    <div class="flex items-center gap-4 text-sm font-mono">
                                        <span id="lat-display" class="text-gray-700"></span>
                                        <span class="text-gray-400">•</span>
                                        <span id="lng-display" class="text-gray-700"></span>
                                    </div>
                                </div>
                            </div>

                            <div id="no-location" class="flex items-center justify-center py-6 text-gray-500">
                                <div class="text-center">
                                    <i data-lucide="map" class="size-8 mx-auto mb-2 text-gray-300"></i>
                                    <p class="text-sm">Click on the map to select a location</p>
                                </div>
                            </div>

                            <!-- Hidden inputs for form submission -->
                            <input wire:model="latitude" type="hidden" id="latitude">
                            <input wire:model="longitude" type="hidden" id="longitude">
                        </div>

                        @error('latitude') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        @error('longitude') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Requirements & Skills Card -->
            <div class="card bg-white shadow-md">
                <div class="card-body">
                    <h2 class="card-title text-xl mb-4 flex items-center">
                        <i data-lucide="user-check" class="size-5 mr-2 text-primary"></i>
                        Volunteer Requirements
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Skills Required -->
                        <div>
                            <label for="skills_required" class="block text-sm font-medium text-gray-700 mb-2">Skills Required</label>
                            <textarea wire:model="skills_required" id="skills_required" rows="3" class="textarea textarea-bordered w-full" placeholder="List any specific skills, experience, or qualifications needed..."></textarea>
                        </div>

                        <!-- What to Bring -->
                        <div>
                            <label for="what_to_bring" class="block text-sm font-medium text-gray-700 mb-2">What Volunteers Should Bring</label>
                            <textarea wire:model="what_to_bring" id="what_to_bring" rows="3" class="textarea textarea-bordered w-full" placeholder="e.g., comfortable clothing, water bottle, gloves..."></textarea>
                        </div>

                        <!-- Age Requirements -->
                        <div>
                            <label for="min_age" class="block text-sm font-medium text-gray-700 mb-2">Minimum Age</label>
                            <select wire:model="min_age" id="min_age" class="select select-bordered w-full">
                                <option value="">No age restriction</option>
                                <option value="13">13+</option>
                                <option value="16">16+</option>
                                <option value="18">18+</option>
                                <option value="21">21+</option>
                            </select>
                        </div>

                        <!-- Physical Requirements -->
                        <div>
                            <label for="physical_requirements" class="block text-sm font-medium text-gray-700 mb-2">Physical Requirements</label>
                            <select wire:model="physical_requirements" id="physical_requirements" class="select select-bordered w-full">
                                <option value="none">No physical requirements</option>
                                <option value="light">Light physical activity</option>
                                <option value="moderate">Moderate physical activity</option>
                                <option value="heavy">Heavy physical activity</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact & Additional Info Card -->
            <div class="card bg-white shadow-md">
                <div class="card-body">
                    <h2 class="card-title text-xl mb-4 flex items-center">
                        <i data-lucide="phone" class="size-5 mr-2 text-primary"></i>
                        Contact & Additional Information
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Contact Person -->
                        <div>
                            <label for="contact_person" class="block text-sm font-medium text-gray-700 mb-2">Contact Person</label>
                            <input wire:model="contact_person" type="text" id="contact_person" class="input input-bordered w-full" placeholder="Name of contact person">
                        </div>

                        <!-- Contact Phone -->
                        <div>
                            <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Contact Phone</label>
                            <input wire:model="contact_phone" type="tel" id="contact_phone" class="input input-bordered w-full" placeholder="+94 77 123 4567">
                        </div>

                        <!-- Contact Email -->
                        <div>
                            <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">Contact Email</label>
                            <input wire:model="contact_email" type="email" id="contact_email" class="input input-bordered w-full" placeholder="contact@organization.com">
                        </div>

                        <!-- Registration Deadline -->
                        <div>
                            <label for="registration_deadline" class="block text-sm font-medium text-gray-700 mb-2">Registration Deadline</label>
                            <input wire:model="registration_deadline" type="date" id="registration_deadline" class="input input-bordered w-full">
                        </div>

                        <!-- Tags -->
                        <div class="md:col-span-2">
                            <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                            <input wire:model="tags" type="text" id="tags" class="input input-bordered w-full" placeholder="e.g., community, environment, youth (comma separated)">
                            <p class="text-xs text-gray-500 mt-1">Separate multiple tags with commas</p>
                        </div>

                        <!-- Additional Notes -->
                        <div class="md:col-span-2">
                            <label for="additional_notes" class="block text-sm font-medium text-gray-700 mb-2">Additional Notes</label>
                            <textarea wire:model="additional_notes" id="additional_notes" rows="3" class="textarea textarea-bordered w-full" placeholder="Any other important information for volunteers..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-between items-center pt-6 border-t">
                <a href="/requester/dashboard/my-events" class="btn btn-outline">
                    <i data-lucide="arrow-left" class="size-4 mr-2"></i>
                    Cancel
                </a>

                <div class="flex gap-3">
                    <button type="button" wire:click="saveDraft" class="btn btn-outline">
                        <i data-lucide="save" class="size-4 mr-2"></i>
                        Save as Draft
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i data-lucide="calendar-plus" class="size-4 mr-2"></i>
                        Create Event
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        let map;
        let marker;

        function initializeMap() {
            // Initialize the map
            const mapOptions = {
                center: { lat: 7.8731, lng: 80.7718 },
                zoom: 7,
                mapId: "198a0e442491558328ee7d20"
            };

            map = new google.maps.Map(document.getElementById("map"), mapOptions);

            // Add a click listener to the map
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
</x-requester.dashboard-layout>
