<template>
  <Transition name="fade">
		<div
			v-if="isModalVisible"
			class="fixed inset-0 w-full h-screen flex items-center justify-center bg-modal-700"
		>
			<div class="max-h-screen w-full max-w-sm bg-white shadow-lg rounded-lg">
      	<div class="overflow-auto p-5 block max-h-screen w-full">
					{{ confirmMessage }}
				</div>
        <div class="flex items-center justify-end border-t p-3">
          <div class="text-red-500 font-semibold">{{ modalTitle }}</div>
 
            <button @click="confirmBtnClick" type="button" class="px-4 py-2 text-white hover:text-white bg-red-600 rounded hover:bg-red-700">
                {{ confirmBtnText }}
            </button>

            <button v-if="displayClose" @click="close" type="button" class="ml-3 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                {{ cancelBtnText }}
            </button>
        </div>
			</div>
		</div>
	</Transition>
</template>
<script>

export default {
  name: "avored-confirm",
  
  props: {
   
    modalTitle: {
      type: [String],
      default: ''
    },
    displayClose: {
      type: [Boolean],
      default: true
    }
  },
  data() {
    return {
        isModalVisible: false,
        confirmMessage: '',
        confirmBtnText: 'Yes',
        cancelBtnText: 'No',
        callback: null,
    };
  },
  methods: {
      close() {
        this.isModalVisible = false
        this.$emit('close')
      },
      confirmBtnClick() {
          this.isModalVisible = false
          if (typeof this.callBack == 'function') {
            this.callback(this)
          }
      },
      open(params) {
        this.isModalVisible = true
        console.log(params)
        if (typeof params === 'object') {
          //@todo implement different types of confirm
          this.confirmMessage = params.message
          this.callback = params.callback
        } else {
          this.confirmMessage = params
        }
      }
  },
  mounted() {
    EventBus.$on('confirmOpen', this.open)
  }
};
</script>
