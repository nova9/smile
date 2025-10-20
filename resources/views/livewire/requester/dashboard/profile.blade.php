<x-requester.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">

            <!-- Flash Messages -->
            @if (session('success'))
                <div class="alert alert-success">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">
                    <i data-lucide="x-circle" class="w-5 h-5"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Profile Card -->
            <div class="group">
                {{-- Picture--}}
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

                <!-- Subscription Status Card -->
                <div class="border border-neutral-200 rounded-3xl p-8 shadow-sm bg-white mt-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            @if(auth()->user()->upgrade()->exists())
                                <!-- Organization Pro Status -->
                                <div class="flex items-center gap-4">
                                    <div class="relative">
                                        <div
                                            class="w-16 h-16 rounded-full bg-gradient-to-r from-amber-400 to-orange-500 flex items-center justify-center">
                                            <i data-lucide="crown" class="w-8 h-8 text-white"></i>
                                        </div>
                                        <div
                                            class="absolute -top-1 -right-1 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                            <i data-lucide="check" class="w-3 h-3 text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900">Organization Pro</h3>
                                        <p class="text-sm text-gray-600">Premium features unlocked</p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-amber-100 to-orange-100 text-amber-800">
                                                Active
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                • Enhanced visibility • Priority support • Advanced features
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Basic Account Status -->
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-16 h-16 rounded-full bg-gradient-to-r from-gray-400 to-gray-500 flex items-center justify-center">
                                        <i data-lucide="user" class="w-8 h-8 text-white"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900">Basic Account</h3>
                                        <p class="text-sm text-gray-600">Standard features available</p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Free Plan
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                • Basic posting • Standard visibility • Community support
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if(auth()->user()->upgrade()->exists())
                            <!-- Downgrade Button for Organization users -->
                            <button class="btn btn-outline btn-error btn-sm" onclick="downgrade_modal.showModal()">
                                <i data-lucide="arrow-down" class="w-4 h-4"></i>
                                Downgrade to Basic
                            </button>
                        @else
                            <!-- Upgrade Button for Basic users -->
                            <a href="/requester/dashboard/upgrade" class="btn btn-primary btn-sm">
                                <i data-lucide="arrow-up" class="w-4 h-4"></i>
                                Upgrade to Pro
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Downgrade Confirmation Modal -->
                <dialog id="downgrade_modal" class="modal">
                    <div class="modal-box">
                        <h3 class="text-lg font-bold text-error">Confirm Downgrade</h3>
                        <div class="py-4">
                            <div class="alert alert-warning">
                                <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                                <div>
                                    <p class="font-medium">Are you sure you want to downgrade to Basic?</p>
                                    <p class="text-sm">You will lose access to:</p>
                                </div>
                            </div>

                            <ul class="list-disc list-inside mt-4 space-y-2 text-sm text-gray-600">
                                <li>Enhanced profile visibility</li>
                                <li>Priority event promotion</li>
                                <li>Advanced analytics and insights</li>
                                <li>Priority customer support</li>
                                <li>Custom organization branding</li>
                                <li>Unlimited volunteer applications</li>
                            </ul>

                            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mt-4">
                                <p class="text-sm text-red-800">
                                    <strong>Note:</strong> Your current premium features will be deactivated
                                    immediately.
                                    You can always upgrade again later, but some data may need to be re-configured.
                                </p>
                            </div>
                        </div>

                        <div class="modal-action">
                            <form method="dialog">
                                <button class="btn btn-ghost">Cancel</button>
                            </form>
                            <button wire:click="downgradeAccount" class="btn btn-error">
                                <i data-lucide="arrow-down" class="w-4 h-4"></i>
                                Yes, Downgrade
                            </button>
                        </div>
                    </div>
                </dialog>


                <!-- Profile Form -->
                <form wire:submit.prevent="save" class="space-y-4 sm:space-y-6" method="post">
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Organization Details -->
                        <div class="flex flex-col gap-6">
                            <fieldset class="border border-gray-300 rounded-md p-4 bg-gray-50">
                                <legend class="text-sm font-medium text-gray-700 px-2">Organization/Requester Name
                                </legend>
                                <input id="name" wire:model="name" name="name" type="text"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200">
                                @error('name')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="border border-gray-300 rounded-md p-4">
                                <legend class="text-sm font-medium text-gray-700 px-2">Description</legend>
                                <textarea id="description" wire:model="description" name="description"
                                    placeholder="Enter a brief description about your organization"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200"
                                    rows="4"></textarea>
                                @error('description')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </fieldset>

                            <fieldset class="border border-gray-300 rounded-md p-4">
                                <legend class="text-sm font-medium text-gray-700 px-2">Email</legend>
                                <input id="email" wire:model="email" name="email" type="email" disabled
                                    class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200">
                                @error('email')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="border border-gray-300 rounded-md p-4">
                                <legend class="text-sm font-medium text-gray-700 px-2">Contact Number</legend>
                                <input id="contact_number" wire:model="contact_number" name="contact_number" type="tel"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200">
                                @error('contact_number')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="border border-gray-300 rounded-md p-4">
                                <legend class="text-sm font-medium text-gray-700 px-2">Verification Details</legend>
                                <div class="space-y-4">
                                    <div>
                                        <label for="registration_number"
                                            class="block text-sm font-medium text-gray-700">Registration Number</label>
                                        <input id="registration_number" wire:model="registration_number"
                                            name="registration_number" type="text"
                                            class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200"
                                            placeholder="e.g. NGO-123456">
                                        @error('registration_number')
                                            <span class="text-xs text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="legal_status" class="block text-sm font-medium text-gray-700">Legal
                                            Status</label>
                                        <input id="legal_status" wire:model="legal_status" name="legal_status"
                                            type="text"
                                            class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200"
                                            placeholder="e.g. Registered NGO, Trust, etc.">
                                        @error('legal_status')
                                            <span class="text-xs text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="credentials" class="block text-sm font-medium text-gray-700">Other
                                            Credentials</label>
                                        <input id="credentials" wire:model="credentials" name="credentials" type="text"
                                            class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200"
                                            placeholder="e.g. Awards, certifications">
                                        @error('credentials')
                                            <span class="text-xs text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="verification_document"
                                            class="block text-sm font-medium text-gray-700">Verification Document (PDF,
                                            optional)</label>
                                        <input id="verification_document" wire:model="verification_document"
                                            name="verification_document" type="file" accept="application/pdf"
                                            class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200">
                                        {{-- @if($verification_document)
                                        <div class="mt-2 text-xs text-green-700">PDF uploaded: {{
                                            $verification_document->getClientOriginalName() }}</div>
                                        @endif --}}
                                        @error('verification_document')
                                            <span class="text-xs text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>
                            {{-- <fieldset class="border border-gray-300 rounded-md p-4">
                                <legend class="text-sm font-medium text-gray-700 px-2">New Password</legend>
                                <input id="password" wire:model="password" name="password" type="password"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200"
                                    autocomplete="new-password">
                                @error('password')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="border border-gray-300 rounded-md p-4">
                                <legend class="text-sm font-medium text-gray-700 px-2">Confirm Password</legend>
                                <input id="password_confirmation" wire:model="password_confirmation"
                                    name="password_confirmation" type="password"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200"
                                    autocomplete="new-password">
                                @error('password_confirmation')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </fieldset> --}}
                            {{-- <fieldset class="border border-gray-300 rounded-md p-4">
                                <legend class="text-sm font-medium text-gray-700 px-2">Notification Preferences</legend>
                                <select id="notification_preference" wire:model="notification_preference"
                                    name="notification_preference"
                                    class="select w-full border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200">
                                    <option value="all" {{ $notification_preference=='all' ? 'selected' : '' }}>All
                                        Notifications</option>
                                    <option value="important" {{ $notification_preference=='important' ? 'selected' : ''
                                        }}>Only Important</option>
                                    <option value="none" {{ $notification_preference=='none' ? 'selected' : '' }}>None
                                    </option>
                                </select>
                                @error('notification_preference')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </fieldset> --}}
                            <fieldset class="border border-gray-300 rounded-md p-4">
                                <legend class="text-sm font-medium text-gray-700 px-2">Payment Details</legend>
                                <p class="text-sm text-gray-500">Manage payment methods for premium features and
                                    donations via
                                    <a href="#" class="text-accent hover:underline">Payment Settings</a>.
                                </p>
                            </fieldset>
                        </div>

                        <!-- Address with Map Picker -->
                        <div class="w-full">
                            <label class="text-sm font-medium text-gray-700 flex gap-1">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Address</span>
                            </label>
                            <div class="card bg-white shadow-md">
                                <div class="card-body">
                                    <!-- Address Input -->
                                    <input id="address" wire:model="address" name="address" type="text"
                                        class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200 mb-4"
                                        placeholder="Enter organization address">
                                    @error('address')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                    <!-- Map Location Picker -->
                                    <div class="mb-6" wire:ignore>
                                        <div class="border border-gray-300 rounded-lg overflow-hidden">
                                            <div id="map" class="w-full h-96 bg-gray-100 relative">
                                                <div class="absolute inset-0 flex items-center justify-center">
                                                    <div class="flex items-center gap-2">
                                                        <button class="btn btn-sm btn-accent" onclick="initializeMap()"
                                                            type="button">
                                                            <i data-lucide="refresh-cw" class="size-4"></i>
                                                            <span class="ml-1">Reload Map</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Selected Coordinates Display -->
                                        <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                                            <div class="flex items-center justify-between mb-3">
                                                <div class="flex items-center gap-2">
                                                    <i data-lucide="navigation" class="size-4 text-accent"></i>
                                                    <h4 class="text-sm font-medium text-gray-700">Selected Location</h4>
                                                </div>
                                                <button type="button" onclick="getCurrentLocation()"
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
                                                    <i data-lucide="map" class="size-8 mx-auto mb-2 text-accent"></i>
                                                    <p class="text-sm">Click on the map to select a location</p>
                                                </div>
                                            </div>
                                            <!-- Hidden inputs for form submission -->
                                            <input wire:model.defer="latitude" type="hidden" id="latitude">
                                            <input wire:model.defer="longitude" type="hidden" id="longitude">
                                        </div>
                                        @error('latitude') <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                        @enderror
                                        @error('longitude') <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-accent w-full">Save Changes</button>
                </form>
            </div>
        </div>
    </main>

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
            if (marker) {
                marker.setMap(null);
            }

            marker = new google.maps.marker.AdvancedMarkerElement({
                map,
                position: pos,
                title: "Organization Location"
            });

            document.getElementById("latitude").value = pos.lat;
            document.getElementById("longitude").value = pos.lng;
            Livewire.dispatch('coordinates', pos);

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
                        const pos = { lat: latitude, lng: longitude };
                        map.setCenter(pos);
                        placeMarker(pos);
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
</x-requester.dashboard-layout>
