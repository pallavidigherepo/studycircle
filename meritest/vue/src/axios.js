import axios from 'axios';

//console.log(`${import.meta.env.VITE_API_BASE_URL}`)
const axiosClient = axios.create({
    baseURL: `${import.meta.env.VITE_API_BASE_URL}/api`
});

export default axiosClient;