import { defineStore } from "pinia";

export const useSideMenuStore = defineStore("sideMenu", {
    state: () => ({
        menu: [
            {
                icon: "HomeIcon",
                pageName: "Dashboard",
                title: "Dashboard",
                allowedRoles: ['Super Admin', 'Director', 'Principal', 'Accountant']
            },
            {
                icon: "AwardIcon",
                pageName: "SettingManagement",
                title: "Academics",
                allowedRoles: ['Super Admin'],
                subMenu: [
                    /*{
                        icon: "BookmarkIcon",
                        pageName: "SettingIndex",
                        title: "Basic Information",
                        ignore: false,
                    },*/
                    {
                        icon: "SettingsIcon",
                        pageName: "MasterData",
                        title: "Master Data",
                        ignore: false,
                        subMenu: [
                            {
                                icon: "ListIcon",
                                pageName: "Batches",
                                title: "Batches",
                                ignore: false,
                            },
                            /*{
                                icon: "LayersIcon",
                                pageName: "Boards",
                                title: "Boards",
                                ignore: false,
                            },*/
                            {
                                icon: "ListIcon",
                                pageName: "Standards",
                                title: "Standards",
                                ignore: false,
                            },
                            {
                                icon: "BookIcon",
                                pageName: "Subjects",
                                title: "Subjects",
                                ignore: false,
                                allowedPages: ['Subjects', 'CreateSubject', 'EditSubject', 'ShowSubject', 'ShowChapter'],
                            },
                        ]
                    },
                ]
            },
            {
                icon: "SlidersIcon",
                pageName: "FeeManagement",
                title: "Fees",
                allowedRoles: ['Super Admin', 'Director', 'Principal', 'Accountant'],
                subMenu: [
                    {
                        icon: "TagIcon",
                        pageName: "Fees",
                        title: "Fees",
                    },
                    {
                        icon: "SettingsIcon",
                        pageName: "MasterData",
                        title: "Master Data",
                        ignore: false,
                        subMenu: [
                            {
                                icon: "ListIcon",
                                pageName: "FeeTypes",
                                title: "Fee Types",
                                ignore: false,
                            },
                            /*{
                                icon: "GitMergeIcon",
                                pageName: "FeeCategories",
                                title: "Fee Categories",
                                ignore: false,
                            },
                            {
                                icon: "ScissorsIcon",
                                pageName: "FeeDiscounts",
                                title: "Fee Discounts",
                                ignore: false,
                            },*/
                            {
                                icon: "LayersIcon",
                                pageName: "FeeStructures",
                                title: "Fee Structures",
                                ignore: false,
                            },
                            /*{
                                icon: "ListIcon",
                                pageName: "FeeTypes",
                                title: "FeeTypes",
                                ignore: false,
                            },*/
                        ]
                    },
                ]
            },
            {
                icon: "ActivityIcon",
                pageName: "SettingManagement",
                title: "Inquiries",
                allowedRoles: ['Super Admin', 'Director', 'Principal', 'Accountant'],
                subMenu: [
                    {
                        icon: "MessageSquareIcon",
                        pageName: "Inquiries",
                        title: "Inquiries",
                        ignore: false,
                        allowedPages: ['Inquiries', 'CreateInquiry', 'EditInquiry', 'ShowInquiry'],
                    },
                    {
                        icon: "SettingsIcon",
                        pageName: "InquirySettingData",
                        title: "Master Data",
                        ignore: false,
                        subMenu: [
                            {
                                icon: "LayersIcon",
                                pageName: "InquiryStatuses",
                                title: "Inquiry Status",
                                ignore: false,
                            },
                            {
                                icon: "LayersIcon",
                                pageName: "InquiryFollowupTypes",
                                title: "Inquiry Follow-Up Types",
                                ignore: false,
                            },
                            {
                                icon: "LayersIcon",
                                pageName: "InquirySources",
                                title: "Inquiry Sources",
                                ignore: false,
                            },
                        ]
                    },
                ]
            },
            'devider',
            {
                icon: "BriefcaseIcon",
                pageName: "Exams",
                title: "Exams",
                allowedRoles: ['Super Admin', 'Director', 'Principal', 'Teacher'],
                subMenu: [
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
                    {
                        icon: "SettingsIcon",
                        pageName: "MasterData",
                        title: "Master Data",
                        subMenu: [
                            {
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
                ],

            },
            'devider',
            {
                icon: "KeyIcon",
                pageName: "AuthManagement",
                title: "Auth Management",
                allowedRoles: ['Super Admin'],
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
                ],
            },
            {
                icon: "UsersIcon",
                pageName: "Students",
                title: "Users",
                ignore: false,
                allowedRoles: ['Super Admin', 'Director', 'Principal'],
                subMenu: [
                    {
                        icon: "UsersIcon",
                        pageName: "Users",
                        title: "Staffs",
                        ignore: false,
                        allowedPages: ['Users', 'CreateUser', 'EditUser', 'ShowUser'],
                        allowedRoles: ['Super Admin', 'Director', 'Principal'],
                    },
                    {
                        icon: "UsersIcon",
                        pageName: "Students",
                        title: "Students",
                        ignore: false,
                        allowedPages: ['Students', 'CreateStudent', 'EditStudent', 'ShowStudent'],
                        allowedRoles: ['Super Admin', 'Director', 'Principal', 'Teacher'],
                    },
                    {
                        icon: "UsersIcon",
                        pageName: "Parents",
                        title: "Parents",
                        ignore: false,
                        allowedPages: ['Parents', 'EditParent', 'ShowParent'],
                        allowedRoles: ['Super Admin', 'Director', 'Principal'],
                    },
                ],
            },
            {
                icon: "SettingsIcon",
                pageName: "SettingIndex",
                title: "Control Panel",
                ignore: false,
                allowedPages: ['SettingIndex'],
                //allowedRoles: ['Super Admin', 'Director', 'Principal', 'Accountant'],
            },
        ],
    }),
});
