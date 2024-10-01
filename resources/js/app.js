import Vue from "vue";
import App from "./App.vue";
import store from "./store";
import vuetify from "./plugins/vuetify";
import "./bootstrap";
import router from "./routers";

new Vue({
    el: "#app",
    store,
    vuetify,
    router,
    render: (h) => h(App),
});
