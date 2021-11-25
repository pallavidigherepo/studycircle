import axios from "axios"

export default {
    // This action is used to fetch all the questions present in database

    async fetch(context, params) {
        const response = await axios.get('/api/v1/questions?page='+params.page+'&search='+params.keyword+'&field='+params.field+'&sort='+params.sort) ;

        if (response.status != 200) {
            const error = new Error('Failed to fetch questions')
            throw error;
        }
        
        context.commit('FETCH_QUESTIONS', response.data.questions);
        context.commit('LANGUAGES', response.data.languages);
        context.commit('ANSWERS', response.data.answers);
    },
    
    async create(context, question) {
        const response = await axios.post('/api/v1/questions', question) ;

        if (response.status != 200) {
            const error = new Error('Failed to create questions')
            throw response.data.message;
        }
        context.commit('CREATE_QUESTION', response.data);
    },

    // After permission submits the form, permission information must be updated in database.
    async update(context, question) {
        const response = await axios.put(`/api/v1/questions/${question.id}`, question);

        if (response.status != 200) {
            const error = new Error('Failed to update course.')
            throw error;
        }

        context.commit('UPDATE_QUESTION', response.data);
    },

    // This action is used to delete permission from serve.
    async delete(context, id) {
        const response = await axios.delete(`/api/v1/questions/${id}`);
        if (response.status != 200) {
            const error = new Error('Failed to delete course')
            throw error;
        }
        context.commit('DELETE_QUESTION', id);
    },
    // This action is used to fetch all the questions present in database

    async show(context, id) {
        const response = await axios.get('/api/v1/questions/show/'+id) ;

        if (response.status != 200) {
            const error = new Error('Failed to fetch questions')
            throw error;
        }
        
        context.commit('VIEW_QUESTION', response.data);
    },
};