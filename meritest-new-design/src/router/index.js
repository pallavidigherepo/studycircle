import { createRouter, createWebHistory } from "vue-router";

import Home from '../views/home/Index.vue';
import About from '../views/About.vue';
import Services from '../views/services/Index.vue';
import Contact from '../views/Contact.vue';
import Portfolio from '../views/Portfolio.vue';
import Products from '../views/Products.vue';
import Team from '../views/Team.vue';
import Career from '../views/Career.vue';

/*import Depression from '../views/services/Depression.vue';
import Anxiety from '../views/services/Anxiety.vue';
import Cbt from '../views/services/Cbt.vue';
import CoupleCounselling from '../views/services/CoupleCounselling.vue';
import Gallery from '../views/gallery/Index.vue';
import Blogs from '../views/blogs/Index.vue';*/

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/about",
        name: "About",
        component: About,
    },
    {
        path: "/portfolio",
        name: "Portfolio",
        component: Portfolio,
    },
    {
        path: "/services",
        name: "Services",
        component: Services,
    },
    {
        path: "/our-products",
        name: "Products",
        component: Products,
    },
    {
        path: "/our-team",
        name: "Team",
        component: Team,
    },
    {
        path: "/career",
        name: "Career",
        component: Career,
    },
    {
        path: "/contact",
        name: "Contact",
        component: Contact,
    },
    /*{
        path: "/services/cbt",
        name: "Cbt",
        component: Cbt,
    },
    {
        path: "/services/couple-counselling",
        name: "CoupleCounselling",
        component: CoupleCounselling,
    },
    {
        path: "/gallery",
        name: "Gallery",
        component: Gallery,
    },
    {
        path: "/blogs",
        name: "Blogs",
        component: Blogs,
    },*/
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