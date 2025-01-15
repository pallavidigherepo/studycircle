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
          icon: "GraduationCap",
          pageName: "academics",
          title: "Academics",
          subMenu: [
            {
              icon: "BoxIcon",
              pageName: "Course-Types",
              title: "Course Types",
            },
            {
              icon: "BriefcaseIcon",
              pageName: "Courses",
              title: "Courses",
            },
            {
              icon: "ListIcon",
              pageName: "Batches",
              title: "Batches",
              
            },
            {
              icon: "ListIcon",
              pageName: "Standards",
              title: "Standards",
            },
            {
              icon: "BookIcon",
              pageName: "Subjects",
              title: "Subjects",
            },
            {
              icon: "BoxIcon",
              pageName: "Attendance",
              title: "Attendance",
            },
            {
              icon: "Banknote",
              pageName: "fee-management",
              title: "Fee",
              subMenu: [
                {
                  icon: "ListIcon",
                  pageName: "FeeTypes",
                  title: "Fee Types",
                },
                {
                  icon: "LayersIcon",
                  pageName: "FeeStructures",
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
                  pageName: "InquirySources",
                  title: "Inquiry Sources",
                },
                {
                  icon: "LayersIcon",
                  pageName: "InquiryStatuses",
                  title: "Inquiry Status",
                },
                {
                  icon: "LayersIcon",
                  pageName: "InquiryFollowupTypes",
                  title: "Inquiry Follow-up Types",
                },
              ],
            },
          ],
        },
        {
          icon: "SettingsIcon",
          pageName: "Settings",
          title: "Control Panel",
        },
        {
          icon: "BadgeIndianRupee",
          pageName: "Fees",
          title: "Fees",
        },
        {
          icon: "Inbox",
          pageName: "Inquiries",
          title: "Inquiries",
        },
        
        {
          icon: "KeyIcon",
          pageName: "auth-management",
          title: "Auth Management",
          subMenu: [
            {
              icon: "SettingsIcon",
              pageName: "Roles",
              title: "Roles",
            },
            {
              icon: "KeyIcon",
              pageName: "Permissions",
              title: "Permissions",
            },
          ],
        },
        {
          icon: "UsersRoundIcon",
          pageName: "Users",
          title: "Users",
          subMenu: [
            {
              icon: "UsersRoundIcon",
              pageName: "Users",
              title: "Executives",
            },
            {
              icon: "UsersIcon",
              pageName: "Students",
              title: "Students",
            },
            {
              icon: "UsersIcon",
              pageName: "Parents",
              title: "Parents",
            },            
          ]
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
  menu = [
    {
      icon: "Home",
      pageName: "dashboard",
      title: "Dashboard",
    },
    "divider",
    {
      icon: "GraduationCap",
      pageName: "academics",
      title: "Academics",
      subMenu: [
        {
          icon: "BoxIcon",
          pageName: "Course-Types",
          title: "Course Types",
        },
        {
          icon: "BriefcaseIcon",
          pageName: "Courses",
          title: "Courses",
        },
        {
          icon: "ListIcon",
          pageName: "Batches",
          title: "Batches",
          
        },
        {
          icon: "ListIcon",
          pageName: "Standards",
          title: "Standards",
        },
        {
          icon: "BookIcon",
          pageName: "Subjects",
          title: "Subjects",
        },
        {
          icon: "BoxIcon",
          pageName: "Attendance",
          title: "Attendance",
        },
        {
          icon: "Banknote",
          pageName: "fee-management",
          title: "Fee",
          subMenu: [
            {
              icon: "ListIcon",
              pageName: "FeeTypes",
              title: "Fee Types",
            },
            {
              icon: "LayersIcon",
              pageName: "FeeStructures",
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
              pageName: "InquirySources",
              title: "Inquiry Sources",
            },
            {
              icon: "LayersIcon",
              pageName: "InquiryStatuses",
              title: "Inquiry Status",
            },
            {
              icon: "LayersIcon",
              pageName: "InquiryFollowupTypes",
              title: "Inquiry Follow-up Types",
            },
          ],
        },
      ],
    },
    {
      icon: "BadgeIndianRupee",
      pageName: "Fees",
      title: "Fees",
    },
    {
      icon: "Inbox",
      pageName: "Inquiries",
      title: "Inquiries",
    },
    
    {
      icon: "KeyIcon",
      pageName: "auth-management",
      title: "Auth Management",
      subMenu: [
        {
          icon: "SettingsIcon",
          pageName: "Roles",
          title: "Roles",
        },
        {
          icon: "KeyIcon",
          pageName: "Permissions",
          title: "Permissions",
        },
      ],
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
      icon: "UsersRoundIcon",
      pageName: "Users",
      title: "Users",
      subMenu: [
        {
          icon: "UsersRoundIcon",
          pageName: "Users",
          title: "Executives",
        },
        {
          icon: "UsersIcon",
          pageName: "Students",
          title: "Students",
        },
        {
          icon: "UsersIcon",
          pageName: "Parents",
          title: "Parents",
        },    
      ]
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

} else if (userRole.value == 'principle') {
  menu = [
    {
      icon: "Home",
      pageName: "dashboard",
      title: "Dashboard",
    },
    "divider",
    {
      icon: "GraduationCap",
      pageName: "academics",
      title: "Academics",
      subMenu: [
        {
          icon: "BoxIcon",
          pageName: "Course-Types",
          title: "Course Types",
        },
        {
          icon: "BriefcaseIcon",
          pageName: "Courses",
          title: "Courses",
        },
        {
          icon: "ListIcon",
          pageName: "Batches",
          title: "Batches",
          
        },
        {
          icon: "ListIcon",
          pageName: "Standards",
          title: "Standards",
        },
        {
          icon: "BookIcon",
          pageName: "Subjects",
          title: "Subjects",
        },
        {
          icon: "BoxIcon",
          pageName: "Attendance",
          title: "Attendance",
        },
        {
          icon: "Banknote",
          pageName: "fee-management",
          title: "Fee",
          subMenu: [
            {
              icon: "ListIcon",
              pageName: "FeeTypes",
              title: "Fee Types",
            },
            {
              icon: "LayersIcon",
              pageName: "FeeStructures",
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
              pageName: "InquirySources",
              title: "Inquiry Sources",
            },
            {
              icon: "LayersIcon",
              pageName: "InquiryStatuses",
              title: "Inquiry Status",
            },
            {
              icon: "LayersIcon",
              pageName: "InquiryFollowupTypes",
              title: "Inquiry Follow-up Types",
            },
          ],
        },
      ],
    },
    {
      icon: "BadgeIndianRupee",
      pageName: "Fees",
      title: "Fees",
    },
    {
      icon: "Inbox",
      pageName: "Inquiries",
      title: "Inquiries",
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
      icon: "UsersRoundIcon",
      pageName: "Users",
      title: "Executives",
    },
    {
      icon: "UsersIcon",
      pageName: "Students",
      title: "Students",
    },
    {
      icon: "UsersIcon",
      pageName: "Parents",
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
} else if (userRole.value == 'teacher') {
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
    {
      icon: "UsersIcon",
      pageName: "Students",
      title: "Students",
    },
    {
      icon: "UsersIcon",
      pageName: "Parents",
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
} else if (userRole.value == 'clerk') {
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
            
  ];
} else if (userRole.value == 'admin') {
  menu = [
    {
      icon: "Home",
      pageName: "dashboard",
      title: "Dashboard",
    },
    "divider",
    {
      icon: "GraduationCap",
      pageName: "academics",
      title: "Academics",
      subMenu: [
        {
          icon: "BoxIcon",
          pageName: "Course-Types",
          title: "Course Types",
        },
        {
          icon: "BriefcaseIcon",
          pageName: "Courses",
          title: "Courses",
        },
        {
          icon: "ListIcon",
          pageName: "Batches",
          title: "Batches",
          
        },
        {
          icon: "ListIcon",
          pageName: "Standards",
          title: "Standards",
        },
        {
          icon: "BookIcon",
          pageName: "Subjects",
          title: "Subjects",
        },
        {
          icon: "BoxIcon",
          pageName: "Attendance",
          title: "Attendance",
        },
        {
          icon: "Banknote",
          pageName: "fee-management",
          title: "Fee",
          subMenu: [
            {
              icon: "ListIcon",
              pageName: "FeeTypes",
              title: "Fee Types",
            },
            {
              icon: "LayersIcon",
              pageName: "FeeStructures",
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
              pageName: "InquirySources",
              title: "Inquiry Sources",
            },
            {
              icon: "LayersIcon",
              pageName: "InquiryStatuses",
              title: "Inquiry Status",
            },
            {
              icon: "LayersIcon",
              pageName: "InquiryFollowupTypes",
              title: "Inquiry Follow-up Types",
            },
          ],
        },
      ],
    },
    {
      icon: "BadgeIndianRupee",
      pageName: "Fees",
      title: "Fees",
    },
    {
      icon: "Inbox",
      pageName: "Inquiries",
      title: "Inquiries",
    },
    
    {
      icon: "KeyIcon",
      pageName: "auth-management",
      title: "Auth Management",
      subMenu: [
        {
          icon: "SettingsIcon",
          pageName: "Roles",
          title: "Roles",
        },
        {
          icon: "KeyIcon",
          pageName: "Permissions",
          title: "Permissions",
        },
      ],
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
      icon: "UsersRoundIcon",
      pageName: "Users",
      title: "Executives",
    },
    {
      icon: "UsersIcon",
      pageName: "Students",
      title: "Students",
    },
    {
      icon: "UsersIcon",
      pageName: "Parents",
      title: "Parents",
    },       
  ];
} else if (userRole.value == 'accountant') {
  menu = [
    {
      icon: "Home",
      pageName: "dashboard",
      title: "Dashboard",
    },
    "divider",
    {
      icon: "GraduationCap",
      pageName: "academics",
      title: "Academics",
      subMenu: [
        {
          icon: "BoxIcon",
          pageName: "Course-Types",
          title: "Course Types",
        },
        {
          icon: "BriefcaseIcon",
          pageName: "Courses",
          title: "Courses",
        },
        {
          icon: "ListIcon",
          pageName: "Batches",
          title: "Batches",
          
        },
        {
          icon: "ListIcon",
          pageName: "Standards",
          title: "Standards",
        },
        {
          icon: "BookIcon",
          pageName: "Subjects",
          title: "Subjects",
        },
        {
          icon: "BoxIcon",
          pageName: "Attendance",
          title: "Attendance",
        },
        {
          icon: "Banknote",
          pageName: "fee-management",
          title: "Fee",
          subMenu: [
            {
              icon: "ListIcon",
              pageName: "FeeTypes",
              title: "Fee Types",
            },
            {
              icon: "LayersIcon",
              pageName: "FeeStructures",
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
              pageName: "InquirySources",
              title: "Inquiry Sources",
            },
            {
              icon: "LayersIcon",
              pageName: "InquiryStatuses",
              title: "Inquiry Status",
            },
            {
              icon: "LayersIcon",
              pageName: "InquiryFollowupTypes",
              title: "Inquiry Follow-up Types",
            },
          ],
        },
      ],
    },
    {
      icon: "BadgeIndianRupee",
      pageName: "Fees",
      title: "Fees",
    },
    {
      icon: "Inbox",
      pageName: "Inquiries",
      title: "Inquiries",
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
      icon: "UsersRoundIcon",
      pageName: "Users",
      title: "Executives",
    },
    {
      icon: "UsersIcon",
      pageName: "Students",
      title: "Students",
    },
    {
      icon: "UsersIcon",
      pageName: "Parents",
      title: "Parents",
    },        
  ];
} else if (userRole.value == 'peon') {
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
  ];
} else if (userRole.value == 'student') {
  menu = [
    {
      icon: "Home",
      pageName: "dashboard",
      title: "Dashboard",
    },
    "divider",
    
    {
      icon: "BadgeIndianRupee",
      pageName: "Fees",
      title: "Fees",
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
  ];
} else if (userRole.value == 'parent') {
  menu = [
    {
      icon: "Home",
      pageName: "dashboard",
      title: "Dashboard",
    },
    "divider",
    {
      icon: "GraduationCap",
      pageName: "academics",
      title: "Academics",
      subMenu: [
        {
          icon: "BoxIcon",
          pageName: "Course-Types",
          title: "Course Types",
        },
        {
          icon: "BriefcaseIcon",
          pageName: "Courses",
          title: "Courses",
        },
        {
          icon: "ListIcon",
          pageName: "Batches",
          title: "Batches",
          
        },
        {
          icon: "ListIcon",
          pageName: "Standards",
          title: "Standards",
        },
        {
          icon: "BookIcon",
          pageName: "Subjects",
          title: "Subjects",
        },
        {
          icon: "BoxIcon",
          pageName: "Attendance",
          title: "Attendance",
        },
        {
          icon: "Banknote",
          pageName: "fee-management",
          title: "Fee",
          subMenu: [
            {
              icon: "ListIcon",
              pageName: "FeeTypes",
              title: "Fee Types",
            },
            {
              icon: "LayersIcon",
              pageName: "FeeStructures",
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
              pageName: "InquirySources",
              title: "Inquiry Sources",
            },
            {
              icon: "LayersIcon",
              pageName: "InquiryStatuses",
              title: "Inquiry Status",
            },
            {
              icon: "LayersIcon",
              pageName: "InquiryFollowupTypes",
              title: "Inquiry Follow-up Types",
            },
          ],
        },
      ],
    },
    {
      icon: "SettingsIcon",
      pageName: "Settings",
      title: "Control Panel",
    },
    {
      icon: "BadgeIndianRupee",
      pageName: "Fees",
      title: "Fees",
    },
    "divider",
    {
      icon: "Video",
      pageName: "meetings",
      title: "Meeting",
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
  ];
} else {
  menu = [];
}

export default menu;