@props([
    'value',
    'label',
    'icon',
    'color',
    'color_bg'
])

<div
    class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 px-4 py-2 hover:bg-white transition-all duration-300">
    <div class="flex items-center justify-between">
        <div>
            <div class="text-3xl font-bold text-slate-800">{{$value}}</div>
            <div class="text-sm text-slate-500 font-medium">{{$label}}</div>
        </div>
        <div
            class="size-10 bg-{{$color_bg}} rounded-xl flex items-center justify-center">
            <i data-lucide="{{$icon}}" class="size-4 text-{{$color}}"></i>
        </div>
    </div>
</div>
