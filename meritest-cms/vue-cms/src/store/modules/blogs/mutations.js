export default {
    setBlogs: (state, blogs) => {
        state.blogs.data = blogs;
    },
    setBlog: (state, blog) => {
        state.chapters.data.unshift(blog);
    },
};