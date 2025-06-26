<div class="min-h-screen flex flex-col gap-y-15 justify-center items-center">

    <div class="font-bold text-primary leading-tight text-center flex flex-col gap-y-5">
        <x-common.headings.h2>
            Get involved
        </x-common.headings.h2>

        <h1 class="lg:text-3xl font-medium ">
            Ways to Make a Difference
        </h1>
    </div>
    <div class="flex flex-col w-full ">
        <div class="grid xl:grid-cols-3 gap-5 lg:grid-cols-2  ">
            <x-common.cards.involved-card>
                <x-slot:img>
                    <img src="{{asset('storage/assets/heart.png')}}" alt="heart" class="w-3xs"/>
                </x-slot:img>
                <x-slot:title>
                    Donate to Support Our Cause
                </x-slot:title>
                <x-slot:des>
                    our contribution helps fund community programs and volunteer efforts. Every little bit counts!
                </x-slot:des>
                <x-slot:icon>
                    <i data-lucide="heart"></i>
                </x-slot:icon>
                <x-slot:name>
                    Donate
                </x-slot:name>
            </x-common.cards.involved-card>

            <x-common.cards.involved-card>

                <x-slot:img>
                    <img src="{{asset('storage/assets/handshake.png')}}" alt="heart" class="w-3xs"/>
                </x-slot:img>
                <x-slot:title>
                    Join an Upcoming Event
                </x-slot:title>
                <x-slot:des>
                    Participate in local events to connect and contribute. Check our calendar for details.
                </x-slot:des>
                <x-slot:icon>
                    <i data-lucide="link"></i>
                </x-slot:icon>
                <x-slot:name>
                    Join an event
                </x-slot:name>
            </x-common.cards.involved-card>

            <x-common.cards.involved-card>
                <x-slot:img>
                    <img src="{{asset('storage/assets/share.png')}}" alt="heart" class="w-3xs"/>
                </x-slot:img>
                <x-slot:title>
                    Spread the Word
                </x-slot:title>
                <x-slot:des>
                    Share our mission with friends and family on social media to grow our community.
                </x-slot:des>
                <x-slot:icon>
                    <i data-lucide="share-2"></i>
                </x-slot:icon>
                <x-slot:name>
                    Share now
                </x-slot:name>
            </x-common.cards.involved-card>


        </div>

        <div class="w-full flex justify-end my-20 lg:justify-center">
            <x-common.buttons.button2 class="max-w-xs">
                Explore more ways to get involved!
                <i data-lucide="circle-arrow-right"></i>
            </x-common.buttons.button2>
        </div>
    </div>



</div>
