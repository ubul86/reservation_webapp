<template>
    <v-row align="center" justify="center">
        <v-col cols="4" class="d-flex">
            <v-btn icon @click="previousDay">
                <v-icon>mdi-chevron-left</v-icon>
            </v-btn>

            <v-menu
                ref="menu"
                v-model="menu"
                :close-on-content-click="false"
                :nudge-right="40"
                transition="scale-transition"
                offset-y
                min-width="290px"
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                        v-model="selectedDate"
                        label="Select Date"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                    ></v-text-field>
                </template>
                <v-date-picker
                    v-model="selectedDate"
                    @input="save"
                ></v-date-picker>
            </v-menu>

            <v-btn icon @click="nextDay">
                <v-icon>mdi-chevron-right</v-icon>
            </v-btn>
        </v-col>
    </v-row>
</template>

<script>
export default {
    data() {
        return {
            menu: false,
            selectedDate: this.$store.state.selectedDate,
        };
    },
    watch: {
        selectedDate(val) {
            this.$store.dispatch("updateSelectedDate", val);
            this.$router.push(`/reservations/${val}`);
        },
    },
    methods: {
        save(date) {
            this.menu = false;
            this.selectedDate = date;
        },
        previousDay() {
            const previous = new Date(this.selectedDate);
            previous.setDate(previous.getDate() - 1);
            this.selectedDate = previous.toISOString().substr(0, 10);
        },
        nextDay() {
            const next = new Date(this.selectedDate);
            next.setDate(next.getDate() + 1);
            this.selectedDate = next.toISOString().substr(0, 10);
        },
    },
};
</script>
