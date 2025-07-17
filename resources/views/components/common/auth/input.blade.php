@props([
    'name',
    'label' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'wire' => false,
])

<div>
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-500">{{ $label }}</label>
    @endif

    <input
        wire:model.live="{{ $name }}"
        id="{{ $name }}"
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ $value ?? old($name) }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        class="input input-bordered w-full mt-2 input-focus @error($name) input-error @enderror"
        @if($required) required @endif
    />

    @error($name)
        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
    @enderror
</div>
