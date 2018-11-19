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

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!store.state.user.isAuth) {
      next({
        path: '/'
      })
    } else {
      next()
    }
  } else if (to.matched.some(record => record.meta.notAuth)) {
    if (store.state.user.isAuth) {
      next({
        path: '/workpage'
      })
    } else {
      next()
    }
  } else {
    next()
  }
})

 sync(store, router);

new Vue({
  el: '#app',
  store,
  router,
  render: h => h(App)
});
