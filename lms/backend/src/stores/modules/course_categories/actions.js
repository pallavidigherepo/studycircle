import axios from "axios"

export default {
    // This action is used to fetch all the permissions present in database
    async fetchCourseCategories(context) {
        const response = await axios.get('/api/v1/courses') ;

        if (response.status != 200) {
            const error = new Error('Failed to fetch course categories')
            throw error;
        }
        context.commit('FETCH_COURSE_CATEGORIES', response.data);
    },
    
    async create(context, courseCategory) {
        const response = await axios.post('/api/v1/courses', courseCategory) ;

        if (response.status != 200) {
            const error = new Error('Failed to create course category.')
            throw response.data.message;
        }
        context.commit('CREATE_COURSE_CATEGORY', response.data);
    },

    // This action is used to fetch only selected permission
    async editPermission(context, id) {
        const response = await axios.get(`/api/v1/courses/${id}/edit`);

        if (response.status != 200) {
            const error = new Error('Failed to fetch permission')
            throw error;
        }
        context.commit('EDIT_COURSE_CATEGORY', response.data.permission);
    },

    // After permission submits the form, permission information must be updated in database.
    async updatePermission(context, courseCategory) {
        const response = await axios.put(`/api/v1/courses/${courseCategory.id}`, courseCategory);

        if (response.status != 200) {
            const error = new Error('Failed to update course category.')
            throw error;
        }

        context.commit('UPDATE_COURSE_CATEGORY', courseCategory);
    },

    // This action is used to delete permission from serve.
    async deletePermission(context, id) {
        const response = await axios.delete(`/api/v1/courses/${id}`);
        if (response.status != 200) {
            const error = new Error('Failed to delete course category.')
            throw error;
        }
        context.commit('DELETE_COURSE_CATEGORY', id);
    },
};