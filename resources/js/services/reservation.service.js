import { publicApi } from "./api";

class ReservationService {
    getReservations(date) {
        return publicApi.get(`/reservation/${date}`).then((response) => {
            return response.data;
        });
    }
}

export default new ReservationService();
