<div>
    <x-dashboard>
        <x-slot name="items">
            <x-dashboard.item to="/requester/dashboard" icon="house" title="Dashboard"/>
            <x-dashboard.item to="/requester/dashboard/events" icon="calendar" title="Events"/>
        </x-slot>

        {{ $slot }}
    </x-dashboard>
</div>
