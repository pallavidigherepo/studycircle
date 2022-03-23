import actions from './actions.js';
import getters from './getters';
import mutations from './mutations';
export default {
    namespaced: true,
    state() {
        return {
            questions: [],
            question: null,
            languages: [],
        }
    },
    actions,
    getters,
    mutations
};