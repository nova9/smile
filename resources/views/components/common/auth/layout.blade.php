<div class="min-h-screen grid place-items-center">
    <div class="m-12 card shadow-lg border border-gray-200 w-full max-w-2xl p-8 rounded-2xl">
        <div class="flex">
            <a href="/" class="mb-3 btn btn-ghost w-fit" wire:navigate.hover>
                ← Go Back
            </a>
        </div>

        {{ $slot }}
    </div>
</div>
