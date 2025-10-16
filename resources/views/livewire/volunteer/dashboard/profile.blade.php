<x-volunteer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">

            <!-- Profile Card -->
            <div>
                <div
                    class="border border-neutral-200 rounded-3xl p-8 shadow-sm bg-white flex flex-col gap-8">
                    <div class="flex items-center justify-between gap-6">
                        <div
                            x-data="{ uploading: false, progress: 0 }"
                            x-on:livewire-upload-start="uploading = true"
                            x-on:livewire-upload-finish="uploading = false"
                            x-on:livewire-upload-cancel="uploading = false"
                            x-on:livewire-upload-error="uploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                            class="flex gap-4"
                        >
                            <div class="flex flex-col gap-2 items-center">
                                <x-common.avatar size="100"
                                                 :src="$profile_picture ? $profile_picture->temporaryUrl() : ($profile_picture_url ? $profile_picture_url : '')"
                                                 :name="$name"/>

                                <div class="flex gap-1">

                                    <label
                                        class="bg-black rounded-full px-4 py-1 text-white cursor-pointer text-xs">
                                        Edit

                                        <input accept="image/*" wire:model="profile_picture" type="file"
                                               class="hidden"/>
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
                            <div class="flex flex-col">
                                <div class="flex flex-col gap-1">
                                    <h3 class="font-extrabold text-3xl  tracking-tight">{{ auth()->user()->name }}</h3>
                                    <h2 class="text-base text-gray-500 font-medium flex items-center gap-2">
                                        <i data-lucide="mail" class="w-4 h-4 text-accent"></i>
                                        {{ auth()->user()->email }}
                                    </h2>
                                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold shadow-sm">
                                        <i data-lucide="star" class="w-4 h-4 text-yellow-400"></i>
                                        {{ $volunteer_level }}
                                    </div>
                                </div>
                                <!-- Progress Bar -->
                                <div x-show="uploading">
                                    <progress class="progress w-56" x-bind:value="progress"
                                              max="100"></progress>
                                </div>
                            </div>

                        </div>

                        {{-- Progress --}}
                        <div
                            class="radial-progress"
                            style="--value:{{ $completion * 100 }};"
                            aria-valuenow="{{ $completion * 100 }}"
                            role="progressbar">{{ $completion * 100 }}%
                        </div>
                    </div>

                </div>
                <form wire:submit.prevent="save" class="space-y-4 sm:space-y-6" method="post">
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8 ">

                        <div class="col-span-2">

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Education</legend>
                                <div class="flex gap-2">
                                    <input type="text" class="input" placeholder="Institution" wire:model="institution">
                                    <input type="text" class="input flex-1" placeholder="Qualification" wire:model="qualification">
                                    <input type="text" class="input max-w-48" placeholder="Year of Completion" wire:model="year_of_completion">
                                    <button class="btn" type="button" wire:click="addEducation">Add</button>
                                </div>

                                @foreach($education as $item)
                                    <div class="flex items-center justify-between border border-neutral-300 rounded-sm p-2">
                                       <div class="flex gap-4">
                                           <p class="font-medium">{{$item['institution']}}</p>
                                           <p>{{$item['qualification']}}</p>
                                           <p>{{$item['year_of_completion']}}</p>
                                       </div>
                                        <button type="button" class="btn btn-sm btn-ghost btn-error p-1" wire:click="removeEducation('{{$item['id']}}')">
                                            <i data-lucide="trash-2" class="size-4"></i>
                                        </button>
                                    </div>
                                @endforeach

                            </fieldset>

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Skills</legend>
                                <x-common.form.input-list
                                    variable="skills"
                                    :suggestions="[
                                        'First Aid', 'Teamwork', 'Communication', 'Leadership', 'Event Planning',
                                        'Fundraising', 'Public Speaking', 'Teaching', 'Mentoring', 'Social Media Management',
                                        'Photography', 'Graphic Design', 'Web Development', 'Project Management', 'Cooking',
                                        'Organizing', 'Counseling', 'Data Entry', 'Advocacy', 'Environmental Awareness'
                                    ]"
                                />


                            </fieldset>

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Interests</legend>
                                <x-common.form.input-list
                                    variable="interests"
                                    :suggestions="[
                                        'Community Service', 'Education', 'Child Welfare', 'Elderly Care', 'Animal Welfare',
                                        'Environmental Conservation', 'Health & Wellness', 'Fundraising', 'Disaster Relief', 'Arts & Culture',
                                        'Sports & Recreation', 'Technology & Coding', 'Advocacy & Human Rights', 'Mentoring', 'Event Organization',
                                        'Homeless Support', 'Mental Health Awareness', 'Sustainable Development', 'Food Drives', 'Research & Data Analysis'
                                    ]"
                                />

                            </fieldset>
                        </div>
                        <div class="w-full">
                            <div class="">

                                <div class="">
                                    <div class="flex items-center gap-4 mb-2">
                                        <p>
                                            <i data-lucide="map-pin" class="size-4 inline"></i>
                                            <span class="font-medium text-sm">Location</span>
                                        </p>
                                        <p class="text-gray-500 text-xs">Select your current location</p>
                                    </div>
                                    <!-- Map Location Picker -->
                                    <div class="" wire:ignore>
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
                                        <div class="mt-2 group">
                                            <div>
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
                                                                    <i data-lucide="crosshair"
                                                                       class="size-3 group-hover:rotate-90 transition-transform duration-200"></i>
                                                                </button>
                                                            </div>
                                                            <div
                                                                class="flex items-center gap-3 text-xs font-mono text-gray-700">
                                                                <span id="lat-display"></span>
                                                                <span class="text-gray-400">•</span>
                                                                <span id="lng-display"></span>
                                                            </div>
                                                        </div>
                                                    </div>

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

                                    {{-- Name--}}
                                    <fieldset class="border border-gray-300 rounded-md p-4 bg-gray-50">
                                        <legend class="text-sm font-medium text-gray-700 px-2">Name</legend>
                                        <div class="w-full p-2 text-gray-800">{{ $name }}</div>
                                    </fieldset>
                                    <fieldset class="border border-gray-300 rounded-md p-4 bg-gray-50">
                                        <legend class="text-sm font-medium text-gray-700 px-2">Email</legend>
                                        <div class="w-full p-2 text-gray-800">{{ $email }}</div>
                                    </fieldset>

                                    <fieldset class="border border-gray-300 rounded-md p-4">
                                        <legend class="text-sm font-medium text-gray-700 px-2">Contact Number
                                        </legend>
                                        <input id="contact_number" wire:model="contact_number"
                                               name="contact_number" type="text"
                                               class="input w-full">
                                        @error('contact_number')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="border border-gray-300 rounded-md p-4">
                                        <legend class="text-sm font-medium text-gray-700 px-2">Gender</legend>
                                        <select id="gender" wire:model="gender" name="gender" class="select w-full">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                            <option value="prefer_not_to_say">Prefer not to say</option>
                                        </select>
                                        @error('gender')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                </div>


                            </div>
                        </div>




                    </div>

                    <button type="submit" class="btn btn-accent w-full">Save Changes</button>

                </form>
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
            const initialPos = {lat: initialLat, lng: initialLng};
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

    window.addEventListener("load", initializeMap);
</script>

@endassets
