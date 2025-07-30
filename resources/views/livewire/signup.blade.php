<x-common.auth.layout>
    <div class="text-center text-white mb-6">
        <h1 class="text-3xl font-bold text-accent">Create an Account</h1>
        <p class="text-gray-500">Let's help each other.</p>
    </div>

    <form x-data="mainForm({ step: $wire.entangle('step') })" wire:submit.prevent="save" class="space-y-4 sm:space-y-6 mt-4"
        method="post">
        @csrf

        <ul class="steps w-full">
            <li class="hover:cursor-pointer" :class="step >= 1 ? 'step step-primary' : 'step'" @click="step = 1">Details
            </li>
            <li class="hover:cursor-pointer" :class="step >= 2 ? 'step step-primary' : 'step'" @click="step = 2">Goal
            </li>

            <li class="hover:cursor-pointer" :class="step >= 3 ? 'step step-primary' : 'step'" @click="step = 3">
                Selfie
            </li>
            <li class="hover:cursor-pointer" :class="step >= 4 ? 'step step-primary' : 'step'" @click="step = 4">
                Identification
            </li>
            <li class="hover:cursor-pointer" :class="step >= 5 ? 'step step-primary' : 'step'" @click="step = 5">Finish
            </li>
        </ul>

        {{-- Page 1 of 5--}}
        <div x-show="step === 1">
            <div class="space-y-6">
                <x-common.auth.input name="name" label="Full Name" placeholder="Enter your full name" required />

                <x-common.auth.input name="email" type="email" label="Email Address" placeholder="Enter your email"
                    required />
                <x-common.auth.input name="password" type="password" label="Password" placeholder="Create a password"
                    required />
                <x-common.auth.input name="password_confirmation" type="password" label="Confirm Password"
                    placeholder="Confirm your password" required />

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-8">
                    <button disabled class="btn btn-outline" type="button">
                        <span class="mr-1">←</span>
                        Previous
                    </button>

                    <button @click="$wire.navigate(1, 2)" class="btn btn-primary" type="button">
                        Next
                        <span class="ml-1">→</span>
                    </button>
                </div>
            </div>
        </div>


        {{-- Page 2 of 5--}}
        <div x-show="step === 2">
            <div class="space-y-6">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-semibold">Choose Your Role</h2>
                    <p class="text-gray-800 text-sm">Select how you'd like to participate in our community</p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <!-- Volunteer Option -->
                    <label class="cursor-pointer">
                        <input wire:model="role" type="radio" name="role" value="volunteer" class="sr-only peer" />
                        <div
                            class="border-2 border-gray-300 rounded-lg p-6 text-center transition-all duration-200 peer-checked:border-primary peer-checked:bg-primary/10 hover:border-gray-500">
                            <div class="text-3xl mb-3">🤝</div>
                            <h3 class="text-lg font-semibold mb-2">Volunteer</h3>
                            <p class="text-gray-700 text-sm mb-4">I want to help others in my community</p>
                            <ul class="text-xs text-left text-gray-500 space-y-1">
                                <li>• Offer your skills and time</li>
                                <li>• Support those in need</li>
                                <li>• Build meaningful connections</li>
                                <li>• Make a positive impact</li>
                            </ul>
                        </div>
                    </label>

                    <!-- Requester Option -->
                    <label class="cursor-pointer">
                        <input wire:model="role" type="radio" name="role" value="requester" class="sr-only peer" />
                        <div
                            class="border-2 border-gray-300 rounded-lg p-6 text-center transition-all duration-200 peer-checked:border-primary peer-checked:bg-primary/10 hover:border-gray-500">
                            <div class="text-3xl mb-3">🙋‍♂️</div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Looking for Help</h3>
                            <p class="text-gray-700 text-sm mb-4">I need assistance from the community</p>
                            <ul class="text-xs text-left text-gray-500 space-y-1">
                                <li>• Request help when needed</li>
                                <li>• Connect with volunteers</li>
                                <li>• Access community resources</li>
                                <li>• Get support and guidance</li>
                            </ul>
                        </div>
                    </label>
                </div>

                @error('role')
                    <p class="text-xs text-rose-500 mt-4 text-center">{{ $message }}</p>
                @enderror

                <!-- Selected Role Confirmation -->
                <div x-show="$wire.role" class="mt-6 p-4 bg-primary/10 border border-primary/20 rounded-lg">
                    <div class="flex items-center justify-center space-x-2">
                        <span class="text-primary">✓</span>
                        <span class="text-gray-800 text-sm">
                            You've selected:
                            <span
                                x-text="$wire.role === 'volunteer' ? 'Volunteer - Help Others' : 'Looking for Help - Get Support'"
                                class="font-semibold text-primary"></span>
                        </span>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-8">
                    <button class="btn btn-outline" type="button" @click="step = 1">
                        <span class="mr-1">←</span>
                        Previous
                    </button>

                    <button @click="$wire.navigate(2, 3)" class="btn btn-primary" type="button">
                        Next
                        <span class="ml-1">→</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Page 3 of 5--}}
        <div x-show="step === 3">
            <div class="space-y-6">
                <!-- Live Camera -->
                <div>
                    <div class="relative bg-black rounded-xl overflow-hidden">
                        <div x-show="showCamera">
                            <video x-ref="video" autoplay playsinline class="z-40 w-full h-full object-cover"></video>
                            <button type="button" class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-white rounded-full p-4 hover:rotate-180 transition-all hover:cursor-pointer"
                                    x-on:click="capture">
                                <i data-lucide="aperture" class="size-8"></i>

                            </button>
                            <span x-show="cameraSwitching" class="absolute bottom-1/2 left-1/2 -translate-x-1/2 translate-y-1/2 loading loading-spinner loading-xl bg-white"></span>
{{--                            <div class="absolute bottom-1/2 left-1/2 -translate-x-1/2 translate-y-1/2 h-48 w-24 border-4 border-white rounded-full"></div>--}}
                        </div>
                        <div x-show="!showCamera">
                            <img class="h-full w-full" src="{{ $selfie_url }}" />
                            <button
                                type="button"
                                class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-white rounded-full p-4 font-semibold hover:cursor-pointer"
                                x-on:click="retake"
                            >
                                <i data-lucide="rotate-cw" class="size-8"></i>
                            </button>
                        </div>
                    </div>

                    <canvas x-ref="canvas" class="hidden"></canvas>

                </div>

                @error('selfie')
                    <p class="text-xs text-rose-500 mt-4 text-center">{{ $message }}</p>
                @enderror

                <div
                    x-show="$wire.selfie_url"
                    class="mt-6 flex flex-col items-center justify-center bg-primary/10 border border-primary/20 rounded-xl p-6 shadow-lg transition-all"
                >
                    <h3 class="text-lg font-semibold text-primary mb-1">Selfie Captured! <span>📸</span></h3>
                    <p class="text-gray-700 text-sm">Looking great! If you want, you can retake your selfie or continue to the next step.</p>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-8">
                    <button class="btn btn-outline" type="button" @click="step = 2">
                        <span class="mr-1">←</span>
                        Previous
                    </button>

                    <button @click="$wire.navigate(3, 4)" class="btn btn-primary" type="button">
                        Next
                        <span class="ml-1">→</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Page 4 of 5 - Document Upload --}}
        <div x-show="step === 4">
            <div class="space-y-6" x-data="documentUpload({ documentType: $wire.entangle('document_type') })">
                <!-- Header -->
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Identity Verification</h2>
                    <p class="text-gray-600 text-sm">Please upload a valid government-issued ID for verification</p>
                </div>

                <!-- Document Type Selection -->
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-gray-700">Select Document Type</label>
                    <div class="grid gap-3 sm:grid-cols-3">
                        <!-- National ID -->
                        <label class="cursor-pointer">
                            <input x-model="documentType" type="radio" name="document_type" value="national_id"
                                class="sr-only peer" />
                            <div
                                class="border-2 border-gray-300 rounded-lg p-4 text-center transition-all duration-200 peer-checked:border-primary peer-checked:bg-primary/10 hover:border-gray-400">
                                <div class="text-2xl mb-2">🆔</div>
                                <h4 class="text-sm font-semibold">National ID</h4>
                                <p class="text-xs text-gray-500">Government ID Card</p>
                            </div>
                        </label>

                        <!-- Driver's License -->
                        <label class="cursor-pointer">
                            <input x-model="documentType" type="radio" name="document_type" value="driving_license"
                                class="sr-only peer" />
                            <div
                                class="border-2 border-gray-300 rounded-lg p-4 text-center transition-all duration-200 peer-checked:border-primary peer-checked:bg-primary/10 hover:border-gray-400">
                                <div class="text-2xl mb-2">🚗</div>
                                <h4 class="text-sm font-semibold">Driver's License</h4>
                                <p class="text-xs text-gray-500">Valid License</p>
                            </div>
                        </label>

                        <!-- Passport -->
                        <label class="cursor-pointer">
                            <input x-model="documentType" type="radio" name="document_type" value="passport"
                                class="sr-only peer" />
                            <div
                                class="border-2 border-gray-300 rounded-lg p-4 text-center transition-all duration-200 peer-checked:border-primary peer-checked:bg-primary/10 hover:border-gray-400">
                                <div class="text-2xl mb-2">📘</div>
                                <h4 class="text-sm font-semibold">Passport</h4>
                                <p class="text-xs text-gray-500">Photo Page Only</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Document Upload Areas -->
                <div x-show="documentType" class="space-y-6">
                    <!-- Front Side / Main Page -->
                    <div class="space-y-3">
                        <label class="block text-sm font-medium text-gray-700">
                            <span x-text="documentType === 'passport' ? 'Photo Page' : 'Front Side'"></span>
                            <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">
                            <div
                                x-data="{ uploading: false, progress: 0 }"
                                x-on:livewire-upload-start="uploading = true"
                                x-on:livewire-upload-finish="uploading = false"
                                x-on:livewire-upload-cancel="uploading = false"
                                x-on:livewire-upload-error="uploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress"
                            >
                                <!-- File Input -->
                                <input wire:model="front_image" type="file" accept="image/*" class="file-input">


                                <!-- Progress Bar -->
                                <div x-show="uploading">
                                    <progress class="progress w-56" x-bind:value="progress" max="100"></progress>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Back Side (not for passport) -->
                    <div x-show="documentType !== 'passport'" class="space-y-3">
                        <label class="block text-sm font-medium text-gray-700">
                            Back Side <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">
                            <div
                                x-data="{ uploading: false, progress: 0 }"
                                x-on:livewire-upload-start="uploading = true"
                                x-on:livewire-upload-finish="uploading = false"
                                x-on:livewire-upload-cancel="uploading = false"
                                x-on:livewire-upload-error="uploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress"
                            >
                                <!-- File Input -->
                                <input wire:model="back_image" type="file" accept="image/*" class="file-input">


                                <!-- Progress Bar -->
                                <div x-show="uploading">
                                    <progress class="progress w-56" x-bind:value="progress" max="100"></progress>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upload Tips -->
                <div x-show="documentType" class=" border border-green-600 rounded-lg p-4">
                    <h4 class="text-sm font-semibold text-green-800 mb-2">📋 Upload Tips</h4>
                    <ul class="text-xs text-green-700 space-y-1">
                        <li>• Ensure the document is clearly visible and not blurry</li>
                        <li>• All four corners should be visible in the image</li>
                        <li>• Avoid glare or shadows on the document</li>
                        <li>• Make sure the text is readable</li>
                    </ul>
                </div>

                <!-- Error Messages -->
                @error('document_type')
                    <p class="text-xs text-rose-500 mt-2 text-center">{{ $message }}</p>
                @enderror

                @error('front_image')
                    <p class="text-xs text-rose-500 mt-2 text-center">{{ $message }}</p>
                @enderror

                @error('back_image')
                    <p class="text-xs text-rose-500 mt-2 text-center">{{ $message }}</p>
                @enderror


                <button x-on:click="verify" class="btn btn-primary" type="button">
                    <span>Validate</span>
                    <span x-show="validating" class="loading loading-spinner loading-sm bg-white"></span>
                </button>

                @if($verified)
                    <div class="mt-6 p-4 bg-green-100 border border-green-200 rounded-lg">
                        <div class="flex items-center justify-center space-x-2">
                            <span class="text-green-600">✓</span>
                            <span class="text-gray-800 text-sm">
                                Your identity has been successfully verified! {{ round($similarity) }}% match with the selfie.
                            </span>
                        </div>
                    </div>
                @endif

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-8">
                    <button class="btn btn-outline" type="button" @click="step = 3">
                        <span class="mr-1">←</span>
                        Previous
                    </button>

                    <button @click="$wire.navigate(4, 5)" @if(!$verified) disabled @endif class="btn btn-primary" type="button">
                        <span>Next</span>
                        <span class="ml-1">→</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Page 5 of 5--}}
        <div x-show="step === 5">
            <div class="space-y-8">
                <!-- Welcome Message -->
                <div class="text-center space-y-4">

                    <h2 class="text-2xl font-bold text-gray-800">Almost There! <span class="text-4xl">🎉</span>
                    </h2>
                    <p class="text-gray-600">
                        You're just one step away from joining our amazing community where
                        <span
                            x-text="$wire.role === 'volunteer' ? 'you can make a difference by helping others' : 'you can find the support you need'">
                        </span>.
                    </p>
                </div>

                <!-- Terms of Service -->
                <div class="bg-white border border-gray-200 rounded-lg p-6 space-y-4">
                    <h4 class="text-lg font-semibold text-gray-800 flex items-center">
                        <span class="text-2xl mr-2">📋</span>
                        Terms & Conditions
                    </h4>

                    <div class="bg-gray-50 rounded-lg p-4 max-h-32 overflow-y-auto text-sm text-gray-700">
                        <p class="mb-2">By creating an account, you agree to:</p>
                        <ul class="space-y-1 list-disc list-inside">
                            <li>Treat all community members with respect and kindness</li>
                            <li>Provide accurate and truthful information</li>
                            <li>Use the platform responsibly and legally</li>
                            <li>Respect privacy and confidentiality</li>
                            <li>Follow community guidelines and policies</li>
                        </ul>
                    </div>

                    <label class="flex items-start space-x-3 cursor-pointer group">
                        <input wire:model="tos" type="checkbox" name="tos"
                            class="checkbox checkbox-primary mt-1 @error('tos') border-error @enderror" />
                        <span class="text-gray-700 group-hover:text-gray-900 transition-colors">
                            I have read and agree to the
                            <a href="#" class="text-primary hover:text-primary-focus underline">Terms of Service</a>
                            and
                            <a href="#" class="text-primary hover:text-primary-focus underline">Privacy Policy</a>
                        </span>
                    </label>

                    @error('tos')
                        <p class="text-xs text-error mt-1 flex items-center">
                            <span class="mr-1">⚠️</span>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Call to Action -->
                <div class="text-center space-y-4">
                    <button
                        type="submit"
                        class="btn btn-primary btn-lg w-full text-lg font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
                        :disabled="!$wire.tos"
                        @click="$wire.save()"
                    >
                        <span class="mr-2">🚀</span>
                        Create My Account
                    </button>
                    <p class="text-xs text-gray-500">
                        By clicking "Create My Account", you'll join thousands of community members making a difference.
                    </p>
                </div>
            </div>
        </div>
    </form>

    <p class="text-center text-sm flex items-center gap-2 mt-4">
        Already have an account?
        <a href="/login">
            <button class="btn btn-link px-0">
                Log in
            </button>
        </a>
    </p>
