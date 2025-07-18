<x-volunteer.dashboard-layout>
    <div class="container mx-auto py-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Profile Card -->
            <div class="card bg-white shadow-lg p-8 flex flex-col items-center">
                <div class="avatar mb-4">
                    <div class="w-32 h-32 rounded-full ring ring-accent ring-offset-base-100 ring-offset-2">
                        <img src="https://img.daisyui.com/images/profile/demo/yellingcat@192.webp" />
                    </div>
                </div>
                <h2 class="font-bold text-2xl mb-1">{{ auth()->user()->name }}</h2>
                <p class="text-sm text-gray-500 mb-2">{{ auth()->user()->role->name }}</p>
                <p class="text-xs text-gray-400 mb-4">{{ auth()->user()->email }}</p>
                <button class="btn btn-accent btn-sm mb-2">Update Photo</button>
                <div class="flex gap-2 mt-2">
                    <span class="badge badge-info">{{ auth()->user()->location ?? 'Ganemulla' }}</span>
                    <span class="badge badge-success">{{ auth()->user()->phone ?? '076-240-2350' }}</span>
                </div>
                <div class="mt-6">
                    <div class="radial-progress bg-accent text-accent-content border-accent border-4" style="--value:70;" aria-valuenow="70" role="progressbar">70%</div>
                    <p class="text-xs text-gray-500 mt-2">Profile Completion</p>
                </div>
            </div>

            <!-- Bio & Skills -->
            <div class="card bg-base-100 shadow-sm p-8">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="font-bold text-xl">Bio & Details</h1>
                    <button class="btn btn-accent btn-sm mb-2">
                        Edit
                    </button>
                </div>
                <div class="grid grid-cols-2 gap-8 mb-8">
                    <div>
                        <div class="flex flex-col mb-3">
                            <h1 class="font-medium text-gray-500 text-sm">Gender</h1>
                            <p class="font-semibold text-base"></p>

                        </div>
                        <h2 id="profileName" class="font-bold  text-2xl bg-clip-text text-black-50 mb-1">{{auth()->user()->name}}</h2>
                        <p id="profileRole" class="text-sm text-gray-500 mb-2">{{auth()->user()->role['name']}}</p>
                        <p id="profileEmail" class="text-xs text-gray-400 mb-4">{{auth()->user()->email}}</p>
                        <button onclick="updatePhoto()" class="btn bg-black text-white px-4 py-2 rounded-md  btn-sm mb-2">Update Photo</button>
                        <div class="flex gap-2 mt-2">
                            <span id="profileLocation" class="badge badge-info bg-blue-500/10 text-blue-600 border-blue-500/20">Ganemulla</span>
                            <span id="profilePhone" class="badge badge-success bg-green-500/10 text-green-600 border-green-500/20">076-240-2350</span>
                        </div>
                        <div class="mt-6">
                            <div class="radial-progress bg-black text-white border-black border-4" style="--value:70;" aria-valuenow="70" role="progressbar">70%</div>
                            <p class="text-xs text-gray-500 mt-2">Profile Completion</p>
                        </div>
                    </div>
                </div>

                <!-- Bio & Skills -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 via-green-500/10 to-gray-800/20 rounded-3xl transform rotate-1 group-hover:rotate-0 transition-transform duration-300"></div>
                    <div class="relative bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                        <div class="flex justify-between items-center mb-6">
                            <h1 class="font-bold text-xl bg-black bg-clip-text text-transparent">Bio & Details</h1>
                            <button onclick="editProfile()" class="btn bg-black text-white px-4 py-2 rounded-md btn-sm">Edit</button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                            <div>
                                <div class="flex flex-col mb-3">
                                    <h1 class="font-medium text-gray-500 text-sm">Gender</h1>
                                    <p id="profileGender" class="font-semibold text-base">Not specified</p>
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h1 class="font-medium text-gray-500 text-sm">Location</h1>
                                    <p id="profileLocationText" class="font-semibold text-base">Ganemulla</p>
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h1 class="font-medium text-gray-500 text-sm">Phone Number</h1>
                                    <p id="profilePhoneText" class="font-semibold text-base">076-240-2350</p>
                                </div>
                            </div>
                            <div>
                                <h1 class="font-bold text-xl mb-2 bg-gradient-to-r from-gray-800 to-blue-500 bg-clip-text text-transparent">Skills</h1>
                                <div id="skillsList" class="flex flex-wrap gap-2 mb-4">
                                    <span class="badge badge-info bg-blue-500/10 text-blue-600 border-blue-500/20">Communication</span>
                                    <span class="badge badge-success bg-green-500/10 text-green-600 border-green-500/20">Adaptability</span>
                                    <span class="badge badge-warning bg-yellow-500/10 text-yellow-600 border-yellow-500/20">Teamwork</span>
                                    <span class="badge badge-error bg-red-500/10 text-red-600 border-red-500/20">Punctual</span>
                                </div>
                                <button onclick="addSkill()" class="btn btn-outline btn-sm border-black-500 text-black-500 ">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Add Skill
                                </button>
                            </div>
                        </div>
                        <div>
                            <h1 class="font-bold text-xl mb-2 bg-gradient-to-r from-gray-800 to-blue-500 bg-clip-text text-transparent">About</h1>
                            <p id="profileAbout" class="text-gray-700">Enthusiastic volunteer passionate about making a difference in the community. Always eager to learn and help others.</p>
                        </div>

                        <button class="btn btn-outline btn-accent btn-sm">
                            <i data-lucide="plus"></i>
                            Add Skill
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </main>



</x-volunteer.dashboard-layout>
