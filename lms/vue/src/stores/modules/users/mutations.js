export default {
    FETCH_USERS(state, payload) {
        state.users = payload;
    },
    CREATE_USER(state, user)
    {
        state.users.unshift(user.user)
    },
    EDIT_USER(state, payload) {
        state.user = payload;
    },

    DELETE_USER(state, id) {
        let index = state.users.findIndex(item => item.id === id)
        state.users.splice(index, 1)
    },

    UPDATE_USER(state, user)
    {
        let index = state.users.findIndex(item => item.id === user.id);
        state.users[index] = user;
    },

    SET_ALLOWED_IMPORT_EXTENSIONS(state, payload) {
        state.allowedImportExtensions = payload;
    }
};