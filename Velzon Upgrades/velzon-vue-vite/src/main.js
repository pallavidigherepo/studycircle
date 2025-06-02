import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import AOS from 'aos'
import 'aos/dist/aos.css'
import i18n from './i18n'
import pinia from './state/store'

// import maska from 'maska';

import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'

import * as BootstrapVueNext from 'bootstrap-vue-next'



// import { BootstrapVueNext } from 'bootstrap-vue-next'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue-next/dist/bootstrap-vue-next.css'

import vClickOutside from 'click-outside-vue3'
import VueApexCharts from 'vue3-apexcharts'
import VueFeather from 'vue-feather'

import 'leaflet/dist/leaflet.css'
import '@/assets/scss/mermaid.min.css'
import 'bootstrap/dist/js/bootstrap.bundle'
import '@vueform/toggle/themes/default.css'
import {
  BContainer,
  BRow,
  BCol,
  BCard,
  BButton,
  BLink,
  BDropdownItem,
  BDropdown,
  BBadge,
  BOffcanvas,
  BCollapse,
  BCardBody,
  BCardHeader,
  BCardTitle,
  BTabs,
  BTab,
  BAlert,
  BProgressBar,
  BProgress,
  BCardFooter,
  BModal,
  BDropdownItemButton,
  BForm,
  BCarouselSlide,
  BCarousel
} from 'bootstrap-vue-next'

AOS.init({
  easing: 'ease-out-back',
  duration: 1000
})

const app = createApp(App)

app.use(pinia)
app.use(router)
app.use(VueApexCharts)
app.use(BootstrapVueNext.default || BootstrapVueNext)
// app.use(BootstrapVueNext)
app.component(VueFeather.type, VueFeather)
app.component('BCarouselSlide', BCarouselSlide)
app.component('BCarousel', BCarousel)
app.component('BForm', BForm)
app.component('BDropdownItemButton', BDropdownItemButton)
app.component('BModal', BModal)
app.component('BCardFooter', BCardFooter)
app.component('BAlert', BAlert)
app.component('BProgressBar', BProgressBar)
app.component('BProgress', BProgress)
app.component('BContainer', BContainer)
app.component('BRow', BRow)
app.component('BCol', BCol)
app.component('BCard', BCard)
app.component('BButton', BButton)
app.component('BLink', BLink)
app.component('BDropdownItem', BDropdownItem)
app.component('BDropdown', BDropdown)
app.component('BBadge', BBadge)
app.component('BOffcanvas', BOffcanvas)
app.component('BCollapse', BCollapse)
app.component('BCardBody', BCardBody)
app.component('BCardHeader', BCardHeader)
app.component('BCardTitle', BCardTitle)
app.component('BTabs', BTabs)
app.component('BTab', BTab)

app.use(i18n)
// app.use(maska);
app.use(VueSweetalert2)
app.use(vClickOutside)

app.mount('#app')
