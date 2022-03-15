import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import globalComponents from './global_components.js'

import "./assets/app.css";
//import "./assets/app.js";

const app = createApp(App)
.use(router)

globalComponents(app);
app.mount('#app')
