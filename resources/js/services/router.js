import Vue from 'vue'
import VueRouter from 'vue-router'

import Admin from '../modules/system/pages/admin.vue'
import ProductCreate from '../modules/catalog/product/ProductCreate.vue'

import CategoryTable from '../modules/catalog/category/CategoryTable.vue'

Vue.use(VueRouter)

let router =  new VueRouter({
	mode: 'history',
	routes: [
        {
            path: '/admin',
            component: Admin,
            children: [
                {
                    path: 'category',
                    component: CategoryTable,
                    meta: {
                        title: "Category List"
                    }
                },
                {
                    path: 'product/create',
                    component: ProductCreate,
                    meta: {
                        title: "Product Create"
                    }
                },
            ]
        },
    ]
})

export default router;
