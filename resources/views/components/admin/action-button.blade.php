@props([
    'type' => 'view', // 'view', 'delete', 'approve', 'reject'
    'url' => null,    // for 'view' type
    'title' => null   // optional custom tooltip
])
@php
    $iconMap = [
        'view' => 'eye',
        'delete' => 'trash-2',
        'approve' => 'check-circle',
        'reject' => 'x-circle',
    ];
    $colorMap = [
        'view' => 'text-success hover:bg-success/10',
        'delete' => 'text-error hover:bg-error/10',
        'approve' => 'text-blue-600 hover:bg-blue-100',
        'reject' => 'text-warning hover:bg-warning/10',
    ];
    $defaultTitle = [
        'view' => 'View',
        'delete' => 'Delete',
        'approve' => 'Approve',
        'reject' => 'Reject',
    ];
    $icon = $iconMap[$type] ?? 'eye';
    $colorClass = $colorMap[$type] ?? 'text-success hover:bg-success/10';
    $classes = "group relative flex items-center justify-center w-10 h-10 rounded-xl bg-white transition font-bold $colorClass";
    $tooltip = $title ?? ($defaultTitle[$type] ?? 'Action');
@endphp

@if($type === 'view' && $url)
    <a href="{{ $url }}" class="{{ $classes }}" title="{{ $tooltip }}">
        <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
        <span class="absolute left-1/2 -translate-x-1/2 -top-8 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">{{ $tooltip }}</span>
    </a>
@else
    <button type="button" class="{{ $classes }}" title="{{ $tooltip }}">
        <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
        <span class="absolute left-1/2 -translate-x-1/2 -top-8 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">{{ $tooltip }}</span>
    </button>
@endif
