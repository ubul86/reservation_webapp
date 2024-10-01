import { publicApi } from "./api";

class PlaceService {
    getPlaces() {
        return publicApi.get(`/places`).then((response) => {
            return response.data;
        });
    }
}

export default new PlaceService();
