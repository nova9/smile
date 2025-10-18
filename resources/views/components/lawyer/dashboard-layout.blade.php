<div>
    <x-common.dashboard>
        <x-slot name="items">
            <x-common.dashboard.item to="/lawyer/dashboard" icon="house" title="Dashboard" />
            <x-common.dashboard.item to="/lawyer/contract-drafting" icon="edit-3" title="Contract Drafting" />
            <x-common.dashboard.item to="/lawyer/digital-signature" icon="pen-tool" title="Digital Signature" />
            <x-common.dashboard.item to="/lawyer/contract-archive" icon="archive" title="Contract Archive" />
            <x-common.dashboard.item to="/lawyer/contract-customization" icon="settings" title="Contract Customization" />
            <x-common.dashboard.item to="/lawyer/legal-qa" icon="help-circle" title="Legal Q&A Support" />
        </x-slot>

        {{ $slot }}
    </x-common.dashboard>

    <style>
        /* Override any z-index issues with dropdown */
        .dropdown {
            z-index: 10000 !important;
        }

        .dropdown-content {
            z-index: 10001 !important;
            position: absolute !important;
        }

        .dropdown.dropdown-open .dropdown-content {
            z-index: 10001 !important;
        }

        /* Ensure main content stays below dropdowns */
        main {
            z-index: 1 !important;
        }

        /* Override any high z-index elements in content */
        .bg-white,
        .backdrop-blur-lg,
        .shadow-xl,
        .rounded-2xl,
        .rounded-3xl {
            z-index: auto !important;
        }

        /* Specific fix for Recent Activities section */
        .space-y-8>div {
            z-index: auto !important;
        }
    </style>
</div>