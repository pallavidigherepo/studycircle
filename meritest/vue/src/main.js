import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import globalComponents from './global_components.js';

import "./libs";
import "./assets/app.css";

const app = createApp(App)
.use(router)

globalComponents(app);
app.mount('#app')
