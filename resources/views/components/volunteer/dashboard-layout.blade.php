<div>
    <x-common.dashboard>
        <x-slot name="items">
            <x-common.dashboard.item to="/volunteer/dashboard" icon="house" title="Dashboard"/>
            <x-common.dashboard.item to="/volunteer/dashboard/events" icon="party-popper" title="Opportunities"/>
            <x-common.dashboard.item to="/volunteer/dashboard/my-events" icon="file-clock" title="My Events"/>
            <x-common.dashboard.item to="/volunteer/dashboard/leaderboard" icon="users" title="Leaderboard"/>
            <x-common.dashboard.item to="/volunteer/dashboard/activities" icon="tractor" title="My Activities"/>
            {{-- <x-common.dashboard.item to="/volunteer/dashboard/feedback" icon="message-square-quote" title="Feedback"/> --}}
            {{-- <x-common.dashboard.item to="/volunteer/dashboard/community" icon="orbit" title="Community"/> --}}


        </x-slot>

        {{ $slot }}
    </x-common.dashboard>
</div>
