<div class="flex gap-8">
    <div class="relative w-3xs h-48">
        {{$img}}
    </div>

    <div class="flex flex-col justify-around">
        <div class="flex flex-col gap-2">
            <h1 class="text-3xl font-bold text-primary ">{{$title}}</h1>
            <p class="xl:text-xl lg:text-base text-primary">{{$des}}</p>
        </div>
        <div class="flex justify-between">
            <div class="text-base text-gray-500 flex flex-col gap-3 ">
                <div class="badge badge-info">
                    <svg class="size-[1em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="currentColor" stroke-linejoin="miter" stroke-linecap="butt"><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></circle><path d="m12,17v-5.5c0-.276-.224-.5-.5-.5h-1.5" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></path><circle cx="12" cy="7.25" r="1.25" fill="currentColor" stroke-width="2"></circle></g></svg>
                     {{$detail1}}
                </div>
                <div class="badge badge-success">
                    <svg class="size-[1em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="currentColor" stroke-linejoin="miter" stroke-linecap="butt"><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></circle><polyline points="7 13 10 16 17 8" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></polyline></g></svg>
                    {{$detail2}}
                </div>
            </div>
            <x-common.landing.buttons.button1 class="btn-primary w-3xs">
                <i data-lucide="mouse-pointer-2"></i>
                Apply now
            </x-common.landing.buttons.button1>
        </div>


    </div>

</div>
