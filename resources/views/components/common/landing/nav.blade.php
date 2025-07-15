<nav class="sticky top-0 z-50 backdrop-blur-lg bg-white/90 border-b border-gray-200/50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/" class="flex items-center group">
                    <img src="{{ asset('storage/assets/logo.svg') }}" alt="Smile Volunteer Logo"
                        class="h-10 xl:h-12 select-none transition-transform duration-300 group-hover:scale-105">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-8">
                <a href="#home"
                    class="nav-link text-gray-700 hover:text-accent transition-colors duration-300 font-medium relative group">
                    Home
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-accent transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#about"
                    class="nav-link text-gray-700 hover:text-accent transition-colors duration-300 font-medium relative group">
                    About Us
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-accent transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#opportunities"
                    class="nav-link text-gray-700 hover:text-accent transition-colors duration-300 font-medium relative group">
                    Opportunities
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-accent transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#involved"
                    class="nav-link text-gray-700 hover:text-accent transition-colors duration-300 font-medium relative group">
                    Get Involved
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-accent transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#donate"
                    class="nav-link text-gray-700 hover:text-accent transition-colors duration-300 font-medium relative group">
                    Donate
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-accent transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>

            <!-- Auth Buttons -->
            <div class="flex items-center space-x-4">
                @guest
                    <a href="/login" wire:navigate.hover class="hidden sm:inline-flex">
                        <button class="text-gray-700 hover:text-accent font-medium transition-colors duration-300">
                            Log In
                        </button>
                    </a>
                    <a href="/signup" wire:navigate.hover>
                        <button
                            class="bg-accent hover:bg-accent/90 text-white px-6 py-2.5 rounded-full font-medium transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Get Started
                        </button>
                    </a>
                @endguest

                @auth
                    <a href="/dashboard" wire:navigate.hover>
                        <button
                            class="bg-primary hover:bg-primary/90 text-white px-6 py-2.5 rounded-full font-medium transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Dashboard
                        </button>
                    </a>
                @endauth

                <!-- Mobile menu button -->
                <button class="lg:hidden p-2 text-gray-700 hover:text-accent transition-colors duration-300"
                    onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobileMenu" class="lg:hidden hidden border-t border-gray-200 py-4">
            <div class="space-y-3">
                <a href="#home"
                    class="block px-4 py-2 text-gray-700 hover:text-accent hover:bg-gray-50 rounded-lg transition-all duration-300">Home</a>
                <a href="#about"
                    class="block px-4 py-2 text-gray-700 hover:text-accent hover:bg-gray-50 rounded-lg transition-all duration-300">About
                    Us</a>
                <a href="#opportunities"
                    class="block px-4 py-2 text-gray-700 hover:text-accent hover:bg-gray-50 rounded-lg transition-all duration-300">Opportunities</a>
                <a href="#involved"
                    class="block px-4 py-2 text-gray-700 hover:text-accent hover:bg-gray-50 rounded-lg transition-all duration-300">Get
                    Involved</a>
                <a href="#donate"
                    class="block px-4 py-2 text-gray-700 hover:text-accent hover:bg-gray-50 rounded-lg transition-all duration-300">Donate</a>
                @guest
                    <a href="/login" wire:navigate.hover
                        class="block px-4 py-2 text-gray-700 hover:text-accent hover:bg-gray-50 rounded-lg transition-all duration-300">Log
                        In</a>
                @endguest
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
    }

    // Smooth scrolling for navigation links
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
</script>