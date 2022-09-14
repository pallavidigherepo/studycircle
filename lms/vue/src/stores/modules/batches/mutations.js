export default {
    SET_BATCHES(state, payload) {
        state.batches = payload;
    },

    SET_PAGINATION_LINKS(state, payload) {
        state.pagination = payload;
    },

    CREATE_BATCH(state, batch) {
        state.batches.data.unshift(batch.batch)
    },
    EDIT_BATCH(state, payload) {
        state.batch = payload;
    },

    DELETE_BATCH(state, id) {
        let index = state.batches.data.findIndex(item => item.id === id)
        state.batches.data.splice(index, 1)
    },

    UPDATE_BATCH(state, payload) {
        let index = state.batches.data.findIndex(item => item.id === payload.batch.id);
        state.batches.data[index] = payload.batch;
    },
};
