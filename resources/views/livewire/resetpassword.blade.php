<div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white/90 backdrop-blur-lg shadow-2xl rounded-2xl p-13 border border-gray-100">
       
        <div class="flex flex-col items-center mb-6">
            <h1 class="text-3xl font-bold text-primary  mb-1">Set a New Password</h1>
            <p class="text-gray-600 text-sm text-center">Create a strong password for your account. Enter your new password below
                and confirm it to reset.</p>
        </div>
        <form class="space-y-6" method="post" wire:submit.prevent="resetPassword">
            @csrf
            <input type="hidden" name="token" wire:model="token">
            <input type="hidden" name="email" wire:model="email">
            <div>
                <label for="new_password" class="block text-sm font-semibold text-gray-700 mb-1">New Password</label>
                <input id="new_password" type="password"  wire:model.defer="password" placeholder="New password"
                    class="input input-bordered w-full mt-2 input-focus @error('password') input-error @enderror"
                    autocomplete="new-password" required aria-label="New password" />
                @error('password')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Confirm New
                    Password</label>
                <input id="password_confirmation" type="password"  wire:model.defer="password_confirmation"
                    placeholder="Confirm new password"
                    class="input input-bordered w-full mt-2 input-focus @error('password_confirmation') input-error @enderror"
                    autocomplete="new-password" required aria-label="Confirm new password" />
                @error('password_confirmation')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                class="btn bg-primary hover:bg-primary text-white w-full font-semibold shadow transition">Reset
                Password</button>
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
