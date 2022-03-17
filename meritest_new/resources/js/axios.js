import axios from 'axios';

//console.log(`${import.meta.env.VITE_API_BASE_URL}`)
const axiosClient = axios.create({
    baseURL: `http://127.0.0.1:1111/api`
});

export default axiosClient;