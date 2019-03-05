<template>
    <table class="table">
        <tr>
            <th v-for="column in columnsData" :key="column.key">
                {{ column.key }}
            </th>
        </tr>
        <tr v-for="category in categoryData" :key="category.id">
            <td>{{ category.id }}</td>
            <td>{{ category.name }}</td>
        </tr>
    </table>
</template>

<script>

export default {
    props: ['columns', 'data'],
    data() {
        return {
            categoryData: [],
            columnsData: [],
        }
    },
    methods: {
    },
    created() {
        this.categoryData = JSON.parse(this.data);
        this.columnsData = JSON.parse(this.columns);
    }
}
</script>
