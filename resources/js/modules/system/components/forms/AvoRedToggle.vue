<template>
    <div class="relative w-full mb-6">
        <label 
            :for="fieldName"
            v-if="labelText"
            class="text-sm pb-2 w-full text-gray-600" :class="labelClass">
            {{ labelText }}
        </label>
        
        <div @click="toggleChange" class="w-full flex items-center mt-2">
            <span role="checkbox" tabindex="0" aria-checked="false" 
                class="relative inline-block flex-shrink-0 h-4 w-12 
                    rounded-full border-2 cursor-pointer transition-colors ease-in-out duration-200 
                    outline-none"
                :class="toggleBgClass">
                <!-- On: "translate-x-5", Off: "translate-x-0" -->
                <span class="translate-x-0 inline-block -mt-1 h-6 w-6 rounded-full bg-white shadow transform transition ease-in-out duration-200"
                    :class="toggleTransitionClass">

                </span>
            </span>
        </div>
        <input type="hidden" :name="fieldName" v-model="changeValue" />
        <div v-if="errorText" class="text-sm ml-1 text-red-500 absolute">
            {{ errorText }}
        </div>
        

    </div>
</template>
<script>
export default {
    name: 'avored-toggle',
    props: {
        labelText: { type: [String], default: ''},
        labelClass: { type: [String], default: ''},
        inputClass: { type: [String], default: ''},
        initValue: { type: [String], default: ''},
        errorText: { type: [String], default: ''},
        fieldName: { type: [String], default: ''},
        toggleOnValue: { type: [String, Number], default: 1},
        toggleOffValue: { type: [String, Number], default: 0},
    },
    data() {
        return {
            changeValue: this.initValue,
            toggle: false,
            toggleTransitionClass: 'translate-x-0',
            toggleBgClass: 'bg-gray-200'
        }
    },
    methods: {
        toggleChange() {
            if (this.toggle) {
                this.toggle = false
                this.changeValue = this.toggleOffValue
                this.toggleBgClass = 'bg-gray-200'
                this.toggleTransitionClass = 'translate-x-0'
            } else if (!this.toggle) {
                this.toggle = true
                this.changeValue = this.toggleOnValue
                this.toggleBgClass = 'bg-red-600'
                this.toggleTransitionClass = 'translate-x-6'
            }
        }
    },
    watch: {
        changeValue(newValue) {
            this.$emit('input', newValue)
        }
    },
    mounted() {
        if (this.errorText) {
            this.inputClass += ' border-red-500'
        }
        if (this.toggleOnValue == this.initValue) {
            this.toggle = true
            this.changeValue = this.toggleOnValue
            this.toggleBgClass = 'bg-red-600'
            this.toggleTransitionClass = 'translate-x-6'
        }
    }
}
</script>
