<template>
    <div>
        <div class="flex">
            <div class="w-1/2 border p-3">
                <div>
                    <div v-if="!selectedComponent" class="find-component">
                        <div class="search-box">
                            Search Input
                        </div>
                        <div class="mt-5 components-list">
                            <div @click="clickOnComponent(1)" 
                                v-for="(acomponent, index) in avoredComponents" 
                                :key="index" class="mt-3">
                                <component :is="acomponent"></component>
                                <div>
                                    <div class="mt-4">
                                        <button class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">
                                            Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="selectedComponent" class="selected-component">
                        <div class="slected-component-preview">
                            Selected Compoennt Preview
                        </div>
                        <div class="mt-5 selected-component-options">
                            Selected Component Options
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/2 border p-3 ml-3">
                RIGHT SIDE
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'content-builder',
    props: {
        avoredComponents: {
            type: [Object, Array],
            default: () => {}
        }
    },
    data() {
        return {
            selectedComponent: false
        }
    },
    methods: {
        clickOnComponent(component) {
            this.selectedComponent = true
            console.log(component)
        }
    }
}
</script>
