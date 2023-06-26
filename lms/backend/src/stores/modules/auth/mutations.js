export default {
    logout: (state) => {
        state.user.token = null;
        state.user.data = {};
        sessionStorage.removeItem("TOKEN");
        sessionStorage.removeItem("USER");
    },

    setUser: (state, user) => {
        state.user.data = user;
        sessionStorage.setItem('USER', JSON.stringify(user));
    },
    setToken: (state, token) => {
        state.user.token = token;
        sessionStorage.setItem('TOKEN', token);
    },
    userProfile: (state, user) => {
        state.profile = user;
    }
};
