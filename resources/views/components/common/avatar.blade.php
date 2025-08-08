@php use Illuminate\Support\Str; @endphp


@props([
    'src' => null,
    'alt' => 'Avatar',
    'name' => null,
    'size' => 40,
    'class' => ''
])

@php
    $initials = collect(explode(' ', $name))
        ->map(fn($word) => Str::substr($word, 0, 1))
        ->join('');
@endphp

@if($src)
    <img src="{{ $src }}" alt="{{ $alt }}" width="{{ $size }}" height="{{ $size }}" class="aspect-square rounded-full object-cover {{ $class }}" />
@elseif($name)

    <div class="flex items-center justify-center rounded-full bg-gray-300 text-gray-700 font-bold {{ $class }}" style="width: {{ $size }}px; height: {{ $size }}px;">
        {{ strtoupper($initials) }}
    </div>
@else
    <div class="flex items-center justify-center rounded-full bg-gray-300 {{ $class }}" style="width: {{ $size }}px; height: {{ $size }}px;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-1/2 h-1/2 text-gray-400">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9.001 9.001 0 0112 15c2.21 0 4.21.805 5.879 2.146M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
    </div>
@endif
