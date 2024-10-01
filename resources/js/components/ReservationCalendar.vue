<template>
    <v-container>
        <DatePickerWithNavigation />
        <v-tabs v-model="tab">
            <v-tab v-for="place in places" :key="place.id">
                {{ place.name }}
            </v-tab>

            <v-tab-item
                v-for="place in places"
                :key="place.id"
                align="center"
                justify="center"
            >
                <v-col
                    v-for="hour in hours"
                    :key="hour"
                    :class="getReservationClass(place.id, hour)"
                    cols="4"
                >
                    <v-card>
                        <v-card-title>{{ formatHour(hour) }}</v-card-title>
                    </v-card>
                </v-col>
            </v-tab-item>
        </v-tabs>
    </v-container>
</template>

<script>
import DatePickerWithNavigation from "./DatePickerWithNavigation.vue";

export default {
    components: {
        DatePickerWithNavigation,
    },
    data() {
        return {
            tab: 0,
            hours: Array.from({ length: 15 }, (_, i) => i + 8)
        };
    },
    computed: {
        places() {
            return this.$store.state.places;
        },
        reservations() {
            return this.$store.state.reservations;
        },
    },
    methods: {
        formatHour(hour) {
            return `${hour}:00`;
        },
        getReservationClass(placeId, hour) {
            const reservation = this.reservations.find(
                (res) => res.place_id === placeId && res.hour === hour,
            );
            return reservation ? "bg-green" : "";
        },
    },
    created() {
        this.$store.dispatch("fetchPlaces");
        this.$store.dispatch("fetchReservations");
    },
};
</script>

<style>
.bg-green {
    background-color: #4caf50 !important;
}
</style>
