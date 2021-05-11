<template>
  <div class="w-full">
    <label :for="fieldName"
        v-if="labelText"
        class="block text-sm leading-5 text-gray-500">
           {{ labelText }}
    </label>
    <div class="mt-1">
      <div class="relative flex items-center">
        <div class="absolute inset-y-0 left-0 pl-3 pointer-events-none">
            <slot name="addOnBefore" />
        </div>
        <input
            :id="fieldName"
            :type="inputType"
            :name="fieldName"   
            :placeholder="placeholder"
            :step="isNumberType ? numberSteps : 1"
            @change="fieldInputChange"
            class="px-3 flex-1 w-full py-2 outline-none shadow-sm focus:shadow focus:border rounded border block border-gray-400"
            :class="extraClass"
            :disabled="isDisabled"
            v-model="changeValue"
        />
        <slot name="addOnAfter" />
      </div>
      
      <p class="text-sm italic text-red-500" v-if="errorText">{{ errorText }}</p>
    </div>
  </div>
</template>

<script>
export default {
  name: "avored-input",
  props: {
    labelText: { type: [String], default: "" },
    labelClass: { type: [String], default: "" },
    inputClass: { type: [String], default: "" },
    inputType: { type: [String], default: "text" },
    initValue: { type: [String], default: "" },
    errorText: { type: [String], default: "" },
    fieldName: { type: [String], default: "" },
    isDisabled: { type: [Boolean], default: false },
    numberSteps: { type: [Number, String], default: 1 },
    placeholder: { type: [Number, String], default: '' },
  },
  data() {
    return {
      changeValue: this.initValue,
      extraClass: '',
      isNumberType: false,
    };
  },
  watch: {
    changeValue(newValue) {
      this.$emit("input", newValue);
    }
  },
  methods: {
    fieldInputChange(e) {
      this.$emit("change", e)
    }
  },
  mounted() {
    if (this.errorText) {
      this.extraClass += " border-red-500";
    }
    if (this.inputType === 'number') {
      this.isNumberType = true
    }
  }
};
</script>
