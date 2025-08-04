@php

    $options = ['hello', 'world', 'foo', 'bar', 'hi', 'hello world', 'hello foo', 'hello bar', 'foo bar', 'bar foo'];
    $legend = 'Skills';
    $label = 'You can edit page title later on from settings'

@endphp

<div x-data="combobox()">
    <legend class="fieldset-legend">{{ $legend }}</legend>
    <fieldset class="fieldset">
        <div
            class="relative flex gap-1 border-b-2 pb-4 border-neutral-300 hover:border-neutral-900 hover:focus-within:border-primary focus-within:border-primary transition-all">
            <template x-for="(option, index) in selectedOptions" :key="index">
                <div class="bg-neutral-200 pl-3 pr-2 py-1.5 rounded-full flex gap-2 items-center">
                    <span x-text="option" class="text-nowrap"></span>
                    <div class="bg-neutral-400 rounded-full p-0.5 hover:bg-neutral-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="size-4 text-white">
                            <path d="M18 6 6 18"/>
                            <path d="m6 6 12 12"/>
                        </svg>
                    </div>
                </div>
            </template>
            <input
                x-model="inputValue"
                type="text"
                class="focus:outline-0 w-full"
                placeholder="type to add..."
                x-on:focusin="shouldShowList = true"
                x-on:focusout="shouldShowList = false"
            >

            <template x-if="shouldShowList">
                <div class="absolute top-full mt-1 bg-white shadow-sm py-2 rounded-md w-full">
                    <template x-for="option in getOptions">
                        <div class="bg-red hover:bg-neutral-100 cursor-pointer p-2" x-on:click="addOption(option)">
                            <span x-text="option"></span>
                        </div>
                    </template>
                </div>
            </template>
        </div>
        <p class="label">{{ $label }}</p>
    </fieldset>
</div>


<script>
    function combobox() {
        return {
            options: @json($options),
            legend: @json($legend),
            label: @json($label),
            selectedOptions: ['hi'],
            inputValue: '',
            shouldShowList: false,

            get getOptions() {
                return this.options.filter(option => !this.selectedOptions.includes(option) && option.toLowerCase().includes(this.inputValue.toLowerCase()));
            },

            addOption(option) {
                this.selectedOptions.push(option);
                this.inputValue = '';
            },

            removeOption(index) {
                this.selectedOptions.splice(index, 1);
            }
        }
    }
</script>

