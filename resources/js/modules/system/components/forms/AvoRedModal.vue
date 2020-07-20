<template>
  <Transition name="fade">
		<div
			v-if="isModalVisible"
			class="fixed inset-0 w-full h-screen flex items-center justify-center bg-modal-700"
		>
			<div
				class="max-h-screen w-full max-w-2xl bg-white shadow-lg rounded-lg"
			>
        <div class="flex items-center border-b p-3">
          <div class="text-red-500 font-semibold">{{ modalTitle }}</div>

            <button
              v-if="displayClose"
              aria-label="close"
              class="text-xl text-gray-500 ml-auto"
              type="button"
              @click="close"
            >
              ×
            </button>
        </div>
      
				<div class="overflow-auto p-5 block max-h-screen w-full">
					{{ confirmMessage }}
				</div>
			</div>
		</div>
	</Transition>
</template>
<script>

export default {
  name: "avored-modal",
  
  props: {
    isVisible: {
      type: [Boolean],
      default: true
    },
    modalTitle: {
      type: [String],
      default: ''
    },
    confirmMessage: {
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
        isModalVisible: false
    };
  },
  methods: {
      close() {
        this.isModalVisible = false
        this.$emit('close')
      }
  },
  watch: { 
      isVisible: function(newVal, oldVal) { // watch it
          this.isModalVisible = newVal
      }
  },
  mounted() {
    this.isModalVisible = this.isVisible 
  }
};
</script>
<style>
	.fade-enter-active,
	.fade-leave-active {
		transition: all 0.6s;
	}
	.fade-enter,
	.fade-leave-to {
		opacity: 0;
	}
</style>
