<div>
    <x-common.dashboard>
        <x-slot name="items">
            <x-common.dashboard.item to="/volunteer/dashboard" icon="house" title="Dashboard"/>
            <x-common.dashboard.item to="/volunteer/dashboard/events" icon="calendar" title="Events"/>
        </x-slot>

        {{ $slot }}
    </x-common.dashboard>
</div>
