<x-requester.dashboard-layout>
    <div class="p-6 max-xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Create New Event</h1>
            <p class="text-gray-600 mt-2">Organize a meaningful volunteer opportunity for your community</p>
        </div>

        <form wire:submit.prevent="save" class="space-y-8">
            <!-- Basic Information Card -->
            <div class="card bg-white shadow-md">
                <div class="card-body">
                    <h2 class="card-title text-xl mb-4 flex items-center">
                        <i data-lucide="info" class="size-5 mr-2 text-primary"></i>
                        Basic Information
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Event Name -->
                        <div class="md:col-span-2">
                            <x-common.auth.input name="name" label="Event Name" placeholder="e.g., Community Food Drive"
                                required />
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category
                                *</label>
                            <select wire:model="category_id" id="category_id"
                                class="select select-bordered w-full @error('category_id') select-error @enderror">
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description
                                *</label>
                            <textarea wire:model="description" id="description" rows="4"
                                class="textarea textarea-bordered w-full @error('description') textarea-error @enderror"
                                placeholder="Describe the event, activities, and what volunteers will be doing..."></textarea>
                            @error('description')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- Tags -->
                        <div class="md:col-span-2" x-data="{
                            availableTags: $wire.availableTags,
                            tags: [],
                            query: '',
                            init() {
                                $watch('query', (value) => {
                                    this.refreshTags()
                                })

                                $watch('availableTags', (value) => {
                                    console.log('availableTags changed', value)
                                })
                            },
                            refreshTags() {
                                if (this.query.trim() === '') {
                                    this.availableTags = $wire.availableTags;
                                } else {
                                    this.availableTags = $wire.availableTags.filter(t => t.toLowerCase().includes(this.query.toLowerCase()));
                                }
                            },
                            addTag(tag) {
                                const trimmedQuery = tag.trim();
                                if (trimmedQuery === '') return;
                                this.tags.push(trimmedQuery);
                                this.tags = [...new Set(this.tags)]; // Remove duplicates
                                $wire.tags = this.tags; // Update Livewire property
                            },
                            addTypedTag() {
                                this.addTag(this.query);
                                this.query = '';
                            },
                            addExistingTag(tag) {
                                this.addTag(tag)
                            },
                            removeTag(tag) {
                                this.tags = this.tags.filter(t => t !== tag);
                            },
                            getTagsToShow() {
                                return this.availableTags.filter(t => !this.tags.includes(t)).slice(0, 10);
                            }
                        }">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                            <template x-if="tags.length > 0">
                                <div class="flex flex-wrap gap-2 mb-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <template x-for="tag in tags" :key="tag">
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-primary rounded-full">
                                            <span x-text="tag"></span>
                                            <button type="button" class="ml-2 text-white hover:cursor-pointer"
                                                x-on:click="removeTag(tag)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="size-3 hover:cursor-pointer lucide lucide-x-icon lucide-x">
                                                    <path d="M18 6 6 18" />
                                                    <path d="m6 6 12 12" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>
                                </div>
                            </template>

                            <div class="flex gap-2 mb-3">
                                <input x-on:keydown.enter.stop.prevent="addTypedTag()" x-model="query" type="text"
                                    class="input input-bordered flex-1" placeholder="Type a tag name and press Enter">
                                <button type="button" x-on:click="addTypedTag()" class="btn btn-primary">
                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                    Add
                                </button>
                            </div>

                            <template x-if="availableTags.length !== 0">
                                <div class="mt-3">
                                    <p class="text-xs text-gray-600 mb-2">Or choose from existing tags:</p>
                                    <div class="flex flex-wrap gap-2">
                                        <template x-for="tag in getTagsToShow()" :key="tag">
                                            <button type="button" x-on:click="addExistingTag(tag)"
                                                class="select-none inline-flex items-center px-2 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="size-3 mr-1">
                                                    <path d="M5 12h14" />
                                                    <path d="M12 5v14" />
                                                </svg>
                                                <span x-text="tag"></span>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Date & Time Card -->
                        <div class="md:col-span-2" x-data="{
                            starts_at: @entangle('starts_at').defer,
                            ends_at: @entangle('ends_at').defer,

                            change_date(e) {
                                // FIXME: will time format be correct?
                                const value = e.target.value;
                                const [starts_at, ends_at] = value.split('/')
                                console.log(value, starts_at, ends_at)
                                $wire.starts_at = starts_at;
                                $wire.ends_at = ends_at;
                            }
                        }">
                            <div class="text-black">
                                <!-- Date Range -->
                                <div class="card">
                                    <label for="starts_at" class="block text-sm font-medium text-gray-700 mb-2">
                                        Event Timespan</label>
                                    <calendar-range x-on:change="change_date"
                                        class="cally bg-base-100 border border-base-300 shadow-lg rounded-box">
                                        <svg aria-label="Previous" class="fill-current size-4" slot="previous"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M15.75 19.5 8.25 12l7.5-7.5"></path>
                                        </svg>
                                        <svg aria-label="Next" class="fill-current size-4" slot="next"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="m8.25 4.5 7.5 7.5-7.5 7.5"></path>
                                        </svg>
                                        <calendar-month></calendar-month>
                                    </calendar-range>
                                    @error('starts_at')
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                    @error('ends_at')
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Requirements & Skills Card -->
            <div class="card bg-white shadow-md">
                <div class="card-body">
                    <h2 class="card-title text-xl mb-4 flex items-center">
                        <i data-lucide="user-check" class="size-5 mr-2 text-primary"></i>
                        Volunteer Requirements
                    </h2>
                    <div x-data="{ filterTypes: $wire.filterTypes || [] }">
                        <!-- Maximum Participants -->
                        <div class="mb-4">
                            <label for="maximum_participants"
                                class="block text-sm font-medium text-gray-700 mb-2">Maximum Participants</label>
                            <input wire:model="maximum_participants" type="number" id="maximum_participants" min="1"
                                class="input input-bordered w-full" placeholder="e.g., 50"
                                aria-describedby="maximum_participants_error">
                            @error('maximum_participants')
                                <p class="text-xs text-red-500 mt-1" id="maximum_participants_error">{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Filter Options -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Filter Maximum Participants
                                By</label>
                            <div class="flex flex-wrap gap-4">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" value="gender" x-model="filterTypes"
                                        @change="$wire.filterTypes = filterTypes" class="checkbox mr-2">
                                    <span>Gender Identity</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" value="level" x-model="filterTypes"
                                        @change="$wire.filterTypes = filterTypes" class="checkbox mr-2">
                                    <span>Experience Level</span>
                                </label>
                            </div>
                        </div>

                        <!-- Gender Identity Filter -->
                        <template x-if="filterTypes.includes('gender')">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Participants by Gender
                                    Identity</label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label for="male_participants"
                                            class="block text-xs text-gray-600 mb-1">Man</label>
                                        <input wire:model="male_participants" type="number" id="male_participants"
                                            min="0" class="input input-bordered w-full" placeholder="e.g., 20"
                                            aria-describedby="male_participants_error">
                                    </div>
                                    <div>
                                        <label for="female_participants"
                                            class="block text-xs text-gray-600 mb-1">Woman</label>
                                        <input wire:model="female_participants" type="number" id="female_participants"
                                            min="0" class="input input-bordered w-full" placeholder="e.g., 20"
                                            aria-describedby="female_participants_error">
                                    </div>
                                    <div>
                                        <label for="non_binary_participants"
                                            class="block text-xs text-gray-600 mb-1">Non-Binary/Other</label>
                                        <input wire:model="non_binary_participants" type="number"
                                            id="non_binary_participants" min="0" class="input input-bordered w-full"
                                            placeholder="e.g., 10" aria-describedby="non_binary_participants_error">
                                    </div>
                                    @error('participant_gender_requirements')
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </template>

                        <!-- Experience Level Filter -->
                        <template x-if="filterTypes.includes('level')">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Participants by Experience
                                    Level</label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label for="beginner_participants"
                                            class="block text-xs text-gray-600 mb-1">Beginner</label>
                                        <input wire:model="beginner_participants" type="number"
                                            id="beginner_participants" min="0" class="input input-bordered w-full"
                                            placeholder="e.g., 10" aria-describedby="beginner_participants_error">
                                    </div>
                                    <div>
                                        <label for="intermediate_participants"
                                            class="block text-xs text-gray-600 mb-1">Intermediate</label>
                                        <input wire:model="intermediate_participants" type="number"
                                            id="intermediate_participants" min="0" class="input input-bordered w-full"
                                            placeholder="e.g., 10" aria-describedby="intermediate_participants_error">
                                    </div>
                                    <div>
                                        <label for="advanced_participants"
                                            class="block text-xs text-gray-600 mb-1">Advanced</label>
                                        <input wire:model="advanced_participants" type="number"
                                            id="advanced_participants" min="0" class="input input-bordered w-full"
                                            placeholder="e.g., 10" aria-describedby="advanced_participants_error">
                                    </div>
                                    @error('participant_level_requirements')
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mt-2 text-xs text-gray-500">
                                    <ul class="list-disc ml-4">
                                        <li><span class="font-semibold">Beginner:</span> No prior experience required,
                                            eager to learn.</li>
                                        <li><span class="font-semibold">Intermediate:</span> Some experience, can work
                                            with guidance.</li>
                                        <li><span class="font-semibold">Advanced:</span> Extensive experience, can lead
                                            or train others.</li>
                                    </ul>
                                </div>
                            </div>
                        </template>

                        <!-- Skills Required -->
                        <div class="mb-4" x-data="{
                            skillInput: '',
                            skills: $wire.skills || [],
                            addSkill() {
                                const skill = this.skillInput.trim();
                                if (skill && !this.skills.includes(skill)) {
                                    this.skills.push(skill);
                                    $wire.skills = this.skills;
                                }
                                this.skillInput = '';
                            },
                            removeSkill(skill) {
                                this.skills = this.skills.filter(s => s !== skill);
                                $wire.skills = this.skills;
                            }
                        }">
                            <label for="skills" class="block text-sm font-medium text-gray-700 mb-2">Required
                                Skills</label>
                            <div class="flex gap-2 mb-3">
                                <input x-model="skillInput" x-on:keydown.enter.prevent="addSkill()" type="text"
                                    class="input input-bordered flex-1" placeholder="Type a skill and press Enter"
                                    aria-describedby="skills_error">
                                <button type="button" x-on:click="addSkill()" class="btn btn-primary">
                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                    Add Skill
                                </button>
                            </div>
                            <template x-if="skills.length > 0">
                                <div class="flex flex-wrap gap-2 mb-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <template x-for="skill in skills" :key="skill">
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-primary rounded-full">
                                            <span x-text="skill"></span>
                                            <button type="button" class="ml-2 text-white hover:cursor-pointer"
                                                x-on:click="removeSkill(skill)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="size-3 hover:cursor-pointer lucide lucide-x-icon lucide-x">
                                                    <path d="M18 6 6 18" />
                                                    <path d="m6 6 12 12" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>
                                </div>
                            </template>
                            @error('skills')
                                <p class="text-xs text-red-500 mt-1" id="skills_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Age and Recruiting Method -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <label for="minimum_age" class="block text-sm font-medium text-gray-700 mb-2">Minimum
                                    Age</label>
                                <input wire:model="minimum_age" type="number" id="minimum_age"
                                    class="input input-bordered w-full" placeholder="e.g., 16" min="16"
                                    aria-describedby="minimum_age_error">
                                @error('minimum_age')
                                    <p class="text-xs text-red-500 mt-1" id="minimum_age_error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="recruiting_method"
                                    class="block text-sm font-medium text-gray-700 mb-2">Recruiting Method</label>
                                <select wire:model="recruiting_method" id="recruiting_method"
                                    class="select select-bordered w-full" aria-describedby="recruiting_method_error">
                                    <option value="">Select recruiting method</option>
                                    <option value="first_come">First Come, First Served</option>
                                    <option value="application_review">Application Review</option>
                                    <option value="skill_assessment">Skill-Based Assessment</option>
                                    <option value="metrics">Based on Metrics (Rank)</option>
                                </select>
                                @error('recruiting_method')
                                    <p class="text-xs text-red-500 mt-1" id="recruiting_method_error">{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Additional Notes -->
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Additional
                                Notes</label>
                            <textarea wire:model="notes" id="notes" rows="3" class="textarea textarea-bordered w-full"
                                placeholder="Any additional information for volunteers (e.g., dress code, time commitment)"
                                aria-describedby="notes_error"></textarea>
                            @error('notes')
                                <p class="text-xs text-red-500 mt-1" id="notes_error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- What do you need -->
            <div class="card bg-white shadow-md">
                <div class="card-body">
                    <h2 class="card-title text-xl mb-4 flex items-center">
                        <i data-lucide="box" class="size-5 mr-2 text-primary"></i>
                        What do you need for the event?
                    </h2>

                    <div x-data="{ rows: @entangle('event_resources') }">
                        <p class="text-sm text-gray-600 mb-3">Add resources required for the event and the
                            amount/quantity needed.</p>

                        <template x-if="rows.length === 0">
                            <div class="mb-3 text-sm text-gray-500">No resources added yet. Click the button below to
                                add one.</div>
                        </template>

                        <div class="space-y-3">
                            <template x-for="(row, index) in rows" :key="index">
                                <div class="grid grid-cols-12 gap-2 items-center">
                                    <div class="col-span-7">
                                        <label class="sr-only">Resource</label>
                                        <template x-if="!rows[index].is_custom">
                                            <select x-model="rows[index].resource_id"
                                                class="select select-bordered w-full">
                                                <option value="">Select a resource</option>
                                                @foreach ($resources as $resource)
                                                    <option value="{{ $resource->id }}">{{ $resource->name }}
                                                        @if($resource->unit) ({{ $resource->unit }}) @endif</option>
                                                @endforeach
                                            </select>
                                        </template>
                                        <template x-if="rows[index].is_custom">
                                            <div class="grid grid-cols-2 gap-2">
                                                <input x-model="rows[index].custom_name" type="text"
                                                    class="input input-bordered w-full" placeholder="Custom resource name">
                                                <input x-model="rows[index].custom_unit" type="text"
                                                    class="input input-bordered w-full" placeholder="Unit (e.g., kg, pcs)">
                                            </div>
                                        </template>
                                    </div>

                                    <div class="col-span-3">
                                        <label class="sr-only">Quantity</label>
                                        <input x-model="rows[index].quantity" type="number" min="1"
                                            class="input input-bordered w-full" placeholder="Quantity">
                                    </div>

                                    <div class="col-span-1 flex items-center justify-center">
                                        <label class="inline-flex items-center text-xs">
                                            <input type="checkbox" class="checkbox mr-2"
                                                x-model="rows[index].is_custom">
                                            <span>Custom</span>
                                        </label>
                                    </div>

                                    <div class="col-span-1 flex justify-end items-center">
                                        <button type="button" class="btn btn-sm"
                                            x-on:click="rows.splice(index, 1)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2 size-4"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="mt-4">
                            <button type="button" class="btn btn-primary"
                                x-on:click="rows.push({ resource_id: '', quantity: 1 })">
                                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                                Add Resource
                            </button>
                        </div>

                        @error('event_resources')
                            <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                        @error('event_resources.*.resource_id')
                            <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                        @error('event_resources.*.quantity')
                            <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Location Card -->

                <div class="card-body">
                    <h2 class="card-title text-xl mb-4 flex items-center">
                        <i data-lucide="map-pin" class="size-5 mr-2 text-primary"></i>
                        Location Details
                    </h2>


                    <!-- Map Location Picker -->

                    <div class="mb-6" wire:ignore>
                        <div class="border border-gray-300 rounded-lg overflow-hidden">
                            <div id="map" class="w-full h-[70vh] bg-gray-100 relative">
                                <!-- Map will be initialized here -->
                                <div class="absolute inset-0 flex items-center justify-center">
                                    {{-- loading state --}}
                                    <div class="flex items-center gap-2">
                                        <button class="btn btn-sm btn-primary" onclick="initializeMap()" type="button">
                                            <i data-lucide="refresh-cw" class="size-4"></i>
                                            <span class="ml-1">Reload Map</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Selected coordinates display -->
                        <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="navigation" class="size-4 text-primary"></i>
                                    <h4 class="text-sm font-medium text-gray-700">Selected Location</h4>
                                </div>
                                <button type="button" onclick="getCurrentLocation()"
                                    class="btn btn-sm bg-primary hover:bg-green-700 text-white border-none shadow-sm hover:shadow-md transition-all duration-200 group"
                                    title="Use my current location">
                                    <i data-lucide="crosshair"
                                        class="size-4 group-hover:rotate-90 transition-transform duration-200"></i>
                                    <span class="hidden sm:inline ml-1">Current Location</span>
                                </button>
                            </div>

                            <div id="coordinates-display" class="hidden">
                                <div class="flex items-center gap-4 p-3 bg-white/50 rounded-lg border border-green-100">
                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                        <i data-lucide="map-pin" class="size-4 text-primary0"></i>
                                        <span class="font-medium">Coordinates:</span>
                                    </div>
                                    <div class="flex items-center gap-4 text-sm font-mono">
                                        <span id="lat-display" class="text-gray-700"></span>
                                        <span class="text-gray-400">•</span>
                                        <span id="lng-display" class="text-gray-700"></span>
                                    </div>
                                </div>
                            </div>

                            <div id="no-location" class="flex items-center justify-center text-gray-500">
                                <div class="text-center">
                                    <i data-lucide="map" class="size-8 mx-auto mb-2 text-primary"></i>
                                    <p class="text-sm">Click on the map to select a location</p>
                                </div>
                            </div>

                            <!-- Hidden inputs for form submission -->
                            <input wire:model="latitude" type="hidden" id="latitude">
                            <input wire:model="longitude" type="hidden" id="longitude">
                        </div>

                        @error('latitude')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                        @error('longitude')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-between items-center p-6">
                <a href="/requester/dashboard/my-events" class="btn btn-outline">
                    <i data-lucide="arrow-left" class="size-4 mr-2"></i>
                    Cancel
                </a>

                <div>
                    <button type="submit" class="btn btn-primary">
                        <i data-lucide="calendar-plus" class="size-4 mr-2"></i>
                        Create Event
                    </button>
                </div>
            </div>
        </form>
    </div>

</x-requester.dashboard-layout>

@assets
<script>
    let map;
    let marker;

    function initializeMap() {
        // Initialize the map
        const mapOptions = {
            center: {
                lat: 7.8731,
                lng: 80.7718
            },
            zoom: 7,
            mapId: "198a0e442491558328ee7d20",
            gestureHandling: "cooperative",
        };

        map = new google.maps.Map(document.getElementById("map"), mapOptions);

        // Add a click listener to the map
        map.addListener("click", (event) => {
            const pos = {
                lat: event.latLng.lat(),
                lng: event.latLng.lng()
            };
            placeMarker(pos);
        });
    }

    function placeMarker(pos) {
        // If a marker already exists, remove it
        if (marker) {
            marker.setMap(null);
        }

        console.log(google)

        // Create a new marker
        marker = new google.maps.marker.AdvancedMarkerElement({
            map,
            position: pos,
            title: "Hello, Sri Lanka!"
        });

        // Set the latitude and longitude input values
        document.getElementById("latitude").value = pos.lat;
        document.getElementById("longitude").value = pos.lng;

        Livewire.dispatch('coordinates', pos);

        // Update the coordinates display
        document.getElementById("lat-display").innerText = `Lat: ${pos.lat.toFixed(6)}`;
        document.getElementById("lng-display").innerText = `Lng: ${pos.lng.toFixed(6)}`;
        document.getElementById("coordinates-display").classList.remove("hidden");
        document.getElementById("no-location").classList.add("hidden");
    }

    function getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    console.log("Latitude:", latitude);
                    console.log("Longitude:", longitude);
                    // Set the map center to the current location
                    const pos = {
                        lat: latitude,
                        lng: longitude
                    }
                    map.setCenter(pos);
                    placeMarker(pos)
                },
                function (error) {
                    console.error("Error getting location:", error.message);
                }
            );
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    }

    // Load the Google Maps script
    // function loadScript() {
    //     const script = document.createElement("script");
    //     script.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyBNNa55DL19ILQw2A6_DXQzZyu8YzYPf5s&loading=async&callback=initializeMap&libraries=marker`;
    //     script.async = true;
    //     document.head.appendChild(script);
    // }

    window.addEventListener("load", initializeMap);
</script>
@endassets
