import Vue from 'vue'
import VueRouter from 'vue-router'

import CategoryTable from '../../components/catalog/category/CategoryTable.vue'

Vue.use(VueRouter)

let router =  new VueRouter({
	mode: 'history',
	routes: [
        {
            path: '/admin/category',
            component: CategoryTable,
            meta: {
                title: "Category List"
            }
        },
    ]
})

export default router;
