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
    },
    {
        path: '/boards',
        name: "boards",
        component: Boards,
        meta: {
            parent: 'Boards'
        },
    },
    {
        path: '/standards',
        name: "standards",
        component: Standards,
        meta: {
            parent: 'Standards'
        },
    },
    {
        path: '/courses_types',
        name: "course-types",
        component: CoursesTypes,
        meta: {
            parent: 'CourseTypes'
        },
    },
    {
        path: '/courses',
        name: "courses",
        component: Courses,
        meta: {
            parent: 'Courses'
        },
    },
    {
        path: '/settings',
        name: "setting-index",
        component: SettingIndex,
    },
    {
        path: '/batches',
        name: "batches",
        component: Batches,
    },
];

export default masterRoutes;
