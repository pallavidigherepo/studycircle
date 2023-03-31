import { createStore } from "vuex";

import blogModule from "@/store/modules/blogs/index.js";

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