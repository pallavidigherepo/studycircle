import axios from 'axios';
import stores from './stores';
import router from './router';

// These changes are made to support multiple domains to work with same codebase and different database.
let axiosClient = axios.create({
    baseURL: `${import.meta.env.VITE_API_BASE_URL}/api/${import.meta.env.VITE_API_CURRENT_VERSION}`
});
if (`${import.meta.env.VITE_PROJECT_NAME}`) {
    axiosClient = axios.create({
        baseURL: `${import.meta.env.VITE_API_BASE_URL}/api/${import.meta.env.VITE_API_CURRENT_VERSION}`
    });
}

axiosClient.interceptors.request.use(config => {
    config.headers.Authorization = `Bearer ${stores.state.auth.user.token}`
    config.headers.Project = `${import.meta.env.VITE_PROJECT_NAME}`
    return config;
});
axiosClient.interceptors.response.use(response => {
    return response;
}, error => {
    if (error.response.status === 401) {
        sessionStorage.removeItem('TOKEN')
        router.push({name: 'Login'})
    } else if (error.response.status === 404) {
        router.push({name: 'NotFound'})
    }
    throw error;
})

export default axiosClient;
