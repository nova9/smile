<li>
    <a href="{{ $to }}" class="hover:bg-gray-100 px-2" wire:current="menu-active">
        <i data-lucide="{{ $icon }}" class="size-6"></i>
        <span x-show="!navClosed">{{ $title }}</span>
    </a>
</li>
