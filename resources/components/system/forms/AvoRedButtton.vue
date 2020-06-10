<template>
  <div>
      <a  v-if="htmlType==='link'"
          :href="linkUrl"
          class="px-4 py-2 font-semibold leading-7 rounded"
          :class="buttonClass">
          <svg class="w-5 h-5 inline-block" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/>
          </svg>
          {{ buttonText }}
      </a>
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
  },
  data() {
    return {
      
    };
  },
  
  computed: {
      buttonClass() {
        if (this.type === 'primary') {
          return 'bg-red-600 hover:bg-red-700 text-white hover:text-white'
        }

        return 'border border-gray-700 text-gray-600'
        
      }
  },
  mounted() {
    
  }
};
</script>
