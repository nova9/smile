<div>
    <x-common.dashboard>
        <x-slot name="items">
            <x-common.dashboard.item to="/requester/dashboard" icon="house" title="Dashboard"/>
            <x-common.dashboard.item to="/requester/dashboard/my-events" icon="calendar-days" title="My Events"/>
            <x-common.dashboard.item to="/requester/dashboard/issued-certificates" icon="shield-check" title="Issued Certificates"/>

        </x-slot>

        {{ $slot }}
         <livewire:common.chatbot/>
    </x-common.dashboard>
</div>
