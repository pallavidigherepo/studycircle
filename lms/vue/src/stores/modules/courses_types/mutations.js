export default {
    FETCH_COURSES_TYPES(state, payload) {
        state.coursesTypes = payload;
    },
    
    CREATE_COURSES_TYPE(state, coursesType)
    {
        state.coursesTypes.data.unshift(coursesType.coursesType)
    },
    EDIT_COURSES_TYPE(state, payload) {
        state.coursesType = payload;
    },

    DELETE_COURSES_TYPE(state, id) {
        let index = state.coursesTypes.data.findIndex(item => item.id === id)
        state.coursesTypes.data.splice(index, 1)
    },

    UPDATE_COURSES_TYPE(state, courseType)
    {
        let index = state.coursesTypes.data.findIndex(item => item.id === courseType.id);
        state.coursesTypes.data[index] = courseType;
    },

    LIST_COURSES_TYPE(state, payload) {
        state.courseTypeList = payload;
    }
};