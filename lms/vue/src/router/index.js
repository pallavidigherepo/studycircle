import { createRouter, createWebHistory } from "vue-router";

import DefaultLayout from "../layouts/DefaultLayout.vue";
import AuthLayout from "../layouts/AuthLayout.vue";

import Dashboard from "../views/Dashboard/Index.vue";

import PermissionIndex from '../views/Permissions/Index.vue';

import Roles from '../views/Roles/Index.vue';
import CreateRole from '../views/Roles/Create.vue';
import EditRole from '../views/Roles/Edit.vue';

import Users from '../views/Users/Index.vue';
import CreateUser from '../views/Users/Create.vue';
import EditUser from '../views/Users/Edit.vue';

import CoursesTypes from '../views/CoursesTypes/Index.vue';

import Courses from '../views/Courses/Index.vue';

import Subjects from '../views/Subjects/Index.vue';
import CreateSubject from '../views/Subjects/Create.vue';
import EditSubject from '../views/Subjects/Edit.vue';
import ShowSubject from '../views/Subjects/Show.vue';

import Chapters from '../views/Chapters/Index.vue';
import CreateChapter from '../views/Chapters/Create.vue';
import EditChapter from '../views/Chapters/Edit.vue';
import ShowChapter from '../views/Chapters/Show.vue';

import Topics from '../views/Topics/Index.vue';
import CreateTopic from '../views/Topics/Create.vue';
import EditTopic from '../views/Topics/Edit.vue';
import ShowTopic from '../views/Topics/Show.vue';

import Questions from '../views/Questions/Index.vue';
import CreateQuestion from '../views/Questions/Create.vue';
import EditQuestion from '../views/Questions/Edit.vue';
import ShowQuestion from '../views/Questions/Show.vue';

import QuestionnaireDashboard from "../views/Questionnaire/Index.vue";

import Templates from '../views/Templates/Index.vue';
import CreateTemplate from '../views/Templates/Create.vue';
import EditTemplate from '../views/Templates/Edit.vue';
import ShowTemplate from '../views/Templates/Show.vue';

import PaperGenerator from "../views/GeneratedQuestions/Create.vue";
import GeneratedQuestionPapers from "../views/GeneratedQuestions/Index.vue";

import Students from '../views/Students/Index.vue';
import CreateStudent from '../views/Students/Create.vue';
import EditStudent from '../views/Students/Edit.vue';
import ShowStudent from '../views/Students/Show.vue';

import Login from "../views/Auth/Login.vue";
import Profile from "../views/Auth/Profile.vue";
import ErrorPage from "../views/ErrorPage.vue";

import store from '@/stores';

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
                children: [{
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
                children: [{
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
                component: Subjects,
                meta: {
                    parent: 'Subjects'
                },
                children: [{
                        path: '/subjects/create',
                        name: "CreateSubject",
                        component: CreateSubject,
                        meta: {
                            parent: 'Subjects'
                        }
                    },
                    {
                        path: '/subjects/:id/edit',
                        name: "EditSubject",
                        component: EditSubject,
                        meta: {
                            parent: 'Subjects'
                        }
                    },
                    {
                        path: '/subjects/:id',
                        name: "ShowSubject",
                        component: ShowSubject,
                        meta: {
                            parent: 'Subjects'
                        }
                    },
                ]
            },
            {
                path: '/chapters',
                name: "Chapters",
                component: Chapters,
                meta: {
                    parent: 'Subjects'
                },
                children: [{
                        path: '/chapters/create',
                        name: "CreateChapter",
                        component: CreateChapter,
                        meta: {
                            parent: 'Subjects'
                        }
                    },
                    {
                        path: '/chapters/:id/edit',
                        name: "EditChapter",
                        component: EditChapter,
                        meta: {
                            parent: 'Subjects'
                        }
                    },
                    {
                        path: '/chapters/:id',
                        name: "ShowChapter",
                        component: ShowChapter,
                        meta: {
                            parent: 'Subjects'
                        }
                    },
                ]
            },
            {
                path: '/topics',
                name: "Topics",
                component: Topics,
                meta: {
                    parent: 'Subjects'
                },
                children: [{
                        path: '/topics/create',
                        name: "CreateTopic",
                        component: CreateTopic,
                        meta: {
                            parent: 'Subjects'
                        }
                    },
                    {
                        path: '/topics/:id/edit',
                        name: "EditTopic",
                        component: EditTopic,
                        meta: {
                            parent: 'Subjects'
                        }
                    },
                    {
                        path: '/topics/:id',
                        name: "ShowTopic",
                        component: ShowTopic,
                        meta: {
                            parent: 'Subjects'
                        }
                    },
                ]
            },
            {
                path: "/questions",
                name: "Questions",
                component: Questions,
                meta: {
                    parent: 'Questions'
                },
                children: [{
                        path: '/questions/create',
                        name: "CreateQuestion",
                        component: CreateQuestion,
                        meta: {
                            parent: 'Questions'
                        }
                    },
                    {
                        path: '/questions/:id/edit',
                        name: "EditQuestion",
                        component: EditQuestion,
                        meta: {
                            parent: 'Questions'
                        }
                    },
                    {
                        path: '/questions/:id',
                        name: "ShowQuestion",
                        component: ShowQuestion,
                        meta: {
                            parent: 'Questions'
                        }
                    },
                ]
            },
            {
                path: "/questionnaire",
                name: "QuestionnaireDashboard",
                component: QuestionnaireDashboard,

            },

            {
                path: "/generated_question_papers",
                name: "GeneratedQuestionPapers",
                component: GeneratedQuestionPapers,
                meta: {
                    parent: 'QuestionnaireDashboard'
                },
            },
            {
                path: "/templates",
                name: "Templates",
                component: Templates,
                meta: {
                    parent: 'QuestionnaireDashboard'
                },
                children: [{
                    path: '/templates/create',
                    name: "CreateTemplate",
                    component: CreateTemplate,
                    meta: {
                        parent: 'QuestionnaireDashboard'
                    }
                },
                    {
                        path: '/templates/:id/edit',
                        name: "EditTemplate",
                        component: EditTemplate,
                        meta: {
                            parent: 'QuestionnaireDashboard'
                        }
                    },
                    {
                        path: '/templates/:id',
                        name: "ShowTemplate",
                        component: ShowTemplate,
                        meta: {
                            parent: 'QuestionnaireDashboard'
                        }
                    },
                    {
                        path: '/templates/:id/generate_paper',
                        name: "PaperGenerator",
                        component: PaperGenerator,
                        meta: {
                            parent: 'QuestionnaireDashboard'
                        }

                    }
                ]
            },
            {
                path: "/students",
                name: "Students",
                component: Students,
                meta: {
                    parent: 'Students'
                },
                children: [{
                        path: '/students/create',
                        name: "CreateStudent",
                        component: CreateStudent,
                        meta: {
                            parent: 'Students'
                        }
                    },
                    {
                        path: '/students/:id/edit',
                        name: "EditStudent",
                        component: EditStudent,
                        meta: {
                            parent: 'Students'
                        }
                    },
                    {
                        path: '/students/:id',
                        name: "ShowStudent",
                        component: ShowStudent,
                        meta: {
                            parent: 'Students'
                        }
                    },
                ]
            },
        ],
    },

    {
        path: "/auth",
        redirect: "/login",
        name: "Auth",
        component: AuthLayout,
        meta: { isGuest: true },
        children: [{
            path: "/login",
            name: "Login",
            component: Login,
        }, ],
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
