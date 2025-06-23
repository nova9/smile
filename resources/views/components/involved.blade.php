<div class="min-h-screen flex flex-col gap-y-15 justify-center items-center">

    <div class="font-bold text-primary leading-tight text-center flex flex-col gap-y-5">
        <h1 class="lg:text-5xl ">
            Get involved
        </h1>
        <h1 class="lg:text-3xl font-medium ">
            Ways to Make a Difference
        </h1>
    </div>
    <div class="flex flex-col">
        <div class="grid grid-cols-3 gap-x-5">
            <div class="card w-sm  shadow-md rounded-xl border border-gray-200">
                <div class="card-body items-center text-center flex flex-col gap-y-5 p-10">
                    <img src="{{asset('storage/assets/heart.png')}}" alt="heart" class="w-3xs"/>
                    <h1 class="text-3xl text-primary font-bold" >Donate to Support Our Cause</h1>
                    <p class="text-gray-500 text-base">
                        Your contribution helps fund community programs and volunteer efforts. Every little bit counts!
                    </p>
                    <x-buttons.button1 class="w-full">
                        <i data-lucide="heart"></i>
                        Donate
                    </x-buttons.button1>
                </div>
            </div>
            <div class="card w-sm  shadow-md rounded-xl border border-gray-200">

                <div class="card-body items-center text-center flex flex-col gap-y-10 p-10">
                    <img src="{{asset('storage/assets/handshake.png')}}" alt="heart" class="h-48 mt-10"/>
                    <h1 class="text-3xl text-primary font-bold" >Join an Upcoming Event</h1>
                    <p class="text-gray-500 text-base">
                        Participate in local events to connect and contribute. Check our calendar for details.
                    </p>
                    <x-buttons.button1 class="w-full">
                        <i data-lucide="link"></i>
                        Join an event
                    </x-buttons.button1>
                </div>
            </div>
            <div class="card w-sm  shadow-md rounded-xl border border-gray-200">

                <div class="card-body items-center text-center flex flex-col gap-y-8 p-10">
                    <img src="{{asset('storage/assets/share.png')}}" alt="heart" class="h-48 mt-10 mb-2"/>
                    <h1 class="text-3xl text-primary font-bold" >Spread the Word</h1>
                    <p class="text-gray-500 text-base">
                        Share our mission with friends and family on social media to grow our community.
                    </p>
                    <x-buttons.button1 class="w-full">
                        <i data-lucide="share-2"></i>
                        Share now
                    </x-buttons.button1>
                </div>
            </div>

        </div>

        <div class="w-full flex justify-end mt-10">
            <x-buttons.button2 class="w-xs">
                Explore more ways to get involved!
                <i data-lucide="circle-arrow-right"></i>
            </x-buttons.button2>
        </div>
    </div>



</div>
