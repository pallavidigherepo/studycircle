import { defineStore } from "pinia";

export const useSideMenuStore = defineStore("sideMenu", {
  state: () => ({
    menu: [
      {
        icon: "HomeIcon",
        pageName: "Dashboard",
        title: "Dashboard",
      },
      {
        icon: "UsersIcon",
        pageName: "UserManagement",
        title: "Users",
        subMenu: [
          {
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
          },
          {
            icon: "UsersIcon",
            pageName: "Users",
            title: "Users",
            ignore: false,
          },
        ],
      },
      {
        icon: "BoxIcon",
        pageName: "Courses",
        title: "Courses",
        subMenu: [
          {
            icon: "",
            pageName: "CourseTypes",
            title: "Course types",
            ignore: true,
          },
          {
            icon: "",
            pageName: "Courses",
            title: "Courses",
            ignore: true,
          },
          {
            icon: "",
            pageName: "Subjects",
            title: "Subjects",
            ignore: true,
          },
          {
            icon: "",
            pageName: "Chapters",
            title: "Chapters",
            ignore: true,
          },
        ],
      },
      "devider",
      {
        icon: "DatabaseIcon",
        pageName: "Questions",
        title: "Questions",
      },
    ],
  }),
});
