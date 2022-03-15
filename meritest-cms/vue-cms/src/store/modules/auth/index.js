import getters from "./getters.js"
import actions from "./actions.js"
import mutations from "./mutations.js"

export default {
    namespaced: true,
    state() {
        return {
            user: {
                data: {},
                token: sessionStorage.getItem("TOKEN"),
            }
        }
    },
    actions,
    mutations,
    getters,
};