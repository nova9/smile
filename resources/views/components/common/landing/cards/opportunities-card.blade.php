<div class="flex gap-8">
    <div class="relative w-3xs h-48">
        {{$img}}
    </div>

    <div class="flex flex-col justify-around">
        <div class="flex flex-col gap-2">
            <h1 class="text-3xl font-bold text-primary ">{{$title}}</h1>
            <p class="text-xl text-primary">{{$des}}</p>
        </div>
        <div class="flex justify-between">
            <div class="text-base text-gray-500 flex flex-col gap-3 ">
                <p>{{$detail1}}</p>
                <p>{{$detail2}}</p>
            </div>
            <x-common.landing.buttons.button1 class="btn-primary w-3xs">
                <i data-lucide="mouse-pointer-2"></i>
                Apply now
            </x-common.landing.buttons.button1>
        </div>


    </div>

</div>
