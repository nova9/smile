<div>
    <x-common.dashboard>
        <x-slot name="items">
            <x-common.dashboard.item to="/requester/dashboard" icon="house" title="Dashboard"/>
            <x-common.dashboard.item to="/requester/dashboard/requests" icon="file-text" title="My Requests"/>
            <x-common.dashboard.item to="/requester/dashboard/new-request" icon="plus-square" title="New Request"/>
            <x-common.dashboard.item to="/requester/dashboard/status" icon="activity" title="Status"/>
            <x-common.dashboard.item to="/requester/dashboard/messages" icon="message-circle" title="Messages"/>
            <x-common.dashboard.item to="/requester/dashboard/settings" icon="settings" title="Settings"/>
        </x-slot>

        {{ $slot }}
    </x-common.dashboard>
</div>
