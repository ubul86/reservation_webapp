<template>
    <div>
        <v-form @submit.prevent="login">
            <v-alert v-if="generalError" type="error" dismissible>
                {{ generalError }}
            </v-alert>
            <v-text-field
                v-model="user.username"
                label="Username"
                :error="!!errors.email"
                :error-messages="errors.email || []"
                required
            ></v-text-field>
            <v-text-field
                v-model="user.password"
                label="Password"
                type="password"
                :error="!!errors.password"
                :error-message="errors.password || []"
                required
            ></v-text-field>
            <v-card-actions>
                <v-btn color="primary" type="submit">Login</v-btn>
            </v-card-actions>
        </v-form>
    </div>
</template>

<script>
import { mapState } from "vuex";
import formMixin from "@/mixins/formMixin";

export default {
    mixins: [formMixin],
    data() {
        return {
            user: {
                username: "",
                password: "",
            },
            generalError: null,
            errors: {},
        };
    },
    computed: {
        ...mapState(["isAuthenticated"]),
    },
    methods: {
        async login() {
            this.resetErrors();

            try {
                await this.$store.dispatch("login", this.user);
                this.$emit("close-auth-popup");
            } catch (error) {
                this.handleApiError(error);
            }
        },

        close() {
            this.dialog = false;
        },
    },
};
</script>
