import { type Menu } from "@/stores/menu";
import _ from 'lodash';
import { computed, ref } from "vue";
/**
 * NOTE: We have made changes according to the role of logged in user. 
 * 
 * We have maintained if-else according to the name of role. 
 * Like: For Owner user role, super-admin will be in corresponding if.
 */
let user = JSON.parse(localStorage.getItem("USER") ?? "{}");

const userRole = ref('');
if (user.roles) {
  userRole.value = _.kebabCase(user.roles[0].name);
}


let menu: Array<Menu | "divider"> = [
    {
      icon: "Sidebar",
      pageName: "simple-menu",
      title: "Simple Menu",
    },
  ];

if (userRole.value == 'super-admin') {
    menu = [
        {
          icon: "Home",
          pageName: "dashboard",
          title: "Dashboard",
        },
        "divider",
        {
          icon: "Video",
          pageName: "meetings",
          title: "Meeting",
        },
        {
          icon: "List",
          pageName: "leave-request",
          title: "Leave Request",
        },
        {
          icon: "Calendar",
          pageName: "events",
          title: "Events",
        },
        {
          icon: "Volume2",
          pageName: "notice-board",
          title: "Notice Board",
        },
        {
          icon: "Calendar",
          pageName: "calendar",
          title: "Holidays",
        },
        {
          icon: "Flag",
          pageName: "reports",
          title: "Report",
        },
        {
          icon: "MessagesSquare",
          pageName: "calendar",
          title: "Feedbacks",
        },
        "divider",
        {
          icon: "GraduationCap",
          pageName: "academics",
          title: "Academics",
          subMenu: [
            {
              icon: "BoxIcon",
              pageName: "course-types",
              title: "Course Types",
            },
            {
              icon: "BriefcaseIcon",
              pageName: "courses",
              title: "Courses",
            },
            {
              icon: "ListIcon",
              pageName: "batches",
              title: "Batches",
              
            },
            {
              icon: "ListIcon",
              pageName: "standards",
              title: "Standards",
            },
            {
              icon: "BookIcon",
              pageName: "Subjects",
              title: "Subjects",
            },
            {
              icon: "Banknote",
              pageName: "fee-management",
              title: "Fee",
              subMenu: [
                {
                  icon: "ListIcon",
                  pageName: "fee-types",
                  title: "Fee Types",
                },
                {
                  icon: "LayersIcon",
                  pageName: "fee-structures",
                  title: "Fee Structure",
                },
              ],
            },
            {
              icon: "ActivityIcon",
              pageName: "SettingManagement",
              title: "Inquiry",
              subMenu: [
                {
                  icon: "LayersIcon",
                  pageName: "inquiry-followup-types",
                  title: "Inquiry Sources",
                },
                {
                  icon: "LayersIcon",
                  pageName: "inquiry-statuses",
                  title: "Inquiry Status",
                },
                {
                  icon: "LayersIcon",
                  pageName: "transaction-detail",
                  title: "Inquiry Follow-up Types",
                },
              ],
            },
          ],
        },
        {
          icon: "SettingsIcon",
          pageName: "SettingIndex",
          title: "Control Panel",
        },
        {
          icon: "BadgeIndianRupee",
          pageName: "inbox",
          title: "Fees",
        },
        {
          icon: "Inbox",
          pageName: "inbox",
          title: "Inquiries",
        },
        
        {
          icon: "KeyIcon",
          pageName: "auth-management",
          title: "Auth Management",
          subMenu: [
            {
              icon: "SettingsIcon",
              pageName: "roles",
              title: "Roles",
            },
            {
              icon: "KeyIcon",
              pageName: "permissions",
              title: "Permissions",
            },
          ],
        },        
        "divider",
        {
          icon: "UsersRoundIcon",
          pageName: "staffs",
          title: "Executives",
        },
        {
          icon: "UsersIcon",
          pageName: "students",
          title: "Students",
        },
        {
          icon: "UsersIcon",
          pageName: "parents",
          title: "Parents",
        },
        "divider",
        {
          icon: "MessageSquare",
          pageName: "chat",
          title: "Exams",
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
                },
                {
                    icon: "ListIcon",
                    pageName: "Templates",
                    title: "Question Paper Formats",
                },
                {
                    icon: "ArchiveIcon",
                    pageName: "GeneratedQuestionPapers",
                    title: "Generated Question Papers",
                },
            ]
          },
        ],
        },
        "divider",        
      ];
} else if (userRole.value == 'director') {

} else if (userRole.value == 'principle') {

} else if (userRole.value == 'teacher') {

} else if (userRole.value == 'clerk') {

} else if (userRole.value == 'admin') {

} else if (userRole.value == 'accountant') {

} else if (userRole.value == 'peon') {

} else if (userRole.value == 'student') {

} else if (userRole.value == 'parent') {

} else {
  menu = [];
}

export default menu;