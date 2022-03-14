export default {
    logout: (state) => {
        state.user.token = null;
        state.user.data = {};
        sessionStorage.removeItem("TOKEN");
    },

    setUser: (state, user) => {
        state.user.data = user;
    },
    setToken: (state, token) => {
        state.user.token = token;
        sessionStorage.setItem('TOKEN', token);
    },
};