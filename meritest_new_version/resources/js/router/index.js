import { createRouter, createWebHistory } from "vue-router";

import Home from '../views/Home.vue';
import AboutUs from '../views/AboutUs.vue';
import ContactUs from '../views/ContactUs.vue';
import Blogs from '../views/Blogs.vue';
import BlogView from '../views/BlogView.vue';
import HowItWorks from '../views/HowItWorks.vue';
import Features from '../views/Features.vue';
import Kvpy from '../views/Kvpy.vue';
import MhtCet from '../views/MhtCet.vue';
import Careers from '../views/Careers.vue';
import OurTeam from '../views/OurTeam.vue';
import OurServices from '../views/OurServices.vue';
import OurProducts from '../views/OurProducts.vue';

const routes = [{
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
        path: '/blogs/:url',
        name: "BlogView",
        component: BlogView
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