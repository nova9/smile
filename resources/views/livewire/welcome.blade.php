<div>
    <x-nav/>

    <div class="hero min-h-screen">
        <div class="hero-content flex-col lg:flex-row-reverse -mt-36 w-full">
            <img src="{{asset('storage/assets/landing_image.svg')}}" class="max-w-lg" alt="a man helping another man get up" />

            <div>
                <h1 class="text-5xl font-bold">Join Our Volunteer Community</h1>
                <p class="py-6 text-lg">Connect with opportunities to make a difference or find dedicated volunteers for
                    your cause. Be part of a movement that creates impact!</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="/signup/volunteer" wire:navigate.hover>
                        <button class="btn btn-primary btn-lg">I'd like to volunteer</button>
                    </a>
                    <a href="/signup/requester" wire:navigate.hover>
                        <button class="btn btn-soft btn-primary btn-lg">I'm looking for volunteers</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <x-footer/>
</div>
