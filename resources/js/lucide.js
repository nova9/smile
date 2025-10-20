import {createIcons, icons} from 'lucide';

// Caution, this will import all the icons and bundle them.

function registerIcons() {
    createIcons({icons});
}

document.addEventListener("livewire:navigated", () => {
    registerIcons();
});

document.addEventListener("DOMContentLoaded", () => {
    registerIcons();
});

Livewire.hook("morph.added", ({el}) => {
    registerIcons();
});
