import './bootstrap'
import { createApp } from 'vue'
import App from './components/App.vue'
import router from './router'
import store from './store'
import globalComponents from './global-components'
import utils from './utils'
import axios from 'axios'

import Toastify from 'toastify-js'

// SASS Theme
//import './assets/sass/app.scss'

const app = createApp(App)
  .use(store)
  .use(router)
  .use(Toastify)

globalComponents(app)
utils(app)
app.config.globalProperties.$axios = axios;

app.mount('#app')