<template>
  <Transition name="fade">
		<div class="rounded-md flex items-center alert-wrap p-4 absolute right-0 mr-6 mb-6 bottom-0" :class="extraClass" v-if="isAlertVisible">
      <div class="flex items-center">
        <!-- <div class="">
          <zondicon icon="checkmark"  class="fill-current h-4 w-4"  :class="textClass"></zondicon>
        </div> -->
        <div class="ml-3 flex items-center">
          <p class="text-sm mr-5" :class="textClass">
            {{ message }}
          </p>
          <p class="text-sm" @click="isAlertVisible=false"> 
            <zondicon icon="close-outline"  class="fill-current h-4 w-4"  :class="textClass"></zondicon>
          </p>
        </div>
      </div>
    </div>
	</Transition>
</template>
<script>

export default {
  name: "avored-alert",
  props: {
  
  },
  data() {
    return {
        isAlertVisible: false,
        message: '',
        extraClass: '',
        textClass: 'text-green-400'
    };
  },
  methods: {
      close() {
        this.isAlertVisible = false
        this.$emit('close')
      },
      open(params) {
        this.isAlertVisible = true
        if (typeof params === 'object') {
          //@todo implement different types of alert
        } else {
          this.message = params
          this.extraClass = 'bg-green-100'
        }
      }
  },

  mounted() {
    EventBus.$on('open', this.open)
    setTimeout(() => {
        this.isAlertVisible = false
    }, 5000)
  }
};
</script>
<style scoped>
  .alert-wrap {
      right: 20px;
  }
</style>>
