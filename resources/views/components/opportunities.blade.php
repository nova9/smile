<div class="-mt-20 min-h-screen flex flex-col gap-y-10 justify-center ">

    <div class="flex justify-between">
        <x-common.headings.h2>
            Volunteer Opportunities
        </x-common.headings.h2>
        <x-common.buttons.button2>View
            All Opportunities
        </x-common.buttons.button2>

    </div>
    <div class="flex gap-8 items-center 2xl:flex-row flex-col">
        <div class="relative 2xl:max-w-1/2 2xl:h-170 max-w-full ">
            <img

                src="{{asset('storage/assets/3.webp')}}"
                class="w-full h-full rounded-lg object-cover shadow-lg "
                alt="volunteer"
            />
        </div>
        <div class="flex flex-col gap-8">

            <x-common.cards.opportunities-card>
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
                    Commitment:4 hours/week<
                </x-slot:detail2>
            </x-common.cards.opportunities-card>

            <x-common.cards.opportunities-card>
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
                    Commitment:4 hours/week<
                </x-slot:detail2>
            </x-common.cards.opportunities-card>

            <x-common.cards.opportunities-card>
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
                    Commitment:4 hours/week<
                </x-slot:detail2>
            </x-common.cards.opportunities-card>

        </div>
    </div>

</div>
