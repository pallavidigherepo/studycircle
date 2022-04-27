import axiosClient from "@/axios";

export default {
    // This action is used to fetch all the questions present in database
    async list({ commit }, { url = null } = {}) {
        url = "/questions" + url;
        return await axiosClient.get(url)
            .then(({ data }) => {
                commit('SET_QUESTIONS', data);
                commit('SET_PAGINATION_LINKS', data.meta.links)
                return data;
            });
    },
    
    async create({commit}, chapter) {
        return await axiosClient.post('/questions', chapter)
                .then(({data}) => {
                    if (data.success) {
                        commit('CREATE_QUESTION', data);
                        //return true;
                    } else {
                        const error = new Error(data.message)
                        throw error;
                    }
                });
    },


    // After model submits the form, model information must be updated in database.
    async update({commit}, model) {
        return await axiosClient.put(`/questions/${model.id}`, model)
                .then(({data}) => {
                    if (data.success) {
                        commit('UPDATE_QUESTION', model);
                        //return ;
                    } else {
                        const error = new Error(data.message)
                        throw error;
                    }
                });
    },
    

    // This action is used to delete permission from serve.
    async delete(context, id) {
        const response = await axiosClient.delete(`/questions/${id}`);
        if (response.status != 200) {
            const error = new Error('Failed to delete question')
            throw error;
        }
        context.commit('DELETE_QUESTION', id);
    },
    
};