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
                        ignore: true,
                    },
                    {
                        icon: "UsersIcon",
                        pageName: "Users",
                        title: "Users",
                        ignore: false,
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
                        ignore: true,
                    },
                    {
                        icon: "BriefcaseIcon",
                        pageName: "Courses",
                        title: "Courses",
                        ignore: true,
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
                icon: "DatabaseIcon",
                pageName: "Questions",
                title: "Questions",
                ignore: false,
                allowedPages: ['Questions', 'CreateQuestion', 'EditQuestion', 'ShowQuestion'],

            },{
                icon: "BriefcaseIcon",
                pageName: "Templates",
                title: "Questionnaire",
                ignore: false,
                allowedPages: ['Questionnaire', 'Templates', 'CreateTemplate', 'EditTemplate'],

            },
        ],
    }),
});
