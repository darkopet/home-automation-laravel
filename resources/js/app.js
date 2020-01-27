import 'es6-promise/auto'
import './bootstrap'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Vue from 'vue'
import VueRouter from 'vue-router'
import VueAuth from '@websanova/vue-auth'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

import auth from './auth'
import router from './router'

import Index from './Index'

Vue.use(BootstrapVue, IconsPlugin)

//Vue.http.options.root = 'http://127.0.0.1/api'

window.Vue = Vue
Vue.router = router

Vue.use(VueRouter)

axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api/`
Vue.use(VueAxios, axios)
Vue.use(VueAuth, auth)

axios.defaults.headers.common['Accept'] = 'application/json'

const app = new Vue({
  el: '#app',
  components: { Index },
  router
});