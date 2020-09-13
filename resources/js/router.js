import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
    { 
        // path: '/customer', 
        // component: require('../components/user/customer/CustomerTable.vue').default 
    },
]

const router = new VueRouter({
    routes
})


export default router;
