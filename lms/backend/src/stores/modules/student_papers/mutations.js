export default {
    SET_STUDENT_PAPERS(state, payload) {
        state.student_papers = payload;
    },

    SET_PAGINATION_LINKS(state, payload) {
        state.pagination = payload;
    },
    CREATE_STUDENT_PAPER(state, student_paper) {
        state.student_papers.data.unshift(student_paper.student_paper)
    },
    EDIT_STUDENT_PAPER(state, payload) {
        state.student_paper = payload;
    },

    DELETE_STUDENT_PAPER(state, id) {
        let index = state.student_papers.data.findIndex(item => item.id === id)
        state.student_papers.data.splice(index, 1)
    },

    UPDATE_STUDENT_PAPER(state, student_paper) {
        let index = state.student_papers.data.findIndex(item => item.id === student_paper.id);
        state.student_papers.data[index] = student_paper;
    },

    VIEW_STUDENT_PAPER(state, student_paper) {
        state.student_paper = student_paper;
    }
};
