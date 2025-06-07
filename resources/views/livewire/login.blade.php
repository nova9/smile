<div class="h-screen grid place-items-center">

    <div class="card w-full max-w-md p-8 shadow-2xl rounded-2xl">
        <a href="/" wire:navigate.hover>
            <button class="btn btn-ghost">&larr; Go Back</button>
        </a>
        <img src="{{ asset('storage/assets/logo.svg') }}" alt="logo" class="h-16 my-3">
        <h1 class="text-3xl font-bold text-center text-white mb-6">Welcome Back</h1>
        <form class="space-y-6">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300">Email Address</label>
                <input id="email" type="email" placeholder="Enter your email" class="input input-bordered w-full mt-2 input-focus" required />
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <input id="password" type="password" placeholder="Enter your password" class="input input-bordered w-full mt-2 input-focus" required />
            </div>
            <div class="flex items-center justify-between">
                <label class="label cursor-pointer">
                    <input type="checkbox" class="checkbox checkbox-primary checkbox-sm" />
                    <span class="label-text text-gray-400 ml-2">Remember me</span>
                </label>
                <a href="#">
                    <button class="btn btn-link px-0">
                        Forgot Password?
                    </button>
                </a>

            </div>
            <button type="submit" class="btn btn-primary w-full">Log In</button>
        </form>
        <p class="text-center text-sm mt-6 flex items-center gap-2">
            Don't have an account?
            <a href="/signup">
                <button class="btn btn-link px-0">
                    Sign up
                </button>
            </a>
        </p>
    </div>
</div>
