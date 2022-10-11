import getters from "./getters.js"
import actions from "./actions.js"
import mutations from "./mutations.js"

export default {
    namespaced: true,
    state() {
        return {
            loading: false,
            clients: [],
            client: null,
            pagination: [],
            datatable: {
                export: true,
                import: false,
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
                    },
                    {
                        label: "NAME",
                        field: "client_name",
                        sort: true,
                    },
                    {
                        label: "EMAIL",
                        field: "client_email",
                        sort: true,
                    },
                    {
                        label: "MOBILE",
                        field: "client_phone_number",
                        sort: false,
                    },
                    {
                        label: "SUBDOMAIN",
                        field: "assigned_subdomain",
                        sort: true,
                    },
                    {
                        label: "Actions",
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
    mutations,
    getters,
};
