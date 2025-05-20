import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import AOS from 'aos'
import 'aos/dist/aos.css'
import i18n from './i18n'
import pinia from './state/store'

import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'

import BootstrapVue3 from 'bootstrap-vue-3'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue-3/dist/bootstrap-vue-3.css'

import vClickOutside from 'click-outside-vue3'
import VueApexCharts from 'vue3-apexcharts'
import VueFeather from 'vue-feather'

import 'leaflet/dist/leaflet.css'
import '@/assets/scss/mermaid.min.css'
import 'bootstrap/dist/js/bootstrap.bundle'
import '@vueform/toggle/themes/default.css'

AOS.init({
  easing: 'ease-out-back',
  duration: 1000
})

const app = createApp(App)

app.use(pinia)
app.use(router)
app.use(VueApexCharts)
app.use(BootstrapVue3)
app.component(VueFeather.type, VueFeather)
app.use(i18n)
app.use(VueSweetalert2)
app.use(vClickOutside)

app.mount('#app')
