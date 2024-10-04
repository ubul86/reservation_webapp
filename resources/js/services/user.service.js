import { privateApi } from "./api";

class UserService {
    getUser() {
        return privateApi
            .get("/user")
            .then((response) => response.data.data)
            .catch((error) => {
                console.error("Failed to fetch user data:", error);
                throw error;
            });
    }
}

export default new UserService();
