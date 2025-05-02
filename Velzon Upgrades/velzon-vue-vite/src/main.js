import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import AOS from 'aos'
import 'aos/dist/aos.css'
import i18n from './i18n'
import pinia from './state/store'

import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'

import * as BootstrapVueNext from 'bootstrap-vue-next'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue-next/dist/bootstrap-vue-next.css'
import vClickOutside from 'click-outside-vue3'
import VueApexCharts from 'vue3-apexcharts'
// import { vMaska } from 'maska' 
import VueFeather from 'vue-feather'

// import '@/assets/scss/config/default/app.scss'
import 'leaflet/dist/leaflet.css'
import '@/assets/scss/mermaid.min.css'
import 'bootstrap/dist/js/bootstrap.bundle'

AOS.init({
  easing: 'ease-out-back',
  duration: 1000
})

const app = createApp(App)
app.use(pinia)
app.use(router)
app.use(VueApexCharts)
app.use(BootstrapVueNext)
app.component(VueFeather.type, VueFeather)
// app.directive('maska', vMaska)
app.use(i18n)
app.use(VueSweetalert2)
app.use(vClickOutside)

app.mount('#app')
