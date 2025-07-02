<x-volunteer.dashboard-layout>
    <div class="grid grid-cols-8 m-10">
        <div class="col-span-7 card bg-base-100  shadow-sm">
            <figure class="px-10 pt-10">
                <div class="avatar ">
                    <div class="w-50 rounded-full">
                        <img src="https://img.daisyui.com/images/profile/demo/yellingcat@192.webp" />
                    </div>
                </div>
            </figure>
            <div class="card-body items-center text-center">
                <div class="card-actions">
                    <button class="btn btn-primary">Update New Photo</button>
                </div>
            </div>

            <div class="card-body p-10">
                <div class="flex justify-between" >
                    <h1 class="font-bold text-xl">Bio & other details</h1>
                    <button class="btn btn-xs sm:btn-sm md:btn-md lg:btn-lg xl:btn-xl">
                        <i data-lucide="square-pen"></i>
                        Edit</button>
                </div>
                <div class="grid grid-cols-4">
                    <div class="flex flex-col  col-span-1">
                        <div>
                            <div class="flex flex-col mb-3">
                                <h1 class="font-medium text-gray-500 text-sm">Role</h1>
                                <p class="font-semibold text-base">{{auth()->user()->role->name}}</p>
                            </div>
                            <div class="flex flex-col mb-3">
                                <h1 class="font-medium text-gray-500 text-sm">Name</h1>
                                <p class="font-semibold text-base">{{auth()->user()->name}}</p>
                            </div>
                            <div class="flex flex-col mb-3">
                                <h1 class="font-medium text-gray-500 text-sm">Email</h1>
                                <p class="font-semibold text-base">{{auth()->user()->email}}</p>
                            </div>

                            <div class="flex flex-col mb-3">
                                <h1 class="font-medium text-gray-500 text-sm">Gender</h1>
                                <p class="font-semibold text-base">Female</p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-y-5">
                            <h1 class="font-bold text-xl">Skills</h1>

                            <div class="flex gap-x-3">
                                <div class="badge badge-info">
                                    Communication
                                </div>
                                <div class="badge badge-success">
                                    Adaptability
                                </div>
                                <div class="badge badge-warning">
                                    Teamwork
                                </div>
                                <div class="badge badge-error">
                                    Puntual
                                </div>
                            </div>

                            <button class="btn btn-outline btn-primary max-w-1/2 ">
                                <i data-lucide="plus"></i>
                                Skill
                            </button>
                        </div>


                    </div>
                    <div class="flex flex-col gap-y-5 col-span-1">
                        <div class="flex flex-col">
                            <h1 class="font-medium text-gray-500 text-sm">Location</h1>
                            <p class="font-semibold text-base">Ganemulla</p>
                        </div>
                        <div class="flex flex-col">
                            <h1 class="font-medium text-gray-500 text-sm">Phone Number</h1>
                            <p class="font-semibold text-base">076-240-2350</p>
                        </div>

                    </div>
                    <div class="col-span-2">
                        <div class="flex flex-col gap-y-6">
                            <h1 class="font-bold text-xl">Badges</h1>
                            <ul class="list bg-base-100 rounded-box shadow-md">

                                <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Current badges you earned</li>

                                <li class="list-row">
                                    <div><img class="size-10 rounded-box" src="https://picsum.photos/200/300.webp"/></div>
                                    <div>
                                        <div>Starter Helper</div>
                                        <div class="text-xs uppercase font-semibold opacity-60">You successfully completed first 1 hour of volunteering.</div>
                                    </div>
                                    <p class="list-col-wrap text-xs">
                                        "You've kicked off your volunteering journey with a bang! This badge celebrates your successful completion of your first hour of volunteering, making a positive impact in your community. Keep up the great work!
                                    </p>
                                    <div class="text-xs opacity-60 tracking-wide flex flex-col text-right">
                                        <p>Earned 13 days ago</p>
                                        <p>3,000 users earned this</p>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-span-1 flex justify-center">

            <div
                class="radial-progress bg-primary text-primary-content border-primary border-4"
                style="--value:70;" aria-valuenow="70" role="progressbar">
                70%
            </div>
        </div>
    </div>
</x-volunteer.dashboard-layout>
