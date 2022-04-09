import getters from "./getters.js"
import actions from "./actions.js"
import mutations from "./mutations.js"

export default {
    namespaced: true,
    state() {
        return {
            courses: [],
            course: null,
            languages: [],
            courseTypes: [],
            pagination: [],
            datatable: {
                export: true,
                import: true,
                addNew: false,
                defaultColumn: "id",
                defaultOrder: "desc",
                defaultPage: 1,
                defaultSearch: "",
                defaultPerPage: 10,
                columns: [
                    {
                        label: "ID",
                        field: "id",
                        sort: true,
                        isJson: false,
                    },
                    {
                        label: "CODE",
                        field: "course_code",
                        sort: true,
                        isJson: true,
                    },
                    {
                        label: "NAME",
                        field: "name",
                        sort: true,
                        isJson: true,
                    },
                    {
                        label: "ACTIONS",
                        field: false,
                        sort: false,
                        actions: {
                            show: false,
                            edit: true,
                            delete: true,
                        }
                    }
                ]
            }

        }
    },
    actions,
    mutations,
    getters,
};