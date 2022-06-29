import actions from './actions.js';
import getters from './getters';
import mutations from './mutations';
export default {
    namespaced: true,
    state() {
        return {
            questions: [],
            question: null,
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
                        label: "QUESTION",
                        field: "question",
                        sort: true,
                        isJson: false,
                    },
                    {
                        label: "Subject",
                        field: "subject_id",
                        sort: true,
                        isJson: false,
                    },
                    {
                        label: "CHAPTER",
                        field: "chapter_id",
                        sort: true,
                        isJson: false,
                    },
                    {
                        label: "STANDARD",
                        field: "standard",
                        sort: false,
                        isJson: false,
                    },
                    {
                        label: "BOARD",
                        field: "board",
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