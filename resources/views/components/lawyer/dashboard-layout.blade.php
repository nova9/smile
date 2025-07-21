<div>
    <x-common.dashboard>
        <x-slot name="items">
            <x-common.dashboard.item to="/lawyer/dashboard" icon="house" title="Dashboard" />
        </x-slot>

        {{ $slot }}
    </x-common.dashboard>
</div>