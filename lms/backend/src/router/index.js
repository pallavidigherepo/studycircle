import { createRouter, createWebHistory } from "vue-router";

import DefaultLayout from "../layouts/DefaultLayout.vue";
import AuthLayout from "../layouts/AuthLayout.vue";

import Dashboard from "../views/Dashboard/Index.vue";

import PermissionIndex from '../views/Permissions/Index.vue';

import Roles from '../views/Roles/Index.vue';
import CreateRole from '../views/Roles/Create.vue';
import EditRole from '../views/Roles/Edit.vue';

import Parents from '../views/Parents/Index.vue';
import CreateParent from '../views/Parents/Create.vue';
import EditParent from '../views/Parents/Edit.vue';

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
import ShowGeneratedQuestionPaper from "../views/GeneratedQuestions/Show.vue";
import AssignToStudent from "../views/GeneratedQuestions/AssignStudent.vue";

import Students from '../views/Students/Index.vue';
import CreateStudent from '../views/Students/Create.vue';
import EditStudent from '../views/Students/Edit.vue';
import ShowStudent from '../views/Students/Show.vue';


import SettingIndex from '../views/Settings/Index.vue';
import Batches from '../views/Batches/Index.vue';
import Standards from '../views/Standards/Index.vue';
import Boards from '../views/Boards/Index.vue';
import InquiryStatuses from '../views/InquiryStatuses/Index.vue';
import InquirySources from '../views/InquirySources/Index.vue';
import InquiryFollowupTypes from '../views/InquiryFollowupTypes/Index.vue';
import Inquiries from '../views/Inquiries/Index.vue';
import CreateInquiry from '../views/Inquiries/Create.vue';
import EditInquiry from '../views/Inquiries/Edit.vue';
import ShowInquiry from '../views/Inquiries/Show.vue';
import FeeTypes from '../views/FeeTypes/Index.vue';

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
                path: "/parents",
                name: "Parents",
                component: Parents,
                meta: {
                    parent: 'Parents'
                },
                children: [{
                    path: "/parents/create",
                    name: "CreateParent",
                    component: CreateParent,
                    meta: {
                        parent: 'Parents'
                    }
                },
                    {
                        path: "/parents/:id/edit",
                        name: "EditParent",
                        component: EditParent,
                        meta: {
                            parent: 'Parents'
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
                path: '/inquiry_statuses',
                name: "InquiryStatuses",
                component: InquiryStatuses,
                meta: {
                    parent: 'InquiryStatuses'
                },
            },
            {
                path: '/inquiry_follow_up_types',
                name: "InquiryFollowupTypes",
                component: InquiryFollowupTypes,
                meta: {
                    parent: 'InquiryFollowupTypes'
                },
            },
            {
                path: '/inquiry_sources',
                name: "InquirySources",
                component: InquirySources,
                meta: {
                    parent: 'InquirySources'
                },
            },
            {
                path: '/inquiries',
                name: "Inquiries",
                component: Inquiries,
                meta: {
                    parent: 'Inquiries'
                },
                children: [{
                    path: '/inquiries/create',
                    name: "CreateInquiry",
                    component: CreateInquiry,
                    meta: {
                        parent: 'Inquiries'
                    }
                },
                    {
                        path: '/inquiries/:id/edit',
                        name: "EditInquiry",
                        component: EditInquiry,
                        meta: {
                            parent: 'Inquiries'
                        }
                    },
                    {
                        path: '/inquiries/:id',
                        name: "ShowInquiry",
                        component: ShowInquiry,
                        meta: {
                            parent: 'Inquiries'
                        }
                    },
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
                    parent: 'GeneratedQuestionPapers'
                },
            },
            {
                path: "/generated_question_papers/:id",
                name: "ShowGeneratedQuestionPaper",
                component: ShowGeneratedQuestionPaper,
                meta: {
                    parent: 'GeneratedQuestionPapers'
                },
            },
            {
                path: "/generated_question_papers/assign/:id",
                name: "AssignToStudent",
                component: AssignToStudent,
                meta: {
                    parent: 'GeneratedQuestionPapers'
                },
            },

            {
                path: "/templates",
                name: "Templates",
                component: Templates,
                meta: {
                    parent: 'Templates'
                },
                children: [{
                    path: '/templates/create',
                    name: "CreateTemplate",
                    component: CreateTemplate,
                    meta: {
                        parent: 'Templates'
                    }
                },
                    {
                        path: '/templates/:id/edit',
                        name: "EditTemplate",
                        component: EditTemplate,
                        meta: {
                            parent: 'Templates'
                        }
                    },
                    {
                        path: '/templates/:id',
                        name: "ShowTemplate",
                        component: ShowTemplate,
                        meta: {
                            parent: 'Templates'
                        }
                    },
                    {
                        path: '/templates/:id/generate_paper',
                        name: "PaperGenerator",
                        component: PaperGenerator,
                        meta: {
                            parent: 'Templates'
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
            {
                path: '/fee_types',
                name: "FeeTypes",
                component: FeeTypes,
            }
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
