<div class="min-h-screen flex flex-col gap-y-15 justify-center items-center xl:p-20">

    <div class="font-bold text-primary leading-tight text-center flex flex-col gap-y-5">
        <x-common.landing.headings.h2>
            Get involved
        </x-common.landing.headings.h2>

        <h1 class="text-3xl font-medium ">
            Ways to Make a Difference
        </h1>
    </div>
    <div class="flex flex-col items-center">
        <div class="grid grid-cols-1 gap-10 max-w-full mx-10 ">
            <div class="grid grid-cols-2 xl:max-h-screen gap-10">
                <div class="relative">
                    <img
                        src="{{asset('storage/assets/4.jpg')}}"
                        class="w-full h-full rounded-lg object-cover "
                        alt="hero image"
                    />
                </div>
                <x-common.landing.cards.involved-card>
                    <x-slot:title>
                        Join an <br>
                        Upcoming Event
                    </x-slot:title>
                    <x-slot:des>
                        Participate in local events to connect and contribute. Check our calendar for details.
                    </x-slot:des>
                </x-common.landing.cards.involved-card>
            </div>

            <div class="grid grid-cols-2  max-h-screen gap-10">
                <x-common.landing.cards.involved-card>
                    <x-slot:title>
                        Donate to Support <br> Our Cause
                    </x-slot:title>
                    <x-slot:des>
                        Your contribution helps fund community programs and volunteer efforts. Every little bit counts!
                    </x-slot:des>
                </x-common.landing.cards.involved-card>

                <div class="relative">
                    <img
                        src="{{asset('storage/assets/2.webp')}}"
                        class="w-full h-full rounded-lg object-cover "
                        alt="hero image"
                    />
                </div>

            </div>

            <div class="grid grid-cols-2  max-h-screen gap-10">
                <div class="relative">
                    <img
                        src="{{asset('storage/assets/3.webp')}}"
                        class="w-full h-full rounded-lg object-cover "
                        alt="hero image"
                    />
                </div>
                <x-common.landing.cards.involved-card>
                    <x-slot:title>
                        Spread the <br>
                        Word
                    </x-slot:title>
                    <x-slot:des>
                        Share our mission with friends and family on social media to grow our community.
                    </x-slot:des>
                </x-common.landing.cards.involved-card>
            </div>

        </div>

        <div class="w-full flex justify-end my-20 lg:justify-center">
            <x-common.landing.buttons.button2 class="max-w-xs">
                Explore more ways to get involved!
                <i data-lucide="circle-arrow-right"></i>
            </x-common.landing.buttons.button2>
        </div>
    </div>



</div>
