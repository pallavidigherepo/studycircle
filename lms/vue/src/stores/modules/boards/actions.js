import axiosClient from "@/axios";

export default {
    // This action is used to fetch all the courses types present in database
    async list({ commit }, { url = null } = {}) {
        url = "/boards" + url;
        return await axiosClient.get(url)
            .then(({ data }) => {
                commit('SET_BOARDS', data);
                commit('SET_PAGINATION_LINKS', data.meta.links)
                return data;
            });
    },

    async save({ commit }, model) {
        let response;

        if (model.id) {
            response = await axiosClient
                .put(`/boards/${model.id}`, model)
                .then(({ data }) => {
                    commit('UPDATE_BOARD', data);
                    return data;
                });
        } else {
            response = await axiosClient
                .post(`/boards`, model)
                .then(({ data }) => {
                    commit('CREATE_BOARD', data);
                    return data;
                });
        }
    },

    // This action is used to delete batch from server.
    async delete({ commit }, id) {
        return await axiosClient
            .delete(`/boards/${id}`)
            .then((res) => {
                commit('DELETE_BOARD', id);
                return res;
            });
    },

};
