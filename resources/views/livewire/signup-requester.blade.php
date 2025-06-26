<div class="h-screen flex">
    <div class="grid place-items-center basis-full sm:basis-1/2">
        <div class="absolute top-0 left-0 m-6 hidden sm:block">
            <img src="{{ asset('storage/assets/logo.svg') }}" alt="logo" class="h-12">
        </div>
        <div class="card w-full max-w-md p-8 rounded-2xl">
            <div class="flex">
                <a href="/" class="mb-3 btn btn-ghost w-fit" wire:navigate.hover>
                    ← Go Back
                </a>
            </div>
            <div class="text-center text-white mb-6">
                <h1 class="text-3xl font-bold text-primary">Create an Account</h1>
                <p class="text-gray-500">Let's find volunteers.</p>
            </div>

            <form class="space-y-4 sm:space-y-6" method="post">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-500">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                           placeholder="Enter your full name"
                           class="input input-bordered w-full mt-2 input-focus @error('name') input-error @enderror"
                           required/>
                    @error('name')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-500">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           placeholder="Enter your email"
                           class="input input-bordered w-full mt-2 input-focus @error('email') input-error @enderror"
                           required/>
                    @error('email')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-500">Password</label>
                    <input id="password" type="password" name="password" placeholder="Create a password"
                           class="input input-bordered w-full mt-2 input-focus @error('password') input-error @enderror"
                           required/>
                    @error('password')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password-confirmation" class="block text-sm font-medium text-gray-500">Confirm
                        Password</label>
                    <input id="password-confirmation" type="password" name="password-confirmation"
                           placeholder="Confirm your password"
                           class="input input-bordered w-full mt-2 input-focus @error('password-confirmation') input-error @enderror"
                           required/>
                    @error('password-confirmation')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <div class="flex items-center">
                        <label class="label cursor-pointer">
                            <input type="checkbox" name="tos"
                                   class="checkbox checkbox-primary checkbox-sm @error('tos') input-error @enderror"/>
                            <span class="label-text text-gray-600 ml-2">I agree to the Terms of Service</span>
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
        </div>
    </div>
    <div class="basis-1/2 hidden sm:block">
        <img src="{{ asset('storage/assets/auth_image.webp') }}" alt="two people working together"
             class="w-full h-full object-cover">
    </div>
</div>
