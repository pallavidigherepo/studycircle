import { createStore } from "vuex";
import axiosClient from "@/axios";

import authModule from './modules/auth/index.js';
import permissionModule from './modules/permissions/index.js';
import roleModule from './modules/roles/index.js';
import userModule from './modules/users/index.js';
import coursesTypeModule from './modules/courses_types/index.js';
import coursesModule from './modules/courses/index.js';
import subjectModule from './modules/subjects/index.js';
import chapterModule from './modules/chapters/index.js';

const store = createStore({
    modules: {
        auth: authModule,
        permissions: permissionModule,
        roles: roleModule,
        users: userModule,
        
        coursesTypes: coursesTypeModule,
        courses: coursesModule,
        subjects: subjectModule,
        chapters: chapterModule,
        /*languages: languageModule,
        questions: questionModule*/
    },

    state: {
        loading: false,
        languages: [],
        courseTypeList: [],
    },
    getters: {
        languages(state) {
            return state.languages;
        },
        courseTypeList(state) {
            return state.courseTypeList;
        }
    },
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
        },
        async listLanguages({commit}) {
            return await axiosClient
                .get('/languages')
                .then(({data}) => {
                    commit('SET_LANGUAGES', data)
                    return data;
                })
        },
        async listCourseTypes({commit}) {
            return await axiosClient
                .get('/course_type_list')
                .then(({data}) => {
                    commit('SET_COURSES_TYPES_LIST', data)
                    return data;
                })
        }
    },
    mutations: {
        SET_LANGUAGES(state, payload) {
            state.languages = payload;
        },
        SET_COURSES_TYPES_LIST(state, payload) {
            state.courseTypeList = payload;
        },
        

    },
});

export default store;