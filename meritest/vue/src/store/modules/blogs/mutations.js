export default {
    SET_BLOGS(state, data) {
        state.blogs = data.blogs;
    },

    SET_BLOG_CATEGORIES(state, data) {
        state.blogCategories = data.blogCategories;
    },

    SET_SHOW_BLOG(state, data) {
        state.blog = data.blog;
    }
}