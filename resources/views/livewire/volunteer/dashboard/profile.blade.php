<x-volunteer.dashboard-layout>
    <h1 class=" ml-5 my-5 text-xl xl:text-3xl font-bold text-primary leading-tight text-left">
        Profile
    </h1>
    <div class="ml-5 grid grid-cols-5 gap-x-5">
        <div class="card col-span-2 bg-base-100 card-xl shadow-sm ">
            <div class="card-body flex flex-col items-center gap-y-7">
                <h1 class="text-xl font-bold">{{auth()->user()->name}}</h1>
                <div class="relative h-50 w-50 rounded-full overflow-hidden">
                    <img src="{{ asset('storage/assets/dummy_profile_pic.png') }}" alt="profile_pic"
                         class="h-full w-full object-cover">
                </div>

                <button class="btn btn-primary">
                    Upload new photo
                </button>
            </div>
        </div>
        <div class="card col-span-2 bg-base-100 card-xl shadow-sm">
            <div class="card-body flex flex-col">
                <div class="flex justify-between">
                    <h2 class="text-base font-bold mb-5">Bio & other details</h2>
                    <button class="btn btn-primary">
                        <i data-lucide="square-pen"></i>
                        Edit
                    </button>
                </div>
                <div class="grid grid-cols-2">
                    <div class="flex flex-col gap-y-5">
                        <div>
                            <h1 class="text-gray-500 text-xs">Role</h1>
                            <p class="text-sm">Volunteer</p>
                        </div>
                        <div>
                            <h1 class="text-gray-500 text-xs">Email</h1>
                            <p class="text-sm">{{auth()->user()->email}}</p>
                        </div>
                        <div>
                            <h1 class="text-gray-500 text-xs">Phone</h1>
                            <p class="text-sm">076-240-2350</p>
                        </div>

                    </div>
                    <div class="flex flex-col gap-y-5">
                        <div>
                            <h1 class="text-gray-500 text-xs">Gender</h1>
                            <p class="text-sm">Female</p>
                        </div>

                        <div>
                            <h1 class="text-gray-500 text-xs">Location</h1>
                            <p class="text-sm">111/j,Bollatha,Ganemulla</p>
                        </div>

                        <div>
                            <h1 class="text-gray-500 text-xs">Total Hours</h1>
                            <p class="text-sm">120</p>
                        </div>

                    </div>
                </div>
                <div>
                    <h2 class="text-base font-bold mt-5">Badges</h2>
                    <div class="flex">
                        <div class="relative h-15 w-15 rounded-full overflow-hidden">
                            <img src="{{ asset('storage/assets/100_hour_legend_badge.png') }}" alt="profile_pic"
                                 class="h-full w-full object-cover">
                        </div>

                        <div class="relative h-15 w-15 rounded-full overflow-hidden">
                            <img src="{{ asset('storage/assets/starter_helper_badge.png') }}" alt="profile_pic"
                                 class="h-full w-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-volunteer.dashboard-layout>
