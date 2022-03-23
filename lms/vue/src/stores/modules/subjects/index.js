import actions from './actions.js';
import getters from './getters';
import mutations from './mutations';
export default {
    namespaced: true,
    state() {
        return {
            subjects: [],
            subject: null,
            languages: [],
            courses: [],
        }
    },
    actions,
    getters,
    mutations
};