import { createRouter, createWebHistory } from "vue-router";

import DefaultLayout from "../layouts/DefaultLayout.vue";
import AuthLayout from "../layouts/AuthLayout.vue";

import Dashboard from "../views/Dashboard/Index.vue";
import PermissionIndex from '../views/Permissions/Index.vue';
import Roles from '../views/Roles/Index.vue';
import CreateRole from '../views/Roles/Create.vue';
import EditRole from '../views/Roles/Edit.vue';
import Users from '../views/Users/Index.vue';
import Questions from '../views/Questions/Index.vue';
import CreateUser from '../views/Users/Create.vue';
import EditUser from '../views/Users/Edit.vue';
import CoursesTypes from '../views/CoursesTypes/Index.vue';
import Courses from '../views/Courses/Index.vue';
import Subjects from '../views/Subjects/Index.vue';
import Chapters from '../views/Chapters/Index.vue';

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
        path: "/permissions",
        name: "PermissionIndex",
        component: PermissionIndex,
      },
      {
        path: "/roles",
        name: "Roles",
        component: Roles,
        meta: {
          parent: 'Roles'
        },
        children: [
          {
            path: "/roles/create",
            name: "CreatRole",
            component: CreateRole,
            meta: {
              parent: 'Roles'
            }
          },
          {
            path: "/roles/:id/edit",
            name: "EditRole",
            component: EditRole,
            meta: {
              parent: 'Roles'
            },
          }
        ]
      },
      {
        path: "/users",
        name: "Users",
        component: Users,
        meta: {
          parent: 'Users'
        },
        children: [
          {
            path: "/users/create",
            name: "CreateUser",
            component: CreateUser,
            meta: {
              parent: 'Users'
            }
          },
          {
            path: "/users/:id/edit",
            name: "EditUser",
            component: EditUser,
            meta: {
              parent: 'Users'
            },
          }
        ]
      },
      {
        path: '/courses_types',
        name: "CourseTypes",
        component: CoursesTypes,
        meta: {
          parent: 'CourseTypes'
        },
      },
      {
        path: '/courses',
        name: "Courses",
        component: Courses,
        meta: {
          parent: 'Courses'
        },
      },
      {
        path: '/subjects',
        name: "Subjects",
        component: Subjects
      },
      {
        path: '/chapters',
        name: "Chapters",
        component: Chapters
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
    meta: { isGuest: true },
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
    next({ name: "Login" });
  } else if (store.state.auth.user.token && to.meta.isGuest) {
    next({ name: "Dashboard" })
  } else {
    next();
  }
})

export default router;
