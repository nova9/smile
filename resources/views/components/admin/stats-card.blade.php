@props(['stats'])

@php
    $iconColors = [
        'users' => 'blue',
        'heart' => 'green',
        'building-2' => 'purple',
        'calendar' => 'orange',
        'award' => 'yellow',
        'clock' => 'blue',
        'shield-check' => 'green',
        'ban' => 'red',
        'user-plus' => 'green'
    ];
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-{{ count($stats) > 3 ? '4' : count($stats) }} gap-6 mb-8">
    @foreach($stats as $stat)
        @php
            $color = $iconColors[$stat['icon']] ?? 'gray';
        @endphp
        <div class="bg-white/90 rounded-2xl shadow-xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">{{ $stat['title'] }}</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stat['value'] }}</p>
                    <p class="text-xs text-gray-500">{{ $stat['description'] }}</p>
                </div>
                <div class="w-12 h-12 bg-{{ $color }}-100 rounded-lg flex items-center justify-center">
                    <i data-lucide="{{ $stat['icon'] }}" class="w-6 h-6 text-{{ $color }}-600"></i>
                </div>
            </div>
        </div>
    @endforeach
</div>