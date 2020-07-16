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
            name="file"   
            class="px-3 flex-1 w-full py-2 outline-none shadow-sm focus:shadow focus:border rounded border block border-gray-400"
            @change="handleUpload"
            :class="extraClass"
            :disabled="isDisabled"
        />
      </div>
        <input type="hidden" :name="fieldName" v-model="changeValue" />
      
      <p class="text-sm italic text-red-500" v-if="errorText">{{ errorText }}</p>
    </div>
  </div>
</template>
<script>
export default {
  name: "avored-upload",
  props: {
    labelText: { type: [String], default: "" },
    labelClass: { type: [String], default: "" },
    inputClass: { type: [String], default: "" },
    initValue: { type: [String], default: "" },
    errorText: { type: [String], default: "" },
    fieldName: { type: [String], default: "" },
    isDisabled: { type: [Boolean], default: false },
    uploadUrl: { type: [String], default: '' },
    multiple: { type: [Boolean], default: false },
  },
  data() {
    return {
      changeValue: this.initValue,
      extraClass: '',
      inputType: 'file'
    };
  },
  methods: {
    handleUpload(event) {
        var formData = new FormData()
        var app = this
        for( var i = 0; i < event.target.files.length; i++ ){
          let file = event.target.files[i];
          if (this.multiple) {
            formData.append('dropdown_options_image[' + i + ']', file);
          } else {
            formData.append('dropdown_options_image', file);
          }
        }
        axios.post(this.uploadUrl, formData, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
        }).then(({data}) => {
          // console.log(data.path)
          app.changeValue = data.path
        })
    }
  },
  watch: {
    changeValue(newValue) {
      this.$emit("input", newValue);
    }
  },
  mounted() {
    if (this.errorText) {
      this.extraClass += " border-red-500";
    }
  }
};
</script>
