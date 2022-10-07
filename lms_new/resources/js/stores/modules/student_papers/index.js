import actions from './actions.js';
import getters from './getters';
import mutations from './mutations';
export default {
    namespaced: true,
    state() {
        return {
            student_papers: [],
            student_paper: null,
            languages: [],
            pagination: [],
            datatable: {
                export: true,
                import: true,
                addNew: true,
                defaultColumn: "id",
                defaultOrder: "desc",
                defaultPage: 1,
                defaultSearch: "",
                defaultPerPage: 10,
                columns: [{
                        label: "ID",
                        field: "id",
                        sort: true,
                        isJson: false,
                    },
                    {
                        label: "STUDENT",
                        field: "students.name",
                        sort: true,
                        isJson: false,
                    },
                    {
                        label: "GENERATED PAPER",
                        field: "generated_questions.name",
                        sort: false,
                        isJson: false,
                    },
                    {
                        label: "STANDARD",
                        field: "generated_questions.standard",
                        sort: false,
                        isJson: false,
                    },
                    {
                        label: "BOARD",
                        field: "generated_questions.board",
                        sort: false,
                        isJson: false,
                    },
                    {
                        label: "ACTIONS",
                        field: false,
                        sort: false,
                        actions: {
                            show: true,
                            edit: true,
                            delete: true,
                        }
                    }
                ]
            }
        }
    },
    actions,
    getters,
    mutations
};
