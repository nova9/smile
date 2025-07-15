<div class="relative group h-full">
    <!-- Background gradient and shadow -->
    <div
        class="absolute inset-0 bg-gradient-to-br from-white via-gray-50 to-white rounded-3xl transform rotate-1 group-hover:rotate-0 transition-transform duration-300 shadow-lg group-hover:shadow-2xl">
    </div>

    <!-- Card content -->
    <div
        class="relative bg-white p-8 rounded-3xl shadow-xl border border-gray-100 h-full flex flex-col justify-between hover:border-accent/20 transition-all duration-300">
        <!-- Quote icon -->
        <div class="absolute top-6 right-6 opacity-10">
            <svg class="w-12 h-12 text-accent" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h4v10h-10z" />
            </svg>
        </div>

        <!-- Rating -->
        <div class="flex items-center gap-x-3 mb-6">
            <div class="flex gap-x-1">
                @for($i = 1; $i <= 5; $i++)
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 24 24">
                        <path
                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                    </svg>
                @endfor
            </div>
            <span class="text-sm font-medium text-gray-600">5.0</span>
        </div>

        <!-- Testimonial text -->
        <blockquote class="text-gray-700 text-lg leading-relaxed mb-8 flex-grow">
            "{{$des}}"
        </blockquote>

        <!-- Profile section -->
        <div class="flex items-center gap-x-4">
            <div class="relative">
                <!-- Profile image with gradient border -->
                <div class="absolute inset-0 bg-gradient-to-r from-accent to-green-600 rounded-full p-0.5">
                    <div class="bg-white rounded-full p-0.5">
                        <img src="{{ asset('storage/assets/dummy_profile_pic.png') }}" alt="{{$name}}"
                            class="w-16 h-16 rounded-full object-cover">
                    </div>
                </div>
            </div>

            <div class="flex flex-col">
                <h3 class="font-bold text-primary text-lg">{{$name}}</h3>
                <p class="text-gray-600 text-sm">{{$role}}</p>
            </div>
        </div>

        <!-- Decorative element -->
        <div class="absolute bottom-4 right-4 w-8 h-8 bg-accent/10 rounded-full opacity-50"></div>
    </div>
</div>