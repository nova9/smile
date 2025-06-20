
<main>
    <section class="px-10">
        <div class="container py-20 mx-auto">
            <div class="flex flex-col-reverse md:flex-row items-center z-20 gap-10">
                <div class="text-center md:text-left md:w-1/2">
                    <div class="avatar-group -space-x-6 mb-10">
                        <div class="avatar">
                            <div class="w-12">
                                <img src="https://img.daisyui.com/images/profile/demo/batperson@192.webp" />
                            </div>
                        </div>
                        <div class="avatar">
                            <div class="w-12">
                                <img src="https://img.daisyui.com/images/profile/demo/spiderperson@192.webp" />
                            </div>
                        </div>
                        <div class="avatar">
                            <div class="w-12">
                                <img src="https://img.daisyui.com/images/profile/demo/averagebulk@192.webp" />
                            </div>
                        </div>
                        <div class="avatar avatar-placeholder">
                            <div class="bg-neutral text-neutral-content w-12">
                                <span>+99</span>
                            </div>
                        </div>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold leading-snug mb-4">
                        Bring a Smile, Be the Change
                    </h1>
                    <p class="leading-relaxed mb-10">
                        Join Smiles – a community of passionate volunteers spreading hope, kindness, and happiness to those who need it most.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        <a href="/signup/volunteer" class="btn btn-primary btn-lg">
                            I'd like to volunteer
                        </a>
                        <a href="/signup/organization">
                            <button class="btn btn-soft btn-primary btn-lg">
                                I'm looking for volunteers
                            </button>
                        </a>
                    </div>
                </div>

                <div class="md:w-1/2 flex justify-center">
                    <img src="{{ asset('storage/assets/landing_image.svg') }}"
                         alt="A person helping another person stand up"
                         class="max-w-full rounded-2xl" loading="lazy" />
                </div>

            </div>
        </div>
    </section>
</main>
