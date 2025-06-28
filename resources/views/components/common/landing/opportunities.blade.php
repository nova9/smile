<div class="min-h-screen flex flex-col gap-y-10 justify-center ">

    <div class="flex justify-between">
        <x-common.landing.headings.h2>
            Volunteer Opportunities
        </x-common.landing.headings.h2>
        <x-common.landing.buttons.button2>View
            All Opportunities
        </x-common.landing.buttons.button2>

    </div>
    <div class="grid 2xl:grid-cols-10 xl:grid-rows-1 gap-10">
        <div class="relative 2xl:col-span-4 ">

            <img

                src="{{asset('storage/assets/3.webp')}}"
                class="w-full h-full rounded-lg object-cover shadow-lg "
                alt="volunteer"
            />
        </div>
        <div class="2xl:col-span-6 flex flex-col gap-8">

            <x-common.landing.cards.opportunities-card>
                <x-slot:img>
                    <img
                        src="{{asset('storage/assets/2.webp')}}"
                        class="w-full h-full rounded-lg object-cover shadow-lg"
                        alt="volunteer"
                    />
                </x-slot:img>
                <x-slot:title>
                    Community Outreach Assistant
                </x-slot:title>
                <x-slot:des>
                    Support local events and connect with community members
                </x-slot:des>
                <x-slot:detail1>
                    Location:Downtown Area
                </x-slot:detail1>
                <x-slot:detail2>
                    Commitment:4 hours/week
                </x-slot:detail2>
            </x-common.landing.cards.opportunities-card>

            <x-common.landing.cards.opportunities-card>
                <x-slot:img>
                    <img
                        src="{{asset('storage/assets/2.webp')}}"
                        class="w-full h-full rounded-lg object-cover shadow-lg"
                        alt="volunteer"
                    />
                </x-slot:img>
                <x-slot:title>
                    Community Outreach Assistant
                </x-slot:title>
                <x-slot:des>
                    Support local events and connect with community members
                </x-slot:des>
                <x-slot:detail1>
                    Location:Downtown Area
                </x-slot:detail1>
                <x-slot:detail2>
                    Commitment:4 hours/week
                </x-slot:detail2>
            </x-common.landing.cards.opportunities-card>

            <x-common.landing.cards.opportunities-card>
                <x-slot:img>
                    <img
                        src="{{asset('storage/assets/2.webp')}}"
                        class="w-full h-full rounded-lg object-cover shadow-lg"
                        alt="volunteer"
                    />
                </x-slot:img>
                <x-slot:title>
                    Community Outreach Assistant
                </x-slot:title>
                <x-slot:des>
                    Support local events and connect with community members
                </x-slot:des>
                <x-slot:detail1>
                    Location:Downtown Area
                </x-slot:detail1>
                <x-slot:detail2>
                    Commitment:4 hours/week
                </x-slot:detail2>
            </x-common.landing.cards.opportunities-card>

        </div>
    </div>

</div>
