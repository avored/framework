<template>
  <div>
      <div v-if="filerable" class="flex items-center">
          <div class="ml-auto">
              <div class="mb-2 relative flex sm:flex-row flex-col">
                    <div class="block relative">
                        <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                <path
                                    d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                </path>
                            </svg>
                        </span>
                        <input placeholder="Search"
                            @change.prevent="filterTextChange"
                            @keydown.enter.prevent='filterTextChange'
                            class="appearance-none rounded-l border-2 border-gray-400 block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                    </div>
                    <div class="flex flex-row mb-1 sm:mb-0">
                        <button @click="filterBtnClick" type="button" 
                            class="px-2 border-none rounded-r active:outline-none flex py-2 bg-gray-400">
                            <svg class="h-6 pt-1 w-6 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path d="M12 12l8-8V0H0v4l8 8v8l4-4v-4z"  fill-rule="evenodd"/>
                            </svg>
                            <span class="ml-1 text-gray-700">Filter</span>
                        </button>
                    </div>
                    <div v-if="filterClicked" class="absolute z-10 right-0" style="top:100%">
                        <div class="border-3 rounded-md text-white p-3 w-64 bg-gray-500 border-gray-800" style="top:100%">
                            <ul>
                                <li 
                                  v-for="(column, index) in localColumns" 
                                  class="z-50 py-2"
                                  :key="`col-checkbox-${index}`">
                                    <input type="checkbox"
                                        :id="`checkbox-column-${index}`" 
                                        @click="toggleColumnVisibility(index)" 
                                        :checked="column.hasOwnProperty('visible') ? column.visible : false" />
                                    <label :for="`checkbox-columns-${index}`" 
                                      class="ml-3 text-xs">
                                        {{ column.label }}
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
              </div>
          </div> 
      </div>
      <table class="mt-3 w-full">
          <thead class="bg-gray-700 text-white">
            <tr>
                <template v-for="(column, index) in localColumns">
                    <th
                      v-if="column.hasOwnProperty('visible') ? column.visible : 'true'"
                      :key="index"
                      class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase"
                    >{{ column.label }}</th>
                </template>
            </tr>
          </thead>
          <tbody class="bg-white">
              <tr v-for="(item, index) in items" :key="index">
                  <template v-for="(column, index) in localColumns">
                      <td
                        v-if="column.hasOwnProperty('visible') ? column.visible : 'true'"
                        :key="index"
                        class="px-6 py-4 text-sm leading-5 border-b border-gray-200"
                      >
                        <slot :name="column.slotName" :item="item">{{ item[column.fieldKey] }}</slot>
                      </td>

                  </template>
              </tr>
          </tbody>
      </table>
      <nav class="bg-white px-4 py-3 z-1 flex items-center justify-between border-t border-gray-200 sm:px-6">
          <div class="hidden sm:block">
            <p class="text-sm leading-5 text-gray-700">
              Showing
              <span class="font-medium">{{ from }}</span>
              to
              <span class="font-medium">{{ to }}</span>
              of
              <span class="font-medium">{{ total }}</span>
              results
            </p>
          </div>
          <div class="flex-1 flex justify-between sm:justify-end">
            <button
              type="button"
              @click="prevButtonOnClick"
              :disabled="!prev_page_url"
              class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm rounded-md text-gray-700 bg-white hover:text-gray-500"
              :class="!prev_page_url ? 'opacity-50' : ''"
            >Previous</button>
            <button
              type="button"
              @click="nextButtonOnClick"
              :disabled="!next_page_url"
              class="ml-3 relative inline-flex items-center  px-4 py-2 border border-gray-300 text-sm rounded-md text-gray-700 bg-white hover:text-gray-500"
              :class="!next_page_url ? 'opacity-50' : ''"
            >Next</button>
          </div>
      </nav>
  </div>
</template>

<script>
export default {
  name: "avored-table",
  props: {
      columns: {
        type: [Array],
        default: () => {
          [];
        }
      },
      items: {
        type: [Array],
        default: () => {
          [];
        }
      },
      from: { type: Number, default: 0 },
      filerable: { type: Boolean, default: false },
      to: { type: Number, default: 0 },
      total: { type: Number, default: 0 },
      prev_page_url: { type: String, default: '' },
      next_page_url: { type: String, default: '' },
      per_page: { type: Number, default: 0 }
  },
  data() {
    return {
        filterClicked: false,
        localColumns: this.columns
    }
  },
  methods: {
    filterBtnClick() {
        this.filterClicked = !this.filterClicked
    },
    toggleColumnVisibility(index) {
        this.localColumns[index]['visible'] = !this.localColumns[index]['visible']
    },
    nextButtonOnClick() {
      location = this.next_page_url
    },
    prevButtonOnClick() {
      location = this.prev_page_url
    },
    filterTextChange(e) {
      this.$emit('changeFilter', e)
    }
  },
  watch: {
    columns: function (newColumns) {
      this.localColumns = newColumns
    }
  },
};
</script>
