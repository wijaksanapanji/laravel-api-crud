import './bootstrap'

import Vue from 'vue'
import Vuetify  from 'vuetify'

import router from './routes'
import App from './App'

Vue.use(Vuetify)

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
})

export default app