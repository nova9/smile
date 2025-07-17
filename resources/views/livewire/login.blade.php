<div class="h-screen grid place-items-center">
    <div class="card w-full max-w-md p-8 shadow-2xl rounded-2xl">
        <a href="/" class="btn btn-ghost w-fit" wire:navigate.hover>
            ← Go Back
        </a>
        <img src="{{ asset('storage/assets/logo.svg') }}" alt="logo" class="h-16 my-3">
        <div class="text-center text-white mb-6">
            <h1 class="text-3xl font-bold text-primary">Log In</h1>
            <p class="text-gray-500">Welcome back! Please log in to continue.</p>
        </div>

        <form class="space-y-6" method="post">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email"
                       class="input input-bordered w-full mt-2 input-focus @error('email') input-error @enderror"
                       required/>
                @error('email')
                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" placeholder="Enter your password"
                       class="input input-bordered w-full mt-2 input-focus @error('password') input-error @enderror"
                       required/>
                @error('password')
                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <label class="label cursor-pointer">
                    <input type="checkbox" name="remember" class="checkbox checkbox-primary checkbox-sm"/>
                    <span class="label-text text-gray-600 ml-2">Remember me</span>
                </label>
                <a href="/forgot-password" class="btn btn-link">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-accent w-full">Log In</button>
        </form>
{{--        <p class="text-center text-sm flex items-center gap-2">--}}
{{--            Don't have an account?--}}
{{--            <a href="/signup/volunteer">--}}
{{--                <button class="btn btn-link px-0">--}}
{{--                    Sign Up--}}
{{--                </button>--}}
{{--            </a>--}}
{{--        </p>--}}
    </div>
</div>
