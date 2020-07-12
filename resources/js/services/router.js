import Vue from 'vue'
import VueRouter from 'vue-router'

import CategorySave from '../../components/catalog/category/Test.vue'

Vue.use(VueRouter)

let router =  new VueRouter({
	mode: 'history',
	routes: [
        {
            path: '/admin/category-test',
            component: CategorySave,
        },
    ]
})

export default router;
