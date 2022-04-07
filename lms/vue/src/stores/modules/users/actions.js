import axiosClient from "@/axios";

export default {
    // This action is used to fetch all the users present in database
    async list({ commit }, { url = null } = {}) {
        url = "/users"+url;
        return await axiosClient.get(url)
            .then(({ data }) => {
                commit('SET_USERS', data);
                commit('SET_PAGINATION_LINKS', data.meta.links)
                return data;
            });
    },
    
    async create({commit}, user) {
        return await axiosClient.post('/users', user)
                .then(({data}) => {
                    if (data.success) {
                        commit('CREATE_USER', data);
                        //return true;
                    } else {
                        const error = new Error(data.message)
                        throw error;
                    }
                });
    },

    // This action is used to fetch only selected user
    async edit(context, id) {
        const response = await axios.get(`/api/v1/users/${id}/edit`);

        if (response.status != 200) {
            const error = new Error('Failed to fetch user')
            throw error;
        }
        context.commit('EDIT_USER', response.data.user);
    },

    // After user submits the form, user information must be updated in database.
    async update({commit}, user) {
        return await axiosClient.put(`/users/${user.id}`, user)
                .then(({data}) => {
                    if (data.success) {
                        commit('UPDATE_USER', user);
                        //return true;
                    } else {
                        const error = new Error(data.message)
                        throw error;
                    }
                });
    },

    // This action is used to delete user from serve.
    async delete({commit}, id) {
        const response = await axiosClient.delete(`/users/${id}`);
        if (response.status != 200) {
            const error = new Error('Failed to delete user')
            throw error;
        }
        commit('DELETE_USER', id);
    },
    
    async checkEmailExists(context, user) {
        return new Promise((resolve, reject) => {
            // Do something here... lets say, a http call using vue-resource
            let apiUrl = `/api/v1/users/check_email_exists/${user.email}/null`;
            if (user.id != '') {
                apiUrl = `/api/v1/users/check_email_exists/${user.email}/${user.id}`
            }
            axios.get(apiUrl).then(response => {
                // http success, call the mutator and change something in state
                resolve(response);  // Let the calling function know that http is done. You may send some data back
            }, error => {
                // http failed, let the calling function know that action did not work out
                reject(error);
            })
        })
    },


    async role_list({commit}) {
        return await axiosClient.get('/users/role_list')
            .then(({ data }) => {
                commit('SET_ROLE_LIST', data);
                return data;
            });
    }
};