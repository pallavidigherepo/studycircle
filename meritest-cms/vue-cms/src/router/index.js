import { createRouter, createWebHistory } from 'vue-router';

import DefaultLayout from "@/components/layouts/DefaultLayout.vue";
import Dashboard from '@/views/Dashboard.vue';
import Contents from '@/views/Contents/Index.vue';
import Blogs from '@/views/Blogs/Index.vue';
import CreateBlog from '@/views/Blogs/Create.vue';
import Login from '@/views/Auth/Login.vue';
import store from '@/store';

const routes = [
    {
        path: "/",
        redirect: "/dashboard",
        name: "Dashboard",
        component: DefaultLayout,
        meta: { requiresAuth: true },
        children: [
            { path: "/dashboard", name: "Dashboard", component: Dashboard },
            { 
                path: '/cms', 
                name: "Contents", 
                component: Contents,
                children: [
                    { path: '/cms/create', name: "Contents", component: Contents}
                ]
            },
            { 
                path: '/blogs', 
                name: "Blogs", 
                component: Blogs,
                children: [
                    { path: '/blogs/create', name: "CreateBlog", component: CreateBlog}
                ]
            },
            
        ]
    },
    {
        path: "/login",
        name: "Login",
        meta: {isGuest: true},
        component: Login
    }
];
const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.auth.user.token) {
        next({ name: "Login"});
    } else if(store.state.auth.user.token && to.meta.isGuest) {
        next( {name: "Dashboard"});
    } else {
        next();
    }
});
export default router;