<x-volunteer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 pt-20 pb-32">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white/90 backdrop-blur-md rounded-3xl  p-10 flex flex-col gap-6">
                <!-- Badge -->
                <div class="inline-flex items-center px-4 py-2 bg-accent/10 text-accent rounded-full text-sm font-medium mx-auto lg:mx-0">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Celebrating Our Top Smilers
                </div>

                <!-- Title -->
                <h2 class="text-4xl sm:text-5xl font-bold text-primary leading-tight text-center relative">
                    Top Smilers
                    <svg class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-32 h-3 text-accent/30" viewBox="0 0 100 12" fill="none">
                        <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </h2>


                <!-- Top 3 Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 my-10">
                    <!-- First Place Card -->
                    <div class="relative bg-yellow-50/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 text-center transform hover:scale-105 transition-transform duration-300">
                        <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                            <div class="avatar">
                                <div class="mask mask-squircle h-16 w-16">
                                    <img src="{{asset('storage/assets/firstplace.png')}}" alt="First Place Medal" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-8">
                            <div class="avatar">
                                <div class="mask mask-squircle h-16 w-16 mx-auto">
                                    <img src="https://img.daisyui.com/images/profile/demo/2@94.webp" alt="Hart Hagerty Avatar" />
                                </div>
                            </div>
                            <h3 class="mt-4 font-bold text-lg bg-gradient-to-r from-yellow-600 to-yellow-400 bg-clip-text text-transparent">{{$users[0]->name}}</h3>
                            <p class="text-sm text-gray-600">UCSC</p>
                            <p class="mt-2 font-semibold text-primary">{{$users[0]->badges_sum_points}} Points</p>
                            <span class="badge bg-yellow-400 text-white font-bold mt-2">1st</span>
                        </div>
                    </div>

                    <!-- Second Place Card -->
                    <div class="relative bg-gray-100/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 text-center transform hover:scale-105 transition-transform duration-300">
                        <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                            <div class="avatar">
                                <div class="mask mask-squircle h-16 w-16">
                                    <img src="{{asset('storage/assets/firstplace.png')}}" alt="Second Place Medal" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-8">
                            <div class="avatar">
                                <div class="mask mask-squircle h-16 w-16 mx-auto">
                                    <img src="https://img.daisyui.com/images/profile/demo/3@94.webp" alt="Brice Swyre Avatar" />
                                </div>
                            </div>
                            <h3 class="mt-4 font-bold text-lg bg-gradient-to-r from-gray-600 to-gray-400 bg-clip-text text-transparent">{{$users[1]->name}}</h3>
                            <p class="text-sm text-gray-600">UOC</p>
                            <p class="mt-2 font-semibold text-primary">{{$users[1]->badges_sum_points}} Points</p>
                            <span class="badge bg-gray-400 text-white font-bold mt-2">2nd</span>
                        </div>
                    </div>

                    <!-- Third Place Card -->
                    <div class="relative bg-orange-50/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 text-center transform hover:scale-105 transition-transform duration-300">
                        <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                            <div class="avatar">
                                <div class="mask mask-squircle h-16 w-16">
                                    <img src="{{asset('storage/assets/firstplace.png')}}" alt="Third Place Medal" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-8">
                            <div class="avatar">
                                <div class="mask mask-squircle h-16 w-16 mx-auto">
                                    <img src="https://img.daisyui.com/images/profile/demo/4@94.webp" alt="Marjy Ferencz Avatar" />
                                </div>
                            </div>
                            <h3 class="mt-4 font-bold text-lg bg-gradient-to-r from-orange-600 to-orange-400 bg-clip-text text-transparent">{{$users[2]->name}}</h3>
                            <p class="text-sm text-gray-600">UOK</p>
                            <p class="mt-2 font-semibold text-primary">{{$users[2]->badges_sum_points}} Points</p>
                            <span class="badge bg-orange-400 text-white font-bold mt-2">3rd</span>
                        </div>
                    </div>
                </div>
                <!-- My Rank Card -->
                <div class="relative bg-gray-50/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 text-center transform hover:scale-105 transition-transform duration-300">

                    <div class="mt-8">
                        <div class="avatar">
                            <div class="mask mask-squircle h-16 w-16 mx-auto">
                                <img src="https://img.daisyui.com/images/profile/demo/2@94.webp" alt="User Avatar" />
                            </div>
                        </div>
                        <h3 class="mt-4 font-bold text-lg bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">You</h3>
                        <p class="text-sm text-gray-600">UCSC</p>
                        <p class="mt-2 font-semibold text-primary">{{$currentUser->badges_sum_points??'Zero'}} Points</p>
                        <span class="badge bg-primary text-white font-bold mt-2">{{$currentUserPosition}}th</span>
                    </div>
                </div>
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <!-- Head -->
                        <thead>
                        <tr class="bg-gradient-to-r from-accent/20 to-primary/20 text-primary">
                            <th class="px-4 py-3"></th>
                            <th class="px-4 py-3 text-left">Volunteer</th>
                            <th class="px-4 py-3 text-left">Points</th>
                            <th class="px-4 py-3 text-left">Rank</th>
                        </tr>
                        </thead>
                        <tbody>

                        <!-- Row 1: First Place -->
                        <tr class="bg-yellow-50/50 hover:bg-yellow-100/50 transition-colors">
                            <th class="px-4 py-3">
                                <label>
                                    <div class="avatar">
                                        <div class="mask mask-squircle h-12 w-12">
                                            <img src="{{asset('storage/assets/firstplace.png')}}" alt="First Place Medal" />
                                        </div>
                                    </div>
                                </label>
                            </th>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="mask mask-squircle h-12 w-12">
                                            <img src="https://img.daisyui.com/images/profile/demo/2@94.webp" alt="Avatar Tailwind CSS Component" />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold text-lg bg-gradient-to-r from-yellow-600 to-yellow-400 bg-clip-text text-transparent">{{$users[0]->name}}</div>
                                        <div class="text-sm text-gray-600">UCSC</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 font-semibold text-primary">{{$users[0]->badges_sum_points}}</td>
                            <td class="px-4 py-3">
                                <span class="badge bg-yellow-400 text-white font-bold">01</span>
                            </td>
                        </tr>
                        <!-- Row 2: Second Place -->
                        <tr class="bg-gray-100/50 hover:bg-gray-200/50 transition-colors">
                            <th class="px-4 py-3">
                                <label>
                                    <div class="avatar">
                                        <div class="mask mask-squircle h-12 w-12">
                                            <img src="{{asset('storage/assets/firstplace.png')}}" alt="Second Place Medal" />
                                        </div>
                                    </div>
                                </label>
                            </th>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="mask mask-squircle h-12 w-12">
                                            <img src="https://img.daisyui.com/images/profile/demo/3@94.webp" alt="Avatar Tailwind CSS Component" />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold text-lg bg-gradient-to-r from-gray-600 to-gray-400 bg-clip-text text-transparent">{{$users[1]->name}}</div>
                                        <div class="text-sm text-gray-600">UOC</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 font-semibold text-primary">{{$users[1]->badges_sum_points}}</td>
                            <td class="px-4 py-3">
                                <span class="badge bg-gray-400 text-white font-bold">02</span>
                            </td>
                        </tr>
                        <!-- Row 3: Third Place -->
                        <tr class="bg-orange-50/50 hover:bg-orange-100/50 transition-colors">
                            <th class="px-4 py-3">
                                <label>
                                    <div class="avatar">
                                        <div class="mask mask-squircle h-12 w-12">
                                            <img src="{{asset('storage/assets/firstplace.png')}}" alt="Third Place Medal" />
                                        </div>
                                    </div>
                                </label>
                            </th>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="mask mask-squircle h-12 w-12">
                                            <img src="https://img.daisyui.com/images/profile/demo/4@94.webp" alt="Avatar Tailwind CSS Component" />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold text-lg bg-gradient-to-r from-orange-600 to-orange-400 bg-clip-text text-transparent">{{$users[2]->name}}</div>
                                        <div class="text-sm text-gray-600">UOK</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 font-semibold text-primary">{{$users[2]->badges_sum_points}}</td>
                            <td class="px-4 py-3">
                                <span class="badge bg-orange-400 text-white font-bold">03</span>
                            </td>
                        </tr>
                        <!-- Row 4 -->
                        @foreach($users->slice(3) as $index => $user)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <th class="px-4 py-3"></th>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle h-12 w-12">
                                                <img src="https://img.daisyui.com/images/profile/demo/5@94.webp" alt="Avatar Tailwind CSS Component" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold text-lg text-primary">{{$user->name}}</div>
                                            <div class="text-sm text-gray-600">Brazil</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 font-semibold text-primary">{{$user->badges_sum_points}}</td>
                                <td class="px-4 py-3">
                                    <span class="badge badge-ghost font-bold">{{$index+1}}</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </main>



</x-volunteer.dashboard-layout>
