export default {
    SET_BOARDS(state, payload) {
        state.boards = payload;
    },

    SET_PAGINATION_LINKS(state, payload) {
        state.pagination = payload;
    },

    CREATE_BOARD(state, payload) {
        state.boards.data.unshift(payload.board)
    },
    EDIT_BOARD(state, payload) {
        state.board = payload.board;
    },

    DELETE_BOARD(state, id) {
        let index = state.boards.data.findIndex(item => item.id === id)
        state.boards.data.splice(index, 1)
    },

    UPDATE_BOARD(state, payload) {
        let index = state.boards.data.findIndex(item => item.id === payload.board.id);
        state.boards.data[index] = payload.board;
    },
};
