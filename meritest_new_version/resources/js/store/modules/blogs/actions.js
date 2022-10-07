import axiosClient from "@/axios.js";

export default {
    async list({ commit }) {
        return await axiosClient.get('/blogs')
            .then(({ data }) => {
                commit('SET_BLOGS', data);
                commit('SET_BLOG_CATEGORIES', data);
                return data;
            });
    },

    async show({commit}, url) {
        return await axiosClient.get(`/blogs/${url}`)
            .then(({ data }) => {
                commit('SET_SHOW_BLOG', data);
                commit('SET_BLOG_CATEGORIES', data);
                return data;
            });
    }
}