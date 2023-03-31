import axiosClient from "@/axios";

export default {
    // This action is used to fetch all the students present in database
    async list({ commit }, { url = null } = {}) {
        url = "/student_papers" + url;
        return await axiosClient.get(url)
            .then(({ data }) => {
                commit('SET_STUDENT_PAPERS', data);
                commit('SET_PAGINATION_LINKS', data.meta.links)
                return data;
            });
    },

    async save({ commit }, model) {
        let response;

        if (model.id) {
            response = await axiosClient
                .put(`/student_papers/${model.id}`, model)
                .then(({ data }) => {
                    commit('UPDATE_STUDENT_PAPER', model);
                    return data;
                });
        } else {
            response = await axiosClient
                .post(`/student_papers`, model)
                .then(({ data }) => {
                    //commit('CREATE_STUDENT_PAPER', data);
                    return data;
                });
        }
    },

    async show({ commit }, id) {
        let response;

        response = await axiosClient
            .get(`/student_papers/${id}`)
            .then(({ data }) => {
                console.log(data)
                commit('VIEW_STUDENT_PAPER', data);
                return data;
            });
    },

    // This action is used to delete permission from serve.
    async delete(context, id) {
        const response = await axiosClient.delete(`/student_papers/${id}`);
        if (response.status !== 200) {
            const error = new Error('Failed to delete student paper')
            throw error;
        }
        context.commit('DELETE_STUDENT_PAPER', id);
    },

};
