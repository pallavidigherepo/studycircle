import axiosClient from "@/axios";

export default {
    list({commit}){
        return axiosClient.get('/blogs')
            .then(({data}) => {
                commit('setBlogs', data.blogs)
            })
    },
    create({commit}, blog) {
        return axiosClient.post('/blogs', blog)
            .then(({data}) => {
                commit('setBlog', data.blog);
                return data;
            });
    },
}