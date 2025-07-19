<div>
    <x-common.dashboard>
        <x-slot name="items">
            <x-common.dashboard.item to="/lawyer/dashboard" icon="house" title="Dashboard"/>
            <x-common.dashboard.item to="/lawyer/legal-reviews" icon="scroll-text" title="Legal Reviews"/>
        </x-slot>

        {{ $slot }}
    </x-common.dashboard>
</div>
