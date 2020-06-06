<template>
  <div class="w-full">
    <label :for="fieldName"
        v-if="labelText"
        class="block text-sm leading-5 text-gray-500">
           {{ labelText }}
    </label>
    <div class="mt-1 flex rounded-md shadow-sm">
      <div class="relative flex-grow focus-within:z-10">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <slot name="addOnBefore" />
        </div>
        <input
            :id="fieldName"
            :type="inputType"
            :name="fieldName"   
            class="px-3 flex-1 w-full py-2 outline-none focus:shadow focus:border rounded border block border-gray-400"
            :class="inputClass"
            v-model="changeValue"
        />
      </div>
      <slot name="addOnAfter" />
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
    fieldName: { type: [String], default: "" }
  },
  data() {
    return {
      changeValue: this.initValue
    };
  },
  watch: {
    changeValue(newValue) {
      this.$emit("input", newValue);
    }
  },
  mounted() {
    if (this.errorText) {
      this.inputClass += " border-red-500";
    }
  }
};
</script>
