const state = () => {
  return {
    menu: [
      {
        icon: 'ActivityIcon',
        pageName: 'dashboard',
        title: 'Dashboard',
      },
      {
        icon: 'UsersIcon',
        pageName: 'users',
        title: 'User Management',
        subMenu: [
          {
            icon: 'HomeIcon',
            pageName: 'permissions',
            title: 'Permissions'
          },
          {
            icon: 'HomeIcon',
            pageName: 'roles',
            title: 'Roles'
          },
          {
            icon: 'HomeIcon',
            pageName: 'users',
            title: 'Users'
          }
        ]
      },
      {
        icon: 'BoxIcon',
        pageName: 'courses',
        title: 'Course Management',
        subMenu: [
          {
            icon: 'HomeIcon',
            pageName: 'courseType',
            title: 'Course Types'
          },
          {
            icon: 'HomeIcon',
            pageName: 'courses',
            title: 'Courses'
          },
          {
            icon: 'HomeIcon',
            pageName: 'subjects',
            title: 'Subjects',
          },
          {
            icon: 'HomeIcon',
            pageName: 'chapters',
            title: 'Chapters',
          },
          /*{
            icon: 'HomeIcon',
            pageName: 'subjectCreate',
            title: 'Subject Create',
            ignore: true
          },*/
          /*{
            icon: 'HomeIcon',
            pageName: 'roles',
            title: 'Roles'
          },
          {
            icon: 'HomeIcon',
            pageName: 'users',
            title: 'Users'
          }*/
        ]
      },      
      {
        icon: 'ActivityIcon',
        pageName: 'questions',
        title: 'Questions',
      },
    ]
  }
}

// getters
const getters = {
  menu: state => state.menu
}

// actions
const actions = {}

// mutations
const mutations = {}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
