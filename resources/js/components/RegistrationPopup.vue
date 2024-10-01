<template>
    <div>
        <v-dialog v-model="dialog" persistent max-width="400px">
            <v-card>
                <v-card-title>
                    <span class="headline">Registration</span>
                    <v-spacer></v-spacer>
                    <v-btn icon @click="close">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </v-card-title>

                <v-card-text>
                    <v-form @submit.prevent="registration">
                        <v-text-field
                            v-model="user.name"
                            label="Name"
                            required
                        ></v-text-field>
                        <v-text-field
                            v-model="user.email"
                            label="Email"
                            required
                        ></v-text-field>
                        <v-text-field
                            v-model="user.password"
                            label="Password"
                            type="password"
                            required
                        ></v-text-field>
                        <v-card-actions>
                            <v-btn color="primary" type="submit">Registration</v-btn>
                            <v-btn @click="close">Cancel</v-btn>
                        </v-card-actions>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import { mapState } from "vuex";

export default {
    data() {
        return {
            dialog: this.value,
            user: {
                name: "",
                email: "",
                password: "",
            },
        };
    },
    props: {
        value: Boolean,
    },
    computed: {
        ...mapState(["isAuthenticated"]),
    },
    watch: {
        value(val) {
            this.dialog = val;
        },
        dialog(val) {
            this.$emit("input", val);
        },
    },
    methods: {
        async registration() {
            try {
                await this.$store.dispatch("registration", this.user);
                this.$emit("registration-success");
                this.close();
            } catch (error) {
                console.error("Registration error:", error);
            }
        },
        close() {
            this.dialog = false;
        },
    },
};
</script>
