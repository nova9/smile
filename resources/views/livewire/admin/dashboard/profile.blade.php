<x-admin.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-3xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="space-y-2 text-center mb-8">
                <h1 class="text-4xl sm:text-5xl font-extrabold text-blue-700 leading-tight">
                    Admin <span class="text-accent">Profile</span>
                </h1>
                <p class="text-base text-gray-500">
                    Update your contact information below.
                </p>
            </div>
            <!-- Profile Card (Volunteer style) -->
            <div class="bg-white shadow-lg rounded-2xl border border-blue-200 p-8">
                <div class="flex items-center gap-6 mb-8">
                    <div class="avatar">
                        <div class="mask mask-squircle h-20 w-20 ring-4 ring-blue-500/20">
                            <img id="profilePhoto"
                                 src="{{ $profile_picture ?? 'https://img.daisyui.com/images/profile/demo/2@94.webp' }}" alt="Profile"/>
                        </div>
                    </div>
                    <div>
                        <h3 id="nameDisplay" class="font-bold text-2xl text-blue-800">{{ $name }}</h3>
                        <button class="btn btn-accent btn-sm mt-2">Upload Photo</button>
                    </div>
                </div>
                <form wire:submit.prevent="save" class="space-y-6" method="post">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <fieldset class="border border-gray-300 rounded-md p-4 mb-4">
                                <legend class="text-sm font-medium text-blue-700 px-2">Email</legend>
                                <input id="email" wire:model="email" name="email" type="email"
                                       class="w-full p-2 border border-blue-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-150">
                                @error('email')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </fieldset>
                        </div>
                        <div>
                            <fieldset class="border border-gray-300 rounded-md p-4 mb-4">
                                <legend class="text-sm font-medium text-blue-700 px-2">Contact Number</legend>
                                <input id="contact_number" wire:model="contact_number" name="contact_number" type="text"
                                       class="w-full p-2 border border-blue-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-150">
                                @error('contact_number')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </fieldset>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="btn btn-primary bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-admin.dashboard-layout>
@assets

<script>

    window.addEventListener("load",loadScript);
</script>
@endassets