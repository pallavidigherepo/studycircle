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
import topicModule from './modules/topics/index.js';
import questionModule from './modules/questions/index.js';
import studentModule from './modules/students/index.js';
import templateModule from './modules/templates/index';
import generateQuestionModule from './modules/generate_questions/index';
import batchModule from './modules/batches/index';
import studentPaperModule from './modules/student_papers/index.js';
import inquiryModule from "./modules/inquiries/index.js";
import inquiryStatusModule from "./modules/inquiry_statuses/index.js";
import inquirySourcesModule from "./modules/inquiry_sources/index.js";
import inquiryFollowUpTypeModule from "./modules/inquiry_followup_types/index.js";

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
        topics: topicModule,
        questions: questionModule,
        students: studentModule,
        templates: templateModule,
        generated_questions: generateQuestionModule,
        batches: batchModule,
        inquiries: inquiryModule,
        inquiry_followup_types: inquiryFollowUpTypeModule,
        inquiry_sources: inquirySourcesModule,
        inquiry_statuses: inquiryStatusModule,
        /*languages: languageModule,
         */
    },

    state: {
        loading: false,
        languages: [],
        courseList: [],
        courseTypeList: [],
        subjectList: [],
        boardList: [],
        standardList: [],
        difficultyList: [],
        typeList: [],
        typeListParagraph: [],
    },
    getters: {
        languages(state) {
            return state.languages;
        },
        courseList(state) {
            return state.courseList;
        },
        courseTypeList(state) {
            return state.courseTypeList;
        },
        listSubjects(state) {
            return state.subjectList;
        },
        listBoards(state) {
            return state.boardList;
        },
        listBatches(state) {
            return state.batchList;
        },
        listStandards(state) {
            return state.standardList;
        },
        listDifficultyLevel(state) {
            return state.difficultyList;
        },
        listType(state) {
            return state.typeList;
        },
        listTypeParagraph(state) {
            return state.typeListParagraph;
        }
    },
    actions: {
        async importMe({ commit }, formData) {
            return await axiosClient
                .post(`/imports`, formData, {
                    headers: { 'content-type': 'multipart/form-data' }
                })
        },
        async exportMe({ commit }, payload) {
            return await axiosClient
                .post(`/exports/index`, { data: payload }, { responseType: "blob" })
        },
        async downloadDemo({ commit }, payload) {
            return await axiosClient
                .post(`/exports/demo`, { data: payload }, { responseType: "blob" })
        },
        async listLanguages({ commit }) {
            return await axiosClient
                .get('/languages')
                .then(({ data }) => {
                    commit('SET_LANGUAGES', data)
                    return data;
                })
        },
        async listCourses({ commit }) {
            return await axiosClient
                .get('/courses_list')
                .then(({ data }) => {
                    commit('SET_COURSES_LIST', data)
                    return data;
                })
        },
        async listCourseTypes({ commit }) {
            return await axiosClient
                .get('/course_type_list')
                .then(({ data }) => {
                    commit('SET_COURSES_TYPES_LIST', data)
                    return data;
                })
        },
        async listSubjects({ commit }) {
            return await axiosClient
                .get('/subject_list')
                .then(({ data }) => {
                    commit('SET_SUBJECTS_LIST', data)
                    return data;
                })
        },
        async listBoard({ commit }) {
            return await axiosClient
                .get('/board_list')
                .then(({ data }) => {
                    commit('SET_BOARD_LIST', data)
                    return data;
                })
        },
        async listBatch({ commit }) {
            return await axiosClient
                .get('/batch_list')
                .then(({ data }) => {
                    commit('SET_BATCH_LIST', data)
                    return data;
                })
        },
        async listStandard({ commit }) {
            return await axiosClient
                .get('/standard_list')
                .then(({ data }) => {
                    commit('SET_STANDARD_LIST', data)
                    return data;
                })
        },
        async listDifficultyLevel({ commit }) {
            return await axiosClient
                .get('/difficulty_level_list')
                .then(({ data }) => {
                    commit('SET_DIFFICULTY_LEVEL_LIST', data)
                    return data;
                })
        },
        async listType({ commit }) {
            return await axiosClient
                .get('/type_list')
                .then(({ data }) => {
                    commit('SET_TYPE_LIST', data)
                    return data;
                })
        },
        async listTypeParagraph({ commit }) {
            return await axiosClient
                .get('/type_list_paragraph')
                .then(({ data }) => {
                    commit('SET_TYPE_LIST_PARAGRAPH', data)
                    return data;
                })
        }
    },
    mutations: {
        SET_LANGUAGES(state, payload) {
            state.languages = payload;
        },
        SET_COURSES_LIST(state, payload) {
            state.courseList = payload;
        },
        SET_COURSES_TYPES_LIST(state, payload) {
            state.courseTypeList = payload;
        },
        SET_SUBJECTS_LIST(state, payload) {
            state.subjectList = payload;
        },
        SET_BOARD_LIST(state, payload) {
            state.boardList = payload;
        },
        SET_BATCH_LIST(state, payload) {
            state.batchList = payload;
        },
        SET_STANDARD_LIST(state, payload) {
            state.standardList = payload;
        },
        SET_DIFFICULTY_LEVEL_LIST(state, payload) {
            state.difficultyList = payload;
        },
        SET_TYPE_LIST(state, payload) {
            state.typeList = payload;
        },
        SET_TYPE_LIST_PARAGRAPH(state, payload) {
            state.typeListParagraph = payload;
        },

    },
});

export default store;
