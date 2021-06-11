<template>
    <div>        
        <category-table
            :init-categories="categories"
            filter-url="filterUrl"
            :base-url="baseUrl"
        ></category-table>

    </div>
</template>

<script>

import CategoryTable from '../category/CategoryTable.vue'

export default {
    name: 'category-test',
    components: {
        'category-table': CategoryTable
    },
    data() {
        return {
            categories: [],
            filterUrl: '/admin/category/filter',
            baseUrl: '/admin'
        }
    }
}
</script>
