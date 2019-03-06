<template>
    <div class="d-table w-100">
        <div class="d-flex text-white bg-dark flex-row ">
            <div 
                class="flex-shrink-1 font-weight-bold align-self-start pt-3 pr-3 pb-3 pl-3"
                v-for="column in columnsData" :key="column.key">
                {{ column.key }}
            </div>
        </div>
        <div  class="d-flex flex-row" v-for="item in items" :key="item.id">
            <div 
                class="flex-shrink-1 align-self-start pt-2 pr-3 pb-2 pl-3"
                v-for="col in columnsData" :key="col.key">
                {{ item[col.key] }}
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['columns', 'data'],
    data() {
        return {
            items: [],
            columnsData: [],
        }
    },
    methods: {
    },
    created() {
        this.items = JSON.parse(this.data);
        this.columnsData = JSON.parse(this.columns);
    }
}
</script>
