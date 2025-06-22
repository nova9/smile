<div class="mt-25">
    <div class="flex justify-between">
        <div class=" w-1/3 h-[510px] flex flex-col lg:gap-[15px]">
            <h1 class=" lg:text-6xl font-bold text-primary leading-tight ">
                Welcome to Smile
                <span class="text-accent">Volunteer</span>
                <br>
                with Heart!
            </h1>
            <p class="lg:text-xl py-6 ">
                Join a community of compassionate individuals making a <br>
                difference. Whether you're lending a hand, sharing a <span class="text-accent">smile</span>,<br>
                or building lasting friendships, your effort changes lives.<br>
                Start your volunteering journey today!
            </p>
            <div class="flex w-1/2 gap-5">
                <a href="/signup/volunteer" wire:navigate.hover>
                    <button
                        class="btn btn-accent w-[230px] h-[46px] rounded-[99px] text-accent-content px-[12px] py-[24px] lg:text-base">
                        I'd like to volunteer
                    </button>
                </a>

                <a href="/signup/requester" wire:navigate.hover>
                    <button
                        class="btn btn-outline border-2 btn-accent w-[230px] h-[46px] rounded-[99px] px-[12px] py-[24px] lg:text-base ">
                        I'm looking for volunteers
                    </button>
                </a>

            </div>

        </div>
        <div class="flex gap-[29px] w-1/2">

            <div class="flex items-center">
                <div class="relative w-[410px] h-[420px]">
                    <img
                        src="{{asset('storage/assets/1.jpg')}}"
                        class="w-full h-full rounded-lg object-cover "
                    />
                    <div
                        class="absolute top-0 left-0 w-full h-full bg-secondary-content opacity-20 rounded-lg pointer-events-none"></div>
                </div>

            </div>

            <div class="flex flex-col gap-[29px]">
                <div class="relative w-[250px] h-[270px]">
                    <img
                        src="{{ asset('storage/assets/2.jpg') }}"
                        class="w-full h-full object-cover rounded-lg"
                    />
                    <div
                        class="absolute top-0 left-0 w-full h-full bg-secondary-content opacity-20 rounded-lg pointer-events-none"></div>
                </div>
                <div class="relative w-[250px] h-[270px] ">

                    <img
                        src="{{asset('storage/assets/3.jpg')}}"
                        class="w-full h-full rounded-lg object-cover"
                    />
                    <div
                        class="absolute top-0 left-0 w-full h-full bg-secondary-content opacity-20 rounded-lg pointer-events-none"></div>

                </div>

            </div>
        </div>

    </div>
</div>
