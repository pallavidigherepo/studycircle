import './bootstrap';

import { createApp } from 'vue'
import App from './components/App.vue'
import router from './router'
import store from './store'
import globalComponents from './global_components.js'

const app = createApp(App)
    .use(store)
    .use(router);

globalComponents(app);

app.mount('#app');