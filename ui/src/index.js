import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './components/App.vue'
import { sync } from 'vuex-router-sync'
import { routes } from './system/routes'
import store from './store/index'

Vue.use(VueRouter);

export const router = new VueRouter({
  mode: 'history',
  routes
});
Vue.component('get-data', {
  props: ['getdata'],
 });

 sync(store, router);

new Vue({
  el: '#app',
  store,
  router,
  data: {
    getData: ""
  },
  render: h => h(App)
});
