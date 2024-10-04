<template>
    <div class="wrapper">
        <v-card
            @click="openPopup"
            class="card"
            v-if="selectedReservations.length"
        >
            <v-card-title>
                Selected Reservations: {{ countedReservations }}
            </v-card-title>
        </v-card>
        <v-dialog v-model="dialog" max-width="600px">
            <v-card>
                <v-card-title>
                    <span class="headline">Reservations</span>
                </v-card-title>
                <v-card-text>
                    <v-list>
                        <v-list-item-group>
                            <v-list-item
                                v-for="(
                                    reservation, index
                                ) in selectedReservations"
                                :key="index"
                            >
                                <v-list-item-content>
                                    <v-list-item-title>
                                        <div>
                                            Place:
                                            {{
                                                getReservationPlaceText(
                                                    reservation,
                                                )
                                            }}
                                        </div>
                                        <div>Date: {{ reservation.date }}</div>
                                        <div>
                                            Time:
                                            {{
                                                `${formatHour(reservation.hour)} - ${formatHour(reservation.hour + 1)}`
                                            }}
                                        </div>
                                    </v-list-item-title>
                                </v-list-item-content>
                                <v-list-item-action
                                    @click="removeReservation(reservation)"
                                >
                                    <v-icon>X</v-icon>
                                </v-list-item-action>
                            </v-list-item>
                        </v-list-item-group>
                    </v-list>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        @click="confirmReservations"
                        v-if="selectedReservations.length"
                        >Confirm Reservations</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {
    computed: {
        countedReservations() {
            return this.$store.state.selectedReservations.length;
        },
        selectedReservations() {
            return this.$store.state.selectedReservations;
        },
    },
    data() {
        return {
            dialog: false,
        };
    },
    watch: {
        selectedReservations(newVal) {
            if (!newVal.length) {
                this.dialog = false;
            }
        },
    },
    methods: {
        openPopup() {
            this.dialog = true;
        },
        removeReservation(reservation) {
            this.$store.dispatch("removeReservation", reservation);
        },
        confirmReservations() {
            this.$store.dispatch('storeSelectedReservations')
            this.dialog = false;
        },
        formatHour(hour) {
            return `${hour}:00`;
        },
        getReservationPlaceText(reservation) {
            const { places } = this.$store.state;

            const foundedPlace = places.find(
                (place) => place.id === reservation.placeId,
            );

            return foundedPlace.name;
        },
    },
};
</script>

<style scoped>
.wrapper {
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1000;
}

.card {
    border-radius: 16px;
    padding: 16px;
    background-color: #e0e0e0; /* Válassz ki egy színt */
    cursor: pointer;
}
</style>
