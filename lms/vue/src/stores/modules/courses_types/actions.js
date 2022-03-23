import axios from "axios"

export default {
    // This action is used to fetch all the permissions present in database
    async fetch(context, params) {
        const response = await axios.get('/api/v1/courses_type?page='+params.page+'&search='+params.keyword+'&field='+params.field+'&sort='+params.sort) ;

        if (response.status != 200) {
            const error = new Error('Failed to fetch course type')
            throw error;
        }

        context.commit('FETCH_COURSES_TYPES', response.data);
    },
    
    async create(context, coursesType) {
        const response = await axios.post('/api/v1/courses_type', coursesType) ;

        if (response.status != 200) {
            const error = new Error('Failed to create course type')
            throw response.data.message;
        }
        context.commit('CREATE_COURSES_TYPE', response.data);
    },

    // This action is used to fetch only selected permission
    async edit(context, id) {
        const response = await axios.get(`/api/v1/courses_type/${id}/edit`);

        if (response.status != 200) {
            const error = new Error('Failed to fetch permission')
            throw error;
        }
        context.commit('EDIT_COURSES_TYPE', response.data.permission);
    },

    // After coursesType submits the form, coursesType information must be updated in database.
    async update(context, coursesType) {
        const response = await axios.put(`/api/v1/courses_type/${coursesType.id}`, coursesType);

        if (response.status != 200) {
            const error = new Error('Failed to update coursesType')
            throw error;
        }
        context.commit('UPDATE_COURSES_TYPE', response.data.coursesType);
    },

    // This action is used to delete coursesType from serve.
    async delete(context, id) {
        const response = await axios.delete(`/api/v1/courses_type/${id}`);
        if (response.status != 200) {
            const error = new Error('Failed to delete courses type')
            throw error;
        }
        context.commit('DELETE_COURSES_TYPE', id);
    },


    // This action is used to get list of all the course categories
    async list(context) {
        //api/v1/courses_type/list
        const resposnse = await axios.get('/api/v1/courses_type/list');
        if (resposnse.status !== 200) {
            const error = new Error('Failed to get list of cours types')
            throw error;
        }
        context.commit('LIST_COURSES_TYPE', resposnse.data);
    }
};