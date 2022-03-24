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
    actions: {
        async importMe({commit}, formData) {
            return await axiosClient
                .post(`/imports`, formData, {
                    headers: { 'content-type': 'multipart/form-data' }
                })
        },
        async exportMe({ commit }, payload) {
            return await axiosClient
                .post(`/exports/index`, {data: payload}, { responseType: "blob" })
        }
    },
    mutations: {},
});

export default store;