import { createRouter, createWebHistory } from "vue-router";

import DefaultLayout from "../layouts/DefaultLayout.vue";
import AuthLayout from "../layouts/AuthLayout.vue";

import Dashboard from "../views/Dashboard/Index.vue";

import Login from "../views/Auth/Login.vue";
import ForgotPassword from "../views/Auth/ForgotPassword.vue";
import Profile from "../views/Auth/Profile.vue";
import ErrorPage from "../views/ErrorPage.vue";

import store from '@/stores';

import roleRoutes from "./role.js";
import parentRoutes from "./parents.js";
import userRoutes from "./users";
import inquiryRoutes from "./inquiries";
import subjectChapterTopicRoutes from "./subject_chapter_topic";
import questionRoutes from "./questions";
import questionnaireTemplateRoutes from "./questionnaire_template";
import studentRoute from "./students";
import feeRoutes from "./fees";
import masterRoutes from "./master";

const routes = [{
        path: "/",
        component: DefaultLayout,
        redirect: '/dashboard',
        meta: { requiresAuth: true },
        children: [{
                path: "/profile",
                name: "Profile",
                component: Profile,
            },
            {
                path: "/dashboard",
                name: "Dashboard",
                component: Dashboard,
                meta: {
                    allowedRoles: ['Super Admin']
                }
            },
            ...masterRoutes,
            ...roleRoutes,
            ...parentRoutes,
            ...userRoutes,
            ...inquiryRoutes,
            ...subjectChapterTopicRoutes,
            ...questionRoutes,
            ...questionnaireTemplateRoutes,
            ...studentRoute,
            ...feeRoutes,
        ],
    },

    {
        path: "/auth",
        redirect: "/login",
        name: "Auth",
        component: AuthLayout,
        meta: { isGuest: true },
        children: [
            {
                path: "/login",
                name: "Login",
                component: Login,
            },
            {
                path: '/forgot-password',
                name: "ForgotPassword",
                component: ForgotPassword
            }
        ],
    },
    {
        path: "/error-page",
        name: "error-page",
        component: ErrorPage,
    },
    {
        path: "/:pathMatch(.*)*",
        component: ErrorPage,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        return savedPosition || { left: 0, top: 0 };
    },
});


router.beforeEach((to, from, next) => {
    let token = sessionStorage.getItem("TOKEN");
    // OLD: Removed, because state was not removing its token if user deleted session storage manually.
    //let token = store.state.auth.user.token;

    if (to.meta.requiresAuth && !token) {
        next({ name: "Login" });
    } else if (token && to.meta.isGuest) {
        next({ name: "Dashboard" })
    } else {
        next();
    }
})

export default router;
