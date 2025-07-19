<x-volunteer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500/10 to-green-600/10 text-black rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-green-500/20">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Your Profile
                </div>
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800 leading-tight relative">
                        My <span class="text-primary">Profile</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-green-500/30" viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Manage your personal information and showcase your skills
                    </p>
                </div>
            </div>

            <!-- Profile Card -->
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-br from-green-500/20 via-green-500/10 to-gray-800/20 rounded-3xl transform rotate-1 group-hover:rotate-0 transition-transform duration-300"></div>
                <div class="relative bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                    <div class="flex flex-col md:flex-row items-start justify-between gap-6">
                        <div class="flex items-center gap-6">
                            <div class="relative">
                                <div class="avatar">
                                    <div class="mask mask-squircle h-20 w-20 ring-4 ring-green-500/20">
                                        <img id="profilePhoto" src="https://img.daisyui.com/images/profile/demo/2@94.webp" alt="Profile" />
                                    </div>
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-black rounded-full flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <h3 id="nameDisplay" class="font-bold text-2xl ">{{auth()->user()->name}}</h3>
                                <input id="nameInput" type="text" value="John Doe" class="hidden mt-1 block w-full border border-gray-300 rounded-md p-2" />
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    <span id="locationDisplay" class="text-sm text-gray-600 font-medium">{{ $attribute['location'] ?? 'not specified' }}</span>
                                </div>
                                <button class="btn btn-accent btn-sm">Upload Photo</button>

                            </div>
                        </div>
                        <div class="flex items-center gap-8">
                            <div class="text-center">
                                <div class="relative">
                                    <p id="completionText" class="text-3xl font-bold">{{$completion === true ? '100%' : '50%'}}</p>
                                    <div class="absolute -inset-2 bg-gradient-to-r from-green-500/20 to-green-600/20 rounded-lg -z-10 opacity-50"></div>
                                </div>
                            </div>
                            <button id="editBtn" class="btn btn-accent" onclick="my_modal_4.showModal()">Edit Profile</button>
                            <dialog id="my_modal_4" class="modal">
                                <div class="modal-box w-11/12 max-w-3xl bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                                    <h3 class="text-lg font-bold text-gray-800">Edit Profile</h3>
                                    <p class="py-4 text-gray-600">Complete the profile in order to apply to events</p>
                                    <form wire:submit.prevent="save" class="space-y-4 sm:space-y-6" method="post">
                                    <div class="space-y-6">

                                        <fieldset class="border border-gray-300 rounded-md p-4">
                                            <legend class="text-sm font-medium text-gray-700 px-2">Name</legend>
                                            <input id="name" wire:model="name"  name="name" type="text" class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200" >
                                        </fieldset>
                                        <fieldset class="border border-gray-300 rounded-md p-4">
                                        <legend class="text-sm font-medium text-gray-700 px-2">Email</legend>
                                        <input id="email" wire:model="email"  name="email" type="email" class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200" >
                                        </fieldset>
                                        <fieldset class="border border-gray-300 rounded-md p-4">
                                            <legend class="text-sm font-medium text-gray-700 px-2">Contact</legend>
                                            <input id="contact_number" wire:model="contact_number"  name="contact_number" type="text" class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200" >
                                        </fieldset>
                                        <fieldset class="border border-gray-300 rounded-md p-4">
                                            <legend class="text-sm font-medium text-gray-700 px-2">Gender</legend>
                                            <input id="gender" wire:model="gender"  name="gender" type="text" class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200" >
                                        </fieldset>
                                        <fieldset class="border border-gray-300 rounded-md p-4">
                                            <legend class="text-sm font-medium text-gray-700 px-2">Location</legend>
                                            <input id="location" wire:model="location"  name="location" type="text" class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200" >
                                        </fieldset>
                                    </div>
                                        <div class="modal-action">
                                            <button type="submit" class="btn btn-accent">Save Changes</button>
                                            <button type="button" class="btn btn-outline" onclick="my_modal_4.close()">Close</button>
                                        </div>
                                    </form>
                                </div>

                            </dialog>
                        </div>
                    </div>
                    <div class="mt-6 w-full bg-gray-200 rounded-full h-2.5">
                        <div id="completionBar" class="bg-black h-2.5 rounded-full" style="width:{{$completion === true ? '100%' : '50%'}}"></div>
                    </div>
                    <div class="mt-8 flex gap-30">
                        <div class="flex flex-col gap-6">
                            <div>
                                <label class="text-sm font-medium text-gray-700 flex gap-1">
                                    <i data-lucide="users" class="size-4 "></i>
                                    <span>Role</span>
                                </label>
                                <p id="emailDisplay" class="text-gray-900 font-medium">{{auth()->user()->role['name']}}</p>
                                <input id="emailInput" type="email" value="john.doe@example.com" class="hidden mt-1 block w-full border border-gray-300 rounded-md p-2" />
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700 flex gap-1">
                                    <i data-lucide="mail" class="size-4 "></i>
                                   <span>Email</span>
                                </label>
                                <p id="emailDisplay" class="text-gray-900 font-medium">{{auth()->user()->email}}</p>
                                <input id="emailInput" type="email" value="john.doe@example.com" class="hidden mt-1 block w-full border border-gray-300 rounded-md p-2" />
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700 flex gap-1">
                                    <i data-lucide="contact" class="size-4 "></i>
                                    <span>Contact</span>
                                </label>
                                <p id="contactDisplay" class="text-gray-900 font-medium">{{ !empty($attribute['contact_number']) ? $attribute['contact_number'] : 'not specified'}}</p>
                                <input id="contactInput" type="text" value="+1 123-456-7890" class="hidden mt-1 block w-full border border-gray-300 rounded-md p-2" />
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-700 flex gap-1">
                                    <i data-lucide="users" class="size-4 "></i>
                                    <span>Gender</span>
                                </label>
                                <p id="genderDisplay" class="text-gray-900 font-medium"> {{ !empty($attribute['gender']) ? $attribute['gender'] : 'not specified' }}</p>
                                <input id="genderInput" type="text" value="Male" class="hidden mt-1 block w-full border border-gray-300 rounded-md p-2" />
                            </div>
                        </div>


                            <div>
                                <label class="text-sm font-medium text-gray-700 flex gap-1">
                                    <i data-lucide="book-open-text" class="size-4 "></i>
                                    <span>Skills</span>
                                </label>
                                <div id="skillsList" class="flex flex-wrap gap-2 mt-2">
                                    @foreach ($skills as $skill)
                                        <span class="bg-green-100 text-green-800 text-sm px-2 py-1 rounded">
                                            {{ $skill }}
                                        </span>
                                    @endforeach

                                </div>
                                <div id="skillsEdit" class=" mt-4">
                                    <input id="newSkillInput" type="text" placeholder="Add new skill" class="block w-full border border-gray-300 rounded-md p-2 mb-2" />
                                    <button id="addSkillBtn" class="btn btn-accent">Add Skill</button>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
</x-volunteer.dashboard-layout>
