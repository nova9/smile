<div class="min-h-screen flex items-center justify-center  px-4">
    <div class="w-full max-w-md bg-white/90 backdrop-blur-lg shadow-2xl rounded-2xl p-8 border border-gray-100">
        <a href="/" class="inline-flex items-center gap-2 text-gray-500 hover:text-emerald-600 transition mb-2">
            <span class="text-lg">←</span> <span>Go Back</span>
        </a>
        <div class="flex flex-col items-center mb-6">
            <h1 class="text-3xl font-bold text-primary mb-1">Forgot Your Password?</h1>
            <p class="text-gray-600 text-sm text-center mt-2">No worries! Enter your email address below and we'll send
                you a link to
                reset your password.</p>
        </div>
        <form class="space-y-6" wire:submit.prevent="sendEmail()">
            @csrf
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                <input id="email" type="email" wire:model="email" placeholder="you@example.com"
                    class="input input-bordered w-full mt-2 input-focus " autocomplete="email" required
                    aria-label="Email address" />
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                class="btn bg-primary hover:bg-white hover:text-primary text-white w-full font-semibold shadow transition">Send
                Reset Link</button>
        </form>
        <p class="text-center text-sm flex items-center gap-2 mt-6">
            <span class="text-gray-600">Need an account?</span>
            <a href="/signup" class="text-primary hover:underline font-semibold">Sign Up</a>
        </p>
    </div>
      @if (session('message'))
    <div class="toast toast-end">
        <div class="alert alert-success">
            <span>
                <div class="mb-3 text-center">{{ session('message') }}</div>
            </span>
        </div>
    </div>
    @endif
</div>
