<div>
    <x-nav/>
    <main>
        <section>
            <div class="container py-20">
                <div class="flex flex-col items-center z-20 md:flex-row">
                    <div class="text-center mb-12 md:text-left md:w-1/2 md:pr-10">
                        <h1 class="text-3xl md:text-4xl font-bold leading-snug mb-4 ">
                            Bring a Smile, Be the Change
                        </h1>
                        <p class="leading-relaxed mb-10 ">
                            Join Smiles – a community of passionate volunteers spreading hope, kindness, and happiness to those who need it most
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="/signup/volunteer" class="btn btn-primary btn-lg">I'd like to volunteer</a>
                            <a href="/signup/organization" class="">
                                <button class="btn btn-soft btn-primary btn-lg">I'm looking for volunteers</button>
                            </a>
                        </div>

                    </div>
                    <div class="md:w-1/2">
                        <img src="{{asset('storage/assets/landing.jpg')}}" class="max-w-2xl align-baseline rounded-2xl" alt="a man helping another man get up" />

                    </div>

                </div>
            </div>
        </section>
    </main>

    <x-footer/>
</div>
