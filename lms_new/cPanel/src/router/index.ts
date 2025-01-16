import { createRouter, createWebHistory } from "vue-router";
import Layout from "@/themes";

import Dashboard from "@/views/Dashboard/Index.vue";
import Profile from "@/views/Auth/Profile.vue";
import Leave from "@/views/Leave/Leave.vue";
import LeaveRequest from "@/views/Leave/LeaveRequest.vue";
import LeaveBalance from "@/views/Leave/LeaveBalance.vue";


import authRoutes from "./auth.js";
// import masterRoutes from "./master";
// import subjectChapterTopicRoutes from "./subject_chapter_topic";
// import studentRoute from "./students";
// import parentRoutes from "./parents";
// import questionRoutes from "./questions";
// import questionnaireTemplateRoutes from "./questionnaire_template";
// import inquiryRoutes from "./inquiries";
// import feeRoutes from "./fees";
// import userRoutes from "./users";
// import roleRoutes from "./role";

const routes = [
  {
    path: "/",
    component: Layout,
    children: [
      {
        path: "/",
        name: "dashboard",
        component: Dashboard,
        meta: { 
          requiresAuth: true,
          // requiresVerification: true, 
        },
      },      
      
      // ...masterRoutes,
      // ...subjectChapterTopicRoutes,
      // ...studentRoute,
      // ...parentRoutes,
      // ...questionRoutes,
      // ...questionnaireTemplateRoutes,
      // ...inquiryRoutes,
      // ...feeRoutes,
      // ...userRoutes,
      // ...roleRoutes,
      
      // {
      //   path: "/profile",
      //   name: "Profile",
      //   component: Profile,
      //   meta: { 
      //     requiresAuth: true,
      //     // requiresVerification: true, 
      //   },
      // },
      // {
      //   path: "/leave",
      //   name: "Leave",
      //   component: Leave,
      //   meta: { 
      //     requiresAuth: true,
      //     // requiresVerification: true, 
      //   },
      // },
      // {
      //   path: "/leave_request",
      //   name: "Leave-Request",
      //   component: LeaveRequest,
      //   meta: { 
      //     requiresAuth: true,
      //     // requiresVerification: true, 
      //   },
      // },
      // {
      //   path: "/leave_balance",
      //   name: "Leave-Balance",
      //   component: LeaveBalance,
      //   meta: { 
      //     requiresAuth: true,
      //     // requiresVerification: true, 
      //   },
      // },
      // {
      //   path: "icon",
      //   name: "icon",
      //   component: () => import("@/pages/Icon.vue"),
      // },
      // {
      //   path: "loading-icon",
      //   name: "loading-icon",
      //   component: () => import("@/pages/LoadingIcon.vue"),
      // },
    ],
  },
  ...authRoutes,
  // {
  //   path: "/error-page",
  //   name: "error-page",
  //   component: () => import("../pages/ErrorPage.vue"),
  // },
  
];
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: routes,
  scrollBehavior(to, from, savedPosition) {
    return savedPosition || { left: 0, top: 0 };
},
});

router.beforeEach((to, from, next) => {
  let token = localStorage.getItem("TOKEN");
  let user = JSON.parse(localStorage.getItem("USER") ?? "{}");

  if (to.meta.requiresAuth && (token === 'undefined' || !token)) {
    next({ name: "Login" });
  } else if (token && to.meta.requiresVerification && user.email_verified_at === null) {
    next({ name: "VerifyError" })
  } else if (token && to.meta.isGuest) {
    next({ name: "Dashboard" })
  } else {
    next();
  }
});

export default router;