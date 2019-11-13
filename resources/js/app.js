require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import Notifications from 'vue-notification'

export const eventBus = new Vue();

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
