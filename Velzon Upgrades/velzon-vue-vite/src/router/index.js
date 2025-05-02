import { createRouter, createWebHistory } from 'vue-router'
import Login from '../views/Auth/login.vue'
import Register from '../views/Auth/register.vue'
import ForgotPassword from '../views/Auth/forgot-password.vue'
import Animation from '../views/Advance-UI/animation.vue'
import Highlight from '../views/Advance-UI/highlight.vue'
import Scrollbar from '../views/Advance-UI/scrollbar.vue'
import Scrollspy from '../views/Advance-UI/scrollspy.vue'
import Sweetalerts from '../views/Advance-UI/sweetalerts.vue'
import SwiperSlider from '../views/Advance-UI/swiper.vue'


const routes = [
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/register',
    name: 'register',
    component: Register
  },
  {
    path: '/forgot-password',
    name: 'forgot-password',
    component: ForgotPassword
  },
  {
    path: '/animation',
    name: 'animation',
    component: Animation
  },
  {
    path: '/highlight',
    name: 'highlight',
    component: Highlight
  },
  {
    path: '/scrollbar',
    name: 'scrollbar',
    component: Scrollbar
  },
  {
    path: '/scrollspy',
    name: 'scrollspy',
    component: Scrollspy
  },
  {
    path: '/sweetalerts',
    name: 'sweetalerts',
    component: Sweetalerts
  },
  {
    path: '/swiper',
    name: 'Swiper Slider',
    component: SwiperSlider
  },
  
];
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
  linkActiveClass: "active",
  linkExactActiveClass: "exact-active",
  scrollBehavior(to, from, savedPosition) {
    return savedPosition || { left: 0, top: 0 }
  }
})

export default router;