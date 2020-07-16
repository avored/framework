<template>
    <div class="w-full">
        <slot>
             <div class="relative block w-full mb-6" 
                v-click-outside="()=>{dropdownToggle=false}">
                
                
                <label
                    v-if="labelText"
                    class="text-sm w-full text-gray-600"
                    :class="labelClass"
                >{{ labelText }}</label>
                <div class="flex w-full items-center">
                    <button
                        type="button"
                        :tabindex="disabled ? -1 : 0"
                        @click="disabled ? '' : dropdownToggle=!dropdownToggle"
                        class="border flex items-center w-full border-gray-400 py-2 px-4 rounded"
                        :class="disabled ? 'bg-gray-300 cursor-not-allowed' : ''"
                    >
                    
                        <span class="flex-1 text-left" >
                            <span class="inline-flex" v-for="(displayText, index) in displayTexts" :key="index">
                                <template v-if="multiple">
                                    <span v-if="displayText" class="bg-gray-200 flex mr-2 items-center rounded px-2 p-1">
                                        <span>{{ displayText }}</span>
                                        <button @click.stop="deleteMultiple(index)" type="button" class="ml-1 text-xs">x</button>
                                    </span>
                                </template>
                                <span v-else>{{ displayText }}</span>
                            </span>
                        </span>
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
                        class="dropdown-options w-full mt-1 z-10 bg-white border border-gray-500 absolute overflow-y-scroll rounded shadow text-gray-700">
                        
                        <template v-for="(optionLabel, optionValue) in options">
                            <li :key="optionValue" :value="optionValue"
                                class="px-2 py-1 hover:bg-gray-300 cursor-pointer">
                                {{ optionLabel }}
                            </li>
                        </template>
                    </ul>
                </div>
                <div v-if="errorText" class="text-sm ml-1 text-red-500 absolute">
                    {{ errorText }}
                </div>
                <span v-for="(val, index) in changeValue" :key="index">
                    <input type="hidden" :name="fieldName" :value="val" />
                </span>
                
             </div>
        </slot>
    </div>
</template>
<script>
import vClickOutside from "v-click-outside"
import includes from 'lodash/includes'
import findKey from 'lodash/findKey'
import remove from 'lodash/remove'

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
        initValue: { type: [String, Array], default: "" },
        options: {type: [Array, Object], default: () =>[]},
        errorText: { type: [String], default: ''},
        fieldName: { type: [String], default: ''},
        disabled: { type: [Boolean], default: false},
        multiple: { type: [Boolean], default: false}
    },
    data() {
        return {
            changeValue: [],
            displayTexts: [],
            dropdownToggle: false
        };
    },
    methods: {
        selectedOption(event) {
            const val = event.target.getAttribute('value')
            var findVal = false
            if (this.multiple) {
                if (!includes(this.changeValue, val)) {
                    findVal = true
                    this.changeValue.push(val)
                }
            } else {
                findVal = true
                this.changeValue = []
                this.displayTexts = []
                this.changeValue.push(val)
            }

            if (findVal) {
                this.displayTexts.push(this.options[val])
            }
            this.dropdownToggle = !this.dropdownToggle
        },
        deleteMultiple(index) {
            const currentDisplayText = this.displayTexts[index]

            const optionValue = findKey(this.options, function (ele) {
                return ele == currentDisplayText
            })
             const changeValueIndex = findKey(this.changeValue, function (ele) {
                return ele == optionValue
            })
            this.changeValue.splice(changeValueIndex, 1)
            this.displayTexts.splice(index, 1)

        }
    },
    watch: {
        changeValue(newValue) {
            this.$emit("input", newValue);
        }
    },
    mounted() {
        if (this.initValue.length > 0 && this.multiple) {
            this.initValue.forEach((ele) => {
                this.displayTexts.push(this.options[ele])
                this.changeValue.push(ele)
            })
        } else {
            this.displayTexts.push(this.options[this.initValue])
            this.changeValue.push(this.initValue)
        }
    }
};
</script>
<style scoped>
.dropdown-options {
    max-height: 9rem;
}
</style>
