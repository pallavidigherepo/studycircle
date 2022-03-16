import axios from 'axios';

//console.log(`${import.meta.env.VITE_API_BASE_URL}`)
const axiosClient = axios.create({
    baseURL: `http://127.0.0.1:8000/api`
});

export default axiosClient;