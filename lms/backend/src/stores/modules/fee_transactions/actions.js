import axios from "axios"
import axiosClient from "@/axios";

export default {
    // This action is used to fetch all the courses types present in database
    async list({ commit }, { url = null } = {}) {
        url = "/fee_transactions" + url;
        return await axiosClient.get(url)
            .then(({ data }) => {
                commit('SET_FEE_TRANSACTION', data);
                commit('SET_PAGINATION_LINKS', data.meta.links)
                return data;
            });
    },

    async save({ commit }, model) {
        let response;

        if (model.id) {
            response = await axiosClient
                .put(`/fee_transactions/${model.id}`, model)
                .then(({ data }) => {
                    commit('UPDATE_FEE_TRANSACTION', data);
                    return data;
                });
        } else {
            response = await axiosClient
                .post(`/fee_transactions`, model)
                .then(({ data }) => {
                    commit('CREATE_FEE_TRANSACTION', data);
                    return data;
                });
        }
    },

    // This action is used to delete coursesType from serve.
    async delete({ commit }, id) {
        return await axiosClient
            .delete(`/fee_transactions/${id}`)
            .then((res) => {
                commit('DELETE_FEE_TRANSACTION', id);
                return res;
            });
    },

};
