export default {
    isAuthenticated: !!localStorage.getItem("user"),
    user: JSON.parse(localStorage.getItem("user")) || null,
    userId: null,
    userData: JSON.parse(localStorage.getItem("userData")) || null,
    reservations: [],
    selectedDate: new Date().toISOString().substr(0, 10),
    places: [],
    selectedReservations: [],
};
