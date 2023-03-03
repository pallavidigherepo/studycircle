export default {
    FETCH_COURSE_CATEGORIES(state, payload) {
        state.courseCategories = payload;
    },
    CREATE_COURSE_CATEGORY(state, courseCategory)
    {
        state.courseCategories.unshift(courseCategory.courseCategory)
    },
    EDIT_COURSE_CATEGORY(state, payload) {
        state.courseCategory = payload;
    },

    DELETE_COURSE_CATEGORY(state, id) {
        let index = state.courseCategories.findIndex(item => item.id === id)
        state.courseCategories.splice(index, 1)
    },

    UPDATE_COURSE_CATEGORY(state, courseCategory)
    {
        let index = state.courseCategories.findIndex(item => item.id === courseCategory.id);
        state.courseCategories[index] = courseCategory;
    },
};