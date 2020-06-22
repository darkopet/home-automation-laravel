import Home from './components/Home';
import Login from './components/Login';
import Logout from './components/Logout';
import Register from './components/Register';
import AddDevice from './components/AddDevice';


const routes = [
    {
        path: '/home',
        name: 'home',
        component: Home,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            requiresVisitor: true,
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            requiresVisitor: true,
        }
    },
    {
        path: '/add-device',
        name: 'add-device',
        component: AddDevice,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/logout',
        name: 'logout',
        component: Logout
    }
]


export default routes