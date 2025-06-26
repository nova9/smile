<div class="card w-sm  shadow-md rounded-xl border border-gray-200 transition-transform duration-300 ease-in-out hover:-translate-y-2 hover:shadow-xl">
    <div class="card-body items-center text-center flex flex-col gap-y-5 p-10">
        {{$img}}
        <h1 class="text-3xl text-primary font-bold" >{{$title}}</h1>
        <p class="text-gray-500 text-base">
            {{$des}}
        </p>
        <x-common.landing.buttons.button1 class="w-full">
            {{$icon}}
            {{$name}}
        </x-common.landing.buttons.button1>
    </div>
</div>
