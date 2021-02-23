// Vue App
import { createApp } from 'vue'
import App from './App.vue'
// Vue-Router
import router from './router'
// bootstrap
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'

createApp(App).use(router).mount('#app')
