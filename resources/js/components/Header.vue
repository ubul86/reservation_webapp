<!-- components/Header.vue -->
<template>
    <v-app-bar app>
        <v-toolbar-title>My App</v-toolbar-title>
        <v-spacer></v-spacer>
        <div v-if="!isAuthenticated">
            <v-btn @click="openLoginPopup">Login</v-btn>
        </div>
        <div v-else>
            <v-btn @click="logout">Logout</v-btn>
        </div>
        <v-btn @click="toggleTheme" icon>
            <v-icon :color="iconColorClass">{{ iconName }}</v-icon>
        </v-btn>
        <LoginPopup
            v-model="showLoginPopup"
            @login-success="handleLoginSuccess"
        />
    </v-app-bar>
</template>

<script>
import { mapState, mapActions } from "vuex";
import LoginPopup from "./LoginPopup.vue";

export default {
    components: { LoginPopup },
    computed: {
        ...mapState(["isAuthenticated"]),
        iconColorClass() {
            return this.isDarkMode ? "warning" : "info";
        },
        iconName() {
            return this.isDarkMode
                ? "mdi-white-balance-sunny"
                : "mdi-weather-night";
        },
    },
    data() {
        return {
            isDarkMode: localStorage.getItem("theme") === "dark",
            showLoginPopup: false,
        };
    },
    mounted() {
        this.$vuetify.theme.dark = this.isDarkMode;
    },
    methods: {
        ...mapActions(["logout"]),
        openLoginPopup() {
            this.showLoginPopup = true;
        },
        toggleTheme() {
            this.isDarkMode = !this.isDarkMode;
            localStorage.setItem("theme", this.isDarkMode ? "dark" : "light");
            this.$vuetify.theme.dark = this.isDarkMode;
        },

        handleLoginSuccess(user) {
            this.showLoginPopup = false;
        },
    },
};
</script>

<style>
.v-icon {
    transition: color 0.3s;
}
</style>
