import './bootstrap';

import { createApp } from 'vue';
import '../css/app.css';
import router from './router';
import App from './layout/App.vue';

const app = createApp(App);


app.use(router)
app.mount('#app')