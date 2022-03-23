import getters from "./getters.js"
import actions from "./actions.js"
import mutations from "./mutations.js"

export default {
    namespaced: true,
    state() {
        return {
            loading: false,
            permissions: [],
            permission: null,
            permission_count: 0,
            module_wise_permissions: [],
        }
    },
    actions,
    mutations,
    getters,
};