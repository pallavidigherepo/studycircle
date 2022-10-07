import axios from "axios"

export default{
    // This action is used to fetch all the users present in database
    async fetchInstitutes(context) {
        const response = await axios.get('/api/v1/institutes') ;

        if (response.status != 200) {
            const error = new Error('Failed to fetch institutes')
            throw error;
        }
        context.commit('FETCH_INSTITUTES', response.data);
    },
    
};