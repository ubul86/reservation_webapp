import { publicApi, privateApi } from "./api";

class AuthService {
    login(user) {
        return publicApi
            .post("/login", {
                email: user.username,
                password: user.password,
            })
            .then((response) => {
                if (response.data.token) {
                    localStorage.setItem("user", JSON.stringify(response.data));
                }
                return response.data;
            });
    }

    logout() {
        return privateApi.post("/logout").then((response) => {
            localStorage.removeItem("user");
            return response.data;
        });
    }

    register(user) {
        return publicApi.post("/register", {
            username: user.username,
            email: user.email,
            password: user.password,
        });
    }

    getToken() {
        const user = JSON.parse(localStorage.getItem("user"));
        return user ? user.token : null;
    }
}

export default new AuthService();
