import axiosClient from "@/axios";

export default {
    // This action is used to fetch all the users present in database
    async list({ commit }, { url = null } = {}) {
        url = "/client_projects"+url;
        return await axiosClient.get(url)
            .then(({ data }) => {
                commit('SET_CLIENTS', data);
                commit('SET_PAGINATION_LINKS', data.meta.links)
                return data;
            });
    },

    async save({ commit }, model) {
        let response;

        if (model.id) {
            response = await axiosClient
                .put(`/client_projects/${model.id}`, model)
                .then(({ data }) => {
                    //commit('UPDATE_USER', model);
                    return true;
                });
        } else {
            response = await axiosClient
                .post(`/client_projects`, model)
                .then(({ data }) => {
                    //console.log(data)
                    //commit('CREATE_USER', data.user);
                    return true;
                });
        }
    },

    // This action is used to delete client from server.
    async delete({commit}, id) {
        const response = await axiosClient.delete(`/client_projects/${id}`);
        if (response.status !== 200) {
            throw new Error('Failed to delete client');
        }
        commit('DELETE_CLIENT', id);
    },
};
