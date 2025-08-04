@props([
    'variable',
])

<div x-data="inputList('{{$variable}}')">
    <div class="flex gap-2">
        <input class="input flex-1" type="text" x-model="inputValue">
        <button class="btn" type="button" x-on:click="addValue()">Add</button>
    </div>


    <div class="flex flex-wrap gap-1 mt-2">
        <template x-for="(item, index) in inputList">
            <span class="badge p-3">
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

{{--    <pre x-text="$wire.{{$variable}}"></pre>--}}
</div>


<script>
    function inputList(variable) {
        return {
            inputList: [],
            inputValue: '',


            init() {
                this.$watch('inputList', (newValue) => {
                    this.$wire[variable] = newValue;
                })

                this.inputList = this.$wire[variable] || [];
            },

            addValue() {
                if (this.inputValue.trim() !== '') {
                    this.inputList.push(this.inputValue.trim());
                    this.inputValue = '';
                }
            },

            removeValue(index) {
                this.inputList.splice(index, 1);
            }
        }
    }
</script>
