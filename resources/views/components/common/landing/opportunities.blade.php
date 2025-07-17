<section class="py-20 bg-white relative overflow-hidden">
    <!-- Background pattern -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=" 40" height="40" viewBox="0 0 40 40"
        xmlns="http://www.w3.org/2000/svg" %3E%3Cg fill="%23f1f5f9" fill-opacity="0.3" %3E%3Cpath
        d="M20 20L0 0v40l20-20z" /%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-16">
            <div class="mb-8 lg:mb-0">
                <div
                    class="inline-flex items-center px-4 py-2 bg-primary/10 text-primary rounded-full text-sm font-medium mb-6">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Make a Difference
                </div>
                <h2 class="text-4xl lg:text-5xl font-bold text-primary mb-4">
                    Volunteer
                    <span class="relative">
                        Opportunities
                        <svg class="absolute -bottom-2 left-0 w-full h-3 text-accent/30" viewBox="0 0 100 12"
                            fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" />
                        </svg>
                    </span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl">
                    Discover meaningful ways to contribute to your community. Whether you have a few hours a week or a
                    day a month,
                    there's an opportunity that matches your passion and schedule.
                </p>
            </div>

            <div class="flex-shrink-0">
                <button
                    class="group bg-white text-primary border-2 border-primary px-8 py-4 rounded-full font-semibold transition-all duration-300 hover:bg-primary hover:text-white shadow-lg hover:shadow-xl transform hover:scale-105">
                    View All Opportunities
                    <svg class="inline-block w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Opportunities Grid -->
        <div class="grid lg:grid-cols-12 gap-8 items-start">
            <!-- Featured Image -->
            <div class="lg:col-span-5">
                <div class="relative group">
                    <div
                        class="absolute inset-0 bg-gradient-to-tr from-accent/20 to-primary/20 rounded-3xl transform rotate-1 group-hover:rotate-2 transition-transform duration-300">
                    </div>
                    <div class="relative bg-white p-4 rounded-3xl shadow-xl">
                        <img src="{{asset('storage/assets/3.webp')}}" class="w-full object-cover rounded-2xl"
                            alt="Volunteers making a difference in the community" />
                        <div class="absolute top-8 left-8 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full">
                            <span class="text-sm font-semibold text-primary">🌟 Featured</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Opportunity Cards -->
            <div class="lg:col-span-7 space-y-6">
                <!-- Card 1 -->
                <div
                    class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-accent/20">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="flex-shrink-0">
                            <div class="relative overflow-hidden rounded-xl">
                                <img src="{{asset('storage/assets/2.webp')}}"
                                    class="w-full md:w-24 h-32 md:h-24 object-cover group-hover:scale-110 transition-transform duration-300"
                                    alt="Community outreach volunteer opportunity" />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            </div>
                        </div>

                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-3">
                                <h3
                                    class="text-xl font-bold text-primary group-hover:text-accent transition-colors duration-300">
                                    Community Outreach Assistant
                                </h3>
                                <span
                                    class="flex-shrink-0 bg-accent/10 text-accent px-3 py-1 rounded-full text-sm font-medium">
                                    New
                                </span>
                            </div>

                            <p class="text-gray-600 mb-4 leading-relaxed">
                                Support local events and connect with community members to strengthen neighborhood bonds
                                and foster positive relationships.
                            </p>

                            <div class="flex flex-wrap gap-4 text-sm">
                                <div class="flex items-center text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Downtown Area
                                </div>
                                <div class="flex items-center text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    4 hours/week
                                </div>
                                <div class="flex items-center text-accent font-medium">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Apply Now
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div
                    class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-accent/20">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="flex-shrink-0">
                            <div class="relative overflow-hidden rounded-xl">
                                <img src="{{asset('storage/assets/1.webp')}}"
                                    class="w-full md:w-24 h-32 md:h-24 object-cover group-hover:scale-110 transition-transform duration-300"
                                    alt="Educational support volunteer opportunity" />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            </div>
                        </div>

                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-3">
                                <h3
                                    class="text-xl font-bold text-primary group-hover:text-accent transition-colors duration-300">
                                    Educational Support Volunteer
                                </h3>
                                <span
                                    class="flex-shrink-0 bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">
                                    Urgent
                                </span>
                            </div>

                            <p class="text-gray-600 mb-4 leading-relaxed">
                                Help students with homework, reading, and educational activities to support their
                                academic growth and development.
                            </p>

                            <div class="flex flex-wrap gap-4 text-sm">
                                <div class="flex items-center text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Local Schools
                                </div>
                                <div class="flex items-center text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    6 hours/week
                                </div>
                                <div class="flex items-center text-accent font-medium">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Apply Now
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div
                    class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-accent/20">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="flex-shrink-0">
                            <div class="relative overflow-hidden rounded-xl">
                                <img src="{{asset('storage/assets/3.webp')}}"
                                    class="w-full md:w-24 h-32 md:h-24 object-cover group-hover:scale-110 transition-transform duration-300"
                                    alt="Senior care volunteer opportunity" />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            </div>
                        </div>

                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-3">
                                <h3
                                    class="text-xl font-bold text-primary group-hover:text-accent transition-colors duration-300">
                                    Senior Care Companion
                                </h3>
                                <span
                                    class="flex-shrink-0 bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                    Popular
                                </span>
                            </div>

                            <p class="text-gray-600 mb-4 leading-relaxed">
                                Provide companionship and support to seniors, helping them stay connected and engaged
                                with their community.
                            </p>

                            <div class="flex flex-wrap gap-4 text-sm">
                                <div class="flex items-center text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Care Centers
                                </div>
                                <div class="flex items-center text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    3 hours/week
                                </div>
                                <div class="flex items-center text-accent font-medium">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Apply Now
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="mt-16 text-center">
            <div class="bg-gradient-to-r from-accent/5 to-primary/5 rounded-3xl p-8 lg:p-12">
                <h3 class="text-2xl lg:text-3xl font-bold text-primary mb-4">
                    Ready to Make a Difference?
                </h3>
                <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                    Join our community of volunteers and start creating positive change in your community today.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button
                        class="bg-accent hover:bg-accent/90 text-white px-8 py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        Browse All Opportunities
                    </button>
                    <button
                        class="bg-white text-primary border-2 border-primary px-8 py-4 rounded-full font-semibold transition-all duration-300 hover:bg-primary hover:text-white">
                        Contact Us
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
