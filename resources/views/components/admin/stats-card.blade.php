@props(['stats'])

<div class="stats shadow mb-8 flex flex-col gap-4 sm:flex-row sm:gap-0">
    @foreach($stats as $stat)
        <div class="stat flex-1 flex items-center gap-4">
            <div class="stat-figure text-secondary flex-none">
                <i data-lucide="{{ $stat['icon'] }}" class="h-8 w-8"></i>
            </div>
            <div>
                <div class="stat-title">{{ $stat['title'] }}</div>
                <div class="stat-value">{{ $stat['value'] }}</div>
                <div class="stat-desc">{{ $stat['description'] }}</div>
            </div>
        </div>
    @endforeach
</div>