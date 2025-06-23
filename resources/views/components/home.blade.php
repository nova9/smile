<div class="my-30">
    <div class="flex justify-around items-center">
        <div class=" max-w-1/3 flex flex-col lg:gap-4">
            <h1 class=" lg:text-6xl font-bold text-primary leading-tight ">
                Welcome to Smile
                <span class="text-accent">Volunteer</span>
                <br>
                with Heart!
            </h1>
            <p class="lg:text-xl py-6 ">
                Join a community of compassionate individuals making a
                difference. Whether you're lending a hand, sharing a <span class="text-accent">smile</span>,
                or building lasting friendships, your effort changes lives.
                Start your volunteering journey today!
            </p>
            <div class="flex w-1/2 gap-5">
                <x-buttons.button1>
                    I'd like to volunteer
                </x-buttons.button1>

                <x-buttons.button2>
                    I'm looking for volunteers
                </x-buttons.button2>

            </div>

        </div>
        <div class="flex gap-8">

            <div class="flex items-center">
                <div class="relative w-sm h-100">
                    <img
                        src="{{asset('storage/assets/1.jpg')}}"
                        class="w-full h-full rounded-lg object-cover "
                    />
                </div>

            </div>

            <div class="flex flex-col gap-8">
                <div class="relative w-3xs h-64">
                    <img
                        src="{{ asset('storage/assets/2.jpg') }}"
                        class="w-full h-full object-cover rounded-lg"
                    />

                </div>
                <div class="relative w-3xs h-64 ">

                    <img
                        src="{{asset('storage/assets/3.jpg')}}"
                        class="w-full h-full rounded-lg object-cover"
                    />


                </div>

            </div>
        </div>

    </div>
</div>
