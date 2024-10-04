export default {
    SET_USER(state, user) {
        state.isAuthenticated = true;
        state.user = user;
        localStorage.setItem("user", JSON.stringify(user));
    },
    SET_USERDATA(state, userData) {
        state.userData = userData;
    },
    LOGOUT(state) {
        state.isAuthenticated = false;
        state.user = null;
        state.userData = null;
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
    },
    ADD_SELECTED_RESERVATION(state, reservation) {
        state.selectedReservations.push(reservation);
    },
    REMOVE_SELECTED_RESERVATION(state, objectToRemove) {
        state.selectedReservations = state.selectedReservations.filter(
            (reservation) =>
                reservation.date !== objectToRemove.date ||
                reservation.hour !== objectToRemove.hour ||
                reservation.placeId !== objectToRemove.placeId,
        );
    },
    DELETE_RESERVATION(state, reservationId) {
        state.reservations = state.reservations.filter(
            (reservation) => reservation.id !== reservationId,
        );
    },
    EMPTY_SELECTED_RESERVATIONS(state) {
        state.selectedReservations = [];
    },
    ADD_CREATED_RESERVATIONS_TO_STORED_RESERVATIONS(
        state,
        createdReservations,
    ) {
        state.reservations.push(...createdReservations);
    },
};
