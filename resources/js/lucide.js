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
    Sparkles,
    CircleArrowRight,
    Heart,
    Link,
    Share2,
    MousePointer2,
    Circle,
    Share
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
            Sparkles,
            CircleArrowRight,
            Heart,
            Link,
            Share2,
            MousePointer2,
            Circle,
            Share

        }
    });
})


