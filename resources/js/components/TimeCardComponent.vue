<template>
    <v-card
        :class="{
            'hover-disabled': reservation,
            'selected-card': isSelectedReservation(),
        }"
        @click="handleClick"
    >
        <v-card-title class="d-flex justify-center">
            {{ formatHour(hour) }}
        </v-card-title>
        <v-card-text>
            <div
                v-if="reservation && hasPermissionToEdit"
                @click="deleteReservation"
            >
                Delete Reservation
            </div>
        </v-card-text>
    </v-card>
</template>

<script>
import UserService from "@/services/user.service.js";

export default {
    props: {
        reservation: {
            type: Object,
        },
        hour: {
            type: Number,
        },
        placeId: {
            type: String,
        },
        date: {
            type: String,
        },
    },
    computed: {
        hasPermissionToEdit() {
            const { userData } = this.$store.state;
            if (!userData) {
                return false;
            }
            return userData.id === this.reservation.user_id;
        },
    },
    methods: {
        formatHour(hour) {
            return `${hour}:00 - ${hour + 1}:00`;
        },
        handleClick() {
            if (!this.reservation) {
                if (this.isSelectedReservation()) {
                    this.$store.dispatch(
                        "removeReservation",
                        this.getReservationObject(),
                    );
                } else {
                    this.$store.dispatch(
                        "addReservation",
                        this.getReservationObject(),
                    );
                }
            }
        },
        deleteReservation() {
            if (this.reservation) {
                this.$store.dispatch(
                    "deleteReservation",
                    this.getReservationObject(),
                );
            }
        },
        isSelectedReservation() {
            const { hour, placeId } = this;
            const { selectedReservations, selectedDate } = this.$store.state;

            return selectedReservations.some(
                (reservation) =>
                    reservation.date === selectedDate &&
                    reservation.hour === hour &&
                    reservation.placeId === placeId,
            );
        },
        getReservationObject() {
            return {
                date: this.$store.state.selectedDate,
                hour: this.hour,
                placeId: this.placeId,
            };
        },
    },
};
</script>

<style scoped>
.v-card--link.hover-disabled {
    cursor: default !important;
}

.v-card--link:not(.hover-disabled):hover {
    background-color: #f0f0f0;
}

.selected-card {
    background-color: #dcdcdc !important;
}
</style>
