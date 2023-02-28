import axios from 'axios';

export default {
    async fetch(context, payload) {
        const response = await axios.get('/api/v1/languages');
        if (response.status !== 200) {
            const error = new Error('Failed to fetch permissions')
            throw error;
        }
        context.commit('LANGUAGES', response.data);
    }
}