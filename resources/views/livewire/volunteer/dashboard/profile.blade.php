<x-volunteer.dashboard-layout>
    <div class="container mx-auto py-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Profile Card -->
            <div class="card bg-white shadow-lg p-8 flex flex-col items-center">
                <div class="avatar mb-4">
                    <div class="w-32 h-32 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                        <img src="https://img.daisyui.com/images/profile/demo/yellingcat@192.webp" />
                    </div>
                </div>
                <h2 class="font-bold text-2xl mb-1">{{ auth()->user()->name }}</h2>
                <p class="text-sm text-gray-500 mb-2">{{ auth()->user()->role->name }}</p>
                <p class="text-xs text-gray-400 mb-4">{{ auth()->user()->email }}</p>
                <button class="btn btn-primary btn-sm mb-2">Update Photo</button>
                <div class="flex gap-2 mt-2">
                    <span class="badge badge-info">{{ auth()->user()->location ?? 'Ganemulla' }}</span>
                    <span class="badge badge-success">{{ auth()->user()->phone ?? '076-240-2350' }}</span>
                </div>
                <div class="mt-6">
                    <div class="radial-progress bg-primary text-primary-content border-primary border-4" style="--value:70;" aria-valuenow="70" role="progressbar">70%</div>
                    <p class="text-xs text-gray-500 mt-2">Profile Completion</p>
                </div>
            </div>

            <!-- Bio & Skills -->
            <div class="card bg-base-100 shadow-sm p-8">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="font-bold text-xl">Bio & Details</h1>
                    <button class="btn btn-primary btn-sm mb-2">
                        Edit
                    </button>
                </div>
                <div class="grid grid-cols-2 gap-8 mb-8">
                    <div>
                        <div class="flex flex-col mb-3">
                            <h1 class="font-medium text-gray-500 text-sm">Gender</h1>
                            <p class="font-semibold text-base"></p>
                        </div>
                        <div class="flex flex-col mb-3">
                            <h1 class="font-medium text-gray-500 text-sm">Location</h1>
                            <p class="font-semibold text-base"></p>
                        </div>
                        <div class="flex flex-col mb-3">
                            <h1 class="font-medium text-gray-500 text-sm">Phone Number</h1>
                            <p class="font-semibold text-base"></p>
                        </div>
                    </div>
                    <div>
                        <h1 class="font-bold text-xl mb-2">Skills</h1>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="badge badge-info">Communication</span>
                            <span class="badge badge-success">Adaptability</span>
                            <span class="badge badge-warning">Teamwork</span>
                            <span class="badge badge-error">Punctual</span>
                        </div>
                        <button class="btn btn-outline btn-primary btn-sm">
                            <i data-lucide="plus"></i>
                            Add Skill
                        </button>
                    </div>
                </div>
                <div>
                    <h1 class="font-bold text-xl mb-2">About</h1>
                    <p class="text-gray-700">Enthusiastic volunteer passionate about making a difference in the community. Always eager to learn and help others.</p>
                </div>
            </div>
        </div>
    </div>
</x-volunteer.dashboard-layout>