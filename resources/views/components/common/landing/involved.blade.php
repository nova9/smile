<!-- Get Involved Section -->
<section
    class="relative min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50 py-20 lg:py-32 overflow-hidden">
    <!-- Background Decorative Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-accent/5 rounded-full blur-3xl"></div>
        <div
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-secondary/3 rounded-full blur-3xl">
        </div>
    </div>

    <div class="relative container mx-auto px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-16 lg:mb-24">
            <div
                class="inline-flex items-center gap-2 bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-medium mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                Community Impact
            </div>

            <x-common.landing.headings.h2 class="mb-6">
                Get Involved
            </x-common.landing.headings.h2>

            <p class="text-xl lg:text-2xl text-gray-600 font-light max-w-3xl mx-auto leading-relaxed">
                Join our community and discover meaningful ways to make a lasting difference in people's lives
            </p>
        </div>

        <!-- Ways to Get Involved Grid -->
        <div class="max-w-7xl mx-auto">
            <!-- First Row: Event Participation -->
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 mb-12 lg:mb-20 items-center">
                <div class="relative group order-2 lg:order-1">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-primary/20 to-secondary/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-105">
                    </div>
                    <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                        <img src="{{asset('storage/assets/4.jpg')}}"
                            class="w-full h-80 lg:h-96 object-cover transition-transform duration-700 group-hover:scale-110"
                            alt="Community event participation" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent">
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2 space-y-6 lg:pl-8">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-3xl lg:text-4xl font-bold text-primary">Join an Upcoming Event</h3>
                    </div>

                    <p class="text-lg text-gray-600 leading-relaxed">
                        Connect with like-minded individuals and make a direct impact in your community. From workshops
                        to volunteer drives, our events offer meaningful ways to contribute while building lasting
                        relationships.
                    </p>

                    <div class="flex flex-wrap gap-3 mt-6">
                        <span class="px-4 py-2 bg-primary/10 text-primary rounded-full text-sm font-medium">Community
                            Workshops</span>
                        <span
                            class="px-4 py-2 bg-secondary/10 text-secondary rounded-full text-sm font-medium">Volunteer
                            Drives</span>
                        <span class="px-4 py-2 bg-accent/10 text-accent rounded-full text-sm font-medium">Networking
                            Events</span>
                    </div>
                </div>
            </div>

            <!-- Second Row: Donations -->
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 mb-12 lg:mb-20 items-center">
                <div class="space-y-6 lg:pr-8">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-secondary rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-3xl lg:text-4xl font-bold text-secondary">Support Our Mission</h3>
                    </div>

                    <p class="text-lg text-gray-600 leading-relaxed">
                        Your generous contributions fuel our community programs and amplify our volunteer efforts. Every
                        donation, regardless of size, creates ripple effects of positive change that reach far beyond
                        what you might imagine.
                    </p>

                    <div
                        class="bg-gradient-to-r from-secondary/5 to-primary/5 p-6 rounded-xl border border-secondary/20">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-8 h-8 bg-secondary/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <span class="font-semibold text-secondary">100% Impact Guarantee</span>
                        </div>
                        <p class="text-sm text-gray-600">Every dollar goes directly to programs that matter.</p>
                    </div>
                </div>

                <div class="relative group">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-secondary/20 to-accent/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-105">
                    </div>
                    <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                        <img src="{{asset('storage/assets/2.webp')}}"
                            class="w-full h-80 lg:h-96 object-cover transition-transform duration-700 group-hover:scale-110"
                            alt="Supporting community cause" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Third Row: Spread the Word -->
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 mb-16 items-center">
                <div class="relative group order-2 lg:order-1">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-accent/20 to-primary/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-105">
                    </div>
                    <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                        <img src="{{asset('storage/assets/3.webp')}}"
                            class="w-full h-80 lg:h-96 object-cover transition-transform duration-700 group-hover:scale-110"
                            alt="Spreading awareness through social media" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent">
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2 space-y-6 lg:pl-8">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-accent rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m0 0V3a1 1 0 011 1v6a1 1 0 01-1 1H7a1 1 0 01-1-1V4m0 0H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2h-2m-2 4h.01M12 11h.01">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-3xl lg:text-4xl font-bold text-accent">Spread the Word</h3>
                    </div>

                    <p class="text-lg text-gray-600 leading-relaxed">
                        Amplify our impact by sharing our mission with your network. Social media, word-of-mouth, and
                        community conversations help us reach more people who want to make a difference.
                    </p>

                    <div class="grid grid-cols-2 gap-4 mt-6">
                        <div class="flex items-center gap-2 p-3 bg-blue-50 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                            <span class="text-sm font-medium text-blue-600">Twitter</span>
                        </div>
                        <div class="flex items-center gap-2 p-3 bg-blue-50 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                            <span class="text-sm font-medium text-blue-600">Facebook</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center">
            <div class="max-w-2xl mx-auto mb-8">
                <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4">Ready to Make a Difference?</h3>
                <p class="text-lg text-gray-600">Choose the path that resonates with you and start your journey of
                    impact today.</p>
            </div>

            <div class="inline-flex items-center gap-4 p-2 bg-white rounded-full shadow-xl border border-gray-100">
                <x-common.landing.buttons.button2
                    class="bg-primary text-white border-primary hover:bg-primary/90 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Start Your Journey
                </x-common.landing.buttons.button2>

                <button
                    class="text-gray-600 hover:text-primary transition-colors duration-300 px-6 py-3 rounded-full hover:bg-gray-50">
                    Learn More
                    <svg class="w-4 h-4 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>