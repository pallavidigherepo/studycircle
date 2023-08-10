import PermissionIndex from '../views/Permissions/Index.vue';
import CoursesTypes from '../views/CoursesTypes/Index.vue';
import Courses from '../views/Courses/Index.vue';

import SettingIndex from '../views/Settings/Index.vue';
import Batches from '../views/Batches/Index.vue';
import Standards from '../views/Standards/Index.vue';
import Boards from '../views/Boards/Index.vue';

const masterRoutes = [
    {
        path: "/permissions",
        name: "PermissionIndex",
        component: PermissionIndex,
    },
    {
        path: '/boards',
        name: "Boards",
        component: Boards,
        meta: {
            parent: 'Boards'
        },
    },
    {
        path: '/standards',
        name: "Standards",
        component: Standards,
        meta: {
            parent: 'Standards'
        },
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
        path: '/settings',
        name: "SettingIndex",
        component: SettingIndex,
    },
    {
        path: '/batches',
        name: "Batches",
        component: Batches,
    },
];

export default masterRoutes;
