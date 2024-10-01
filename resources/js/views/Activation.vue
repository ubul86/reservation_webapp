<template>
    <v-container>
        <v-row justify="center">
            <v-col cols="12" md="8" class="text-center">
                <v-alert v-if="generalError" type="error" dismissible>
                    {{ generalError }}
                </v-alert>

                <v-card>
                    <v-card-title>{{ message }}</v-card-title>
                    <v-alert v-if="success" type="success">
                        Profile activation was successful. Redirecting in {{ countdown }} seconds...
                    </v-alert>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import authService from "@/services/auth.service.js";
import formMixin from "@/mixins/formMixin";

export default {
    mixins: [formMixin],
    data() {
        return {
            message: "Activating your account...",
            success: false,
            countdown: 5,
        };
    },
    created() {
        const { token } = this.$route.params;
        authService
            .activation(token)
            .then(() => {
                this.success = true;
                this.startCountdown();
            })
            .catch((e) => {
                console.log(e);
                this.handleApiError(e);
            });
    },
    methods: {
        startCountdown() {
            const interval = setInterval(() => {
                if (this.countdown > 0) {
                    this.countdown--;
                } else {
                    clearInterval(interval);
                    this.$router.push("/");
                }
            }, 1000);
        },
    },
};
</script>
