import { createStore } from "vuex";
import axiosClient from "@/axios";

import authModule from './modules/auth/index.js';
import blogModule from './modules/blogs/index.js';

const store = createStore({
    state: {
        loading: false
    },
    actions: {},
    mutations: {},
    getters: {},
    modules: {
        auth: authModule,
        blogs: blogModule,
    }
});

export default store;