import 'es6-promise/auto'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Vue from 'vue'
import VueRouter from 'vue-router'
import {store} from './store/store'

import routes from './routes'
import Index from './Index'

Vue.use(VueRouter)

const router = new VueRouter({
  routes,
  mode: 'history',
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!store.getters.isLogged) {
      next({
        name: 'login',
      })
    } else {
      next()
    }
  } else if (to.matched.some(record => record.meta.requiresVisitor)) {
    if (store.getters.isLogged) {
      next({
        name: 'home',
      })
    } else {
      next()
    }
  } else {
    next()
  }
})

new Vue({
  el: '#app',
  store,
  components: { Index },
  router
});