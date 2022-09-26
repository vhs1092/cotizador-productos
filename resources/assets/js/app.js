
/**
 * We will load all of this project's JavaScript dependencies 
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

window.Vue.use(VueRouter);

import ProductsIndex from './components/products/ProductsIndex.vue';
import MaterialesIndex from './components/materiales/MaterialesIndex.vue';
import ProductsCreate from './components/products/ProductsCreate.vue';
import ProductsEdit from './components/products/ProductsEdit.vue';
import MaterialesCreate from './components/materiales/MaterialesCreate.vue';
import MaterialesEdit from './components/materiales/MaterialesEdit.vue';

/*Here are our routes where the index will redirect us to the products index page*/ 
const routes = [
    {
        path: '/productos',
        components: {
            productsIndex: ProductsIndex
        }
    },
    {
        path: '/materiales',
        components: {
            materialesIndex: MaterialesIndex
        }
    },
    {path: '/admin/products/create', component: ProductsCreate, name: 'createProduct'},
    {path: '/admin/products/edit/:id', component: ProductsEdit, name: 'editProduct'},
    {path: '/admin/materiales/create', component: MaterialesCreate, name: 'createMaterial'},
    {path: '/admin/materiales/edit/:id', component: MaterialesEdit, name: 'editMaterial'},
]

const router = new VueRouter({ routes })

const app = new Vue({ router }).$mount('#app')
