import axios from "axios";
import AuthService from "./auth.service";

const publicApi = axios.create({
    baseURL: import.meta.env.VITE_API_URL,
});

const privateApi = axios.create({
    baseURL: import.meta.env.VITE_API_URL,
});

privateApi.interceptors.request.use(
    async (config) => {
        let token = AuthService.getToken();

        if (!token) {
            throw new Error("Nincs érvényes token");
        }

        try {
            const refreshResponse = await publicApi.post(
                "/refresh-token",
                null,
                {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                },
            );
            const { data } = refreshResponse.data;
            token = data.token;
            AuthService.setToken(data);
        } catch (error) {
            AuthService.logout();
            throw new Error(
                "Nem sikerült a token frissítése, jelentkezzen be újra.",
            );
        }

        config.headers.Authorization = `Bearer ${token}`;

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
            AuthService.removeToken();
        }
        return Promise.reject(error);
    },
);

export { publicApi, privateApi };
