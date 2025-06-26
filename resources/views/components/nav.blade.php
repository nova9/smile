<div class="navbar bg-base-100 sticky">
    <div class="navbar-start">
        <a href="/">
            <img src="{{ asset('storage/assets/logo.svg') }}" alt="logo" class="xl:h-15 h-8 select-none">
        </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1  xl:text-xl text-base ">
            <li><a>Home</a></li>
            <li><a>About Us</a></li>
            <li><a>Volunteer Opportunities</a></li>
            <li><a >Get Involved</a></li>
            <li><a>Donate</a></li>
        </ul>
    </div>

    <div class="navbar-end">
        <div class="flex-none">
            @guest
                <a href="/login" wire:navigate.hover>
                    <button class="btn btn-accent p-5 xl:text-base text-sm"">Log In</button>
                </a>
            @endguest

            @auth
                <a href="/dashboard" wire:navigate.hover>
                    <button class="btn btn-primary">Dashboard</button>
                </a>
            @endauth
        </div>
    </div>
</div>
