import './bootstrap';
import '../css/app.css';
// import flowbite
import '@themesberg/flowbite';

import {createApp} from 'vue'
import router from "@/router/index"

import App from './App.vue'

createApp(App)
    .use(router)
    .mount('#app')
