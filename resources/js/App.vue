<template>
    <v-app>
        <Header />
        <v-main>
            <router-view></router-view>
        </v-main>
    </v-app>
</template>

<script>
import Header from "./components/Header.vue";

export default {
    components: {
        Header,
    },
    created() {
        this.$store.dispatch("initializeUser");
        this.$store.dispatch("storeUserLocation");
        this.$store.dispatch("getUserData");
    },
};
</script>
