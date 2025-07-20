<x-requester.dashboard-layout>
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
                            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8  ">
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
                                            <legend class="text-sm font-medium text-gray-700 px-2">Contact</legend>
                                            <input id="contact_number" wire:model="contact_number"
                                                   name="contact_number" type="text"
                                                   class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200">
                                        </fieldset>
                                        
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
</x-requester.dashboard-layout>

