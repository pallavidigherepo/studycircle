export default {
    FETCH_ROLES(state, payload) {
        state.roles = payload;
    },
    CREATE_ROLE(state, role)
    {
        state.roles.unshift(role.role)
    },
    EDIT_ROLE(state, payload) {
        state.role = payload;
    },

    DELETE_ROLE(state, id) {
        let index = state.roles.findIndex(item => item.id === id)
        state.roles.splice(index, 1)
    },

    UPDATE_ROLE(state, role)
    {
        let index = state.roles.findIndex(item => item.id === role.id);
        state.roles[index] = role;
    },
};