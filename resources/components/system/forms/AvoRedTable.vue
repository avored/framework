<template>
  <div>
    <table class="w-full">
      <thead class="bg-gray-700 text-white">
        <tr>
          <th
            v-for="(column, index) in columns"
            :key="index"
            class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase"
          >{{ column.label }}</th>
        </tr>
      </thead>
      <tbody class="bg-white">
        <tr v-for="(item, index) in items" :key="index">
          <td
            v-for="(column, index) in columns"
            :key="index"
            class="px-6 py-4 text-sm leading-5 border-b border-gray-200"
          >
            <slot :name="column.slotName" :item="item">{{ item[column.fieldKey] }}</slot>
          </td>
        </tr>
      </tbody>
    </table>
    <nav
      class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
    >
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
          class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700"
          :class="!prev_page_url ? 'opacity-50' : ''"
        >Previous</button>
        <button
          type="button"
          @click="nextButtonOnClick"
          :disabled="!next_page_url"
          class="ml-3 relative inline-flex items-center  px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700"
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
    to: { type: Number, default: 0 },
    total: { type: Number, default: 0 },
    prev_page_url: { type: String, default: '' },
    next_page_url: { type: String, default: '' },
    per_page: { type: Number, default: 0 }
  },
  data() {
    return {};
  },
  methods: {
    nextButtonOnClick() {
      location = this.next_page_url
      // this.$emit('next')
    },
    prevButtonOnClick() {
      location = this.prev_page_url
      // this.$emit('prev')
    }
  },
  mounted() {}
};
</script>
