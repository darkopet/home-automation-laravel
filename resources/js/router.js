import VueRouter from 'vue-router';
import Home from './components/Home';
import Login from './components/Login';
import Register from './components/Register';
import AddDevice from './components/AddDevice';

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
        },
        {
            path: '/add-device',
            name: 'add-device',
            component: AddDevice,
            meta: {
                auth: true
            }
        }
    ]
});

export default router