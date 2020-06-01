<template>
    <div class="relative w-full mb-6">
        <label 
            :for="fieldName"
            v-if="labelText"
            class="text-sm pb-2 w-full text-gray-600" :class="labelClass">
            {{ labelText }}
        </label>
        <input
            :id="fieldName"
            :type="inputType"
            :name="fieldName"
            class="px-3 w-full py-2 outline-none focus:shadow focus:border rounded border block border-gray-400"
            :class="inputClass"
            v-model="changeValue"
        />
        <div v-if="errorText" class="text-sm text-red-500 absolute">
            {{ errorText }}
        </div>

    </div>
</template>
<script>
export default {
    name: 'avored-input',
    props: {
        labelText: { type: [String], default: ''},
        labelClass: { type: [String], default: ''},
        inputClass: { type: [String], default: ''},
        inputType: { type: [String], default: 'text'},
        initValue: { type: [String], default: ''},
        errorText: { type: [String], default: ''},
        fieldName: { type: [String], default: ''}
    },
    data() {
        return {
            changeValue: this.initValue
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
    }
}
</script>
