<div class="relative min-h-screen bg-gradient-to-br from-white via-gray-50 to-white">
    <!-- Background pattern -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=" 60" height="60" viewBox="0 0 60 60"
        xmlns="http://www.w3.org/2000/svg" %3E%3Cg fill="none" fill-rule="evenodd" %3E%3Cg fill="%23f1f5f9"
        fill-opacity="0.4" %3E%3Ccircle cx="30" cy="30" r="2" /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-40"></div>

    <!-- Navigation -->
    <div class="relative z-20">
        <x-common.landing.nav />
    </div>

    <!-- Hero Content -->
    <div class="relative z-10 px-4 sm:px-6 lg:px-8 pt-20 pb-32">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Left Column - Text Content -->
                <div class="space-y-8 text-center lg:text-left">
                    <!-- Badge -->
                    <div
                        class="inline-flex items-center px-4 py-2 bg-accent/10 text-accent rounded-full text-sm font-medium">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Making a difference together
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold text-primary leading-tight">
                        Welcome to
                        <span class="bg-gradient-to-r from-accent to-green-600 bg-clip-text text-transparent">
                            Smile
                        </span>
                        <br>
                        <span class="relative">
                            Volunteer
                            <svg class="absolute -bottom-2 left-0 w-full h-3 text-accent/30" viewBox="0 0 100 12"
                                fill="none">
                                <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                        </span>
                        with Heart!
                    </h1>

                    <!-- Description -->
                    <p class="text-lg lg:text-xl text-gray-600 max-w-2xl leading-relaxed">
                        Join a community of compassionate individuals making a
                        difference. Whether you're lending a hand, sharing a
                        <span class="text-accent font-semibold">smile</span>,
                        or building lasting friendships, your effort changes lives.
                        <br><br>
                        <strong class="text-primary">Start your volunteering journey today!</strong>
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 items-center lg:items-start">
                        <a href="/signup" wire:navigate.hover class="w-full sm:w-auto">
                            <button
                                class="w-full sm:w-auto bg-accent hover:bg-accent/90 text-white px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                Let's get started
                                <svg class="inline-block w-5 h-5 ml-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </button>
                        </a>

                        <button
                            class="w-full sm:w-auto bg-white text-primary border-2 border-primary px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 hover:bg-primary hover:text-white shadow-lg">
                            Learn More
                        </button>
                    </div>

                    <!-- Stats -->
                    <div class="pt-8 grid grid-cols-3 gap-8 text-center lg:text-left">
                        <div>
                            <div class="text-2xl lg:text-3xl font-bold text-primary">5K+</div>
                            <div class="text-sm text-gray-600">Volunteers</div>
                        </div>
                        <div>
                            <div class="text-2xl lg:text-3xl font-bold text-primary">50K+</div>
                            <div class="text-sm text-gray-600">Hours Donated</div>
                        </div>
                        <div>
                            <div class="text-2xl lg:text-3xl font-bold text-primary">100+</div>
                            <div class="text-sm text-gray-600">Communities</div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Images -->
                <div class="relative">
                    <!-- Main Hero Image -->
                    <div class="relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-tr from-accent/20 to-primary/20 rounded-3xl transform rotate-3">
                        </div>
                        <div class="relative bg-white p-6 rounded-3xl shadow-2xl">

                            <img src="{{asset('storage/assets/1.webp')}}" class="w-full aspect-square object-cover object-top rounded-2xl"

                                alt="Volunteers making a difference" />
                        </div>
                    </div>

                    <!-- Floating Cards -->
                    <div
                        class="absolute -top-8 -left-8 bg-white p-4 rounded-2xl shadow-xl border border-gray-100 transform -rotate-6 hover:rotate-0 transition-transform duration-300">
                        <img src="{{ asset('storage/assets/2.webp') }}" class="w-24 h-24 object-cover rounded-xl"
                            alt="Community impact" />
                        <div class="mt-2 text-center">
                            <div class="text-xs font-semibold text-accent">Community</div>
                            <div class="text-xs text-gray-600">Impact</div>
                        </div>
                    </div>

                    <div
                        class="absolute -bottom-8 -right-8 bg-white p-4 rounded-2xl shadow-xl border border-gray-100 transform rotate-6 hover:rotate-0 transition-transform duration-300">
                        <img src="{{asset('storage/assets/3.webp')}}" class="w-24 h-24 object-cover rounded-xl"
                            alt="Volunteer spirit" />
                        <div class="mt-2 text-center">
                            <div class="text-xs font-semibold text-primary">Volunteer</div>
                            <div class="text-xs text-gray-600">Spirit</div>
                        </div>
                    </div>

                    <!-- Decorative Elements -->
                    <div class="absolute top-20 -right-4 w-20 h-20 bg-accent/10 rounded-full animate-pulse"></div>
                    <div class="absolute bottom-20 -left-4 w-16 h-16 bg-primary/10 rounded-full animate-pulse"
                        style="animation-delay: 1s;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</div>
