import axios from 'axios';
import stores from './stores';
import router from './router';

console.log(`${import.meta.env.VITE_API_BASE_URL}`)
const axiosClient = axios.create({
    baseURL: `http://127.0.0.1:8000/api/v1`
});

axiosClient.interceptors.request.use(config => {
    config.headers.Authorization = `Bearer ${stores.state.auth.user.token}`
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
