export default {
    isAuthenticated: !!localStorage.getItem("user"),
    user: JSON.parse(localStorage.getItem("user")) || null,
    userId: null,
    reservations: [],
    selectedDate: new Date().toISOString().substr(0, 10),
    places: []
};
