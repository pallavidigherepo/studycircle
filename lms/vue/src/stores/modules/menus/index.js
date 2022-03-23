import getters from "./getters.js"
import actions from "./actions.js"
import mutations from "./mutations.js"

export default {
    namespaced: true,
    state() {
        return {
            sidemenus: [
                {
                    title: 'Dashboard',
                    showInSideMenu: true,
                    path: '/',
                    pageName: 'dashboard',
                    icon: 'HomeIcon',
                },
                {
                    title: 'Institutes',
                    showInSideMenu: true,
                    path: '/institutes',
                    icon: 'ActivityIcon',  
                    pageName: 'institutes',
                }
            ],
            activeMenu: null,
        }
    },
    actions,
    mutations,
    getters,
};