import { createRouter, createWebHistory } from "vue-router";

import Home from '../pages/Home.vue';
import AboutUs from '../pages/AboutUs.vue';
import ContactUs from '../pages/ContactUs.vue';
import Blogs from '../pages/Blogs.vue';
import HowItWorks from '../pages/HowItWorks.vue';
import Features from '../pages/Features.vue';
import Kvpy from '../pages/Kvpy.vue';
import MhtCet from '../pages/MhtCet.vue';
import Careers from '../pages/Careers.vue';
import OurTeam from '../pages/OurTeam.vue';
import OurServices from '../pages/OurServices.vue';
import OurProducts from '../pages/OurProducts.vue';

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/about-us',
        name: 'aboutUs',
        component: AboutUs
    },
    {
        path: '/our-team',
        name: 'ourTeam',
        component: OurTeam
    },
    {
        path: '/our-services',
        name: 'ourServices',
        component: OurServices
    },
    {
        path: '/our-products',
        name: 'ourProducts',
        component: OurProducts
    },
    {
        path: '/how-it-works',
        name: 'howItWorks',
        component: HowItWorks
    },
    {
        path: '/contact-us',
        name: 'ContactUs',
        component: ContactUs
    },
    {
        path: '/kvpy',
        name: 'kvpy',
        component: Kvpy
    },
    {
        path: '/mht-cet',
        name: 'mhtCet',
        component: MhtCet
    },
    {
        path: '/careers',
        name: 'careers',
        component: Careers
    },
    {
        path: '/blogs',
        name: 'blogs',
        component: Blogs
    },
    {
        path: '/features',
        name: 'features',
        component: Features
    },
    {
        path: '/:pathMatch(.*)*',
        component: Home
    }
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active",
    scrollBehavior(to, from, savedPosition) {
        return savedPosition || { left: 0, top: 0 }
    }
});
export default router;