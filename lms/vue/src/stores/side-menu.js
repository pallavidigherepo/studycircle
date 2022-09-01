import { defineStore } from "pinia";

export const useSideMenuStore = defineStore("sideMenu", {
    state: () => ({
        menu: [{
                icon: "HomeIcon",
                pageName: "Dashboard",
                title: "Dashboard",
            },
            {
                icon: "UsersIcon",
                pageName: "UserManagement",
                title: "Users & Students",
                subMenu: [{
                        icon: "SettingsIcon",
                        pageName: "PermissionIndex",
                        title: "Permissions",
                        ignore: false,
                    },
                    {
                        icon: "KeyIcon",
                        pageName: "Roles",
                        title: "Roles",
                        ignore: false,
                        allowedPages: ['Roles', 'CreateRole', 'EditRole', 'ShowRole'],
                    },
                    {
                        icon: "UsersIcon",
                        pageName: "Users",
                        title: "Users",
                        ignore: false,
                        allowedPages: ['Users', 'CreateUser', 'EditUser', 'ShowUser'],
                    },
                    {
                        icon: "UsersIcon",
                        pageName: "Students",
                        title: "Students",
                        ignore: false,
                    },
                ],
            },

            "devider",
            {
                icon: "BoxIcon",
                pageName: "Courses",
                title: "Courses",
                subMenu: [{
                        icon: "BoxIcon",
                        pageName: "CourseTypes",
                        title: "Course types",
                        ignore: false,
                    },
                    {
                        icon: "BriefcaseIcon",
                        pageName: "Courses",
                        title: "Courses",
                        ignore: false,
                    },
                ],
            },
            {
                icon: "BookIcon",
                pageName: "Subjects",
                title: "Subjects",
                ignore: false,
                allowedPages: ['Subjects', 'CreateSubject', 'EditSubject', 'ShowSubject', 'ShowChapter'],
            },
            "devider",
            {
                icon: "BriefcaseIcon",
                pageName: "Questionnaire",
                title: "Questionnaire",
                subMenu: [
                    {
                        icon: "DatabaseIcon",
                        pageName: "Questions",
                        title: "Questions",
                        ignore: false,
                        allowedPages: ['Questions', 'CreateQuestion', 'EditQuestion', 'ShowQuestion'],
                    },
                    {
                        icon: "ListIcon",
                        pageName: "Templates",
                        title: "Question Paper Formats",
                        ignore: false,
                        allowedPages: ['Templates', 'CreateTemplate', 'EditTemplate', 'ShowTemplate'],
                    },
                    {
                        icon: "ArchiveIcon",
                        pageName: "GeneratedQuestionPapers",
                        title: "Generated Question Papers",
                        ignore: false,
                        allowedPages: ['GeneratedQuestionPapers', 'ShowGeneratedQuestionPaper'],
                    },
                ]
            },
        ],
    }),
});
