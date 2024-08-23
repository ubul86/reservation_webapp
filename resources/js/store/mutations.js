export default {
    SET_USER(state, user) {
        state.isAuthenticated = true;
        state.user = user;
        localStorage.setItem("user", JSON.stringify(user));
    },
    LOGOUT(state) {
        state.isAuthenticated = false;
        state.user = null;
        localStorage.removeItem("user");
    },
    SET_USER_ID(state, userId) {
        state.userId = userId;
    },
};
