import { createRouter, createWebHistory } from "vue-router";
import store from '../store/index.js';

/*** Begin Auth component(s)  */
import Login from '@/components/Pages/Auth/Login.vue'
import Register from '@/components/Pages/Auth/Register.vue'
import Profile from '@/components/Pages/Auth/Profile.vue'

/*** Begin Dashboard component(s)  */
import Dashboard from '@/components/Pages/Dashboard/Index.vue'

/*** Begin Role component(s) */
import RoleList from '@/components/Pages/Roles/Index.vue';
import RoleCreate from '@/components/Pages/Roles/Create.vue';
import RoleEdit from '@/components/Pages/Roles/Edit.vue';

/*** Begin Permission component(s) */
import PermissionList from '@/components/Pages/Permissions/Index.vue';
import PermissionCreate from '@/components/Pages/Permissions/Create.vue';
import PermissionEdit from '@/components/Pages/Permissions/Edit.vue';

/*** Begin User component(s)  */
import UserList from '@/components/Pages/Users/Index.vue'
import UserCreate from '@/components/Pages/Users/Create.vue'
import UserEdit from '@/components/Pages/Users/Edit.vue'

/*** Begin Course components */
import CoursesList from '@/components/Pages/Courses/Index.vue'
import CourseTypeList from '@/components/Pages/CoursesTypes/Index.vue'

/*** Begin Subject components */
import SubjectList from '@/components/Pages/Subjects/Index.vue';
import SubjectCreate from '@/components/Pages/Subjects/Create.vue';
import SubjectEdit from '@/components/Pages/Subjects/Edit.vue';
import SubjectView from '@/components/Pages/Subjects/View.vue'

/*** Begin Subject components */
import ChapterList from '@/components/Pages/Chapters/Index.vue'
import ChapterCreate from '@/components/Pages/Chapters/Create.vue'
import ChapterEdit from '@/components/Pages/Chapters/Edit.vue'

/*** Begin Subject components */
import QuestionList from '@/components/Pages/Questions/Index.vue'
import QuestionCreate from '@/components/Pages/Questions/Create.vue'
import QuestionEdit from '@/components/Pages/Questions/Edit.vue'

/*** Begin Error component(s)  */
import ErrorPage from '@/components/Error.vue'

const routes = [
    {
        path: '/',
        redirect: '/dashboard',
        meta: { requiresAuth: true }
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: { requiresAuth: true }
    },
    {
        path: '/roles',
        name: 'roles',
        component: RoleList,
        meta: { requiresAuth: true },
        children: [
            {
                path: '/roles/create',
                name: 'roleCreate',
                component: RoleCreate,
                meta: { requiresAuth: true, parent: 'roles' },
            },
            {
                path: '/roles/:id/edit',
                name: 'roleEdit',
                component: RoleEdit, 
                props: true,
                meta: { requiresAuth: true, parent: 'roles' },
            }
        ]
    },
    {
        path: '/permissions',
        name: 'permissions',
        component: PermissionList,
        meta: { requiresAuth: true },
        children: [
            {
                path: '/permissions/create',
                name: 'permissionCreate',
                component: PermissionCreate,
                meta: { requiresAuth: true, parent: 'permissions' },
            },
            {
                path: '/permissions/:id/edit',
                name: 'permissionEdit',
                component: PermissionEdit,
                meta: { requiresAuth: true, parent: 'permissions' },
            }
        ]
    },
    {
        path: '/courses',
        name: 'courses',
        component: CoursesList,
        meta: { requiresAuth: true },
    },
    {
        path: '/course-types',
        name: 'courseType',
        component: CourseTypeList,
        params: true,
        meta: { requiresAuth: true },
    },
    {
        path: '/users',
        name: 'users',
        component: UserList,
        meta: { requiresAuth: true },
        children: [
            {
                path: '/create',
                name: 'userCreate',
                component: UserCreate,
                meta: { requiresAuth: true, parent: 'users' },
            },
            {
                path: '/:id/edit',
                name: 'userEdit',
                component: UserEdit,
                props: true,
                meta: { requiresAuth: true, parent: 'users' },
            },
        ]
    },
    {
        path: '/subjects',
        name: 'subjects',
        component: SubjectList,
        meta: { requiresAuth: true },
        children: [
            {
                path: '/subjects/create',
                name: 'subjectCreate',
                component: SubjectCreate,
                parent: 'subjects',
                meta: { requiresAuth: true, parent: 'subjects' },
            },
            {
                path: '/subjects/:id/edit',
                name: 'subjectEdit',
                component: SubjectEdit,
                props: true,
                meta: { requiresAuth: true, parent: 'subjects' },
            },
            {
                path: '/subjects/show/:id',
                name: 'subjectView',
                component: SubjectView,
                props: true,
                meta: { requiresAuth: true, parent: 'subjects' },
            },
        ]
    },
    {
        path: '/chapters',
        name: 'chapters',
        component: ChapterList,
        meta: { requiresAuth: true },
        children: [
            {
                path: '/chapters/create',
                name: 'chapterCreate',
                component: ChapterCreate,
                parent: 'chapters',
                meta: { requiresAuth: true, parent: 'chapters' },
            },
            {
                path: '/chapters/:id/edit',
                name: 'chapterEdit',
                component: ChapterEdit,
                props: true,
                meta: { requiresAuth: true, parent: 'chapters' },
            },
        ]
    },    
    {
        path: '/questions',
        name: 'questions',
        component: QuestionList,
        meta: { requiresAuth: true }
    },
    {
        path: '/profile',
        name: 'profile',
        component: Profile,
        meta: { requiresAuth: true },
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: { requiresUnauth: true }
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/reset-password',
        name: 'resetPassword',
        component: Register
    },
    {
        path: '/error-page',
        name: 'error-page',
        component: ErrorPage
    },
    /*{
        path: '/:pathMatch(.*)*',
        component: ErrorPage
    }*/
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
    linkActiveClass: "side-menu--active router-active-link",
    linkExactActiveClass: "exact-active",
    scrollBehavior(to, from, savedPosition) {
        return savedPosition || { left: 0, top: 0 }
    }
});

router.beforeEach(function(to, _, next) {
    if (to.meta.requiresAuth && !store.getters.isAuthenticated) {
        next('/login');
    } else if (to.meta.requiresUnauth && store.getters.isAuthenticated) {
        next('/dashboard');
        //prev();
    } else {
        next();
    }
});
export default router;