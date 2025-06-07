<div class="h-screen grid place-items-center">
    <div class="card w-full max-w-md p-8 shadow-2xl rounded-2xl">
        <a href="/" class="btn btn-ghost w-fit" wire:navigate.hover>
            ← Go Back
        </a>
        <img src="{{ asset('storage/assets/logo.svg') }}" alt="logo" class="h-16 my-3">
        <h1 class="text-3xl font-bold text-center text-white mb-6">Create an Account</h1>
        <form class="space-y-6" method="post">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300">Full Name</label>
                <input id="name" type="text" name="name" placeholder="Enter your full name" class="input input-bordered w-full mt-2 input-focus @error('name') input-error @enderror" required />
                @error('title')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300">Email Address</label>
                <input id="email" type="email" name="email" placeholder="Enter your email" class="input input-bordered w-full mt-2 input-focus" required />
                @error('email')
                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <input id="password" type="password" name="password" placeholder="Create a password" class="input input-bordered w-full mt-2 input-focus" required />
                @error('password')
                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password-confirmation" class="block text-sm font-medium text-gray-300">Confirm Password</label>
                <input id="password-confirmation" type="password" name="password-confirmation" placeholder="Confirm your password" class="input input-bordered w-full mt-2 input-focus" required />
                @error('password-confirmation')
                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center">
                <label class="label cursor-pointer">
                    <input type="checkbox" name="tos" class="checkbox checkbox-primary checkbox-sm" />
                    <span class="label-text text-gray-400 ml-2">I agree to the Terms of Service</span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary w-full">Sign Up</button>
        </form>
        <p class="text-center text-sm mt-6 flex items-center gap-2">
            Already have an account?
            <a href="/login">
                <button class="btn btn-link px-0">
                    Log in
                </button>
            </a>
        </p>
    </div>
</div>
