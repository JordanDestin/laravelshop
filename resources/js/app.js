import './bootstrap';

import { createApp } from 'vue';
import '../css/app.css';
import router from './router';
import App from './layout/App.vue';
import Toaster from '@meforma/vue-toaster';
import  {TailwindPagination}  from 'laravel-vue-pagination';


const app = createApp(App);

//app.config.compilerOptions.isCustomElement = (tag) => tag.includes('TailwindPagination')
app.use(Toaster).provide('toast',app.config.globalProperties.$toast);
app.use(router)
app.mount('#app')