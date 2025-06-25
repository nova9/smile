<div class="card max-w-sm  shadow-md rounded-xl border border-gray-200">
    <div class="card-body items-left text-left transition-transform duration-300 ease-in-out hover:translate-y-2 hover:shadow-xl ">
        <div class="flex flex-col gap-y-15">
            <div class="flex gap-x-3">
                <div class="rating">
                    <input type="radio" name="rating-2" class="mask mask-star-2 bg-yellow-400" aria-label="1 star" checked="checked" disabled/>
                </div>
                <p class="flex items-center text-sm">4.8</p>
            </div>

            <p class="text-neutral text-base  mx-3">
                {{$des}}
            </p>
            <div class="flex gap-x-3 items-center">
                <div class="relative w-20 h-20 rounded-full overflow-hidden">
                    <img src="{{ asset('storage/assets/dummy_profile_pic.png') }}" alt="profile_pic" class="h-full w-full object-cover">
                </div>


                <div class="flex flex-col ">
                    <h2 class="card-title text-primary text-3xl">{{$name}}</h2>

                    <p class="text-neutral text-base-sm ">
                        {{$role}}
                    </p>
                </div>
            </div>

        </div>


    </div>
</div>
