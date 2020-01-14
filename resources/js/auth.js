import bearer from '@websanova/vue-auth/drivers/auth/bearer'
import axios from '@websanova/vue-auth/drivers/http/axios.1.x'
import router from '@websanova/vue-auth/drivers/router/vue-router.2.x'
// Auth base configuration some of this options
// can be override in method calls
const config = {
  auth: bearer,
  http: axios,
  router: router,
  tokenDefaultName: 'token',
  tokenStore: ['localStorage'],
  rolesVar: 'isAdmin',
  registerData: {url: 'user/register', method: 'POST', redirect: '/login'},
  loginData: {url: 'user/login', method: 'POST', redirect: '', fetchUser: true},
  logoutData: {url: 'user/logout', method: 'GET', redirect: '/', makeRequest: true},
  fetchData: {url: 'user', method: 'GET', enabled: true},
  refreshData: {url: 'user/refresh', method: 'GET', enabled: false, interval: 30}
}
export default config