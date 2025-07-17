<div class="h-screen flex">
    <div class="grid place-items-center basis-full lg:basis-1/2">
        <div class="absolute top-0 left-0 m-6 hidden sm:block">
            <img src="{{ asset('storage/assets/logo.svg') }}" alt="logo" class="h-12">
        </div>
        <div class="card w-full max-w-md p-8 rounded-2xl">
            <div class="flex">
                <a href="/" class="mb-3 btn btn-ghost w-fit" wire:navigate.hover>
                    ← Go Back
                </a>
            </div>

            {{ $slot }}
        </div>
    </div>
    <div class="basis-1/2 hidden lg:block">
        <img
            src="{{ asset('storage/assets/auth_image.webp') }}"
            alt="two people working together"
            class="w-full h-full object-cover brightness-75"
        >
    </div>
</div>
