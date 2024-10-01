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
    SET_RESERVATIONS(state, reservations) {
        state.reservations = reservations;
    },
    SET_SELECTED_DATE(state, date) {
        state.selectedDate = date;
    },
    SET_PLACES(state, places) {
        state.places = places;
    }
};
