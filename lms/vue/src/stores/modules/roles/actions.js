import axios from "axios"

export default {
    // This action is used to fetch all the roles present in database
    async fetchRoles(context) {
        const response = await axios.get('/api/v1/roles') ;

        if (response.status != 200) {
            const error = new Error('Failed to fetch roles')
            throw error;
        }
        context.commit('FETCH_ROLES', response.data);
    },
    
    async createRole(context, role) {
        const response = await axios.post('/api/v1/roles', role) ;

        if (response.status != 200) {
            const error = new Error('Failed to fetch roles')
            throw error;
        }
        context.commit('CREATE_ROLE', response.data);
    },

    // This action is used to fetch only selected permission
    async edit(context, id) {
        const response = await axios.get(`/api/v1/roles/${id}/edit`);

        if (response.status != 200) {
            const error = new Error('Failed to fetch role')
            throw error;
        }
        context.commit('EDIT_ROLE', response.data);
    },

    // After role submits the form, role information must be updated in database.
    async updateRole(context, role) {
        const response = await axios.put(`/api/v1/roles/${role.id}`, role);

        if (response.status != 200) {
            const error = new Error('Failed to update role')
            throw error;
        }

        context.commit('UPDATE_ROLE', role);
    },

    // This action is used to delete role from serve.
    async deleteRole(context, id) {
        const response = await axios.delete(`/api/v1/roles/${id}`);
        if (response.status != 200) {
            const error = new Error('Failed to delete role')
            throw error;
        }
        context.commit('DELETE_ROLE', id);
    },
};