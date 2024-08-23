<template>
    <v-app>
        <Header />
    </v-app>
</template>

<script>
import Header from "./components/Header.vue";

export default {
    components: {
        Header,
    },
    computed: {
    },
    data() {
        return {
        };
    },
    created() {
        this.$store.dispatch("initializeUser");
    },
};
</script>

<style>
@import "vuetify/dist/vuetify.min.css";
</style>
