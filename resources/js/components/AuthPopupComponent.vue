<template>
    <v-dialog v-model="dialog" max-width="500">
        <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" v-bind="attrs" v-on="on">
                Sign In / Register
            </v-btn>
        </template>

        <v-card>
            <v-card-title>
                <v-tabs
                    v-model="activeTab"
                    background-color="blue lighten-4"
                    centered
                >
                    <v-tab>Login</v-tab>
                    <v-tab>Register</v-tab>
                </v-tabs>
            </v-card-title>

            <v-card-text>
                <v-tabs-items v-model="activeTab">
                    <v-tab-item>
                        <LoginFormComponent
                            @close-auth-popup="closeAuthPopup"
                        />
                    </v-tab-item>
                    <v-tab-item>
                        <RegistrationFormComponent
                            @close-auth-popup="closeAuthPopup"
                        />
                    </v-tab-item>
                </v-tabs-items>
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="dialog = false"
                    >Close</v-btn
                >
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import LoginFormComponent from "@/components/forms/LoginFormComponent.vue";
import RegistrationFormComponent from "@/components/forms/RegistrationFormComponent.vue";

export default {
    components: {
        LoginFormComponent,
        RegistrationFormComponent,
    },
    data() {
        return {
            dialog: false,
            activeTab: 0,
        };
    },
    methods: {
        closeAuthPopup() {
            this.dialog = false;
        },
    },
};
</script>
