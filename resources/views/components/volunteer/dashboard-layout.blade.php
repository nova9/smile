<div>
    <x-common.dashboard>
        <x-slot name="items">
            <x-common.dashboard.item to="/volunteer/dashboard" icon="house" title="Dashboard"/>
            <x-common.dashboard.item to="/volunteer/dashboard/my-events" icon="file-clock" title="My Events"/>
            <x-common.dashboard.item to="/volunteer/dashboard/events" icon="party-popper" title="Opportunities"/>
            <x-common.dashboard.item to="/volunteer/dashboard/leaderboard" icon="users" title="Leaderboard"/>
            <x-common.dashboard.item to="/volunteer/dashboard/achievements" icon="trophy" title="My Achievements"/>
            <x-common.dashboard.item to="/volunteer/dashboard" icon="help" title="Help Center"/>
            
        </x-slot>

        {{ $slot }}

    </x-common.dashboard>
</div>