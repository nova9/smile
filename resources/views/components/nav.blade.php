<div class="navbar bg-base-100 shadow-sm px-16">
    <div class="navbar-start">
        <a href="/">
            <img src="{{ asset('storage/assets/logo.svg') }}" alt="logo" class="h-10 select-none">
        </a>
    </div>

    <div class="navbar-end">
        <div class="flex-none">
            @guest
                <a href="/login" wire:navigate.hover>
                    <button class="btn btn-primary btn-outline">Log In</button>
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
