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

    async save({ commit }, model) {
        let response;

        if (model.id) {
            response = await axiosClient
                .put(`/questions/${model.id}`, model)
                .then(({ data }) => {
                    commit('UPDATE_QUESTION', model);
                    return data;
                });
        } else {
            response = await axiosClient
                .post(`/questions`, model)
                .then(({ data }) => {
                    commit('CREATE_QUESTION', data);
                    return data;
                });
        }
    },

    async show({ commit }, id) {
        let response;

        response = await axiosClient
            .get(`/questions/${id}`)
            .then(({ data }) => {
                console.log(data)
                commit('VIEW_QUESTION', data);
                return data;
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