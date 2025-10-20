<div>
    <x-common.dashboard>
        <x-slot name="items">
            <x-common.dashboard.item to="/admin/dashboard" icon="handshake" title="Report Handling" />
            <x-common.dashboard.item to="/admin/dashboard/volunteer-management" icon="users" title="Volunteers" />
            <x-common.dashboard.item to="/admin/dashboard/organization-management" icon="building-2"
                title="Organizations" />
            <x-common.dashboard.item to="/admin/dashboard/analytics" icon="chart-spline" title="Analytics" />
          <x-common.dashboard.item to="/admin/dashboard/help-requests" icon="help-circle" title="Help Requests" />
        </x-slot>

        {{ $slot }}
    </x-common.dashboard>
</div>