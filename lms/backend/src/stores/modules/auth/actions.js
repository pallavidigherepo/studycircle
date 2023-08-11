import axiosClient from "@/axios";
import store from "@/stores";

export default {
    login({ commit }, user) {
        return axiosClient.post('/login', user)
            .then(({ data }) => {
                commit('setUser', data.user);
                commit('setToken', data.token)
                return data;
            })
            .catch(e => {
                throw new Error('The provided credentials are not correct.');
            })
    },
    forgot_password({ commit }, user) {
        return axiosClient.post('/forgot_password', user)
            .then(({ data }) => {
                //commit('setUser', data.user);
                //commit('setToken', data.token)
                return data;
            })
            .catch(e => {
                throw new Error('The provided credentials are not correct.');
            })
    },
    logout({ commit }) {
        return axiosClient.post('/logout')
            .then(response => {
                commit('logout')
                return response;
            })
    },
    profile({ commit }) {
        return axiosClient.get('/profile')
            .then(({ data }) => {
                commit('userProfile', data)
            })
            .catch((e) => {})
    },
    save({ commit }, payload) {
        return axiosClient.put('/profile/' + payload.id, payload)
            .then(({ data }) => {
                commit('userProfile', data);
            })
            .catch((e) => {})

    }
}
