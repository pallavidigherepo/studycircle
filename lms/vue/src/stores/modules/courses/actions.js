import axios from "axios"

export default {
    // This action is used to fetch all the courses present in database

    async fetch(context, params) {
        const response = await axios.get('/api/v1/courses?page='+params.page+'&search='+params.keyword+'&field='+params.field+'&sort='+params.sort) ;

        if (response.status != 200) {
            const error = new Error('Failed to fetch courses')
            throw error;
        }
        
        context.commit('FETCH_COURSES', response.data.courses);
        context.commit('LANGUAGES', response.data.languages);
        context.commit('COURSE_TYPES', response.data.type_ids);
    },
    
    async create(context, course) {
        const response = await axios.post('/api/v1/courses', course) ;

        if (response.status != 200) {
            const error = new Error('Failed to create courses')
            throw response.data.message;
        }
        context.commit('CREATE_COURSE', response.data);
    },

    // After permission submits the form, permission information must be updated in database.
    async update(context, course) {
        const response = await axios.put(`/api/v1/courses/${course.id}`, course);

        if (response.status != 200) {
            const error = new Error('Failed to update course.')
            throw error;
        }

        context.commit('UPDATE_COURSE', response.data);
    },

    // This action is used to delete permission from serve.
    async delete(context, id) {
        const response = await axios.delete(`/api/v1/courses/${id}`);
        if (response.status != 200) {
            const error = new Error('Failed to delete course')
            throw error;
        }
        context.commit('DELETE_COURSE', id);
    },
};