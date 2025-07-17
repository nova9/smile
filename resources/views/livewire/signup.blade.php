<x-common.auth.layout>
    <div class="text-center text-white mb-6">
        <h1 class="text-3xl font-bold text-primary">Create an Account</h1>
        <p class="text-gray-500">Let's help each other.</p>
    </div>

    <form wire:submit="save" class="space-y-4 sm:space-y-6" method="post">
        @csrf

        <div>
            <div class="join join-vertical sm:join-horizontal flex">
                <input
                    wire:model="role"
                    type="radio"
                    name="role"
                    class="btn join-item sm:basis-1/2"
                    aria-label="I'd like to volunteer"
                    value="volunteer"
                />
                <input
                    wire:model="role"
                    type="radio"
                    name="role"
                    class="btn join-item sm:basis-1/2"
                    aria-label="I'm looking for help"
                    value="requester"
                />
            </div>
            @error('role')
            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <x-common.auth.input
            name="name"
            label="Full Name"
            placeholder="Enter your full name"
            required
        />

        <x-common.auth.input
            name="email"
            type="email"
            label="Email Address"
            placeholder="Enter your email"
            required
        />
        <x-common.auth.input
            name="password"
            type="password"
            label="Password"
            placeholder="Create a password"
            required
        />
        <x-common.auth.input
            name="password_confirmation"
            type="password"
            label="Confirm Password"
            placeholder="Confirm your password"
            required
        />
        <div>
            <div class="flex items-center">
                <label class="label cursor-pointer">
                    <input
                        wire:model="tos"
                        type="checkbox"
                        name="tos"
                        class="checkbox checkbox-accent checkbox-sm @error('tos') input-error @enderror"
                    />
                    <span class="label-text text-gray-600 ml-1">I agree to the Terms of Service</span>
                </label>
            </div>
            @error('tos')
            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-accent w-full">Sign Up</button>
    </form>
    <p class="text-center text-sm flex items-center gap-2">
        Already have an account?
        <a href="/login">
            <button class="btn btn-link px-0">
                Log in
            </button>
        </a>
    </p>
</x-common.auth.layout>