</x-common.auth.layout>


<script>
    function documentUpload(config) {
        return {
            documentType: config.documentType,
            validating: false,

            async verify() {
                this.validating = true;
                await this.$wire.verify();
                this.validating = false;
                this.$wire.$refresh();
            }
        }
    }

    function mainForm(config) {
        return {
            step: config.step,

            init() {
                this.$nextTick(() => {
                    // this.startCamera()
                })

                this.$watch('step', (newStep) => {
                    if (newStep === 3) {
                        this.startCamera()
                    } else {
                        this.stopCamera()
                    }
                    console.log('Current step:', newStep);
                });
            },

            showCamera: true,
            cameraSwitching: false,

            video() {
                console.log(this.$refs.video)
            },

            startCamera() {
                const video = this.$refs.video;

                navigator.mediaDevices.getUserMedia({ video: true })
                    .then((stream) => {
                        video.srcObject = stream;
                    })
                    .catch((err) => {
                        console.error("Camera access denied:", err);
                    });
            },

            stopCamera() {
                const video = this.$refs.video;
                const stream = video.srcObject;

                if (stream) {
                    const tracks = stream.getTracks();
                    tracks.forEach(track => track.stop());
                    video.srcObject = null;
                }
            },

            async capture() {
                this.cameraSwitching = true
                console.log('Capturing photo...');
                const canvas = this.$refs.canvas;
                const video = this.$refs.video;


                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;

                const context = canvas.getContext('2d');
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                const base64Image = canvas.toDataURL('image/png');

                console.log('Captured base64:', base64Image);
                await this.$wire.capture(base64Image)

                await new Promise(resolve => setTimeout(resolve, 100));
                // TODO: this fixes UI jittering somehow

                this.showCamera = false
                this.cameraSwitching = false


                console.log('Photo captured and sent to Livewire component');
            },
            retake() {
                const video = this.$refs.video;
                console.log(video)
                this.$wire.retake()
                this.showCamera = true
                // this.startCamera()
            }
        }
    }
</script>
