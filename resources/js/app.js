/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import Vue from 'vue'
import Notifications from 'vue-notification'

import 'font-awesome/css/font-awesome.min.css'
import VueNumber from 'vue-number-animation'

export const eventBus = new Vue();

Vue.use(VueNumber)
Vue.use(Notifications);

//component areas
Vue.component('area-create-component', require('./components/areas/area-create.vue').default);
Vue.component('area-show-component', require('./components/areas/area-show.vue').default);
Vue.component('area-edit-component', require('./components/areas/area-edit.vue').default);
//component warehouses
Vue.component('warehouse-create-component', require('./components/warehouses/create.vue').default);
Vue.component('warehouse-show-component', require('./components/warehouses/show.vue').default);
Vue.component('warehouse-edit-component', require('./components/warehouses/edit.vue').default);
//component zones
Vue.component('zone-create-component', require('./components/zones/zone-create.vue').default);
Vue.component('zone-show-component', require('./components/zones/zone-show.vue').default);
Vue.component('zone-edit-component', require('./components/zones/zone-edit.vue').default);
//calculation unit
//Vue.component('calculation-create-component', require('./components/calculationUnit/calculation-create.vue').default);
// Vue.component('calculation-edit-component', require('./components/calculationUnit/calculation-edit.vue').default);

//item-group
Vue.component('item-create-component', require('./components/itemGroup/item-create.vue').default);
Vue.component('item-show-component', require('./components/itemGroup/item-show.vue').default);
Vue.component('item-edit-component', require('./components/itemGroup/item-edit.vue').default);
// manufacturer
Vue.component('manu-create-component', require('./components/manufacturers/manu-create.vue').default);
Vue.component('manu-edit-component', require('./components/manufacturers/manu-edit.vue').default);
Vue.component('manu-show-component', require('./components/manufacturers/manu-show.vue').default);
//quality
Vue.component('quality-create-component', require('./components/quality/quality-create.vue').default);
//calculation
Vue.component('calculation-create-component', require('./components/calculationUnit/calculation-create.vue').default);
//users
Vue.component('user-create-component', require('./components/users/user-create.vue').default);
Vue.component('user-show-component', require('./components/users/user-show.vue').default);
Vue.component('user-edit-component', require('./components/users/user-edit.vue').default);
Vue.component('user-profile-component', require('./components/users/user-profile.vue').default);
//daboard
Vue.component('index-component', require('./components/index.vue').default);
//Product
Vue.component('create-product-component', require('./components/product/create-product.vue').default);
Vue.component('product-show-component', require('./components/product/product-show.vue').default);
Vue.component('product-edit-component', require('./components/product/product-edit.vue').default);
//Input warehouse
Vue.component('input-create-component', require('./components/inputWarehouse/input-warehouse-create.vue').default);
Vue.component('input-purchase-component', require('./components/inputWarehouse/input-warehouse-purchase.vue').default);
Vue.component('input-show-component', require('./components/inputWarehouse/input-ware-show.vue').default);
Vue.component('input-edit-component', require('./components/inputWarehouse/input-ware-edit.vue').default);

//Output Warehouse
Vue.component('output-create-component', require('./components/outputWare/output-warehouse-create.vue').default);
Vue.component('output-checklist-component', require('./components/outputWare/output-checklist.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    methods: {
      notificationMessage(message,type) {
        this.$notify({
          group: "notifi",
          type: type,
          text: message,
          duration: 6000
        });
      },
    },
    mounted() {
        console.log('app mounted');
        if (localStorage.getItem('success')) {
            this.notificationMessage(localStorage.getItem('success'),'success');
            localStorage.removeItem('success');
        }

        if (localStorage.getItem('error')) {
            this.notificationMessage(localStorage.getItem('error'),'error');
            localStorage.removeItem('error');
        }
    }
});
