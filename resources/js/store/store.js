import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)
axios.defaults.baseURL = 'http://homeautomation.com/api/'
axios.defaults.headers.common['Accept'] = 'application/json';


export const store = new Vuex.Store({
    state: {
        devices: [],
        deviceTypes: [],
        token: localStorage.getItem('access_token') || null,
    },
    getters: {
        isLogged(state) {
            return state.token !== null
        },
        getDeviceTypes(state) {
            return state.deviceTypes
        },
        getDevices(state) {
            return state.devices
        }
    },
    mutations: {
        retrieveToken(state, token) {
            state.token = token
        },
        destroyToken(state) {
            state.token = null
        },
        retrieveDeviceTypes(state, deviceTypes) {
            state.deviceTypes = deviceTypes
        },
        retrieveDevices(state, devices) {
            state.devices = devices
        },
        addDevice(state, device) {
            state.devices.push(device)
        },
        changeDeviceState(state, id, status) {
            state.devices.find(d => d.id == id).status = status
        }
    },
    actions: {
        changeDeviceState(context, stat) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token
            
            if(context.getters.isLogged) {
                return new Promise((resolve, reject) => {
                    axios.get(`/devices/${stat.id}/status/${stat.status}`)
                    .then(response => {
                        context.commit('changeDeviceState', stat.id, stat.status)
                        resolve(response)
                    }).catch(error => {
                        console.log(error);
                        reject(error)
                    })
                })
            }
        },
        addDevice(context, device) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token

            if(context.getters.isLogged) {
                return new Promise((resolve, reject) => {
                    axios.post('/devices', device)
                    .then(response => {
                        context.commit('addDevice', response.data.device)
                        resolve(response)
                    }).catch(error => {
                        console.log(error);
                        reject(error)
                    })
                })
            }
        },
        retrieveDevices(context) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token

            if(context.getters.isLogged) {
                return new Promise((resolve, reject) => {
                    axios.get('/devices')
                    .then(response => {
                        context.commit('retrieveDevices', response.data.devices)
                        resolve(response)
                    }).catch(error => {
                        console.log(error);
                        reject(error)
                    })
                })
            }
        },
        retrieveDeviceTypes(context) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token

            if(context.getters.isLogged) {
                return new Promise((resolve, reject) => {
                    axios.get('/device-type')
                    .then(response => {
                        context.commit('retrieveDeviceTypes', response.data.deviceTypes)
                        resolve(response)
                    }).catch(error => {
                        console.log(error);
                        reject(error)
                    })
                })
            }
        },
        retrieveToken(context, credentials) { //login
            return new Promise((resolve, reject) => {
                axios.post('/user/login', {
                    email: credentials.email,
                    password: credentials.password,
                })
                .then(response => {
                    const token = response.data.access_token

                    localStorage.setItem('access_token', token)
                    context.commit('retrieveToken', token)
                    resolve(response)
                })
                .catch(error => {
                   console.log(error),
                   reject(error) 
                })
            })
        },
        destroyToken(context) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token

            if(context.getters.isLogged) {
                return new Promise((resolve, reject) => {
                    axios.get('/user/logout')
                    .then(response => {
                        localStorage.removeItem('access_token')
                        context.commit('destroyToken')
                        resolve(response)
                    })
                    .catch(error => {
                        localStorage.removeItem('access_token')
                        context.commit('destroyToken')
                        reject(error)
                    })
                })
            }
        },
        register(context, credentials) {
            return new Promise((resolve, reject) => {
                axios.post('/user/register', {
                    email: credentials.email,
                    password: credentials.password,
                })
                .then(response => {
                    const token = response.data.access_token

                    localStorage.setItem('access_token', token)
                    context.commit('retrieveToken', token)
                    resolve(response)
                })
                .catch(error => {
                   reject(error) 
                })
            })
        }
    }
})