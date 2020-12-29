import axios from 'axios';

// global appVar

const api = axios.create({
    baseURL: appVar.baseURL
});

export default api;