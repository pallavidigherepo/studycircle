import axios from "axios"

export default {
    // This action is used to fetch all the chapters present in database

    async fetch(context, params) {
        const response = await axios.get('/api/v1/chapters?page='+params.page+'&search='+params.keyword+'&field='+params.field+'&sort='+params.sort) ;

        if (response.status != 200) {
            const error = new Error('Failed to fetch chapters')
            throw error;
        }
        
        context.commit('FETCH_CHAPTERS', response.data.chapters);
        context.commit('LANGUAGES', response.data.languages);
        context.commit('SUBJECTS', response.data.subjects);
    },
    
    async edit(context, id) {
        const response = await axios.get('/api/v1/chapters/'+id+'/edit') ;

        if (response.status != 200) {
            const error = new Error('Failed to create chapters')
            throw response.data.message;
        }
        context.commit('EDIT_CHAPTER', response.data);
    },
    
    async create(context, chapter) {
        const response = await axios.post('/api/v1/chapters', chapter) ;

        if (response.status != 200) {
            const error = new Error('Failed to create chapters')
            throw response.data.message;
        }
        context.commit('CREATE_CHAPTER', response.data);
    },

    // After permission submits the form, permission information must be updated in database.
    async update(context, chapter) {
        const response = await axios.put(`/api/v1/chapters/${chapter.id}`, chapter);

        if (response.status != 200) {
            const error = new Error('Failed to update course.')
            throw error;
        }

        context.commit('UPDATE_CHAPTER', response.data);
    },

    // This action is used to delete permission from serve.
    async delete(context, id) {
        const response = await axios.delete(`/api/v1/chapters/${id}`);
        if (response.status != 200) {
            const error = new Error('Failed to delete course')
            throw error;
        }
        context.commit('DELETE_CHAPTER', id);
    },
};