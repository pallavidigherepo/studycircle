import { createRouter, createWebHistory } from "vue-router";

import DefaultLayout from "../layouts/DefaultLayout.vue";
import AuthLayout from "../layouts/AuthLayout.vue";

import Dashboard from "../views/Dashboard/Index.vue";
import PermissionIndex from '../views/Permissions/Index.vue';
import Roles from '../views/Roles/Index.vue';
import Users from '../views/Users/Index.vue';
import Questions from '../views/Questions/Index.vue';
import CreateUser from '../views/Users/Create.vue';

import Login from "../views/Auth/Login.vue";
import ErrorPage from "../views/ErrorPage.vue";

import store from '@/stores';

const routes = [
  {
    path: "/",
    component: DefaultLayout,
    redirect: '/dashboard',
    meta: { requiresAuth: true },
    children: [
      {
        path: "/dashboard",
        name: "Dashboard",
        component: Dashboard,
      },
      {
        path: "/users",
        name: "UserManagement",
        component: Users,
        children: [
          { path: "/users/create", name: "CreatUser", component: CreateUser },
        ]
      },
      {
        path: "/permissions",
        name: "PermissionIndex",
        component: PermissionIndex,
      },
      {
        path: "/roles",
        name: "Roles",
        component: Roles,
      },
      {
        path: "/users",
        name: "Users",
        component: Users,
      },
      {
        path: "/questions",
        name: "Questions",
        component: Questions,
      },
    ],
  },
  
  {
    path: "/auth",
    redirect: "/login",
    name: "Auth",
    component: AuthLayout,
    meta: {isGuest: true},
    children: [
      {
        path: "/login",
        name: "Login",
        component: Login,
      },
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
  if (to.meta.requiresAuth && !store.state.auth.user.token) {
     next({name: "Login"});
  } else if (store.state.auth.user.token && to.meta.isGuest) {
     next({name: "Dashboard"})
  } else {
      next();
  }
 })

export default router;
