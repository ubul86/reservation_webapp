<template>
    <div>
        <v-form @submit.prevent="registration">
            <v-alert v-if="generalError" type="error" dismissible>
                {{ generalError }}
            </v-alert>
            <v-text-field
                v-model="user.name"
                label="Name"
                :error="!!errors.name"
                :error-messages="errors.name || []"
                required
            ></v-text-field>
            <v-text-field
                v-model="user.email"
                label="Email"
                :error="!!errors.email"
                :error-messages="errors.email || []"
                required
            ></v-text-field>
            <v-text-field
                v-model="user.password"
                label="Password"
                type="password"
                :error="!!errors.password"
                :error-messages="errors.password || []"
                required
            ></v-text-field>
            <v-card-actions>
                <v-btn color="primary" type="submit">Registration</v-btn>
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
                name: "",
                email: "",
                password: "",
            },
        };
    },
    computed: {
        ...mapState(["isAuthenticated"]),
    },
    methods: {
        async registration() {
            this.resetErrors();

            try {
                await this.$store.dispatch("registration", this.user);
                this.$emit("close-auth-popup");
            } catch (error) {
                this.handleApiError(error);
            }
        },
    },
};
</script>
