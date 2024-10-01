<template>
    <v-container>
        <reservation-calendar></reservation-calendar>
    </v-container>
</template>

<script>
import ReservationCalendar from "@/components/ReservationCalendar.vue";

export default {
    components: { ReservationCalendar },
    computed: {},
    data() {},
};
</script>

<style>
@import "vuetify/dist/vuetify.min.css";
</style>
