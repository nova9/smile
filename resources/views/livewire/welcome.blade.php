<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100">
    <!-- Hero Section -->
    <x-common.landing.home />

    <!-- Content Sections with improved spacing and modern layout -->
    <div class="relative">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-primary/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-accent/5 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-32 py-16">
            <!-- About Us Section -->
            <section class="scroll-mt-20" id="about">
                <x-common.landing.aboutus />
            </section>

            <!-- Opportunities Section -->
            <section class="scroll-mt-20" id="opportunities">
                <x-common.landing.opportunities />
            </section>

            <!-- Get Involved Section -->
            <section class="scroll-mt-20" id="involved">
                <x-common.landing.involved />
            </section>

            {{-- <!-- Donate Section -->
            <section class="scroll-mt-20" id="donate">
                <x-common.landing.donate />
            </section> --}}

            <!-- Testimonials Section -->
            <section class="scroll-mt-20" id="testimonials">
                <x-common.landing.testimonials />
            </section>
        </div>
    </div>


    @if (session()->has('message'))
        <div class="toast toast-end">
            <div class="alert alert-success">
                <span>{{ session('message') }}</span>
            </div>
        </div>
    @endif
    <!-- Footer -->
    <x-common.landing.footer />

</div>
