import {
    createIcons,
    Menu,
    ArrowRight,
    Globe,
    House,
    PanelLeft,
    ChevronUp,
    ChevronDown,
    Calendar,
    MessageCircle,
    Bell,
    LogOut,
    CircleUser,
    Sparkles
} from 'lucide';

document.addEventListener('livewire:navigated', () => {
    createIcons({
        icons: {
            Menu,
            ArrowRight,
            Globe,
            House,
            PanelLeft,
            ChevronUp,
            ChevronDown,
            Calendar,
            MessageCircle,
            Bell,
            LogOut,
            CircleUser,
            Sparkles
        }
    });
})


