<div>
    <x-common.dashboard>
        <x-slot name="items">
            <x-common.dashboard.item to="/lawyer/dashboard" icon="house" title="Dashboard" />
            <x-common.dashboard.item to="/lawyer/contract-drafting" icon="edit-3" title="Contract Drafting" />
            <x-common.dashboard.item to="/lawyer/approval-workflow" icon="workflow" title="Approval Workflow" />
            <x-common.dashboard.item to="/lawyer/digital-signature" icon="pen-tool" title="Digital Signature" />
            <x-common.dashboard.item to="/lawyer/contract-archive" icon="archive" title="Contract Archive" />
            <x-common.dashboard.item to="/lawyer/contract-customization" icon="settings" title="Contract Customization" />
            <x-common.dashboard.item to="/lawyer/legal-qa" icon="help-circle" title="Legal Q&A Support" />
        </x-slot>

        {{ $slot }}
    </x-common.dashboard>
</div>