import VueRouter from 'vue-router';
import Home from './components/Home'
import Login from './components/Login'
import Register from './components/Register'

const router = new VueRouter({
mode: 'history',
routes: [
        {
            path: '/home',
            name: 'home',
            component: Home,
            meta: {
                auth: true
            }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                auth: false
            }
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: {
                auth: false
            }
        }
    ]
});

export default router