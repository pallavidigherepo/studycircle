import axios from "axios"

export default {
    // This action is used to fetch all the users present in database
    async fetch(context, params) {
        const response = await axios.get('/api/v1/users?page='+params.page+'&search='+params.keyword+'&field='+params.field+'&sort='+params.sort) ;

        //const response = await axios.get('/api/v1/users') ;

        if (response.status != 200) {
            const error = new Error('Failed to fetch users')
            throw error;
        }
        context.commit('FETCH_USERS', response.data.users);
        context.commit('SET_ALLOWED_IMPORT_EXTENSIONS', response.data.allowedExtensions);
    },
    
    async create(context, user) {
        const response = await axios.post('/api/v1/users', user) ;

        if (response.status != 200) {
            const error = new Error('Failed to fetch users')
            throw error;
        }
        context.commit('CREATE_USER', response.data);
    },

    // This action is used to fetch only selected user
    async edit(context, id) {
        const response = await axios.get(`/api/v1/users/${id}/edit`);

        if (response.status != 200) {
            const error = new Error('Failed to fetch user')
            throw error;
        }
        context.commit('EDIT_USER', response.data.user);
    },

    // After user submits the form, user information must be updated in database.
    async update(context, user) {
        const response = await axios.put(`/api/v1/users/${user.id}`, user);

        if (response.status != 200) {
            const error = new Error('Failed to update user')
            throw error;
        }

        context.commit('UPDATE_USER', user);
    },

    // This action is used to delete user from serve.
    async delete(context, id) {
        const response = await axios.delete(`/api/v1/users/${id}`);
        if (response.status != 200) {
            const error = new Error('Failed to delete user')
            throw error;
        }
        context.commit('DELETE_USER', id);
    },
    
    async checkEmailExists(context, user) {
        return new Promise((resolve, reject) => {
            // Do something here... lets say, a http call using vue-resource
            let apiUrl = `/api/v1/users/check_email_exists/${user.email}/null`;
            if (user.id != '') {
                apiUrl = `/api/v1/users/check_email_exists/${user.email}/${user.id}`
            }
            axios.get(apiUrl).then(response => {
                // http success, call the mutator and change something in state
                resolve(response);  // Let the calling function know that http is done. You may send some data back
            }, error => {
                // http failed, let the calling function know that action did not work out
                reject(error);
            })
        })
    }
};