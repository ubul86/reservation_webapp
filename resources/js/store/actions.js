import AuthService from "@/services/auth.service.js";
import ReservationService from "@/services/reservation.service";
import PlaceService from "@/services/place.service.js";

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

    updateSelectedDate({ commit, dispatch }, date) {
        commit("SET_SELECTED_DATE", date);
        dispatch("fetchReservations");
    },
};
