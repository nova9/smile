@props([
    'variable',
    'suggestions'
])

<div x-data="inputList('{{$variable}}', {{json_encode($suggestions)}})" class="w-full">
    <div class="flex gap-2">
        <div class="relative flex-1" @click="showSuggestions = true" @click.outside="showSuggestions = false">
            <input class="input w-full focus:outline-0" type="text" x-model="inputValue">
            <template x-if="showSuggestions">
                <div class="absolute z-40 bg-white w-full p-2 shadow-sm rounded-sm max-h-[200px] overflow-scroll">
                    <template x-for="item in suggestions">
                        <div class="rounded-sm w-full p-2 hover:bg-accent hover:cursor-pointer hover:text-white transition-all" @click="addValue(item)">
                            <p x-text="item"></p>
                        </div>
                    </template>
                    <template x-if="suggestions.length === 0">
                        <div class="text-neutral-600">
                            No suggestions
                        </div>
                    </template>
                </div>
            </template>
        </div>
        <button class="btn" type="button" x-on:click="addValue(inputValue)">Add</button>
    </div>

    <div class="flex flex-wrap gap-1 mt-2">
        <template x-for="(item, index) in inputList">
            <span class="badge p-3 text-sm">
                <span x-text="item"></span>
                 <span class="hover:cursor-pointer" type="button" x-on:click="removeValue(index)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="size-4">
                        <path d="M18 6 6 18"/>
                        <path d="m6 6 12 12"/>
                    </svg>
                </span>
            </span>
        </template>
    </div>
</div>


<script>
    function inputList(variable, suggestions) {
        return {
            inputList: [],
            inputValue: '',
            initialSuggestions: suggestions,
            suggestions: suggestions,
            showSuggestions: false,


            init() {
                this.$watch('inputList', (newValue) => {
                    this.$wire[variable] = newValue;
                })

                this.$watch('inputValue', (newValue) => {
                    if (newValue.trim() === '') {
                        this.suggestions = this.initialSuggestions;
                    } else {
                        this.suggestions = this.initialSuggestions.filter(item => item.toLowerCase().includes(newValue.toLowerCase()) && !this.inputList.includes(item));
                    }
                })

                this.inputList = this.$wire[variable] || [];
            },

            addValue(value) {
                if (value !== '') {
                    this.inputList.push(value.trim());
                    this.inputValue = '';
                    this.$nextTick(() => {
                        this.showSuggestions = false
                    });
                }
            },

            removeValue(index) {
                this.inputList.splice(index, 1);
            }
        }
    }
</script>
