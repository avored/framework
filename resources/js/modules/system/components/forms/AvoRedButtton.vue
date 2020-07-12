<template>
  <div class="flex justify-center">
      <a v-if="htmlType==='link'"
          :href="linkUrl"
          @click="$emit('click', $event)"
          class="px-4 py-2 rounded"
          :class="orverrideClass">
              <zondicon 
                v-if="iconType"
                :icon="iconType" 
                class="h-4 w-4 inline-block fill-current" />
              {{ buttonText }}
      </a>
      <button 
        v-if="htmlType==='button'" 
        @click="$emit('click', $event)" 
        class="px-4 py-2 rounded"
        :class="orverrideClass"
        type="button">
          <zondicon 
                v-if="iconType"
                :icon="iconType" 
                class="h-4 w-4 inline-block fill-current"
                 />
          {{ buttonText }}
      </button>
  </div>
</template>
<script>

export default {
  name: "avored-button",
  
  props: {
    buttonText: { type: [String], default: '' },
    htmlType: { type: [String], default: 'button' },
    type: { type: [String], default: 'default' },
    linkUrl: { type: [String], default: ''},
    iconType: { type: String, default: ''},
    buttonClass: { type: String, default: ''}
  },
  data() {
    return {
      
    };
  },
  
  computed: {
      orverrideClass() {
        if (this.type === 'primary') {
          return this.buttonClass + ' bg-red-600 text-white hover:bg-red-500 hover:text-white'
        }

        return this.buttonClass + ' border border-gray-700 text-gray-600 hover:text-red-500'
        
      }
  },
  mounted() {
    
  }
};
</script>
