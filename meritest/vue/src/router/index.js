import { createRouter, createWebHistory } from "vue-router";

import Home from "@/views/home/Index.vue";
import AboutUs from '@/views/aboutus/Index.vue';
import ContactUs from '@/views/contactus/Index.vue';
import Blogs from '../views/blogs/Index.vue';
import BlogView from '../views/blogs/View.vue';
import HowItWorks from '../views/howitworks/Index.vue';
import Features from '../views/features/Index.vue';
import Careers from '../views/careers/Index.vue';
import OurTeam from '../views/ourteam/Index.vue';
import OurServices from '../views/ourservices/Index.vue';
import OurProducts from '../views/ourproducts/Index.vue';

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
        path: '/blogs/:id',
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
    history: createWebHistory(),
    routes,
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active",
    scrollBehavior(to, from, savedPosition) {
        return savedPosition || { left: 0, top: 0 }
    }
});
export default router;