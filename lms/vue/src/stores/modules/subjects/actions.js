import axios from "axios"

export default {
    // This action is used to fetch all the subjects present in database

    async fetch(context, params) {
        const response = await axios.get('/api/v1/subjects?page='+params.page+'&search='+params.keyword+'&field='+params.field+'&sort='+params.sort) ;

        if (response.status != 200) {
            const error = new Error('Failed to fetch subjects')
            throw error;
        }
        
        context.commit('FETCH_SUBJECTS', response.data.subjects);
        context.commit('LANGUAGES', response.data.languages);
        context.commit('COURSES', response.data.courses);
    },
    
    async create(context, subject) {
        const response = await axios.post('/api/v1/subjects', subject) ;

        if (response.status != 200) {
            const error = new Error('Failed to create subjects')
            throw response.data.message;
        }
        context.commit('CREATE_SUBJECT', response.data);
    },

    // After permission submits the form, permission information must be updated in database.
    async update(context, subject) {
        const response = await axios.put(`/api/v1/subjects/${subject.id}`, subject);

        if (response.status != 200) {
            const error = new Error('Failed to update course.')
            throw error;
        }

        context.commit('UPDATE_SUBJECT', response.data);
    },

    // This action is used to delete permission from serve.
    async delete(context, id) {
        const response = await axios.delete(`/api/v1/subjects/${id}`);
        if (response.status != 200) {
            const error = new Error('Failed to delete course')
            throw error;
        }
        context.commit('DELETE_SUBJECT', id);
    },
    // This action is used to fetch all the subjects present in database

    async show(context, id) {
        const response = await axios.get('/api/v1/subjects/show/'+id) ;

        if (response.status != 200) {
            const error = new Error('Failed to fetch subjects')
            throw error;
        }
        
        context.commit('VIEW_SUBJECT', response.data);
    },
};