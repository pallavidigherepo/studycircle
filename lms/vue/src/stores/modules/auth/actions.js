import axiosClient from "@/axios";

export default {
    login({commit}, user) {
        return axiosClient.post('/login', user)
            .then(({data}) => {
                commit('setUser', data.user);
                commit('setToken', data.token)
                return data;
            })
    },
    logout({commit}) {
        return axiosClient.post('/logout')
            .then(response => {
            commit('logout')
            return response;
        })
    },
}