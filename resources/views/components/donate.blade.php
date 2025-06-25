<div class="-mt-20 min-h-screen flex flex-col gap-y-10 justify-center ">

    <div class="flex flex-col gap-y-3 w-1/2">
        <x-common.headings.h2 class="text-left">
            Support Smile with a Donation
        </x-common.headings.h2>
        <p class="text-gray-500 text-base">
            Every contribution helps us fund community programs, support volunteers, and spread smiles across the world. Your generosity makes a lasting impact!
        </p>

    </div>
    <div class="grid grid-cols-2">
        <div class="flex flex-col gap-y-10">

            <div class="flex flex-col gap-y-3">
                <h1 class="lg:text-3xl font-bold text-primary">
                    Donation Options
                </h1>
                <ul class="flex flex-col gap-y-3">
                    <li class="bg-info-content rounded-full pl-10 py-5 max-w-xs">
                        Provide supplies for a local event.
                    </li>
                    <li class="bg-info-content rounded-full pl-10 py-5 max-w-xs">
                        Support a volunteer for a week.
                    </li>
                    <li class="bg-info-content rounded-full pl-10 py-5 max-w-sm">
                        Fund a community outreach program.
                    </li>

                </ul>
            </div>

            <div class="flex flex-col gap-y-3">
                <h1 class="lg:text-3xl font-bold text-primary">
                    Why Donate?
                </h1>
                <ul class="flex flex-col gap-y-3">
                    <li class="bg-info-content rounded-full px-10 py-5 max-w-md ">
                        Your donation directly benefits those in need.
                    </li>
                    <li class="bg-info-content rounded-full px-10 py-5 max-w-md">
                        Tax-deductible contributions (where applicable).
                    </li>
                    <li class="bg-info-content rounded-full px-10 py-5 max-w-md">
                        Join a community of givers making a difference.
                    </li>

                </ul>
            </div>

            <x-common.buttons.button1 class="w-full">
                <i data-lucide="heart"></i>
                Donate
            </x-common.buttons.button1>
        </div>



        <div class="relative w-full h-170">
            <img
                src="{{asset('storage/assets/5.jpg')}}"
                class="w-full h-full rounded-lg object-cover shadow-lg "
                alt="volunteer"
            />

        </div>
    </div>


</div>
