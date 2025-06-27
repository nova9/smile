<div class="px-4 sm:px-6 lg:px-8">
    <div class="grid place-items-center grid-cols-2 gap-x-10 ">
        <div class="w-full flex flex-col gap-y-2 ">
            <h1 class="xl:text-6xl lg:text-4xl font-bold text-primary leading-tight">
                Welcome to Smile
                <span class="text-accent">Volunteer</span>
                <br>
                with Heart!
            </h1>
            <p class="xl:text-xl  text-base py-4 md:py-6 max-w-2xl mx-auto lg:mx-0 ">
                Join a community of compassionate individuals making a
                difference. Whether you're lending a hand, sharing a <span class="text-accent">smile</span>,
                or building lasting friendships, your effort changes lives.
                Start your volunteering journey today!
            </p>
            <div class="flex gap-x-4 ">
                <a href="/signup" wire:navigate.hover>
                    <x-common.landing.buttons.button1>
                        Let's get started
                    </x-common.landing.buttons.button1>
                </a>
            </div>

        </div>

        <div class="flex gap-8 max-w-full items-center">

            <div class="flex items-center">
                <div class="relative max-w-3xs xl:max-w-sm  aspect-square">
                    <img
                        src="{{asset('storage/assets/1.webp')}}"
                        class="w-full h-full rounded-lg object-cover "
                        alt="hero image"
                    />
                </div>

            </div>

            <div class="flex flex-col gap-8 max-w-full">
                <div class="relative  xl:max-w-3xs max-w-36 aspect-square  ">
                    <img
                        src="{{ asset('storage/assets/2.webp') }}"
                        class="w-full h-full object-cover rounded-lg"
                        alt="hero image"
                    />


                </div>
                <div class="relative xl:max-w-3xs max-w-36 aspect-square ">


                    <img
                        src="{{asset('storage/assets/3.webp')}}"
                        class="w-full h-full rounded-lg object-cover"
                        alt="hero image"
                    />

                </div>

            </div>
        </div>

    </div>
</div>
