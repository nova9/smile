<x-volunteer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-4xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500/10 to-green-600/10 text-green-600 rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-blue-500/20">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Your Volunteer Journey
                </div>
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl font-bold text-gray-800 leading-tight relative">
                        My <span class="bg-gradient-to-r from-green-500 to-green-600 bg-clip-text text-transparent">Profile</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-blue-500/30" viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Showcase your contributions and skills as a dedicated volunteer
                    </p>
                </div>
            </div>

            <!-- Profile and Bio Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Profile Card -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 via-green-500/10 to-gray-800/20 rounded-3xl transform rotate-1 group-hover:rotate-0 transition-transform duration-300"></div>
                    <div class="relative bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50 flex flex-col items-center">
                        <div class="avatar mb-4">
                            <div class="w-32 h-32 rounded-full ring ring-blue-500 ring-offset-base-100 ring-offset-2">
                                <img src="https://img.daisyui.com/images/profile/demo/yellingcat@192.webp" alt="Profile Avatar" />
                            </div>
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
                    </div>
                </div>
            </div>
        </div>
    </main>


</x-volunteer.dashboard-layout>
