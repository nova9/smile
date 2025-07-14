<div>
    <x-common.dashboard>
        <x-slot name="items">
            <x-common.dashboard.item to="/admin/dashboard" icon="house" title="Dashboard" />
            <x-common.dashboard.item to="/admin/dashboard/volunteer-management" icon="users"
                title="Volunteer Management" />
            <x-common.dashboard.item to="/admin/dashboard/organization-management" icon="building-2"
                title="Organization Management" />
            <x-common.dashboard.item to="/admin/dashboard/announcements" icon="megaphone"
                title="Announcements" />
                   <x-common.dashboard.item to="/admin/dashboard/dispute-handling" icon="handshake"
                title="Dispute Handling" />

        </x-slot>

        {{ $slot }}
    </x-common.dashboard>
</div>