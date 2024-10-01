<!-- components/Header.vue -->
<template>
    <v-app-bar app>
        <v-toolbar-title>My App</v-toolbar-title>
        <v-spacer></v-spacer>
        <div v-if="!isAuthenticated">
            <AuthPopupComponent
                v-model="showAuthPopup"
                @auth-success="handleAuthSuccess"
            />
        </div>
        <div v-else>
            <v-btn @click="logout">Logout</v-btn>
        </div>
        <v-btn @click="toggleTheme" icon>
            <v-icon :color="iconColorClass">{{ iconName }}</v-icon>
        </v-btn>

    </v-app-bar>
</template>

<script>
import { mapState, mapActions } from "vuex";
import AuthPopupComponent from "@/components/AuthPopupComponent.vue";

export default {
    components: { AuthPopupComponent },
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
            showAuthPopup: false,
        };
    },
    mounted() {
        this.$vuetify.theme.dark = this.isDarkMode;
    },
    methods: {
        ...mapActions(["logout"]),
        openAuthPopup() {
            this.showAuthPopup = true;
        },
        toggleTheme() {
            this.isDarkMode = !this.isDarkMode;
            localStorage.setItem("theme", this.isDarkMode ? "dark" : "light");
            this.$vuetify.theme.dark = this.isDarkMode;
        },
        handleAuthSuccess() {
            this.showAuthPopup = false;
        },
        async logout() {
            try {
                await this.$store.dispatch("logout");
            } catch (error) {
                console.error("Logout error:", error);
            }
        },
    },
};
</script>

<style>
.v-icon {
    transition: color 0.3s;
}
</style>
