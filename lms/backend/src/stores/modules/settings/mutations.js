export default {
    SET_CLIENTS(state, payload) {
        state.clients = payload;
    },

    SET_PAGINATION_LINKS(state, payload) {
        state.pagination = payload;
    },

    CREATE_CLIENT(state, payload)
    {
        state.clients.unshift(payload)
    },
    EDIT_CLIENT(state, payload) {
        state.client = payload;
    },

    DELETE_CLIENT(state, id) {
        let index = state.clients.data.findIndex(item => item.id === id)
        state.clients.data.splice(index, 1)
    },

    UPDATE_CLIENT(state, payload)
    {
        let index = state.clients.findIndex(item => item.id === payload.id);
        state.clients[index] = payload;
    },
};
