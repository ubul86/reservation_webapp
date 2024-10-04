import AuthService from "@/services/auth.service.js";
import ReservationService from "@/services/reservation.service";
import PlaceService from "@/services/place.service.js";
import UserService from "@/services/user.service.js";

export default {
    initializeUser({ commit }) {
        let userId = localStorage.getItem("user_id");
        if (!userId) {
            userId = `user_${Math.random().toString(36).substr(2, 9)}`;
            localStorage.setItem("user_id", userId);
        }
        commit("SET_USER_ID", userId);
    },

    async login({ commit }, user) {
        try {
            const response = await AuthService.login(user);
            commit("SET_USER", response);

            const userData = await UserService.getUser();
            commit("SET_USERDATA", {
                token: response.token,
                ...userData.user,
            });

            return response;
        } catch (error) {
            console.error("Login failed:", error);
            throw error;
        }
    },
    async registration({ commit }, user) {
        try {
            const response = await AuthService.registration(user);
            return response;
        } catch (error) {
            console.error("Login failed:", error);
            throw error;
        }
    },

    async logout({ commit }) {
        try {
            await AuthService.logout();
            commit("LOGOUT");
        } catch (error) {
            console.error("Logout failed:", error);
            throw error;
        }
    },

    async getUserData({ state, commit }) {
        if (!state.user) {
            return false;
        }
        try {
            const userData = await UserService.getUser();
            commit("SET_USERDATA", {
                ...userData.user,
            });
        } catch (error) {
            console.error("fetch User data failed");
        }
    },

    async fetchPlaces({ commit }) {
        const response = await PlaceService.getPlaces();
        commit("SET_PLACES", response.data);
    },
    async fetchReservations({ commit, state }) {
        const response = await ReservationService.getReservations(
            state.selectedDate,
        );
        commit("SET_RESERVATIONS", response.data);
    },

    addReservation({ commit }, reservation) {
        commit("ADD_SELECTED_RESERVATION", reservation);
    },
    removeReservation({ commit }, reservation) {
        commit("REMOVE_SELECTED_RESERVATION", reservation);
    },

    updateSelectedDate({ commit, dispatch }, date) {
        commit("SET_SELECTED_DATE", date);
        dispatch("fetchReservations");
    },
    async storeSelectedReservations({ state, commit }) {
        try {
            const response =
                await ReservationService.bulkStoreSelectedReservations(
                    state.selectedReservations,
                );
            if (response) {
                commit(
                    "ADD_CREATED_RESERVATIONS_TO_STORED_RESERVATIONS",
                    response.data,
                );
                commit("EMPTY_SELECTED_RESERVATIONS");
            }
        } catch (error) {
            throw error;
        }
    },
    async deleteReservation({ commit }, reservation) {
        try {
            await ReservationService.deleteReservation(reservation.id);
            commit('DELETE_RESERVATION', reservation.id);
        } catch (error) {
            throw error;
        }
    },
};
