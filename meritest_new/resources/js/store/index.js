import { createStore } from "vuex";

import blogModule from "./modules/blogs"; 

const store = createStore({
    modules: {
        blogs: blogModule
    },
    states: {},
    actions: {},
    getters: {},
    mutations: {}
});

export default store;