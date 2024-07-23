import PermissionIndex from '@/views/Permissions/Index.vue';
import CoursesTypes from '@/views/CoursesTypes/Index.vue';
import Courses from '@/views/Courses/Index.vue';

import SettingIndex from '@/views/Settings/Index.vue';
import Batches from '@/views/Batches/Index.vue';
import Standards from '@/views/Standards/Index.vue';
import Boards from '@/views/Boards/Index.vue';

const masterRoutes = [
    {
        path: "/permissions",
        name: "permissions",
        component: PermissionIndex,
        meta: { 
            requiresAuth: true,
            // requiresVerification: true, 
          },
    },
    {
        path: '/boards',
        name: "boards",
        component: Boards,
        meta: {
            parent: 'Boards',
            requiresAuth: true,
            // requiresVerification: true, 
        },
    },
    {
        path: '/standards',
        name: "standards",
        component: Standards,
        meta: {
            parent: 'Standards',
            requiresAuth: true,
            // requiresVerification: true,               
        },
    },
    {
        path: '/courses_types',
        name: "course-types",
        component: CoursesTypes,
        meta: {
            parent: 'CourseTypes',
            requiresAuth: true,
            // requiresVerification: true, 
        },
    },
    {
        path: '/courses',
        name: "courses",
        component: Courses,
        meta: {
            parent: 'Courses',
            requiresAuth: true,
            // requiresVerification: true, 
        },
    },
    {
        path: '/settings',
        name: "setting-index",
        component: SettingIndex,
        meta: { 
            requiresAuth: true,
            // requiresVerification: true, 
          },
    },
    {
        path: '/batches',
        name: "batches",
        component: Batches,
        meta: { 
            requiresAuth: true,
            // requiresVerification: true, 
          },
    },
];

export default masterRoutes;
