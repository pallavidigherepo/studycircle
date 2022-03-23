import { createStore } from "vuex";
import axiosClient from "@/axios";

import authModule from './modules/auth/index.js';
import permissionModule from './modules/permissions/index.js';

const store = createStore({
    modules: {
        auth: authModule,
        permissions: permissionModule,
        /*users: userModule,
        
        roles: roleModule,
        coursesType: coursesTypeModule,
        courses: coursesModule,
        subjects: subjectModule,
        chapters: chapterModule,
        languages: languageModule,
        questions: questionModule*/
    },
        
    state: {
        loading: false
    },
    getters: {},
    actions: {},
    mutations: {},
});

export default store;