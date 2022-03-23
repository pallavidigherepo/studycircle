import actions from './actions.js';
import getters from './getters';
import mutations from './mutations';
export default {
    namespaced: true,
    state() {
        return {
            chapters: [],
            chapter: null,
            languages: [],
            subjects: [],
        }
    },
    actions,
    getters,
    mutations
};