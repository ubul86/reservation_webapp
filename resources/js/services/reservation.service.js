import {privateApi, publicApi} from "./api";

class ReservationService {
    getReservations(date) {
        return publicApi.get(`/reservation/${date}`).then((response) => {
            return response.data;
        });
    }

    bulkStoreSelectedReservations(selectedReservations) {
        return privateApi
            .post("/reservation/bulk-store", selectedReservations)
            .then((response) => {
                return response.data;
            });
    }
}

export default new ReservationService();
