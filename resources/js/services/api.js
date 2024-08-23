import axios from "axios";
import AuthService from "./auth.service";

const publicApi = axios.create({
    baseURL: import.meta.env.VITE_API_URL,
});

const privateApi = axios.create({
    baseURL: import.meta.env.VITE_API_URL,
});

privateApi.interceptors.request.use(
    (config) => {
        const token = AuthService.getToken();
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    (error) => {
        return Promise.reject(error);
    },
);

privateApi.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        if (error.response && error.response.status === 401) {
            AuthService.logout();
        }
        return Promise.reject(error);
    },
);

export { publicApi, privateApi };
