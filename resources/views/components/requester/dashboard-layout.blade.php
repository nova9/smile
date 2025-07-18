<div>
    <x-common.dashboard>
        <x-slot name="items">
            <x-common.dashboard.item to="/requester/dashboard" icon="house" title="Dashboard"/>
            <x-common.dashboard.item to="/requester/dashboard/messages" icon="message-circle" title="Messages"/>
            <x-common.dashboard.item to="/requester/dashboard/settings" icon="settings" title="Settings"/>
            <x-common.dashboard.item to="/requester/dashboard/settings/profile" icon="circle-user" title="Edit Profile"/>
            <x-common.dashboard.item to="/requester/dashboard/settings/password" icon="shield-check" title="Change Password"/>
            <x-common.dashboard.item to="/requester/dashboard/settings/notifications" icon="bell" title="Notification Settings"/>
            <x-common.dashboard.item to="/requester/dashboard/settings/privacy" icon="lock" title="Privacy Settings"/>
            <x-common.dashboard.item to="/requester/dashboard/settings/delete-account" icon="ban" title="Delete Account"/>
        </x-slot>

        {{ $slot }}
    </x-common.dashboard>
</div>
