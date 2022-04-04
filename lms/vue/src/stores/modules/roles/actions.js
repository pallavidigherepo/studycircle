import axiosClient from "@/axios";

export default {
    // This action is used to fetch all the roles present in database
    async list({ commit }, { url = null } = {}) {
        url = "/roles"+url;
        return await axiosClient.get(url)
            .then(({ data }) => {
                commit('SET_ROLES', data);
                commit('SET_PAGINATION_LINKS', data.meta.links)
                return data;
            });
    },
    
    async create({commit}, role) {
        return await axiosClient.post('/roles', role)
                .then(({data}) => {
                    if (data.success) {
                        commit('CREATE_ROLE', data);
                        //return true;
                    } else {
                        const error = new Error(data.message)
                        throw error;
                    }
                });
    },

    // This action is used to fetch only selected permission
    async edit(context, id) {
        const response = await axios.get(`/api/v1/roles/${id}/edit`);

        if (response.status != 200) {
            const error = new Error('Failed to fetch role')
            throw error;
        }
        context.commit('EDIT_ROLE', response.data);
    },

    // After role submits the form, role information must be updated in database.
    async update({commit}, role) {
        return await axiosClient.put(`/roles/${role.id}`, role)
                .then(({data}) => {
                    if (data.success) {
                        commit('UPDATE_ROLE', role);
                        //return ;
                    } else {
                        const error = new Error(data.message)
                        throw error;
                    }
                });
    },

    // This action is used to delete role from serve.
    async delete({commit}, id) {
        const response = await axiosClient.delete(`/roles/${id}`);
        if (response.status != 200) {
            const error = new Error('Failed to delete role')
            throw error;
        }
        commit('DELETE_ROLE', id);
    },
};