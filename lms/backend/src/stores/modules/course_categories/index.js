import getters from "./getters.js"
import actions from "./actions.js"
import mutations from "./mutations.js"

export default {
    namespaced: true,
    state() {
        return {
            courseCategories: [],
            courseCategory: null,
        }
    },
    actions,
    mutations,
    getters,
};