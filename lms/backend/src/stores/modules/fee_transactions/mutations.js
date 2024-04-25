export default {
    SET_FEE_TRANSACTIONS(state, payload) {
        state.fee_transactions = payload;
    },

    SET_PAGINATION_LINKS(state, payload) {
        state.pagination = payload;
    },

    CREATE_FEE_TRANSACTION(state, payload) {
        state.fee_transactions.data.unshift(payload.fee_transaction)
    },
    EDIT_FEE_TRANSACTION(state, payload) {
        state.fee_transaction = payload;
    },

    DELETE_FEE_TRANSACTION(state, id) {
        let index = state.fee_transactions.data.findIndex(item => item.id === id)
        state.fee_transactions.data.splice(index, 1)
    },

    UPDATE_FEE_TRANSACTION(state, payload) {
        let index = state.fee_transactions.data.findIndex(item => item.id === payload.fee_transaction.id);
        state.fee_transactions.data[index] = payload.fee_transaction;
    },
};
