import { publicApi, privateApi } from "./api";

class AuthService {
    login(user) {
        return publicApi
            .post("/login", {
                email: user.username,
                password: user.password,
            })
            .then(async (response) => {
                if (response.data.data.token) {
                    localStorage.setItem(
                        "user",
                        JSON.stringify(response.data.data.token),
                    );
                }
                return response.data.data;
            });
    }

    logout() {
        return privateApi.post("/logout").then((response) => {
            localStorage.removeItem("user");
            localStorage.removeItem("userData");
            return response.data.data;
        });
    }

    removeToken() {
        localStorage.removeItem("user");
        localStorage.removeItem("userData");
    }

    registration(user) {
        return publicApi.post("/registration", {
            name: user.name,
            email: user.email,
            password: user.password,
        });
    }

    getToken() {
        const user = JSON.parse(localStorage.getItem("user"));
        return user ? user.token : null;
    }

    setToken(token) {
        localStorage.setItem("user", JSON.stringify(token));
    }

    activation(token) {
        return publicApi.post("/activation", {
            token,
        });
    }
}

export default new AuthService();
