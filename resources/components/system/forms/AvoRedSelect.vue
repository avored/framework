<template>
    <div class="mt-6" v-click-outside="()=>{dropdownToggle=false}">
        <label
            v-if="labelText"
            class="text-sm text-gray-600"
            :class="labelClass"
        >{{ labelText }}</label>
        <div class="relative">
            <button
                type="button"
                @click="dropdownToggle=!dropdownToggle"
                class="border border-gray-500 w-full flex text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center"
            >
                <span class="flex-1 text-left">{{ changeValue }}</span>
                <span class="ml-auto">
                    <svg
                        class="fill-current text-gray-400 h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                    >
                        <path
                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                        />
                    </svg>
                </span>
            </button>
            <ul @click="selectedOption" v-if="dropdownToggle" 
                
                class="w-full mt-1 z-10 bg-white border border-gray-500 absolute rounded shadow text-gray-700">
                
                <template v-for="(optionLabel, optionValue) in options">
                    <li :key="optionValue" :value="optionValue"
                        class="px-2 py-1 hover:bg-gray-300 cursor-pointer">
                        {{ optionLabel }}
                    </li>
                </template>
                
            </ul>
        </div>

        <input type="hidden" v-model="changeValue" />
    </div>
</template>
<script>
import vClickOutside from "v-click-outside";
export default {
    name: "avored-select",
    components: {
    
    },
    directives: {
        clickOutside: vClickOutside.directive
    },
    props: {
        labelClass: { type: [String], default: "" },
        labelText: { type: [String], default: "" },
        initValue: { type: [String], default: "" },
        onhover: { type: [Boolean], default: false },
        options: {type: [Array, Object], default: () =>[]}
    },
    data() {
        return {
            changeValue: this.initValue,
            displayText: '',
            dropdownToggle: false
        };
    },
    methods: {
        selectedOption(event) {
            this.changeValue = event.target.getAttribute('value')
            this.displayText = this.options[event.target.getAttribute('value')]
            this.dropdownToggle = !this.dropdownToggle
        }
    },
    watch: {
        changeValue(newValue) {
            this.$emit("input", newValue);
        }
    },
    mounted() {
        if (this.onhover) {
            this.dropdownToggle = true;
        }
    }
};
</script>
